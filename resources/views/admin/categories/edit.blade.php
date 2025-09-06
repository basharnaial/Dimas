<x-admin-layout>
    <x-slot name="header">
        تعديل الفئة: {{ $category->name }}
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            الفئات
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400 rotate-180" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="mr-1 text-sm font-medium text-gray-500 md:mr-2">تعديل: {{ Str::limit($category->name, 30) }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Form -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">تعديل معلومات الفئة</h2>
                            <p class="text-sm text-gray-600 mt-1">آخر تحديث: {{ $category->updated_at->format('Y-m-d H:i') }}</p>
                        </div>
                        <div class="flex items-center space-x-2 space-x-reverse">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $category->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $category->is_active ? 'مفعلة' : 'معطلة' }}
                            </span>
                            <span class="text-sm text-gray-500">{{ $category->products_count ?? 0 }} منتج</span>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="p-6">
                    @csrf
                    @method('PUT')

                    <!-- Category Name - Arabic -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            اسم الفئة (عربي) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                               placeholder="مثل: العناية بالجروح">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">الرابط الحالي: <span class="font-mono text-blue-600">{{ $category->slug }}</span></p>
                    </div>

                    <!-- Category Name - English -->
                    <div class="mb-6">
                        <label for="name_en" class="block text-sm font-medium text-gray-700 mb-2">
                            اسم الفئة (إنجليزي)
                        </label>
                        <input type="text" name="name_en" id="name_en" value="{{ old('name_en', $category->name_en) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('name_en') border-red-500 @enderror"
                               placeholder="e.g: Wound Care">
                        @error('name_en')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description - Arabic -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            وصف الفئة (عربي)
                        </label>
                        <textarea name="description" id="description" rows="4" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"
                                  placeholder="وصف مختصر عن الفئة ومنتجاتها">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description - English -->
                    <div class="mb-6">
                        <label for="description_en" class="block text-sm font-medium text-gray-700 mb-2">
                            وصف الفئة (إنجليزي)
                        </label>
                        <textarea name="description_en" id="description_en" rows="4" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('description_en') border-red-500 @enderror"
                                  placeholder="Brief description about the category and its products">{{ old('description_en', $category->description_en) }}</textarea>
                        @error('description_en')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- SEO Section -->
                    <div class="border-t border-gray-100 pt-6 mb-6">
                        <h3 class="text-base font-semibold text-gray-900 mb-4">إعدادات SEO</h3>
                        
                        <!-- Meta Title - Arabic -->
                        <div class="mb-4">
                            <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">
                                عنوان الصفحة (عربي)
                            </label>
                            <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $category->meta_title) }}" maxlength="60"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('meta_title') border-red-500 @enderror"
                                   placeholder="عنوان الصفحة للمحركات البحث">
                            @error('meta_title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">يُفضل أن يكون بين 50-60 حرف</p>
                        </div>

                        <!-- Meta Title - English -->
                        <div class="mb-4">
                            <label for="meta_title_en" class="block text-sm font-medium text-gray-700 mb-2">
                                عنوان الصفحة (إنجليزي)
                            </label>
                            <input type="text" name="meta_title_en" id="meta_title_en" value="{{ old('meta_title_en', $category->meta_title_en) }}" maxlength="60"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('meta_title_en') border-red-500 @enderror"
                                   placeholder="Category title for search engines">
                            @error('meta_title_en')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Recommended 50-60 characters</p>
                        </div>

                        <!-- Meta Description - Arabic -->
                        <div class="mb-4">
                            <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">
                                وصف الصفحة (عربي)
                            </label>
                            <textarea name="meta_description" id="meta_description" rows="3" maxlength="160"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('meta_description') border-red-500 @enderror"
                                      placeholder="وصف مختصر للصفحة يظهر في نتائج البحث">{{ old('meta_description', $category->meta_description) }}</textarea>
                            @error('meta_description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">يُفضل أن يكون بين 150-160 حرف</p>
                        </div>

                        <!-- Meta Description - English -->
                        <div class="mb-4">
                            <label for="meta_description_en" class="block text-sm font-medium text-gray-700 mb-2">
                                وصف الصفحة (إنجليزي)
                            </label>
                            <textarea name="meta_description_en" id="meta_description_en" rows="3" maxlength="160"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('meta_description_en') border-red-500 @enderror"
                                      placeholder="Brief category description for search results">{{ old('meta_description_en', $category->meta_description_en) }}</textarea>
                            @error('meta_description_en')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Recommended 150-160 characters</p>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-6">
                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="is_active" class="mr-2 block text-sm font-medium text-gray-700">
                                فئة مفعلة
                            </label>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">الفئات المفعلة فقط تظهر في الموقع العام</p>
                        @if($category->products_count > 0 && !$category->is_active)
                            <p class="mt-1 text-sm text-yellow-600">⚠️ تحتوي هذه الفئة على {{ $category->products_count }} منتج. تعطيل الفئة سيخفي جميع منتجاتها.</p>
                        @endif
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                        <div class="flex items-center space-x-4 space-x-reverse">
                            <a href="{{ route('admin.categories.index') }}" 
                               class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                                إلغاء
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                حفظ التعديلات
                            </button>
                        </div>
                    </div>
                </form>
                
                <!-- Delete Form (Outside the update form) -->
                <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-red-600">منطقة الخطر</h3>
                            <p class="text-sm text-gray-600 mt-1">حذف الفئة عملية لا يمكن التراجع عنها</p>
                        </div>
                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="inline" 
                              onsubmit="return confirm('هل أنت متأكد من حذف هذه الفئة؟ سيتم حذف جميع المنتجات المرتبطة بها أيضاً.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors">
                                حذف الفئة
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Category Statistics -->
            @if($category->products_count > 0)
                <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">إحصائيات الفئة</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="text-center p-4 bg-blue-50 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600">{{ $category->products_count }}</div>
                            <div class="text-sm text-gray-600">إجمالي المنتجات</div>
                        </div>
                        <div class="text-center p-4 bg-green-50 rounded-lg">
                            <div class="text-2xl font-bold text-green-600">{{ $category->products()->where('is_active', true)->count() }}</div>
                            <div class="text-sm text-gray-600">المنتجات المفعلة</div>
                        </div>
                        <div class="text-center p-4 bg-yellow-50 rounded-lg">
                            <div class="text-2xl font-bold text-yellow-600">{{ $category->products()->where('is_active', false)->count() }}</div>
                            <div class="text-sm text-gray-600">المنتجات المعطلة</div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Character counter for meta fields
        function addCharacterCounter(fieldId, maxLength) {
            const field = document.getElementById(fieldId);
            const counter = document.createElement('div');
            counter.className = 'text-xs text-gray-400 mt-1 text-left';
            counter.style.direction = 'ltr';
            field.parentNode.appendChild(counter);

            function updateCounter() {
                const remaining = maxLength - field.value.length;
                counter.textContent = `${field.value.length}/${maxLength}`;
                counter.className = remaining < 10 ? 'text-xs text-red-500 mt-1 text-left' : 'text-xs text-gray-400 mt-1 text-left';
            }

            field.addEventListener('input', updateCounter);
            updateCounter();
        }

        // Add character counters
        addCharacterCounter('meta_title', 60);
        addCharacterCounter('meta_description', 160);
    </script>
</x-admin-layout>
