<x-admin-layout>
    <x-slot name="header">
        إدارة الفئات
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Actions -->
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center space-x-4">
                    <h1 class="text-2xl font-semibold text-gray-900">الفئات</h1>
                    <span class="text-gray-500">({{ $categories->total() }} فئة)</span>
                </div>
                <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    إضافة فئة جديدة
                </a>
            </div>

            <!-- Search and Filters -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-6">
                <form method="GET" action="{{ route('admin.categories.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">البحث</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" 
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                               placeholder="اسم الفئة أو الوصف">
                    </div>
                    
                    <div>
                        <label for="sort_by" class="block text-sm font-medium text-gray-700 mb-1">ترتيب حسب</label>
                        <select name="sort_by" id="sort_by" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>تاريخ الإنشاء</option>
                            <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>الاسم</option>
                            <option value="products_count" {{ request('sort_by') == 'products_count' ? 'selected' : '' }}>عدد المنتجات</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">الترتيب</label>
                        <select name="sort_order" id="sort_order" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>تنازلي</option>
                            <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>تصاعدي</option>
                        </select>
                    </div>
                    
                    <div class="md:col-span-3 flex justify-end">
                        <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            تطبيق الفلتر
                        </button>
                    </div>
                </form>
            </div>

            <!-- Bulk Actions -->
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-6">
                <form method="POST" action="{{ route('admin.categories.bulk-action') }}" id="bulk-action-form">
                    @csrf
                    <div class="flex items-center space-x-4">
                        <select name="action" class="border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">اختر الإجراء</option>
                            <option value="delete">حذف المحدد</option>
                            <option value="activate">تفعيل المحدد</option>
                            <option value="deactivate">تعطيل المحدد</option>
                        </select>
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            تطبيق
                        </button>
                    </div>
                </form>
            </div>

            <!-- Categories Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($categories as $category)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="p-6">
                            <!-- Category Header -->
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <div class="flex items-center mb-2">
                                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" form="bulk-action-form" 
                                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 ml-3">
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $category->name }}</h3>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-2">{{ Str::limit($category->description, 100) }}</p>
                                    <div class="flex items-center space-x-4 space-x-reverse">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $category->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $category->is_active ? 'مفعلة' : 'معطلة' }}
                                        </span>
                                        <span class="text-sm text-gray-500">{{ $category->products_count }} منتج</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Category Actions -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex items-center space-x-2 space-x-reverse">
                                    <a href="{{ route('admin.categories.edit', $category) }}" 
                                       class="text-blue-600 hover:text-blue-800 text-sm font-medium">تعديل</a>
                                    <form method="POST" action="{{ route('admin.categories.toggle-status', $category) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-yellow-600 hover:text-yellow-800 text-sm font-medium">
                                            {{ $category->is_active ? 'تعطيل' : 'تفعيل' }}
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="inline" 
                                          onsubmit="return confirm('هل أنت متأكد من حذف هذه الفئة؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">حذف</button>
                                    </form>
                                </div>
                                <div class="text-xs text-gray-400">
                                    {{ $category->created_at->format('Y-m-d') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">لا توجد فئات</h3>
                            <p class="mt-1 text-sm text-gray-500">ابدأ بإضافة فئة جديدة لتصنيف منتجاتك.</p>
                            <div class="mt-6">
                                <a href="{{ route('admin.categories.create') }}" 
                                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700">
                                    إضافة فئة جديدة
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($categories->hasPages())
                <div class="mt-8">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        // Select all functionality
        document.getElementById('select-all')?.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('input[name="categories[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    </script>
</x-admin-layout>
