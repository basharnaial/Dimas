<x-admin-layout>
    <x-slot name="header">
        عرض رسالة التواصل
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            رسائل التواصل
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400 rotate-180" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="mr-1 text-sm font-medium text-gray-500 md:mr-2">رسالة من {{ $contact->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Message Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                <!-- Header -->
                <div class="px-6 py-4 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="mr-4">
                                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                                    {{ $contact->name }}
                                    @if(!$contact->is_read)
                                        <span class="mr-2 h-2 w-2 bg-blue-600 rounded-full"></span>
                                    @endif
                                </h2>
                                <p class="text-sm text-gray-600">{{ $contact->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-2 space-x-reverse">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $contact->is_read ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ $contact->is_read ? 'مقروء' : 'جديد' }}
                            </span>
                            <span class="text-sm text-gray-500">
                                {{ $contact->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-sm font-semibold text-gray-900 mb-3">معلومات التواصل</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-gray-400 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <div class="text-xs text-gray-500 uppercase tracking-wide">البريد الإلكتروني</div>
                                <div class="text-sm font-medium text-gray-900">
                                    <a href="mailto:{{ $contact->email }}" class="text-blue-600 hover:text-blue-800">{{ $contact->email }}</a>
                                </div>
                            </div>
                        </div>

                        @if($contact->phone)
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-gray-400 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <div>
                                    <div class="text-xs text-gray-500 uppercase tracking-wide">رقم الهاتف</div>
                                    <div class="text-sm font-medium text-gray-900">
                                        <a href="tel:{{ $contact->phone }}" class="text-blue-600 hover:text-blue-800">{{ $contact->phone }}</a>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($contact->subject)
                            <div class="flex items-center md:col-span-2">
                                <svg class="h-5 w-5 text-gray-400 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                                <div>
                                    <div class="text-xs text-gray-500 uppercase tracking-wide">الموضوع</div>
                                    <div class="text-sm font-medium text-gray-900">{{ $contact->subject }}</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Message Content -->
                <div class="px-6 py-6">
                    <h3 class="text-sm font-semibold text-gray-900 mb-4">محتوى الرسالة</h3>
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <div class="text-gray-800 whitespace-pre-wrap leading-relaxed">{{ $contact->message }}</div>
                    </div>
                </div>

                <!-- Consent Information -->
                @if($contact->consent !== null)
                    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 {{ $contact->consent ? 'text-green-500' : 'text-red-500' }} ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($contact->consent)
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                @endif
                            </svg>
                            <span class="text-sm text-gray-600">
                                {{ $contact->consent ? 'وافق على سياسة الخصوصية' : 'لم يوافق على سياسة الخصوصية' }}
                            </span>
                        </div>
                    </div>
                @endif

                <!-- Actions -->
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4 space-x-reverse">
                            <a href="mailto:{{ $contact->email }}?subject=رد على: {{ $contact->subject ?? 'استفسارك' }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                <svg class="h-4 w-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                الرد عبر البريد الإلكتروني
                            </a>

                            @if($contact->phone)
                                <a href="tel:{{ $contact->phone }}" 
                                   class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors">
                                    <svg class="h-4 w-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    اتصال هاتفي
                                </a>
                            @endif
                        </div>

                        <div class="flex items-center space-x-2 space-x-reverse">
                            <a href="{{ route('admin.contacts.index') }}" 
                               class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                                العودة للقائمة
                            </a>
                            
                            <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" class="inline" 
                                  onsubmit="return confirm('هل أنت متأكد من حذف هذه الرسالة؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors">
                                    حذف الرسالة
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            @php
                $prevContact = \App\Models\ContactMessage::where('id', '<', $contact->id)->orderBy('id', 'desc')->first();
                $nextContact = \App\Models\ContactMessage::where('id', '>', $contact->id)->orderBy('id', 'asc')->first();
            @endphp

            @if($prevContact || $nextContact)
                <div class="mt-6 flex items-center justify-between">
                    @if($prevContact)
                        <a href="{{ route('admin.contacts.show', $prevContact) }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                            <svg class="h-4 w-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            الرسالة السابقة
                        </a>
                    @else
                        <div></div>
                    @endif

                    @if($nextContact)
                        <a href="{{ route('admin.contacts.show', $nextContact) }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                            الرسالة التالية
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <script>
        // Mark as read when viewing
        @if(!$contact->is_read)
            fetch(`/admin/contacts/{{ $contact->id }}/mark-read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                }
            });
        @endif
    </script>
</x-admin-layout>
