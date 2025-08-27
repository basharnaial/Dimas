<x-admin-layout>
    <x-slot name="header">
        إدارة رسائل التواصل
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Actions -->
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center space-x-4">
                    <h1 class="text-2xl font-semibold text-gray-900">رسائل التواصل</h1>
                    <span class="text-gray-500">({{ $contacts->total() }} رسالة)</span>
                </div>
                <div class="flex items-center space-x-2 space-x-reverse">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        {{ $contacts->where('created_at', '>=', now()->startOfDay())->count() }} رسالة اليوم
                    </span>
                </div>
            </div>

            <!-- Search and Filters -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-6">
                <form method="GET" action="{{ route('admin.contacts.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">البحث</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" 
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                               placeholder="الاسم، البريد الإلكتروني، أو المحتوى">
                    </div>
                    
                    <div>
                        <label for="date_from" class="block text-sm font-medium text-gray-700 mb-1">من تاريخ</label>
                        <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" 
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    
                    <div>
                        <label for="date_to" class="block text-sm font-medium text-gray-700 mb-1">إلى تاريخ</label>
                        <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}" 
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    
                    <div>
                        <label for="sort_by" class="block text-sm font-medium text-gray-700 mb-1">ترتيب حسب</label>
                        <select name="sort_by" id="sort_by" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>تاريخ الإرسال</option>
                            <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>الاسم</option>
                            <option value="email" {{ request('sort_by') == 'email' ? 'selected' : '' }}>البريد الإلكتروني</option>
                        </select>
                    </div>
                    
                    <div class="md:col-span-4 flex justify-end">
                        <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            تطبيق الفلتر
                        </button>
                    </div>
                </form>
            </div>

            <!-- Bulk Actions -->
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-6">
                <form method="POST" action="{{ route('admin.contacts.bulk-action') }}" id="bulk-action-form">
                    @csrf
                    <div class="flex items-center space-x-4">
                        <select name="action" class="border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">اختر الإجراء</option>
                            <option value="delete">حذف المحدد</option>
                            <option value="mark_read">وضع علامة مقروء</option>
                            <option value="mark_unread">وضع علامة غير مقروء</option>
                        </select>
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            تطبيق
                        </button>
                    </div>
                </form>
            </div>

            <!-- Messages List -->
            <div class="bg-white shadow-sm rounded-xl border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <input type="checkbox" id="select-all" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">المرسل</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الموضوع</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">تاريخ الإرسال</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الحالة</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($contacts as $contact)
                                <tr class="hover:bg-gray-50 {{ !$contact->is_read ? 'bg-blue-50' : '' }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" name="contacts[]" value="{{ $contact->id }}" form="bulk-action-form" 
                                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                    <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="mr-4">
                                                <div class="text-sm font-medium text-gray-900 flex items-center">
                                                    {{ $contact->name }}
                                                    @if(!$contact->is_read)
                                                        <span class="mr-2 h-2 w-2 bg-blue-600 rounded-full"></span>
                                                    @endif
                                                </div>
                                                <div class="text-sm text-gray-500">{{ $contact->email }}</div>
                                                @if($contact->phone)
                                                    <div class="text-sm text-gray-500">{{ $contact->phone }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 font-medium">{{ $contact->subject ?? 'بدون موضوع' }}</div>
                                        <div class="text-sm text-gray-500 max-w-xs truncate">{{ Str::limit($contact->message, 100) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div>{{ $contact->created_at->format('Y-m-d') }}</div>
                                        <div class="text-xs text-gray-400">{{ $contact->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $contact->is_read ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ $contact->is_read ? 'مقروء' : 'جديد' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2 space-x-reverse">
                                            <a href="{{ route('admin.contacts.show', $contact) }}" class="text-blue-600 hover:text-blue-900">عرض</a>
                                            <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" class="inline" 
                                                  onsubmit="return confirm('هل أنت متأكد من حذف هذه الرسالة؟')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">حذف</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        <h3 class="text-sm font-medium text-gray-900 mb-1">لا توجد رسائل</h3>
                                        <p class="text-sm text-gray-500">لم يتم استلام أي رسائل تواصل بعد.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            @if($contacts->hasPages())
                <div class="mt-6">
                    {{ $contacts->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        // Select all functionality
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('input[name="contacts[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Auto-set today's date as default
        document.addEventListener('DOMContentLoaded', function() {
            const dateFrom = document.getElementById('date_from');
            const dateTo = document.getElementById('date_to');
            
            if (!dateFrom.value && !dateTo.value) {
                const today = new Date().toISOString().split('T')[0];
                dateTo.value = today;
                
                const weekAgo = new Date();
                weekAgo.setDate(weekAgo.getDate() - 7);
                dateFrom.value = weekAgo.toISOString().split('T')[0];
            }
        });
    </script>
</x-admin-layout>
