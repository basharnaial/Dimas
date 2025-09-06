<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    /**
     * Display a listing of products
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'images']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->string('category'));
            });
        }

        // Sort functionality
        $sortBy = $request->string('sort_by', 'created_at');
        $sortOrder = $request->string('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $products = $query->paginate(15);
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new product
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product
     */
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        // Handle hero image upload
        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $request->file('hero_image')->store('products', 'public');
        }

        $product = Product::create($validated);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');
                
                $product->images()->create([
                    'path' => $path,
                    'sort_order' => $index
                ]);
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'تم إنشاء المنتج بنجاح');
    }

    /**
     * Show the form for editing the specified product
     */
    public function edit(Product $product)
    {
        $product->load(['category', 'images']);
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        // Handle hero image upload
        if ($request->hasFile('hero_image')) {
            // Delete old hero image if exists
            if ($product->hero_image) {
                Storage::disk('public')->delete($product->hero_image);
            }
            $validated['hero_image'] = $request->file('hero_image')->store('products', 'public');
        }

        $product->update($validated);

        // Handle new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');
                
                $product->images()->create([
                    'path' => $path,
                    'sort_order' => $product->images()->count() + $index
                ]);
            }
        }

        // Handle image deletion
        if ($request->filled('delete_images')) {
            $deleteIds = $request->input('delete_images');
            foreach ($deleteIds as $imageId) {
                $image = $product->images()->find($imageId);
                if ($image) {
                    Storage::disk('public')->delete($image->path);
                    $image->delete();
                }
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'تم تحديث المنتج بنجاح');
    }

    /**
     * Remove the specified product
     */
    public function destroy(Product $product)
    {
        // Delete hero image
        if ($product->hero_image) {
            Storage::disk('public')->delete($product->hero_image);
        }
        
        // Delete associated images
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->path);
        }
        
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'تم حذف المنتج بنجاح');
    }

    /**
     * Toggle product status
     */
    public function toggleStatus(Product $product)
    {
        $product->update([
            'is_active' => !$product->is_active
        ]);

        $status = $product->is_active ? 'مفعل' : 'معطل';
        
        return redirect()
            ->route('admin.products.index')
            ->with('success', "تم {$status} المنتج بنجاح");
    }

    /**
     * Bulk actions
     */
    public function bulkAction(Request $request)
    {
        $action = $request->input('action');
        $productIds = $request->input('products', []);

        if (empty($productIds)) {
            return redirect()
                ->route('admin.products.index')
                ->with('error', 'لم يتم تحديد أي منتجات');
        }

        switch ($action) {
            case 'delete':
                Product::whereIn('id', $productIds)->delete();
                $message = 'تم حذف المنتجات المحددة بنجاح';
                break;
                
            case 'activate':
                Product::whereIn('id', $productIds)->update(['is_active' => true]);
                $message = 'تم تفعيل المنتجات المحددة بنجاح';
                break;
                
            case 'deactivate':
                Product::whereIn('id', $productIds)->update(['is_active' => false]);
                $message = 'تم تعطيل المنتجات المحددة بنجاح';
                break;
                
            default:
                return redirect()
                    ->route('admin.products.index')
                    ->with('error', 'إجراء غير صحيح');
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', $message);
    }
}
