<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // GET /api/v1/products
    public function index(Request $request)
    {
        $q = Product::query()->with(['category', 'images']);

        // فلترة بالمنتجات المفعلة فقط (للعرض العام)
        if (!$request->has('include_inactive') || !$request->boolean('include_inactive')) {
            $q->where('is_active', true);
        }

        // فلترة بالقسم (slug)
        if ($request->filled('category')) {
            $slug = $request->string('category');
            $q->whereHas('category', fn($qq) => $qq->where('slug', $slug));
        }

        // بحث باسم/وصف
        if ($request->filled('search')) {
            $s = $request->string('search');
            $q->where(function ($w) use ($s) {
                $w->where('name', 'like', "%{$s}%")
                  ->orWhere('short_description', 'like', "%{$s}%");
            });
        }

        // ترتيب
        if ($request->filled('sort')) {
            $sort = $request->string('sort'); // name,-created_at
            foreach (explode(',', $sort) as $col) {
                $dir = str_starts_with($col, '-') ? 'desc' : 'asc';
                $name = ltrim($col, '-');
                if (in_array($name, ['name', 'created_at', 'sku'])) {
                    $q->orderBy($name, $dir);
                }
            }
        } else {
            $q->latest('id');
        }

        return ProductResource::collection(
            $q->paginate($request->integer('per_page', 12))
        );
    }

    // GET /api/v1/products/{slug}
    public function show(Request $request, Product $product)
    {
        // التحقق من أن المنتج مفعل (إلا إذا كان الطلب يتضمن include_inactive)
        if ((!$request->has('include_inactive') || !$request->boolean('include_inactive')) && !$product->is_active) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        $product->load(['category', 'images']);
        return new ProductResource($product);
    }

    // POST /api/v1/products
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        $product = DB::transaction(function () use ($validated) {
            // أنشئ المنتج
            $images = $validated['images'] ?? null;
            unset($validated['images']);

            /** @var Product $p */
            $p = Product::create($validated);

            // إنشاء الصور إن وُجدت
            if (is_array($images)) {
                $rows = [];
                foreach ($images as $img) {
                    $rows[] = [
                        'product_id' => $p->id,
                        'path'       => $img['path'],
                        'sort_order' => $img['sort_order'] ?? 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                if ($rows) {
                    ProductImage::insert($rows);
                }
            }

            return $p;
        });

        $product->load(['category', 'images']);
        return (new ProductResource($product))
            ->additional(['message' => 'Product created.']);
    }

    // PUT/PATCH /api/v1/products/{slug}
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        DB::transaction(function () use ($product, $validated) {
            $images = $validated['images'] ?? null;
            unset($validated['images']);

            $product->update($validated);

            // مزامنة الصور (بدون ملفات، فقط مسارات/ترتيب)
            if (is_array($images)) {
                // إستراتيجية بسيطة: حذف ثم إدراج (كافي لهذا السيناريو)
                $product->images()->delete();

                $rows = [];
                foreach ($images as $img) {
                    $rows[] = [
                        'product_id' => $product->id,
                        'path'       => $img['path'],
                        'sort_order' => $img['sort_order'] ?? 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                if ($rows) {
                    ProductImage::insert($rows);
                }
            }
        });

        $product->load(['category', 'images']);
        return (new ProductResource($product))
            ->additional(['message' => 'Product updated.']);
    }

    // DELETE /api/v1/products/{slug}
    public function destroy(Product $product)
    {
        $product->images()->delete();
        $product->delete(); // soft delete
        return response()->json(['message' => 'Product deleted.']);
    }
}
