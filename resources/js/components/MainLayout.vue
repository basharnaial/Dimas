<template>
  <div class="medical-layout">
    <!-- Professional Medical Header -->
    <header class="medical-header" :dir="i18n.isRTL() ? 'rtl' : 'ltr'">
      <div class="header-backdrop"></div>
      <div class="container">
        <div class="header-content">
          <!-- Premium Medical Logo -->
          <div class="medical-logo">
            <router-link to="/" class="logo-container">
              <img src="/storage/products/logo-dimas.svg" alt="Dimas Logo" class="logo-svg" />

              <div class="logo-text">
                <span class="brand-name">{{ i18n.t('company_name') }}</span>
                <span class="brand-tagline">{{ i18n.t('company_tagline') }}</span>
              </div>
            </router-link>
          </div>

          <!-- Professional Navigation -->
          <nav class="medical-nav">
            <router-link to="/" class="nav-item">
              <span>{{ i18n.t('home') }}</span>
            </router-link>
            <router-link to="/products" class="nav-item">
              <span>{{ i18n.t('products') }}</span>
            </router-link>
            <!-- <router-link to="/about" class="nav-item">
              <span>{{ i18n.t('about') }}</span>
            </router-link> -->
            <router-link to="/contact" class="nav-item">
              <span>{{ i18n.t('contact') }}</span>
            </router-link>
          </nav>

          <!-- Professional Admin Access -->
          <div class="header-actions">
            <LanguageSwitcher @language-changed="handleLanguageChange" />
            
            <a href="/login" class="admin-access">
              <svg viewBox="0 0 24 24" fill="white" class="admin-icon">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
              </svg>
              <!-- <span class="admin-text">{{ i18n.t('admin_panel') }}</span> -->
            </a>
            
            <!-- Mobile Menu Toggle -->
            <button @click="toggleMobileMenu" class="mobile-toggle">
              <svg viewBox="0 0 24 24" fill="white">
                <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/>
              </svg>
          </button>
          </div>
        </div>

        <!-- Mobile Navigation Panel -->
        <div v-show="mobileMenuOpen" class="mobile-panel">
          <div class="mobile-nav">
            <router-link to="/" class="mobile-item" @click="closeMobileMenu">
              <span>{{ i18n.t('home') }}</span>
            </router-link>
            <router-link to="/products" class="mobile-item" @click="closeMobileMenu">
              <span>{{ i18n.t('products') }}</span>
            </router-link>
            <!-- <router-link to="/about" class="mobile-item" @click="closeMobileMenu">
              <span>{{ i18n.t('about') }}</span>
            </router-link> -->
            <router-link to="/contact" class="mobile-item" @click="closeMobileMenu">
              <span>{{ i18n.t('contact') }}</span>
            </router-link>
            <!-- <a href="/login" class="mobile-admin" @click="closeMobileMenu">
              <svg viewBox="0 0 24 24" fill="white">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
            </svg>
              <span>{{ i18n.t('admin_panel') }}</span>
          </a> -->
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content Area -->
    <main class="medical-main">
      <router-view />
    </main>

            <!-- Apple-Style Clean Footer -->
        <footer class="medical-footer" :dir="i18n.isRTL() ? 'rtl' : 'ltr'">
          <div class="footer-container">
            <!-- Company Info Section -->
            <div class="footer-company">
              <div class="footer-logo">
                <div class="footer-logo-icon">
                  <svg viewBox="0 0 24 24" fill="white">
                    <path d="M12 2C13.1 2 14 2.9 14 4V10H20C21.1 10 22 10.9 22 12C22 13.1 21.1 14 20 14H14V20C14 21.1 13.1 22 12 22C10.9 22 10 21.1 10 20V14H4C2.9 14 2 13.1 2 12C2 10.9 2.9 10 4 10H10V4C10 2.9 10.9 2 12 2Z"/>
                  </svg>
                </div>
                <div class="footer-brand-text">
                  <h3 class="footer-brand">{{ i18n.t('company_name') }}</h3>
                  <p class="footer-tagline">{{ i18n.t('company_tagline') }}</p>
                </div>
              </div>
              <p class="company-description">
                {{ i18n.t('company_description') }}
            </p>
          </div>
          
            <!-- Links Grid -->
            <div class="footer-links-grid">
              <!-- Quick Links -->
          <div class="footer-section">
                <h4 class="section-title">{{ i18n.t('main_pages') }}</h4>
            <ul class="footer-links">
              <li><router-link to="/" class="footer-link">{{ i18n.t('home') }}</router-link></li>
                  <li><router-link to="/products" class="footer-link">{{ i18n.t('products') }}</router-link></li>
                  <!-- <li><router-link to="/about" class="footer-link">{{ i18n.t('about') }}</router-link></li> -->
                  <li><router-link to="/contact" class="footer-link">{{ i18n.t('contact') }}</router-link></li>
                </ul>
              </div>
              
              <!-- Product Categories -->
              <div class="footer-section">
                <h4 class="section-title">{{ i18n.t('product_categories') }}</h4>
                <ul class="footer-links">
                  <li v-for="category in footerCategories" :key="category.id">
                    <router-link :to="`/category/${category.slug}`" class="footer-link">
                      {{ category.name }}
                    </router-link>
                  </li>
                  <li v-if="footerCategories.length > 0">
                    <router-link to="/products" class="footer-link footer-link-all">
                      {{ i18n.t('view_all_products') }}
                    </router-link>
                  </li>
            </ul>
          </div>
          
              <!-- Contact Information -->
          <div class="footer-section">
                <h4 class="section-title">{{ i18n.t('contact_info') }}</h4>
            <div class="contact-info">
                  <div class="contact-item">
                    <span class="contact-label">{{ i18n.t('email_label') }}</span>
                    <a href="mailto:info@dimas.sa" class="contact-value contact-email">
                      <svg class="contact-icon" viewBox="0 0 24 24" fill="white">
                        <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                      </svg>
                      info@dimas.sa
                    </a>
                  </div>
                  <div class="contact-item">
                    <span class="contact-label">{{ i18n.t('phone_label') }}</span>
                    <a href="https://wa.me/966503402000" target="_blank" class="contact-value contact-whatsapp">
                      <svg class="contact-icon" viewBox="0 0 24 24" fill="white">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                      </svg>
                      <span dir="ltr">+966 50 340 2000</span>
                    </a>
                  </div>
                  <div class="contact-item">
                    <span class="contact-label">{{ i18n.t('address_label') }}</span>
                    <span class="contact-value">{{ i18n.t('address_value') }}</span>
                  </div>
                </div>
              </div>
          </div>
        </div>
        
          <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="footer-bottom-content">
              <p class="copyright">{{ i18n.t('copyright') }}</p>
              <div class="footer-meta">
                <a href="#" class="meta-link">{{ i18n.t('privacy_policy') }}</a>
                <!-- <a href="#" class="meta-link">{{ i18n.t('terms_conditions') }}</a> -->
              </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
