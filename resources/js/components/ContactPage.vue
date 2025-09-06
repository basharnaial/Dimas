<template>
  <div class="contact-page" :dir="i18n.isRTL() ? 'rtl' : 'ltr'">
    <!-- Hero Section -->
    <section class="contact-hero">
      <div class="container">
        <h1 class="hero-title">{{ i18n.t('contact_us') }}</h1>
        <p class="hero-subtitle">{{ i18n.t('contact_hero_subtitle') }}</p>
      </div>
    </section>

    <div class="container">
      <div class="contact-content">
        <!-- Contact Information -->
        <div class="contact-info-section">
          <h2 class="section-title">{{ i18n.t('contact_info') }}</h2>
          
          <div class="contact-cards">
            <!-- Email Card -->
            <div class="contact-card">
              <div class="contact-card-icon email-icon">
                <svg viewBox="0 0 24 24" fill="currentColor">
                  <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                </svg>
              </div>
              <div class="contact-card-content">
                <h3 class="contact-card-title">{{ i18n.t('email_label') }}</h3>
                <a href="mailto:info@dimas.sa" class="contact-card-link">info@dimas.sa</a>
                <p class="contact-card-desc">{{ i18n.t('email_desc') }}</p>
              </div>
            </div>

            <!-- Phone Card -->
            <div class="contact-card">
              <div class="contact-card-icon phone-icon">
                <svg viewBox="0 0 24 24" fill="currentColor">
                  <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                </svg>
              </div>
              <div class="contact-card-content">
                <h3 class="contact-card-title">{{ i18n.t('phone_label') }}</h3>
                <a href="https://wa.me/966503402000" target="_blank" class="contact-card-link">
                  <span dir="ltr">+966 50 340 2000</span>
                </a>
                <p class="contact-card-desc">{{ i18n.t('phone_desc') }}</p>
              </div>
            </div>

            <!-- Address Card -->
            <div class="contact-card">
              <div class="contact-card-icon location-icon">
                <svg viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                </svg>
              </div>
              <div class="contact-card-content">
                <h3 class="contact-card-title">{{ i18n.t('address_label') }}</h3>
                <p class="contact-card-link">{{ i18n.t('address_value') }}</p>
                <p class="contact-card-desc">{{ i18n.t('address_desc') }}</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Contact Form -->
        <div class="contact-form-section">
          <h2 class="section-title">{{ i18n.t('send_message') }}</h2>
          
          <form @submit.prevent="submitForm" class="contact-form" :class="{ 'form-loading': loading }">
            <!-- Error Messages -->
            <div v-if="Object.keys(errors).length > 0" class="alert alert-error">
              <svg class="alert-icon" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
              </svg>
              <div>
                <div class="font-medium mb-2">{{ i18n.t('validation_errors') }}</div>
                <div v-for="(errorList, field) in errors" :key="field" class="mb-1">
                  <div v-for="error in errorList" :key="error" class="text-sm">
                    • {{ translateError(error, field) }}
                  </div>
                </div>
              </div>
            </div>

            <div class="form-grid">
              <!-- Name Field -->
              <div class="form-group">
                <label for="name" class="form-label">{{ i18n.t('name_label') }} *</label>
                  <input
                    type="text"
                    id="name"
                    v-model="form.name"
                    class="form-input"
                    :class="{ 'error': errors.name }"
                    :placeholder="i18n.t('name_placeholder')"
                    
                  >
                <div v-if="errors.name" class="field-error">
                  <div v-for="error in errors.name" :key="error" class="error-text">
                    {{ translateError(error, 'name') }}
                  </div>
                </div>
              </div>

              <!-- Email Field -->
              <div class="form-group">
                <label for="email" class="form-label">{{ i18n.t('email_label') }} *</label>
                <input
                  type="email"
                  id="email"
                  v-model="form.email"
                  class="form-input"
                  :class="{ 'error': errors.email }"
                  :placeholder="i18n.t('email_placeholder')"
                  
                >
                <div v-if="errors.email" class="field-error">
                  <div v-for="error in errors.email" :key="error" class="error-text">
                    {{ translateError(error, 'email') }}
                  </div>
                </div>
              </div>

              <!-- Phone Field -->
              <div class="form-group">
                <label for="phone" class="form-label">{{ i18n.t('phone_label') }} *</label>
                <input
                  type="tel"
                  id="phone"
                  v-model="form.phone"
                  class="form-input"
                  :class="{ 'error': errors.phone }"
                  :placeholder="i18n.t('phone_placeholder')"
                  
                >
                <div v-if="errors.phone" class="field-error">
                  <div v-for="error in errors.phone" :key="error" class="error-text">
                    {{ translateError(error, 'phone') }}
                  </div>
                </div>
              </div>
            </div>

            <!-- Message Field -->
            <div class="form-group">
              <label for="message" class="form-label">{{ i18n.t('message_label') }} *</label>
                <textarea
                  id="message"
                  v-model="form.message"
                  class="form-textarea"
                  :class="{ 'error': errors.message }"
                  :placeholder="i18n.t('message_placeholder')"
                  rows="6"
                  
                ></textarea>
              <div v-if="errors.message" class="field-error">
                <div v-for="error in errors.message" :key="error" class="error-text">
                  {{ translateError(error, 'message') }}
                </div>
              </div>
            </div>

            <!-- Consent Checkbox -->
              <div class="form-group checkbox-group">
                <label class="checkbox-label" :class="{ 'error': errors.consent }">
                  <input
                    type="checkbox"
                    v-model="form.consent"
                    class="checkbox-input"
                    :class="{ 'error': errors.consent }"
                    
                  >
                  <span class="checkbox-custom"></span>
                  <span class="checkbox-text">{{ i18n.t('consent_text') }} *</span>
                </label>
                <div v-if="errors.consent" class="field-error">
                  <div v-for="error in errors.consent" :key="error" class="error-text">
                    {{ translateError(error, 'consent') }}
                  </div>
                </div>
              </div>

            <!-- Honeypot Field (Hidden) -->
            <input type="text" v-model="form.trap_field" style="display: none;" tabindex="-1" autocomplete="off">

            <!-- Submit Button -->
            <div class="form-actions">
              <button type="submit" class="submit-btn" :disabled="loading">
                <svg v-if="loading" class="loading-spinner" viewBox="0 0 24 24">
                  <circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-dasharray="31.416" stroke-dashoffset="31.416">
                    <animate attributeName="stroke-dasharray" dur="2s" values="0 31.416;15.708 15.708;0 31.416" repeatCount="indefinite"/>
                    <animate attributeName="stroke-dashoffset" dur="2s" values="0;-15.708;-31.416" repeatCount="indefinite"/>
                  </circle>
                </svg>
                <span v-if="!loading">{{ i18n.t('send_message') }}</span>
                <span v-else>{{ i18n.t('sending') }}</span>
              </button>
            </div>

            <!-- Success Message -->
            <div v-if="successMessage" class="alert alert-success success-below-button" key="success-message">
              <svg class="alert-icon" viewBox="0 0 24 24" fill="currentColor">
                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
              </svg>
              <span>{{ successMessage }}</span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import i18n from '../i18n/index.js'

