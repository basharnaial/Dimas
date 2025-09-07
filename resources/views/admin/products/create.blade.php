<x-admin-layout>
    <x-slot name="header">
        إضافة منتج جديد
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            المنتجات
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400 rotate-180" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="mr-1 text-sm font-medium text-gray-500 md:mr-2">إضافة منتج جديد</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Basic Information -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h2 class="text-lg font-semibold text-gray-900">المعلومات الأساسية</h2>
                        <p class="text-sm text-gray-600 mt-1">أدخل المعلومات الأساسية للمنتج</p>
                    </div>

                    <div class="p-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Product Name - Arabic -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                اسم المنتج (عربي) <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                                   placeholder="مثل: جهاز تعقيم بالأشعة فوق البنفسجية">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Product Name - English -->
                        <div>
                            <label for="name_en" class="block text-sm font-medium text-gray-700 mb-2">
                                اسم المنتج (إنجليزي)
                            </label>
                            <input type="text" name="name_en" id="name_en" value="{{ old('name_en') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('name_en') border-red-500 @enderror"
                                   placeholder="e.g: UV Sterilization Device">
                            @error('name_en')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- SKU -->
                        <div>
                            <label for="sku" class="block text-sm font-medium text-gray-700 mb-2">
                                رمز المنتج (SKU) <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="sku" id="sku" value="{{ old('sku') }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('sku') border-red-500 @enderror"
                                   placeholder="مثل: UV-STER-001">
                            @error('sku')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                الفئة <span class="text-red-500">*</span>
                            </label>
                            <select name="category_id" id="category_id" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('category_id') border-red-500 @enderror">
                                <option value="">اختر الفئة</option>
                                @forelse($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @empty
                                    <option value="" disabled>لا توجد فئات متاحة</option>
                                @endforelse
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @if($categories->isEmpty())
                                <p class="mt-1 text-sm text-yellow-600">
                                    ⚠️ لا توجد فئات مفعلة. <a href="{{ route('admin.categories.create') }}" class="text-blue-600 hover:text-blue-800">إنشاء فئة جديدة</a>
                                </p>
                            @endif
                        </div>

                        <!-- Short Description - Arabic -->
                        <div>
                            <label for="short_description" class="block text-sm font-medium text-gray-700 mb-2">
                                وصف مختصر (عربي) <span class="text-red-500">*</span>
                            </label>
                            <textarea name="short_description" id="short_description" rows="3" required
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('short_description') border-red-500 @enderror"
                                      placeholder="وصف مختصر يظهر في قوائم المنتجات">{{ old('short_description') }}</textarea>
                            @error('short_description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Short Description - English -->
                        <div>
                            <label for="short_description_en" class="block text-sm font-medium text-gray-700 mb-2">
                                وصف مختصر (إنجليزي)
                            </label>
                            <textarea name="short_description_en" id="short_description_en" rows="3"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('short_description_en') border-red-500 @enderror"
                                      placeholder="Short description for product listings">{{ old('short_description_en') }}</textarea>
                            @error('short_description_en')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Full Description - Arabic -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                الوصف الكامل (عربي)
                            </label>
                            <textarea name="description" id="description" rows="6"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"
                                      placeholder="وصف تفصيلي عن المنتج وفوائده واستخداماته">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Full Description - English -->
                        <div>
                            <label for="description_en" class="block text-sm font-medium text-gray-700 mb-2">
                                الوصف الكامل (إنجليزي)
                            </label>
                            <textarea name="description_en" id="description_en" rows="6"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('description_en') border-red-500 @enderror"
                                      placeholder="Detailed description about the product and its benefits">{{ old('description_en') }}</textarea>
                            @error('description_en')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Product Images -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h2 class="text-lg font-semibold text-gray-900">صور المنتج</h2>
                        <p class="text-sm text-gray-600 mt-1">أضف صور عالية الجودة للمنتج</p>
                    </div>

                    <div class="p-6">
                        <!-- Hero Image -->
                        <div class="mb-6">
                            <label for="hero_image" class="block text-sm font-medium text-gray-700 mb-2">
                                الصورة الرئيسية <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="hero_image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                            <span>اختر ملف</span>
                                            <input id="hero_image" name="hero_image" type="file" class="sr-only" accept="image/*" required>
                                        </label>
                                        <p class="pr-1">أو اسحب واتركه هنا</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF حتى 10MB</p>
                                </div>
                            </div>
                            @error('hero_image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Additional Images -->
                        <div>
                            <label for="images" class="block text-sm font-medium text-gray-700 mb-2">
                                صور إضافية
                            </label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="images" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                            <span>اختر ملفات متعددة</span>
                                            <input id="images" name="images[]" type="file" class="sr-only" accept="image/*" multiple>
                                        </label>
                                        <p class="pr-1">أو اسحب واتركها هنا</p>
                                    </div>
                                    <p class="text-xs text-gray-500">يمكن اختيار عدة صور PNG, JPG, GIF حتى 10MB لكل صورة</p>
                                </div>
                            </div>
                            @error('images')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Product Specifications (الحقول الحرة) - HIDDEN -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100" style="display: none;">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h2 class="text-lg font-semibold text-gray-900">مواصفات المنتج</h2>
                        <p class="text-sm text-gray-600 mt-1">أضف المواصفات التقنية والخصائص</p>
                    </div>

                    <div class="p-6">
                        <div id="specs-container">
                            <div class="spec-item grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">اسم المواصفة</label>
                                    <input type="text" name="specs[0][key]" placeholder="مثل: الأبعاد" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">القيمة</label>
                                    <input type="text" name="specs[0][value]" placeholder="مثل: 30 × 40 × 50 سم" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="button" id="add-spec" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors">
                                إضافة مواصفة أخرى
                            </button>
                            <button type="button" id="remove-spec" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors" style="display: none;">
                                حذف المواصفة الأخيرة
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Dynamic Option Tables -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h2 class="text-lg font-semibold text-gray-900">جداول المنتج الديناميكية</h2>
                        <p class="text-sm text-gray-600 mt-1">أضف جداول مخصصة مثل معلومات الطلب أو الأحجام المتاحة</p>
                        <div class="mt-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                ملاحظة: العناوين والأعمدة يمكن إدخالها باللغتين
                            </span>
                        </div>
                    </div>

                    <div class="p-6">
                        <div id="option-tables-container">
                            <!-- Tables will be added dynamically -->
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="button" id="add-option-table" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                إضافة جدول جديد
                            </button>
                            <button type="button" id="remove-option-table" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors" style="display: none;">
                                حذف الجدول الأخير
                            </button>
                        </div>
                    </div>
                </div>

                <!-- SEO Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h2 class="text-lg font-semibold text-gray-900">إعدادات SEO</h2>
                        <p class="text-sm text-gray-600 mt-1">تحسين المنتج لمحركات البحث</p>
                    </div>

                    <div class="p-6 grid grid-cols-1 gap-6">
                        <!-- Meta Title - Arabic -->
                        <div>
                            <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">
                                عنوان الصفحة (عربي)
                            </label>
                            <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}" maxlength="60"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('meta_title') border-red-500 @enderror"
                                   placeholder="عنوان الصفحة للمحركات البحث">
                            @error('meta_title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">يُفضل أن يكون بين 50-60 حرف</p>
                        </div>

                        <!-- Meta Title - English -->
                        <div>
                            <label for="meta_title_en" class="block text-sm font-medium text-gray-700 mb-2">
                                عنوان الصفحة (إنجليزي)
                            </label>
                            <input type="text" name="meta_title_en" id="meta_title_en" value="{{ old('meta_title_en') }}" maxlength="60"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('meta_title_en') border-red-500 @enderror"
                                   placeholder="Page title for search engines">
                            @error('meta_title_en')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Recommended 50-60 characters</p>
                        </div>

                        <!-- Meta Description - Arabic -->
                        <div>
                            <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">
                                وصف الصفحة (عربي)
                            </label>
                            <textarea name="meta_description" id="meta_description" rows="3" maxlength="160"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('meta_description') border-red-500 @enderror"
                                      placeholder="وصف مختصر للصفحة يظهر في نتائج البحث">{{ old('meta_description') }}</textarea>
                            @error('meta_description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">يُفضل أن يكون بين 150-160 حرف</p>
                        </div>

                        <!-- Meta Description - English -->
                        <div>
                            <label for="meta_description_en" class="block text-sm font-medium text-gray-700 mb-2">
                                وصف الصفحة (إنجليزي)
                            </label>
                            <textarea name="meta_description_en" id="meta_description_en" rows="3" maxlength="160"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('meta_description_en') border-red-500 @enderror"
                                      placeholder="Short page description for search results">{{ old('meta_description_en') }}</textarea>
                            @error('meta_description_en')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Recommended 150-160 characters</p>
                        </div>
                    </div>
                </div>

                <!-- Status & Actions -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <!-- Hidden input to ensure is_active is always sent -->
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="is_active" class="mr-2 block text-sm font-medium text-gray-700">
                                    منتج مفعل
                                </label>
                            </div>

                            <div class="flex items-center space-x-4 space-x-reverse">
                                <a href="{{ route('admin.products.index') }}" 
                                   class="px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                                    إلغاء
                                </a>
                                <button type="submit" 
                                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                    إنشاء المنتج
                                </button>
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">المنتجات المفعلة فقط تظهر في الموقع العام</p>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        let specCount = 1;

        // Add specification
        document.getElementById('add-spec').addEventListener('click', function() {
            const container = document.getElementById('specs-container');
            const newSpec = document.createElement('div');
            newSpec.className = 'spec-item grid grid-cols-1 md:grid-cols-2 gap-4 mb-4';
            newSpec.innerHTML = `
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">اسم المواصفة</label>
                    <input type="text" name="specs[${specCount}][key]" placeholder="مثل: الوزن" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">القيمة</label>
                    <input type="text" name="specs[${specCount}][value]" placeholder="مثل: 2.5 كجم" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>
            `;
            container.appendChild(newSpec);
            specCount++;

            // Show remove button if more than one spec
            if (specCount > 1) {
                document.getElementById('remove-spec').style.display = 'block';
            }
        });

        // Remove specification
        document.getElementById('remove-spec').addEventListener('click', function() {
            const container = document.getElementById('specs-container');
            const specs = container.querySelectorAll('.spec-item');
            if (specs.length > 1) {
                container.removeChild(specs[specs.length - 1]);
                specCount--;
            }

            // Hide remove button if only one spec left
            if (container.querySelectorAll('.spec-item').length <= 1) {
                this.style.display = 'none';
            }
        });

        // Auto-fill meta title from product name
        document.getElementById('name').addEventListener('input', function() {
            const metaTitle = document.getElementById('meta_title');
            if (!metaTitle.value) {
                metaTitle.value = this.value;
            }
        });

        // Character counters for meta fields
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

        addCharacterCounter('meta_title', 60);
        addCharacterCounter('meta_description', 160);

        // File upload preview
        function setupFilePreview(inputId) {
            const input = document.getElementById(inputId);
            input.addEventListener('change', function(e) {
                const files = e.target.files;
                if (files.length > 0) {
                    const parent = input.closest('.border-dashed');
                    parent.style.borderColor = '#10b981';
                    parent.style.backgroundColor = '#f0fdf4';
                }
            });
        }

        setupFilePreview('hero_image');
        setupFilePreview('images');

        // Option Tables Management
        let optionTableCount = 0;

        // Add option table
        document.getElementById('add-option-table').addEventListener('click', function() {
            const container = document.getElementById('option-tables-container');
            const tableDiv = document.createElement('div');
            tableDiv.className = 'option-table border border-gray-200 rounded-lg p-4 mb-4';
            tableDiv.setAttribute('data-table-index', optionTableCount);
            
            tableDiv.innerHTML = `
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-md font-medium text-gray-800">جدول #${optionTableCount + 1}</h4>
                    <button type="button" class="text-red-600 hover:text-red-800" onclick="removeOptionTable(this)">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Table Title - Arabic -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">عنوان الجدول (عربي)</label>
                    <input type="text" name="option_tables[${optionTableCount}][title]" 
                           placeholder="مثل: معلومات الطلب" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <!-- Table Title - English -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">عنوان الجدول (إنجليزي)</label>
                    <input type="text" name="option_tables[${optionTableCount}][title_en]" 
                           placeholder="e.g: Ordering Information" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Table Description - Arabic -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">وصف الجدول (عربي)</label>
                    <textarea name="option_tables[${optionTableCount}][description]" 
                              placeholder="وصف مختصر عن محتوى الجدول"
                              rows="2"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <!-- Table Description - English -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">وصف الجدول (إنجليزي)</label>
                    <textarea name="option_tables[${optionTableCount}][description_en]" 
                              placeholder="Brief description about table content"
                              rows="2"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                
                <!-- Column Count -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">عدد الأعمدة</label>
                    <input type="number" min="1" max="10" value="3" 
                           class="column-count-input w-20 px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                           onchange="updateTableColumns(this, ${optionTableCount})">
                </div>
                
                <!-- Columns - Arabic -->
                <div class="columns-container mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">أسماء الأعمدة (عربي)</label>
                    <div class="columns-grid grid grid-cols-1 md:grid-cols-3 gap-3">
                        <input type="text" name="option_tables[${optionTableCount}][columns][0]" placeholder="العمود الأول" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <input type="text" name="option_tables[${optionTableCount}][columns][1]" placeholder="العمود الثاني" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <input type="text" name="option_tables[${optionTableCount}][columns][2]" placeholder="العمود الثالث" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                
                <!-- Columns - English -->
                <div class="columns-container-en mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">أسماء الأعمدة (إنجليزي)</label>
                    <div class="columns-grid-en grid grid-cols-1 md:grid-cols-3 gap-3">
                        <input type="text" name="option_tables[${optionTableCount}][columns_en][0]" placeholder="First Column" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <input type="text" name="option_tables[${optionTableCount}][columns_en][1]" placeholder="Second Column" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <input type="text" name="option_tables[${optionTableCount}][columns_en][2]" placeholder="Third Column" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                
                <!-- Rows -->
                <div class="rows-container">
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-sm font-medium text-gray-700">صفوف البيانات</label>
                        <div>
                            <button type="button" class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-sm rounded" onclick="addTableRow(this, ${optionTableCount})">إضافة صف</button>
                            <button type="button" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-sm rounded" onclick="removeTableRow(this, ${optionTableCount})">حذف صف</button>
                        </div>
                    </div>
                    <div class="rows-grid">
                        <div class="row-item grid grid-cols-1 md:grid-cols-3 gap-3 mb-2">
                            <input type="text" name="option_tables[${optionTableCount}][rows][0][0]" placeholder="قيمة العمود الأول" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <input type="text" name="option_tables[${optionTableCount}][rows][0][1]" placeholder="قيمة العمود الثاني" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <input type="text" name="option_tables[${optionTableCount}][rows][0][2]" placeholder="قيمة العمود الثالث" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>
            `;
            
            container.appendChild(tableDiv);
            optionTableCount++;
            
            // Show remove button if more than one table
            if (optionTableCount > 0) {
                document.getElementById('remove-option-table').style.display = 'block';
            }
        });

        // Remove option table
        document.getElementById('remove-option-table').addEventListener('click', function() {
            const container = document.getElementById('option-tables-container');
            const tables = container.querySelectorAll('.option-table');
            if (tables.length > 0) {
                container.removeChild(tables[tables.length - 1]);
                optionTableCount--;
            }
            
            // Hide remove button if no tables left
            if (container.querySelectorAll('.option-table').length === 0) {
                this.style.display = 'none';
            }
        });

        // Helper functions for table management
        window.removeOptionTable = function(button) {
            const tableDiv = button.closest('.option-table');
            tableDiv.remove();
            
            // Hide remove button if no tables left
            const container = document.getElementById('option-tables-container');
            if (container.querySelectorAll('.option-table').length === 0) {
                document.getElementById('remove-option-table').style.display = 'none';
            }
        };

        window.updateTableColumns = function(input, tableIndex) {
            const columnCount = parseInt(input.value);
            const tableDiv = input.closest('.option-table');
            const columnsGrid = tableDiv.querySelector('.columns-grid');
            const rowsContainer = tableDiv.querySelector('.rows-grid');
            
            // Update columns
            columnsGrid.innerHTML = '';
            columnsGrid.className = `columns-grid grid grid-cols-1 md:grid-cols-${Math.min(columnCount, 4)} gap-3`;
            
            for (let i = 0; i < columnCount; i++) {
                const columnInput = document.createElement('input');
                columnInput.type = 'text';
                columnInput.name = `option_tables[${tableIndex}][columns][${i}]`;
                columnInput.placeholder = `العمود ${i + 1}`;
                columnInput.className = 'px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500';
                columnsGrid.appendChild(columnInput);
            }
            
            // Update existing rows
            const rows = rowsContainer.querySelectorAll('.row-item');
            rows.forEach((row, rowIndex) => {
                row.innerHTML = '';
                row.className = `row-item grid grid-cols-1 md:grid-cols-${Math.min(columnCount, 4)} gap-3 mb-2`;
                
                for (let i = 0; i < columnCount; i++) {
                    const cellInput = document.createElement('input');
                    cellInput.type = 'text';
                    cellInput.name = `option_tables[${tableIndex}][rows][${rowIndex}][${i}]`;
                    cellInput.placeholder = `قيمة العمود ${i + 1}`;
                    cellInput.className = 'px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500';
                    row.appendChild(cellInput);
                }
            });
        };

        window.addTableRow = function(button, tableIndex) {
            const tableDiv = button.closest('.option-table');
            const rowsGrid = tableDiv.querySelector('.rows-grid');
            const columnCount = parseInt(tableDiv.querySelector('.column-count-input').value);
            const currentRowCount = rowsGrid.querySelectorAll('.row-item').length;
            
            const rowDiv = document.createElement('div');
            rowDiv.className = `row-item grid grid-cols-1 md:grid-cols-${Math.min(columnCount, 4)} gap-3 mb-2`;
            
            for (let i = 0; i < columnCount; i++) {
                const cellInput = document.createElement('input');
                cellInput.type = 'text';
                cellInput.name = `option_tables[${tableIndex}][rows][${currentRowCount}][${i}]`;
                cellInput.placeholder = `قيمة العمود ${i + 1}`;
                cellInput.className = 'px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500';
                rowDiv.appendChild(cellInput);
            }
            
            rowsGrid.appendChild(rowDiv);
        };

        window.removeTableRow = function(button, tableIndex) {
            const tableDiv = button.closest('.option-table');
            const rowsGrid = tableDiv.querySelector('.rows-grid');
            const rows = rowsGrid.querySelectorAll('.row-item');
            
            if (rows.length > 1) {
                rowsGrid.removeChild(rows[rows.length - 1]);
            }
        };
    </script>
</x-admin-layout>
