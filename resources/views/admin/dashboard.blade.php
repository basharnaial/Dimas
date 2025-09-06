<x-admin-layout>
    <x-slot name="header">
        لوحة التحكم الرئيسية
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-gradient-to-r from-white via-gray-50 to-slate-50 rounded-2xl shadow-lg border border-gray-100 backdrop-blur-sm p-8 mb-8 relative overflow-hidden">
                <!-- Background Pattern -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-bl from-gray-100/20 to-transparent rounded-full -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-gradient-to-tr from-slate-100/20 to-transparent rounded-full -ml-24 -mb-24"></div>
                
                <div class="flex items-center justify-between relative z-10">
                    <div>
                        <div class="flex items-center mb-4">
                            <img src="{{ asset('storage/products/logo-dimas.svg') }}" 
                                 alt="Dimas Logo" 
                                 class="h-16 w-16 object-contain drop-shadow-lg ml-4" />
                            <div>
                                <h1 class="text-4xl font-bold text-gray-900 mb-2">مرحباً، {{ Auth::user()->name }}</h1>
                                <p class="text-gray-600 text-lg font-medium">إليك نظرة سريعة على إحصائيات موقع ديماس </p>
                            </div>
                        </div>
                        <div class="flex items-center text-sm text-gray-500 mt-4">
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0h6m-6 0L8 21l4-7 4 7-6-14z"></path>
                            </svg>
                            آخر تسجيل دخول: {{ now()->format('Y/m/d - H:i') }}
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-20 h-20 bg-gradient-to-br from-slate-400 to-gray-500 rounded-2xl flex items-center justify-center shadow-lg transform hover:rotate-6 transition-transform duration-300">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Products Card -->
                <div class="group bg-gradient-to-br from-white to-slate-50 rounded-2xl shadow-md border border-slate-100 p-6 hover:shadow-lg hover:scale-102 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-slate-100/20 rounded-full -mr-10 -mt-10"></div>
                    <div class="flex items-center relative z-10">
                        <div class="flex-shrink-0">
                            <div class="w-14 h-14 bg-gradient-to-br from-slate-500 to-slate-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-105 transition-transform duration-300">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                        </div>
                        <div class="mr-4 flex-1">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-gray-600 mb-1">إجمالي المنتجات</p>
                                    <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Product::count() }}</p>
                                </div>
                                <a href="{{ route('admin.products.index') }}" class="text-slate-600 hover:text-slate-800 text-sm font-bold bg-slate-100 px-3 py-1 rounded-full hover:bg-slate-200 transition-colors">عرض الكل</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Categories Card -->
                <div class="group bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-md border border-gray-100 p-6 hover:shadow-lg hover:scale-102 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gray-100/20 rounded-full -mr-10 -mt-10"></div>
                    <div class="flex items-center relative z-10">
                        <div class="flex-shrink-0">
                            <div class="w-14 h-14 bg-gradient-to-br from-gray-500 to-gray-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-105 transition-transform duration-300">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                        </div>
                        <div class="mr-4 flex-1">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-gray-600 mb-1">إجمالي الفئات</p>
                                    <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Category::count() }}</p>
                                </div>
                                <a href="{{ route('admin.categories.index') }}" class="text-gray-600 hover:text-gray-800 text-sm font-bold bg-gray-100 px-3 py-1 rounded-full hover:bg-gray-200 transition-colors">عرض الكل</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Products Card -->
                <div class="group bg-gradient-to-br from-white to-stone-50 rounded-2xl shadow-md border border-stone-100 p-6 hover:shadow-lg hover:scale-102 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-stone-100/20 rounded-full -mr-10 -mt-10"></div>
                    <div class="flex items-center relative z-10">
                        <div class="flex-shrink-0">
                            <div class="w-14 h-14 bg-gradient-to-br from-stone-500 to-stone-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-105 transition-transform duration-300">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="mr-4 flex-1">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-gray-600 mb-1">المنتجات المفعلة</p>
                                    <p class="text-3xl font-bold text-gray-900">{{ \App\Models\Product::where('is_active', true)->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Messages Card -->
                <div class="group bg-gradient-to-br from-white to-zinc-50 rounded-2xl shadow-md border border-zinc-100 p-6 hover:shadow-lg hover:scale-102 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-zinc-100/20 rounded-full -mr-10 -mt-10"></div>
                    <div class="flex items-center relative z-10">
                        <div class="flex-shrink-0">
                            <div class="w-14 h-14 bg-gradient-to-br from-zinc-500 to-zinc-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-105 transition-transform duration-300">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="mr-4 flex-1">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-gray-600 mb-1">رسائل التواصل</p>
                                    <p class="text-3xl font-bold text-gray-900">{{ \App\Models\ContactMessage::count() }}</p>
                                </div>
                                <a href="{{ route('admin.contacts.index') }}" class="text-zinc-600 hover:text-zinc-800 text-sm font-bold bg-zinc-100 px-3 py-1 rounded-full hover:bg-zinc-200 transition-colors">عرض الكل</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Recent Products -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200 p-8 hover:shadow-2xl transition-all duration-300">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center">
                            <div class="w-2 h-8 bg-gradient-to-b from-slate-400 to-gray-500 rounded-full ml-3"></div>
                            <h3 class="text-xl font-bold text-gray-900">أحدث المنتجات</h3>
                        </div>
                        <a href="{{ route('admin.products.index') }}" class="text-slate-600 hover:text-slate-800 text-sm font-bold bg-slate-100 px-4 py-2 rounded-full hover:bg-slate-200 transition-colors">عرض الكل</a>
                    </div>
                    <div class="space-y-4">
                        @forelse(\App\Models\Product::latest()->take(5)->get() as $product)
                            <div class="flex items-center space-x-4 space-x-reverse">
                                <div class="flex-shrink-0">
                                    @if($product->images->count() > 0)
                                        <img class="h-10 w-10 rounded-lg object-cover" src="{{ asset('storage/' . $product->images->first()->path) }}" alt="{{ $product->name }}">
                                    @else
                                        <div class="h-10 w-10 rounded-lg bg-gray-200 flex items-center justify-center">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $product->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $product->sku }}</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $product->is_active ? 'مفعل' : 'معطل' }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">لا توجد منتجات</p>
                        @endforelse
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200 p-8 hover:shadow-2xl transition-all duration-300">
                    <div class="flex items-center mb-8">
                        <div class="w-2 h-8 bg-gradient-to-b from-gray-400 to-slate-500 rounded-full ml-3"></div>
                        <h3 class="text-xl font-bold text-gray-900">إجراءات سريعة</h3>
                    </div>
                    <div class="space-y-4">
                        <a href="{{ route('admin.products.create') }}" class="group flex items-center p-5 bg-gradient-to-r from-slate-50 to-gray-50 rounded-xl hover:from-slate-100 hover:to-gray-100 transition-all duration-300 transform hover:scale-102 hover:shadow-md">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-br from-slate-500 to-slate-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-105 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                            </div>
                            <div class="mr-4">
                                <p class="text-base font-bold text-gray-900 mb-1">إضافة منتج جديد</p>
                                <p class="text-sm text-gray-600">إضافة منتج طبي جديد للكتالوج</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.categories.create') }}" class="group flex items-center p-5 bg-gradient-to-r from-gray-50 to-stone-50 rounded-xl hover:from-gray-100 hover:to-stone-100 transition-all duration-300 transform hover:scale-102 hover:shadow-md">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-br from-gray-500 to-stone-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-105 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                            </div>
                            <div class="mr-4">
                                <p class="text-base font-bold text-gray-900 mb-1">إضافة فئة جديدة</p>
                                <p class="text-sm text-gray-600">إنشاء فئة جديدة لتصنيف المنتجات</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.contacts.index') }}" class="group flex items-center p-5 bg-gradient-to-r from-stone-50 to-zinc-50 rounded-xl hover:from-stone-100 hover:to-zinc-100 transition-all duration-300 transform hover:scale-102 hover:shadow-md">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-br from-stone-500 to-zinc-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-105 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="mr-4">
                                <p class="text-base font-bold text-gray-900 mb-1">مراجعة الرسائل</p>
                                <p class="text-sm text-gray-600">عرض وإدارة رسائل العملاء</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
