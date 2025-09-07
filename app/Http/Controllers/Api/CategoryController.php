<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
     // GET /api/v1/categories
     public function index(Request $request)
     {
         $q = Category::query()->withCount(['products' => function ($query) {
             $query->where('is_active', true);
         }]);

         // فلترة بالأقسام المفعلة فقط (للعرض العام)
         if (!$request->has('include_inactive') || !$request->boolean('include_inactive')) {
             $q->where('is_active', true);
         }
 
         if ($request->filled('search')) {
             $s = $request->string('search');
             $q->where('name', 'like', "%{$s}%");
         }
 
         return CategoryResource::collection(
             $q->orderBy('name')->paginate($request->integer('per_page', 20))
         );
     }
 
     // GET /api/v1/categories/{slug}
     public function show(Request $request, Category $category)
     {
         // التحقق من أن القسم مفعل (إلا إذا كان الطلب يتضمن include_inactive)
         if ((!$request->has('include_inactive') || !$request->boolean('include_inactive')) && !$category->is_active) {
             return response()->json(['message' => 'Category not found.'], 404);
         }

         $category->loadCount(['products' => function ($query) {
             $query->where('is_active', true);
         }]);
         return new CategoryResource($category);
     }
 
     // POST /api/v1/categories
     public function store(StoreCategoryRequest $request)
     {
         $cat = Category::create($request->validated());
         $cat->loadCount(['products' => function ($query) {
             $query->where('is_active', true);
         }]);
         return (new CategoryResource($cat))
             ->additional(['message' => 'Category created.']);
     }
 
     // PUT/PATCH /api/v1/categories/{slug}
     public function update(UpdateCategoryRequest $request, Category $category)
     {
         $category->update($request->validated());
         $category->loadCount(['products' => function ($query) {
             $query->where('is_active', true);
         }]);
         return (new CategoryResource($category))
             ->additional(['message' => 'Category updated.']);
     }
 
     // DELETE /api/v1/categories/{slug}
     public function destroy(Category $category)
     {
         $category->delete();
         return response()->json(['message' => 'Category deleted.']);
     }
}