export default {
  name: 'ContactPage',
  data() {
    return {
      i18n,
      loading: false,
      successMessage: '',
      errors: {},
      form: {
        name: '',
        email: '',
        phone: '',
        message: '',
        consent: false,
        trap_field: '' // Honeypot
      }
    }
  },
  methods: {
    async submitForm() {
      if (this.loading) return
      
        console.log('Starting form submission...')
        this.loading = true
        this.errors = {}
        this.successMessage = ''
        
        // Client-side validation for consent
        if (!this.form.consent) {
          this.errors = {
            consent: [i18n.currentLanguage === 'ar' 
              ? 'يجب الموافقة على معالجة البيانات الشخصية.'
              : 'You must agree to the privacy policy.']
          }
          this.loading = false
          return
        }

      try {
        const response = await fetch('/api/v1/contact', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
          },
          body: JSON.stringify(this.form)
        })

        const data = await response.json()

        if (response.ok) {
          // Clear any previous errors
          this.errors = {}
          
          console.log('Success response received:', data)
          
          this.successMessage = i18n.currentLanguage === 'ar' 
            ? 'تم إرسال رسالتك بنجاح. سنتواصل معك قريباً.'
            : 'Your message has been sent successfully. We will contact you soon.'
          
          // Reset form
          this.form = {
            name: '',
            email: '',
            phone: '',
            message: '',
            consent: false,
            trap_field: ''
          }

          console.log('Form reset completed. Success message:', this.successMessage)
          
          // Force Vue to update the DOM
          this.$nextTick(() => {
            console.log('Vue nextTick - Success message should be visible:', this.successMessage)
            // Force reactivity update
            this.$forceUpdate()
          })
        } else {
          // Handle validation errors
          console.log('Response not OK. Status:', response.status, 'Data:', data)
          
          // Clear success message on error
          this.successMessage = ''
          
          if (data.errors) {
            this.errors = data.errors
            console.log('Validation errors set:', this.errors)
          } else if (data.message && Array.isArray(data.message)) {
            // Handle case where message is an array
            this.errors = { general: data.message }
          } else if (response.status === 422) {
            // Handle 422 validation error without proper errors object
            this.errors = { 
              general: [data.message || (i18n.currentLanguage === 'ar' 
                ? 'يرجى التحقق من البيانات المدخلة.'
                : 'Please check your input data.')]
            }
          } else {
            throw new Error(data.message || 'حدث خطأ غير متوقع')
          }
        }
      } catch (error) {
        console.error('Contact form error:', error)
        this.successMessage = '' // Clear any success message
        this.errors = {
          general: [i18n.currentLanguage === 'ar' 
            ? 'حدث خطأ أثناء إرسال الرسالة. يرجى المحاولة مرة أخرى.'
            : 'An error occurred while sending the message. Please try again.']
        }
      } finally {
        this.loading = false
        console.log('Form submission finished. Loading:', this.loading, 'Success:', this.successMessage, 'Errors:', this.errors)
        
        // Debug: Log all reactive data
        console.log('Current component state:', {
          loading: this.loading,
          successMessage: this.successMessage,
          errors: this.errors,
          form: this.form
        })
      }
    },

    translateError(error, field) {
      // Common validation error translations
      const translations = {
        ar: {
          'The name field is required.': 'حقل الاسم مطلوب.',
          'The email field is required.': 'حقل البريد الإلكتروني مطلوب.',
          'The phone field is required.': 'حقل الهاتف مطلوب.',
          'The message field is required.': 'حقل الرسالة مطلوب.',
          'The email must be a valid email address.': 'يجب أن يكون البريد الإلكتروني صالحاً.',
          'The name may not be greater than 150 characters.': 'لا يجب أن يتجاوز الاسم 150 حرف.',
          'The email may not be greater than 150 characters.': 'لا يجب أن يتجاوز البريد الإلكتروني 150 حرف.',
          'The phone may not be greater than 30 characters.': 'لا يجب أن يتجاوز رقم الهاتف 30 حرف.',
          'The message may not be greater than 5000 characters.': 'لا يجب أن تتجاوز الرسالة 5000 حرف.',
          'You must agree to the terms and conditions.': 'يجب الموافقة على معالجة البيانات الشخصية.',
          'You must agree to the privacy policy.': 'يجب الموافقة على معالجة البيانات الشخصية.'
        },
        en: {
          'The name field is required.': 'The name field is required.',
          'The email field is required.': 'The email field is required.',
          'The phone field is required.': 'The phone field is required.',
          'The message field is required.': 'The message field is required.',
          'The email must be a valid email address.': 'The email must be a valid email address.',
          'The name may not be greater than 150 characters.': 'The name may not be greater than 150 characters.',
          'The email may not be greater than 150 characters.': 'The email may not be greater than 150 characters.',
          'The phone may not be greater than 30 characters.': 'The phone may not be greater than 30 characters.',
          'The message may not be greater than 5000 characters.': 'The message may not be greater than 5000 characters.',
          'You must agree to the terms and conditions.': 'You must agree to the terms and conditions.'
        }
      }

      const currentLang = i18n.currentLanguage
      if (translations[currentLang] && translations[currentLang][error]) {
        return translations[currentLang][error]
      }
      
      return error // Return original error if no translation found
    }
  },
  mounted() {
    // Listen for language changes using Vue 3 approach
    if (this.$root && this.$root.$emit) {
      // Create a listener for language changes
      this.languageChangeHandler = () => {
        // Clear messages when language changes
        this.successMessage = ''
        this.errors = {}
      }
      
      // Store the handler for cleanup
      this.$root.languageChangeHandlers = this.$root.languageChangeHandlers || []
      this.$root.languageChangeHandlers.push(this.languageChangeHandler)
    }
  },
  
  beforeUnmount() {
    // Clean up event listener
    if (this.$root && this.$root.languageChangeHandlers) {
      const index = this.$root.languageChangeHandlers.indexOf(this.languageChangeHandler)
      if (index > -1) {
        this.$root.languageChangeHandlers.splice(index, 1)
      }
    }
  }
}
</script>

