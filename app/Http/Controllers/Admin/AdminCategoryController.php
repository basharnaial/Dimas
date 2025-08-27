<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of categories
     */
    public function index(Request $request)
    {
        $query = Category::withCount('products');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Sort functionality
        $sortBy = $request->string('sort_by', 'created_at');
        $sortOrder = $request->string('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $categories = $query->paginate(15);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string|max:1000',
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
            'sort_order' => 'nullable|integer|min:0'
        ]);

        // Generate slug from name
        $validated['slug'] = Str::slug($validated['name']);
        
        // Handle checkbox - if not present in request, it means unchecked (false)
        $validated['is_active'] = $request->has('is_active') ? true : false;
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Category::create($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'تم إنشاء الفئة بنجاح');
    }

    /**
     * Show the form for editing the specified category
     */
    public function edit(Category $category)
    {
        $category->loadCount('products');
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified category
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:1000',
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160',
            'sort_order' => 'nullable|integer|min:0'
        ]);

        // Generate slug from name, but check for uniqueness
        $newSlug = Str::slug($validated['name']);
        
        // If the new slug is different from current slug, ensure it's unique
        if ($newSlug !== $category->slug) {
            $baseSlug = $newSlug;
            $counter = 1;
            while (Category::where('slug', $newSlug)->where('id', '!=', $category->id)->exists()) {
                $newSlug = $baseSlug . '-' . $counter;
                $counter++;
            }
        }
        
        $validated['slug'] = $newSlug;
        
        // Handle checkbox - if not present in request, it means unchecked (false)
        $validated['is_active'] = $request->has('is_active') ? true : false;
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        try {
            // Log the update attempt for debugging
            \Log::info('Attempting to update category', [
                'category_id' => $category->id,
                'category_name' => $category->name,
                'validated_data' => $validated
            ]);
            
            $category->update($validated);
            
            // Log successful update
            \Log::info('Category updated successfully', [
                'category_id' => $category->id,
                'new_name' => $category->fresh()->name
            ]);
            
            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'تم تحديث الفئة بنجاح');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error updating category', [
                'category_id' => $category->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'حدث خطأ أثناء تحديث الفئة: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified category
     */
    public function destroy(Category $category)
    {
        // Log the delete attempt
        \Log::info('Attempting to delete category', [
            'category_id' => $category->id,
            'category_name' => $category->name,
            'products_count' => $category->products()->count()
        ]);
        
        // Check if category has products
        if ($category->products()->count() > 0) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', 'لا يمكن حذف الفئة لأنها تحتوي على منتجات');
        }

        $category->delete();
        
        \Log::info('Category deleted successfully', [
            'category_id' => $category->id,
            'category_name' => $category->name
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'تم حذف الفئة بنجاح');
    }

    /**
     * Toggle category status
     */
    public function toggleStatus(Category $category)
    {
        $category->update([
            'is_active' => !$category->is_active
        ]);

        $status = $category->is_active ? 'مفعلة' : 'معطلة';
        
        return redirect()
            ->route('admin.categories.index')
            ->with('success', "تم {$status} الفئة بنجاح");
    }

    /**
     * Bulk actions
     */
    public function bulkAction(Request $request)
    {
        $action = $request->input('action');
        $categoryIds = $request->input('categories', []);

        if (empty($categoryIds)) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', 'لم يتم تحديد أي فئات');
        }

        switch ($action) {
            case 'delete':
                // Check if any category has products
                $categoriesWithProducts = Category::whereIn('id', $categoryIds)
                    ->whereHas('products')
                    ->count();
                
                if ($categoriesWithProducts > 0) {
                    return redirect()
                        ->route('admin.categories.index')
                        ->with('error', 'لا يمكن حذف بعض الفئات لأنها تحتوي على منتجات');
                }
                
                Category::whereIn('id', $categoryIds)->delete();
                $message = 'تم حذف الفئات المحددة بنجاح';
                break;
                
            case 'activate':
                Category::whereIn('id', $categoryIds)->update(['is_active' => true]);
                $message = 'تم تفعيل الفئات المحددة بنجاح';
                break;
                
            case 'deactivate':
                Category::whereIn('id', $categoryIds)->update(['is_active' => false]);
                $message = 'تم تعطيل الفئات المحددة بنجاح';
                break;
                
            default:
                return redirect()
                    ->route('admin.categories.index')
                    ->with('error', 'إجراء غير صحيح');
        }

        return redirect()
            ->route('admin.categories.index')
            ->with('success', $message);
    }

    /**
     * Reorder categories
     */
    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'categories' => 'required|array',
            'categories.*.id' => 'required|exists:categories,id',
            'categories.*.sort_order' => 'required|integer|min:0'
        ]);

        foreach ($validated['categories'] as $categoryData) {
            Category::where('id', $categoryData['id'])
                ->update(['sort_order' => $categoryData['sort_order']]);
        }

        return response()->json(['message' => 'تم إعادة ترتيب الفئات بنجاح']);
    }
}