import i18n from '../i18n/index.js'
import LanguageSwitcher from './LanguageSwitcher.vue'

export default {
  name: 'MainLayout',
  components: {
    LanguageSwitcher
  },
  data() {
    return {
      mobileMenuOpen: false,
      i18n,
      footerCategories: []
    }
  },
  async mounted() {
    await this.loadFooterCategories()
  },
  methods: {
    toggleMobileMenu() {
      this.mobileMenuOpen = !this.mobileMenuOpen
    },
    closeMobileMenu() {
      this.mobileMenuOpen = false
    },
    handleLanguageChange(newLanguage) {
      // Update language in i18n system
      this.i18n.setLanguage(newLanguage)
      // Reload categories when language changes
      this.loadFooterCategories()
    },
    async loadFooterCategories() {
      try {
        const response = await fetch(`/api/v1/categories?per_page=4&locale=${i18n.currentLanguage}`)
        const data = await response.json()
        this.footerCategories = data.data || []
      } catch (error) {
        console.error('Error loading footer categories:', error)
        this.footerCategories = []
      }
    }
  }
}
</script>

<style scoped>
/* Apple-Style Medical Layout */
.medical-layout {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  background: var(--white);
}

/* Apple-Style Header */
.medical-header {
  position: sticky;
  top: 0;
  z-index: 1000;
  background: rgba(253, 253, 253, 0.8);
  backdrop-filter: saturate(180%) blur(20px);
  border-bottom: 0.5px solid rgba(0, 0, 0, 0.05);
  transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

/* English layout for header */
.medical-header[dir="ltr"] .header-content {
  direction: ltr;
}

.header-backdrop {
  display: none;
}

.header-content {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 3rem;
  gap: var(--spacing-xl);
  padding: 0 1.375rem;
  max-width: 1280px;
  margin: 0 auto;
}

/* Apple-Style Logo */
.medical-logo {
  flex-shrink: 0;
}

.logo-container {
  display: flex;
  align-items: center;
  gap: var(--spacing-sm);
  text-decoration: none;
  padding: var(--spacing-xs);
  border-radius: var(--radius-md);
  transition: all 0.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.logo-container:hover {
  background: rgba(0, 125, 187, 0.04);
}

.logo-icon {
  width: 1.75rem;
  height: 1.75rem;
  background: var(--logo-gray);
  border: 1px solid var(--gray-200);
  border-radius: var(--radius-sm);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--primary);
  transition: all 0.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.logo-container:hover .logo-icon {
  background: var(--primary);
  color: var(--white);
  border-color: var(--primary);
  box-shadow: 0 2px 8px rgba(0, 125, 187, 0.15);
}

.logo-svg {
  width: 1.875rem;
  height: 1.875rem;
}

.logo-text {
  display: flex;
  flex-direction: column;
}

.brand-name {
  font-family: var(--font-arabic);
  font-size: 1.25rem;
  font-weight: 600;
  color: var(--gray-900);
  line-height: 1.2;
  letter-spacing: -0.01em;
}

.brand-tagline {
  font-family: var(--font-arabic);
  font-size: 0.6875rem;
  color: var(--gray-500);
  font-weight: 400;
  line-height: 1;
  margin-top: -0.125rem;
}

/* Apple-Style Navigation */
.medical-nav {
  display: flex;
  align-items: center;
  gap: 0;
}

.nav-item {
  position: relative;
  display: flex;
  align-items: center;
  padding: 0.5rem 0.875rem;
  color: var(--gray-600);
  text-decoration: none;
  font-family: var(--font-arabic);
  font-weight: 400;
  font-size: 1.0625rem;
  border-radius: var(--radius-md);
  transition: all 0.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  white-space: nowrap;
}

.nav-item span {
  position: relative;
}

.nav-item:hover {
  color: var(--gray-900);
  background: rgba(0, 125, 187, 0.04);
}

.nav-item.router-link-active {
  color: var(--primary);
  font-weight: 500;
}

.nav-item.router-link-active::after {
  content: '';
  position: absolute;
  bottom: -0.5rem;
  left: 50%;
  transform: translateX(-50%);
  width: 0.25rem;
  height: 0.25rem;
  background: var(--primary);
  border-radius: 50%;
}

/* Apple-Style Header Actions */
.header-actions {
  display: flex;
  align-items: center;
  gap: var(--spacing-md);
}

.admin-access {
  display: flex;
  align-items: center;
  gap: var(--spacing-xs);
  padding: 0.4375rem 0.875rem;
  background: var(--primary);
  color: var(--white);
  text-decoration: none;
  font-family: var(--font-arabic);
  border-radius: var(--radius-md);
  font-weight: 400;
  font-size: 0.9375rem;
  transition: all 0.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  white-space: nowrap;
}

.admin-access:hover {
  background: var(--primary-dark);
  transform: translateY(-0.5px);
  box-shadow: 0 4px 12px rgba(0, 125, 187, 0.15);
}

.admin-icon {
  width: 1.5rem;
  height: 1.5rem;
}

.mobile-toggle {
  display: none;
  padding: 0.5rem;
  background: none;
  border: none;
  color: var(--neutral-500);
  cursor: pointer;
  border-radius: 0.375rem;
  transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

.mobile-toggle:hover {
  background: var(--neutral-100);
  color: var(--neutral-700);
}

.mobile-toggle svg {
  width: 1.5rem;
  height: 1.5rem;
}

/* Mobile Navigation Panel */
.mobile-panel {
  border-top: 1px solid var(--neutral-100);
  background: white;
  padding: 1rem 0;
}

.mobile-nav {
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
}

.mobile-item {
  display: flex;
  align-items: center;
  padding: 0.75rem 1rem;
  color: var(--neutral-600);
  text-decoration: none;
  font-weight: 500;
  border-radius: 0.5rem;
  transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

.mobile-item:hover {
  background: var(--neutral-50);
  color: var(--primary-600);
}

.mobile-admin {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem 1rem;
  background: var(--primary-600);
  color: white;
  text-decoration: none;
  border-radius: 0.5rem;
  font-weight: 500;
  margin-top: 0.5rem;
}

.mobile-admin svg {
  width: 1rem;
  height: 1rem;
}

/* Main Content */
.medical-main {
  flex: 1;
  position: relative;
}

/* Apple-Style Clean Footer */
.medical-footer {
  background: var(--surface-secondary);
  border-top: 0.5px solid var(--gray-200);
  margin-top: auto;
}

.footer-container {
  max-width: 1280px;
  margin: 0 auto;
  padding: var(--spacing-3xl) 1.375rem var(--spacing-2xl);
  display: grid;
  grid-template-columns: 1fr 2fr;
  gap: var(--spacing-3xl);
  align-items: start;
}

/* Mobile layout - single column */
@media (max-width: 768px) {
  .footer-container {
    grid-template-columns: 1fr;
    gap: var(--spacing-2xl);
    padding: var(--spacing-2xl) 1rem var(--spacing-xl);
    text-align: center;
  }
  
  /* Center all footer sections on mobile */
  .footer-company,
  .footer-links,
  .footer-contact {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
  }
  
  /* Center company logo and text */
  .footer-logo {
    justify-content: center;
  }
  
  /* Center navigation links */
  .footer-nav {
    align-items: center;
  }
  
  .footer-nav ul {
    align-items: center;
  }
  
  /* Center contact information */
  .contact-item {
    justify-content: center;
  }
  
  /* Center footer bottom */
  .footer-bottom {
    text-align: center;
  }
  
  /* Center section headings */
  .footer-section h3 {
    text-align: center;
  }
  
  /* Center all text elements */
  .footer-company p,
  .footer-nav li,
  .contact-item {
    text-align: center;
  }
  
  /* Center the company description */
  .footer-company p {
    max-width: 100%;
    margin: 0 auto;
  }
}

/* English layout - reverse order of main grid items */
.medical-footer[dir="ltr"] .footer-container {
  direction: ltr;
  grid-template-columns: 1fr 2fr; /* عكس الترتيب: الروابط أولاً ثم الشعار */
}

/* Mobile layout for English - single column */
@media (max-width: 768px) {
  .medical-footer[dir="ltr"] .footer-container {
    grid-template-columns: 1fr;
  }
}

/* RTL support for contact icons */
[dir="rtl"] .contact-email:hover,
[dir="rtl"] .contact-whatsapp:hover {
  transform: translateX(-2px);
}

/* Company Section */
.footer-company {
  display: flex;
  flex-direction: column;
  gap: var(--spacing-lg);
}

.footer-logo {
  display: flex;
  align-items: center;
  gap: var(--spacing-sm);
}

.footer-logo-icon {
  width: 2rem;
  height: 2rem;
  background: var(--primary);
  border-radius: var(--radius-sm);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--white);
}

.footer-logo-icon svg {
  width: 1rem;
  height: 1rem;
}

.footer-brand-text {
  display: flex;
  flex-direction: column;
}

.footer-brand {
  font-family: var(--font-arabic);
  font-size: 1.25rem;
  font-weight: 600;
  color: var(--gray-900);
  margin: 0;
  letter-spacing: -0.01em;
}

.footer-tagline {
  font-family: var(--font-arabic);
  font-size: 0.75rem;
  color: var(--gray-500);
  margin: 0;
  margin-top: -0.125rem;
}

.company-description {
  font-family: var(--font-arabic);
  color: var(--gray-600);
  line-height: 1.6;
  font-size: 0.9375rem;
  max-width: 400px;
}

/* Links Grid */
.footer-links-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: var(--spacing-xl);
}

.footer-section {
  display: flex;
  flex-direction: column;
  gap: var(--spacing-md);
}

.section-title {
  font-family: var(--font-arabic);
  font-size: 0.875rem;
  font-weight: 600;
  color: var(--gray-900);
  margin: 0;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

/* Footer Links */
.footer-links {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: var(--spacing-sm);
}

.footer-link {
  font-family: var(--font-arabic);
  color: var(--gray-600);
  text-decoration: none;
  font-size: 0.9375rem;
  transition: all 0.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  line-height: 1.4;
}

.footer-link:hover {
  color: var(--primary);
}

.footer-link-all {
  font-weight: 500;
  color: var(--primary) !important;
  border-top: 1px solid var(--gray-200);
  padding-top: var(--spacing-sm);
  margin-top: var(--spacing-sm);
  display: block;
}

.footer-link-all:hover {
  color: var(--primary-dark) !important;
}

/* Contact Info */
.contact-info {
  display: flex;
  flex-direction: column;
  gap: var(--spacing-sm);
}

.contact-item {
  display: flex;
  flex-direction: column;
  gap: 0.125rem;
}

.contact-label {
  font-size: 0.75rem;
  color: var(--gray-500);
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.contact-value {
  font-size: 0.9375rem;
  color: var(--gray-700);
  font-weight: 500;
  text-decoration: none;
  transition: all 0.3s ease;
}

.contact-email,
.contact-whatsapp {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem;
  border-radius: 0.5rem;
  transition: all 0.3s ease;
}

.contact-email:hover {
  background: rgba(59, 130, 246, 0.1);
  color: #3b82f6 !important;
  transform: translateX(2px);
}

.contact-whatsapp:hover {
  background: rgba(37, 211, 102, 0.1);
  color: #25D366 !important;
  transform: translateX(2px);
}

.contact-icon {
  width: 1.25rem;
  height: 1.25rem;
  flex-shrink: 0;
}

.contact-email .contact-icon {
  color: #3b82f6;
}

.contact-whatsapp .contact-icon {
  color: #25D366;
}

/* Phone number styling */
.contact-whatsapp span[dir="ltr"] {
  font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  font-weight: 500;
  letter-spacing: 0.5px;
}

/* Footer Bottom */
.footer-bottom {
  border-top: 0.5px solid var(--gray-200);
  background: var(--surface-tertiary);
}

.footer-bottom-content {
  max-width: 1280px;
  margin: 0 auto;
  padding: var(--spacing-lg) 1.375rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: var(--spacing-xl);
}

.copyright {
  color: var(--gray-500);
  font-size: 0.875rem;
  margin: 0;
}

.footer-meta {
  display: flex;
  align-items: center;
  gap: var(--spacing-lg);
}

.meta-link {
  color: var(--gray-500);
  text-decoration: none;
  font-size: 0.875rem;
  transition: color 0.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.meta-link:hover {
  color: var(--primary);
}

/* Responsive Design */
@media (max-width: 1024px) {
  .medical-nav {
    display: none;
  }
  
  .mobile-toggle {
    display: block;
  }
  
  .admin-text {
    display: none;
  }
  
  .footer-container {
    grid-template-columns: 1fr;
    gap: var(--spacing-2xl);
  }
  
  
  .footer-links-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 768px) {
  .header-content {
    height: 4rem;
  }
  
  .brand-name {
    font-size: 1.25rem;
  }
  
  .footer-container {
    padding: var(--spacing-2xl) 1rem;
  }
  
  .footer-links-grid {
    grid-template-columns: 1fr;
    gap: var(--spacing-lg);
    text-align: center;
  }
  
  .footer-company {
    text-align: center;
  }
  
  .footer-bottom-content {
    flex-direction: column;
    text-align: center;
    gap: var(--spacing-md);
    padding: var(--spacing-md) 1rem;
  }
  
  .footer-meta {
    justify-content: center;
  }
}

@media (max-width: 480px) {
  .logo-container {
    gap: 0.5rem;
  }
  
  .logo-icon {
    width: 2rem;
    height: 2rem;
  }
  
  .brand-tagline {
    display: none;
  }
  
  .footer-container {
    padding: var(--spacing-xl) 1rem;
  }
  
  .footer-meta {
    flex-direction: column;
    gap: var(--spacing-sm);
  }
}
</style>
