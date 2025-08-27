<x-admin-layout>
    <x-slot name="header">
        إضافة فئة جديدة
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
                            <span class="mr-1 text-sm font-medium text-gray-500 md:mr-2">إضافة فئة جديدة</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Form -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900">معلومات الفئة</h2>
                    <p class="text-sm text-gray-600 mt-1">أدخل المعلومات الأساسية للفئة الجديدة</p>
                </div>

                <form method="POST" action="{{ route('admin.categories.store') }}" class="p-6">
                    @csrf

                    <!-- Category Name -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            اسم الفئة <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                               placeholder="مثل: العناية بالجروح">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">سيتم إنشاء الرابط (slug) تلقائياً من اسم الفئة</p>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            وصف الفئة
                        </label>
                        <textarea name="description" id="description" rows="4" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"
                                  placeholder="وصف مختصر عن الفئة ومنتجاتها">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- SEO Section -->
                    <div class="border-t border-gray-100 pt-6 mb-6">
                        <h3 class="text-base font-semibold text-gray-900 mb-4">إعدادات SEO</h3>
                        
                        <!-- Meta Title -->
                        <div class="mb-4">
                            <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">
                                عنوان الصفحة (Meta Title)
                            </label>
                            <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}" maxlength="60"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('meta_title') border-red-500 @enderror"
                                   placeholder="عنوان الصفحة للمحركات البحث">
                            @error('meta_title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">يُفضل أن يكون بين 50-60 حرف</p>
                        </div>

                        <!-- Meta Description -->
                        <div class="mb-4">
                            <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">
                                وصف الصفحة (Meta Description)
                            </label>
                            <textarea name="meta_description" id="meta_description" rows="3" maxlength="160"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('meta_description') border-red-500 @enderror"
                                      placeholder="وصف مختصر للصفحة يظهر في نتائج البحث">{{ old('meta_description') }}</textarea>
                            @error('meta_description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">يُفضل أن يكون بين 150-160 حرف</p>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-6">
                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="is_active" class="mr-2 block text-sm font-medium text-gray-700">
                                فئة مفعلة
                            </label>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">الفئات المفعلة فقط تظهر في الموقع العام</p>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-end space-x-4 space-x-reverse pt-6 border-t border-gray-100">
                        <a href="{{ route('admin.categories.index') }}" 
                           class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                            إلغاء
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                            إنشاء الفئة
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Auto-generate slug from name
        document.getElementById('name').addEventListener('input', function() {
            const name = this.value;
            // Auto-fill meta title if empty
            const metaTitle = document.getElementById('meta_title');
            if (!metaTitle.value) {
                metaTitle.value = name;
            }
        });

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
