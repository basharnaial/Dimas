// Translation system for Vue.js
import { reactive } from 'vue'

// Translation files
const translations = {
  ar: {
    // Navigation
    home: 'الرئيسية',
    products: 'منتجاتنا',
    categories: 'الفئات',
    contact: 'تواصل معنا',
    about: 'عن الشركة',
    language: 'اللغة',
    admin_panel: 'نظام الإدارة',
    
    // Product related
    product_name: 'اسم المنتج',
    product_description: 'وصف المنتج',
    short_description: 'وصف مختصر',
    category: 'الفئة',
    sku: 'رمز المنتج',
    specifications: 'المواصفات',
    related_products: 'منتجات مشابهة',
    view_product: 'عرض المنتج',
    view_details: 'عرض التفاصيل',
    all_products: 'جميع المنتجات',
    featured_products: 'منتجات مميزة',
    product_count: 'منتج',
    
    // Search and filter
    search_placeholder: 'ابحث عن منتج...',
    all_categories: 'جميع الفئات',
    search_products: 'البحث في المنتجات',
    filter_by_category: 'تصفية حسب الفئة',
    
    // Actions
    contact_us: 'تواصل معنا',
    share: 'مشاركة',
    back_to_categories: '← العودة لجميع الأقسام',
    view_all_products: 'عرض جميع المنتجات',
    contact_now: 'راسلنا الآن',
    browse_products: 'تصفح المنتجات',
    
    // Messages
    loading: 'جاري التحميل...',
    not_found: 'غير موجود',
    product_not_found: 'المنتج غير موجود',
    category_not_found: 'القسم غير موجود',
    no_products: 'لا توجد منتجات',
    success: 'تم بنجاح',
    error: 'حدث خطأ',
    additional_details: 'تفاصيل إضافية',
    related_products: 'منتجات مشابهة',
    copy_link: 'نسخ الرابط',
    
    // Contact page
    contact_hero_subtitle: 'نحن هنا لمساعدتك. تواصل معنا في أي وقت',
    send_message: 'إرسال رسالة',
    name_label: 'الاسم',
    name_placeholder: 'أدخل اسمك الكامل',
    email_placeholder: 'أدخل بريدك الإلكتروني',
    phone_placeholder: 'أدخل رقم هاتفك',
    message_label: 'الرسالة',
    message_placeholder: 'اكتب رسالتك هنا...',
    consent_text: 'أوافق على معالجة بياناتي الشخصية وفقاً لسياسة الخصوصية',
    sending: 'جاري الإرسال...',
    email_desc: 'راسلنا على البريد الإلكتروني',
    phone_desc: 'تواصل معنا عبر الواتساب',
    address_desc: 'زورنا في مقرنا الرئيسي',
    validation_errors: 'يرجى تصحيح الأخطاء التالية:',
    
    // Hero section
    welcome_title: 'مرحباً بكم في موقع',
    welcome_title_brand: 'ديماس',
    welcome_subtitle: 'اكتشفوا منتجاتنا المميزة',
    
    // Sections
    our_categories: 'أقسامنا',
    contact_section_title: 'تواصل معنا',
    contact_section_text: 'هل لديك استفسار؟ نحن هنا لمساعدتك',
    
    // Company info
    company_name: 'ديماس',
    company_tagline: 'الحلول الطبية المتقدمة',
    company_description: 'نحن شركة رائدة في مجال توفير المعدات والمستلزمات الطبية عالية الجودة للمؤسسات الصحية والمهنيين الطبيين في جميع أنحاء المملكة.',
    
    // Footer sections
    main_pages: 'الصفحات الرئيسية',
    product_categories: 'فئات المنتجات',
    contact_info: 'معلومات التواصل',
    
    // Footer links
    wound_care: 'العناية بالجروح',
    infection_control: 'مكافحة العدوى',
    surgical_equipment: 'المعدات الجراحية',
    diagnostic_devices: 'أجهزة التشخيص',
    
    // Contact details
    email_label: 'البريد الإلكتروني',
    phone_label: 'الهاتف',
    address_label: 'العنوان',
    address_value: 'الرياض، المملكة العربية السعودية',
    
    // Footer bottom
    copyright: '© 2024 ديماس للحلول الطبية. جميع الحقوق محفوظة.',
    privacy_policy: 'سياسة الخصوصية',
    terms_conditions: 'الشروط والأحكام',
    return_policy: 'سياسة الإرجاع'
  },
  
  en: {
    // Navigation
    home: 'Home',
    products: 'Our Products',
    categories: 'Categories',
    contact: 'Contact Us',
    about: 'About Us',
    language: 'Language',
    admin_panel: 'Admin Panel',
    
    // Product related
    product_name: 'Product Name',
    product_description: 'Product Description',
    short_description: 'Short Description',
    category: 'Category',
    sku: 'SKU',
    specifications: 'Specifications',
    related_products: 'Related Products',
    view_product: 'View Product',
    view_details: 'View Details',
    all_products: 'All Products',
    featured_products: 'Featured Products',
    product_count: 'product',
    
    // Search and filter
    search_placeholder: 'Search for product...',
    all_categories: 'All Categories',
    search_products: 'Search Products',
    filter_by_category: 'Filter by Category',
    
    // Actions
    contact_us: 'Contact Us',
    share: 'Share',
    back_to_categories: '← Back to All Categories',
    view_all_products: 'View All Products',
    contact_now: 'Contact Now',
    browse_products: 'Browse Products',
    
    // Messages
    loading: 'Loading...',
    not_found: 'Not Found',
    product_not_found: 'Product not found',
    category_not_found: 'Category not found',
    no_products: 'No products found',
    success: 'Success',
    error: 'Error',
    additional_details: 'Additional Details',
    related_products: 'Related Products',
    copy_link: 'Copy Link',
    
    // Contact page
    contact_hero_subtitle: 'We are here to help you. Contact us anytime',
    send_message: 'Send Message',
    name_label: 'Name',
    name_placeholder: 'Enter your full name',
    email_placeholder: 'Enter your email address',
    phone_placeholder: 'Enter your phone number',
    message_label: 'Message',
    message_placeholder: 'Write your message here...',
    consent_text: 'I agree to the processing of my personal data according to the privacy policy',
    sending: 'Sending...',
    email_desc: 'Send us an email',
    phone_desc: 'Contact us via WhatsApp',
    address_desc: 'Visit us at our main office',
    validation_errors: 'Please correct the following errors:',
    
    // Hero section
    welcome_title: 'Dimas',
    welcome_title_brand: 'Welcome to',
    welcome_subtitle: 'Discover our premium products and advanced services',

    // Sections
    our_categories: 'Our Categories',
    contact_section_title: 'Contact Us',
    contact_section_text: 'Have a question? We\'re here to help',
    
    // Company info
    company_name: 'Dimas',
    company_tagline: 'Advanced Medical Solutions',
    company_description: 'We are a leading company in providing high-quality medical equipment and supplies to healthcare institutions and medical professionals throughout the Kingdom.',
    
    // Footer sections
    main_pages: 'Main Pages',
    product_categories: 'Product Categories',
    contact_info: 'Contact Information',
    
    // Footer links
    wound_care: 'Wound Care',
    infection_control: 'Infection Control',
    surgical_equipment: 'Surgical Equipment',
    diagnostic_devices: 'Diagnostic Devices',
    
    // Contact details
    email_label: 'Email',
    phone_label: 'Phone',
    address_label: 'Address',
    address_value: 'Riyadh, Saudi Arabia',
    
    // Footer bottom
    copyright: '© 2026 Dimas Medical Solutions. All rights reserved.',
    privacy_policy: 'Privacy Policy',
    terms_conditions: 'Terms & Conditions',
    return_policy: 'Return Policy'
  }
}

// Reactive state for current language and translations
export const i18n = reactive({
  currentLanguage: localStorage.getItem('language') || 'ar',
  translations: translations,
  
  // Get translation for a key
  t(key) {
    return this.translations[this.currentLanguage][key] || key
  },
  
  // Set language
  setLanguage(lang) {
    if (lang !== this.currentLanguage && translations[lang]) {
      this.currentLanguage = lang
      localStorage.setItem('language', lang)
      
      // Update document direction and font
      document.documentElement.dir = lang === 'ar' ? 'rtl' : 'ltr'
      document.documentElement.lang = lang
      
      // Apply font class to body
      document.body.classList.remove('font-arabic', 'font-english')
      document.body.classList.add(lang === 'ar' ? 'font-arabic' : 'font-english')
      
      return true
    }
    return false
  },
  
  // Get current language
  getCurrentLanguage() {
    return this.currentLanguage
  },
  
  // Check if current language is RTL
  isRTL() {
    return this.currentLanguage === 'ar'
  }
})

// Initialize language settings on load
i18n.setLanguage(i18n.currentLanguage)

export default i18n