<style scoped>
.contact-page {
  min-height: 100vh;
}

.contact-hero {
  background: linear-gradient(135deg, #027EBE 0%, #C2D732 100%);
  color: white;
  padding: 4rem 0;
  text-align: center;
}

.hero-title {
  font-size: 3rem;
  font-weight: 700;
  margin-bottom: 1rem;
}

.hero-subtitle {
  font-size: 1.25rem;
  opacity: 0.9;
  max-width: 600px;
  margin: 0 auto;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 2rem;
}

.contact-content {
  padding: 4rem 0;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 4rem;
  align-items: start;
}

.section-title {
  font-size: 2rem;
  font-weight: 600;
  color: #1f2937;
  margin-bottom: 2rem;
}

/* Contact Cards */
.contact-cards {
  display: flex;
  flex-direction: column;
  gap: 2rem;
}

.contact-card {
  display: flex;
  align-items: flex-start;
  gap: 1rem;
  padding: 2rem;
  background: white;
  border-radius: 1rem;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.contact-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1);
}

.contact-card-icon {
  width: 3rem;
  height: 3rem;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.contact-card-icon svg {
  width: 1.5rem;
  height: 1.5rem;
}

.email-icon {
  background: rgba(59, 130, 246, 0.1);
  color: #3b82f6;
}

.phone-icon {
  background: rgba(34, 197, 94, 0.1);
  color: #22c55e;
}

.location-icon {
  background: rgba(239, 68, 68, 0.1);
  color: #ef4444;
}

.contact-card-content {
  flex: 1;
}

.contact-card-title {
  font-size: 1.25rem;
  font-weight: 600;
  color: #1f2937;
  margin-bottom: 0.5rem;
}

.contact-card-link {
  font-size: 1.125rem;
  font-weight: 500;
  color: #3b82f6;
  text-decoration: none;
  margin-bottom: 0.5rem;
  display: block;
}

.contact-card-link:hover {
  text-decoration: underline;
}

.contact-card-desc {
  color: #6b7280;
  font-size: 0.875rem;
  line-height: 1.5;
}

/* Contact Form */
.contact-form {
  background: white;
  padding: 2rem;
  border-radius: 1rem;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.form-loading {
  pointer-events: none;
  opacity: 0.7;
}

.alert {
  padding: 1rem;
  border-radius: 0.5rem;
  margin-bottom: 1.5rem;
  display: flex;
  align-items: flex-start;
  gap: 0.75rem;
}

.alert-success {
  background: rgba(34, 197, 94, 0.1);
  color: #166534;
  border: 1px solid rgba(34, 197, 94, 0.2);
}

.alert-error {
  background: rgba(239, 68, 68, 0.1);
  color: #991b1b;
  border: 1px solid rgba(239, 68, 68, 0.2);
}

.alert-icon {
  width: 1.25rem;
  height: 1.25rem;
  flex-shrink: 0;
  margin-top: 0.125rem;
}

.success-below-button {
  margin-top: 1.5rem;
  text-align: center;
  animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.form-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.5rem;
  margin-bottom: 1.5rem;
}

.form-group {
  margin-bottom: 1.5rem;
}

.form-label {
  display: block;
  font-weight: 500;
  color: #374151;
  margin-bottom: 0.5rem;
}

.form-input,
.form-textarea {
  width: 100%;
  padding: 0.75rem 1rem;
  border: 2px solid #e5e7eb;
  border-radius: 0.5rem;
  font-size: 1rem;
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
  background: #f9fafb;
}

.form-input:focus,
.form-textarea:focus {
  outline: none;
  border-color: #3b82f6;
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
  background: white;
}

.form-input.error,
.form-textarea.error {
  border-color: #ef4444;
  background: rgba(239, 68, 68, 0.05);
}

.form-textarea {
  resize: vertical;
  min-height: 120px;
}

/* Checkbox */
.checkbox-group {
  margin-bottom: 2rem;
}

.checkbox-label {
  display: flex;
  align-items: flex-start;
  gap: 0.75rem;
  cursor: pointer;
  line-height: 1.5;
}

.checkbox-input {
  display: none;
}

.checkbox-custom {
  width: 1.25rem;
  height: 1.25rem;
  border: 2px solid #d1d5db;
  border-radius: 0.25rem;
  flex-shrink: 0;
  margin-top: 0.125rem;
  position: relative;
  transition: all 0.3s ease;
}

.checkbox-input:checked + .checkbox-custom {
  background: #3b82f6;
  border-color: #3b82f6;
}

.checkbox-input:checked + .checkbox-custom::after {
  content: '';
  position: absolute;
  top: 2px;
  left: 4px;
  width: 6px;
  height: 10px;
  border: solid white;
  border-width: 0 2px 2px 0;
  transform: rotate(45deg);
}

.checkbox-text {
  color: #4b5563;
  font-size: 0.875rem;
}

/* Field Errors */
.field-error {
  margin-top: 0.5rem;
}

.error-text {
  color: #ef4444;
  font-size: 0.875rem;
  display: flex;
  align-items: center;
  gap: 0.25rem;
}

.error-text::before {
  content: '⚠';
  font-size: 0.75rem;
}

/* Submit Button */
.form-actions {
  text-align: center;
}

.submit-btn {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  padding: 1rem 2rem;
  border: none;
  border-radius: 0.75rem;
  font-size: 1.125rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  min-width: 200px;
  justify-content: center;
}

.submit-btn:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px -3px rgba(102, 126, 234, 0.4);
}

.submit-btn:disabled {
  opacity: 0.7;
  cursor: not-allowed;
  transform: none;
}

.loading-spinner {
  width: 1.25rem;
  height: 1.25rem;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}

/* Responsive */
@media (max-width: 768px) {
  .hero-title {
    font-size: 2rem;
  }

  .contact-content {
    grid-template-columns: 1fr;
    gap: 3rem;
    padding: 3rem 0;
  }

  .form-grid {
    grid-template-columns: 1fr;
    gap: 1rem;
  }

  .contact-card {
    padding: 1.5rem;
  }

  .contact-form {
    padding: 1.5rem;
  }

  .container {
    padding: 0 1rem;
  }
}

/* Checkbox Error Styling */
.checkbox-input.error + .checkbox-custom {
  border-color: #ef4444;
  background-color: rgba(239, 68, 68, 0.1);
}

.checkbox-label.error .checkbox-text {
  color: #ef4444;
}

/* RTL Support */
[dir="rtl"] .contact-card {
  direction: rtl;
}

[dir="rtl"] .checkbox-label {
  flex-direction: row-reverse;
}

[dir="rtl"] .checkbox-custom::after {
  left: 6px;
}
</style>
