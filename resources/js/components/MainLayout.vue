<template>
  <div class="main-layout">
    <!-- Header -->
    <header class="header">
      <div class="container">
        <div class="header-content">
          <!-- Logo -->
          <div class="logo">
            <router-link to="/" class="logo-link">
              <span class="logo-text">ديماس</span>
            </router-link>
          </div>

          <!-- Navigation -->
          <nav class="main-nav">
            <router-link to="/" class="nav-link">الرئيسية</router-link>
            <router-link to="/products" class="nav-link">المنتجات</router-link>
            <router-link to="/about" class="nav-link">من نحن</router-link>
            <router-link to="/contact" class="nav-link">اتصل بنا</router-link>
          </nav>

          <!-- Admin Login -->
          <div class="admin-login">
            <a href="/login" class="admin-btn">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
              </svg>
              <span>لوحة التحكم</span>
            </a>
          </div>

          <!-- Mobile Menu Button -->
          <button @click="toggleMobileMenu" class="mobile-menu-btn">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>

        <!-- Mobile Navigation -->
        <div v-show="mobileMenuOpen" class="mobile-nav">
          <router-link to="/" class="mobile-nav-link" @click="closeMobileMenu">الرئيسية</router-link>
          <router-link to="/products" class="mobile-nav-link" @click="closeMobileMenu">المنتجات</router-link>
          <router-link to="/about" class="mobile-nav-link" @click="closeMobileMenu">من نحن</router-link>
          <router-link to="/contact" class="mobile-nav-link" @click="closeMobileMenu">اتصل بنا</router-link>
          <a href="/login" class="mobile-admin-btn" @click="closeMobileMenu">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <span>لوحة التحكم</span>
          </a>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
      <router-view />
    </main>

    <!-- Footer -->
    <footer class="footer">
      <div class="container">
        <div class="footer-content">
          <div class="footer-section">
            <h3 class="footer-title">ديماس</h3>
            <p class="footer-description">
              موقع متخصص في تقديم المنتجات والخدمات المميزة لعملائنا الكرام
            </p>
          </div>
          
          <div class="footer-section">
            <h4 class="footer-subtitle">روابط سريعة</h4>
            <ul class="footer-links">
              <li><router-link to="/" class="footer-link">الرئيسية</router-link></li>
              <li><router-link to="/products" class="footer-link">المنتجات</router-link></li>
              <li><router-link to="/about" class="footer-link">من نحن</router-link></li>
              <li><router-link to="/contact" class="footer-link">اتصل بنا</router-link></li>
            </ul>
          </div>
          
          <div class="footer-section">
            <h4 class="footer-subtitle">معلومات التواصل</h4>
            <div class="contact-info">
              <p>البريد الإلكتروني: info@dimas.sa</p>
              <p>الهاتف: +966 50 123 4567</p>
              <p>العنوان: المملكة العربية السعودية</p>
            </div>
          </div>
        </div>
        
        <div class="footer-bottom">
          <p>&copy; 2024 ديماس. جميع الحقوق محفوظة</p>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
export default {
  name: 'MainLayout',
  data() {
    return {
      mobileMenuOpen: false
    }
  },
  methods: {
    toggleMobileMenu() {
      this.mobileMenuOpen = !this.mobileMenuOpen
    },
    closeMobileMenu() {
      this.mobileMenuOpen = false
    }
  }
}
</script>

<style scoped>
.main-layout {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 2rem;
}

/* Header */
.header {
  background: white;
  border-bottom: 1px solid #e5e7eb;
  position: sticky;
  top: 0;
  z-index: 50;
}

.header-content {
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 4rem;
}

.logo-link {
  text-decoration: none;
  color: #1f2937;
}

.logo-text {
  font-size: 1.5rem;
  font-weight: 700;
  color: #667eea;
}

.main-nav {
  display: flex;
  gap: 2rem;
}

.nav-link {
  color: #6b7280;
  text-decoration: none;
  font-weight: 500;
  transition: color 0.2s;
  position: relative;
}

.nav-link:hover,
.nav-link.router-link-active {
  color: #667eea;
}

.nav-link.router-link-active::after {
  content: '';
  position: absolute;
  bottom: -0.5rem;
  left: 0;
  right: 0;
  height: 2px;
  background: #667eea;
}

.admin-btn {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  background: #667eea;
  color: white;
  padding: 0.5rem 1rem;
  border-radius: 0.375rem;
  text-decoration: none;
  font-weight: 500;
  transition: background 0.2s;
}

.admin-btn:hover {
  background: #5a67d8;
}

.mobile-menu-btn {
  display: none;
  background: none;
  border: none;
  color: #6b7280;
  cursor: pointer;
  padding: 0.5rem;
}

.mobile-nav {
  display: none;
  padding: 1rem 0;
  border-top: 1px solid #e5e7eb;
}

.mobile-nav-link {
  display: block;
  padding: 0.75rem 0;
  color: #6b7280;
  text-decoration: none;
  border-bottom: 1px solid #f3f4f6;
}

.mobile-nav-link:hover {
  color: #667eea;
}

.mobile-admin-btn {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  background: #667eea;
  color: white;
  padding: 0.75rem;
  border-radius: 0.375rem;
  text-decoration: none;
  font-weight: 500;
  margin-top: 1rem;
}

/* Main Content */
.main-content {
  flex: 1;
}

/* Footer */
.footer {
  background: #1f2937;
  color: white;
  padding: 3rem 0 1rem;
  margin-top: auto;
}

.footer-content {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 2rem;
  margin-bottom: 2rem;
}

.footer-title {
  font-size: 1.5rem;
  font-weight: 700;
  margin-bottom: 1rem;
  color: #667eea;
}

.footer-description {
  color: #d1d5db;
  line-height: 1.6;
}

.footer-subtitle {
  font-size: 1.125rem;
  font-weight: 600;
  margin-bottom: 1rem;
}

.footer-links {
  list-style: none;
  padding: 0;
}

.footer-links li {
  margin-bottom: 0.5rem;
}

.footer-link {
  color: #d1d5db;
  text-decoration: none;
  transition: color 0.2s;
}

.footer-link:hover {
  color: #667eea;
}

.contact-info p {
  color: #d1d5db;
  margin-bottom: 0.5rem;
}

.footer-bottom {
  border-top: 1px solid #374151;
  padding-top: 1rem;
  text-align: center;
  color: #9ca3af;
}

/* Responsive */
@media (max-width: 768px) {
  .main-nav {
    display: none;
  }
  
  .admin-btn span {
    display: none;
  }
  
  .mobile-menu-btn {
    display: block;
  }
  
  .mobile-nav {
    display: block;
  }
  
  .footer-content {
    grid-template-columns: 1fr;
    text-align: center;
  }
}
</style>
