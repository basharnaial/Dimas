<template>
  <div class="home-page">
    <!-- Hero Section -->
    <section class="hero-section">
      <!-- Background Logo -->
      <div class="hero-background-logo">
        <img src="/storage/products/7Y7xXk01.svg" alt="Dimas Background" class="background-logo-svg" />
      </div>
      <div class="hero-content">
        <h1 class="hero-title">
          {{ i18n.t('welcome_title') }} 
          <span class="brand-highlight">{{ i18n.t('welcome_title_brand') }}</span>
        </h1>
        <p class="hero-subtitle">{{ i18n.t('welcome_subtitle') }}</p>
        <router-link to="/products" class="cta-button">
          {{ i18n.t('browse_products') }}
        </router-link>
      </div>
    </section>

    <!-- Categories Section -->
    <section class="categories-section">
      <div class="container">
        <h2 class="section-title">{{ i18n.t('our_categories') }}</h2>
        
        <!-- Categories Loading State -->
        <div v-if="categoriesLoading" class="categories-skeleton">
          <div v-for="n in 4" :key="n" class="category-skeleton-card">
            <div class="category-skeleton-icon"></div>
            <div class="category-skeleton-title"></div>
            <div class="category-skeleton-description"></div>
            <div class="category-skeleton-count"></div>
          </div>
        </div>
        
        <!-- Categories Content -->
        <div v-else class="categories-grid">
          <div 
            v-for="category in categories" 
            :key="category.id" 
            class="category-card"
            @click="goToCategory(category.slug)"
          >
            <div class="category-icon">
              <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" clip-rule="evenodd" />
              </svg>
            </div>
            <h3 class="category-name">{{ category.name }}</h3>
            <p class="category-description">{{ category.description }}</p>
            <div class="category-products-count">
              {{ category.products_count || 0 }} {{ i18n.t('product_count') }}
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Featured Products Section -->
    <section class="featured-products-section">
      <div class="container">
        <h2 class="section-title">{{ i18n.t('featured_products') }}</h2>
        
        <!-- Featured Products Loading State -->
        <div v-if="productsLoading" class="products-skeleton">
          <div v-for="n in 4" :key="n" class="product-skeleton-card">
            <div class="product-skeleton-image"></div>
            <div class="product-skeleton-content">
              <div class="product-skeleton-title"></div>
              <div class="product-skeleton-description"></div>
              <div class="product-skeleton-meta">
                <div class="product-skeleton-meta-item"></div>
                <div class="product-skeleton-meta-item"></div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Featured Products Content -->
        <div v-else-if="featuredProducts.length > 0" class="products-grid">
          <div 
            v-for="product in featuredProducts" 
            :key="product.id" 
            class="product-card"
            @click="goToProduct(product.slug)"
          >
            <div class="product-image">
              <img 
                :src="product.images?.[0]?.url || product.hero_image_url || '/images/placeholder.jpg'" 
                :alt="product.name"
                loading="lazy"
                class="w-full h-48 object-cover rounded-t-lg"
              >
            </div>
            <div class="product-info p-4">
              <h3 class="product-title">{{ product.name }}</h3>
              <p class="product-description">{{ product.short_description }}</p>
              <div class="product-meta">
                <span class="product-category">{{ product.category?.name }}</span>
                <span class="product-sku">{{ product.sku }}</span>
              </div>
            </div>
          </div>
        </div>
        
        <div v-if="!productsLoading && featuredProducts.length > 0" class="text-center mt-8">
          <router-link to="/products" class="view-all-button">
            {{ i18n.t('view_all_products') }}
          </router-link>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
      <div class="container">
        <div class="contact-content">
          <h2 class="contact-title">{{ i18n.t('contact_section_title') }}</h2>
        <p class="contact-text">{{ i18n.t('contact_section_text') }}</p>
          <div class="contact-actions">
            <router-link to="/contact" class="contact-button primary">
          {{ i18n.t('contact_now') }}
        </router-link>
            <a href="https://wa.me/966503402000" target="_blank" class="contact-button whatsapp">
              <svg class="whatsapp-icon" viewBox="0 0 24 24" fill="currentColor">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
              </svg>
              واتساب
            </a>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import i18n from '../i18n/index.js'

export default {
  name: 'HomePage',
  data() {
    return {
      categories: [],
      featuredProducts: [],
      loading: true,
      categoriesLoading: true,
      productsLoading: true,
      i18n
    }
  },
  async mounted() {
    await this.loadCategories()
    await this.loadFeaturedProducts()
    this.loading = false
    this.categoriesLoading = false
    this.productsLoading = false
    
    // Listen for language changes using Vue 3 approach
    if (this.$root && this.$root.$emit) {
      // Create a listener for language changes
      this.languageChangeHandler = (newLanguage) => {
        this.loadCategories()
        this.loadFeaturedProducts()
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
  },
  methods: {
    async loadCategories() {
      try {
        const response = await fetch(`/api/v1/categories?locale=${i18n.currentLanguage}`)
        const data = await response.json()
        this.categories = data.data || []
      } catch (error) {
        console.error('Error loading categories:', error)
        this.categories = []
      }
    },
    async loadFeaturedProducts() {
      try {
        const response = await fetch(`/api/v1/products?per_page=6&locale=${i18n.currentLanguage}`)
        const data = await response.json()
        this.featuredProducts = data.data || []
      } catch (error) {
        console.error('Error loading featured products:', error)
        this.featuredProducts = []
      }
    },
    goToCategory(slug) {
      this.$router.push(`/category/${slug}`)
    },
    goToProduct(slug) {
      this.$router.push(`/product/${slug}`)
    }
  }
}
</script>

<style scoped>
.home-page {
  min-height: 100vh;
  -webkit-overflow-scrolling: touch;
  overflow-x: hidden;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 2rem;
}

/* Hero Section */
.hero-section {
  background: linear-gradient(135deg, #007DBB 0%, #005A85 100%);
  color: white;
  padding: 6rem 2rem;
  text-align: center;
  position: relative;
  overflow: hidden;
  min-height: 60vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background-attachment: fixed;
  background-size: cover;
  position: relative;
}

.hero-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(45deg, rgba(0, 125, 187, 0.1) 0%, rgba(0, 90, 133, 0.1) 100%);
  animation: heroShimmer 3s ease-in-out infinite;
}

@keyframes heroShimmer {
  0%, 100% { opacity: 0.3; }
  50% { opacity: 0.6; }
}

.hero-background-logo {
  position: absolute;
  top: 62%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 120%;
  height: 120%;
  opacity: 0.08;
  z-index: 1;
  pointer-events: none;
}

.background-logo-svg {
  width: 100%;
  height: 100%;
  object-fit: contain;
  filter: brightness(2) contrast(0.5);
  @media (max-width: 768px) {
    filter: brightness(2) contrast(0.4);
  }
}

.hero-content {
  max-width: 800px;
  margin: 0 auto;
  position: relative;
  z-index: 2;
}

.hero-title {
  font-family: var(--font-arabic);
  font-size: 3rem;
  font-weight: 700;
  margin-bottom: 1rem;
  text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
  animation: titleGlow 2s ease-in-out infinite alternate;
}

@keyframes titleGlow {
  from { text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3), 0 0 20px rgba(192, 213, 48, 0.3); }
  to { text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3), 0 0 30px rgba(192, 213, 48, 0.6); }
}

.brand-highlight {
  color: #c0d530;
  font-weight: 800;
  text-shadow: 0 2px 4px rgba(192, 213, 48, 0.3);
  display: inline-block;
  position: relative;
  font-family: var(--font-arabic);
}

.brand-highlight::after {
  content: '';
  position: absolute;
  bottom: -4px;
  left: 0;
  width: 100%;
  height: 3px;
  background: linear-gradient(90deg, #c0d530, #a5c41f);
  border-radius: 2px;
  opacity: 0.8;
}

.hero-subtitle {
  font-family: var(--font-arabic);
  font-size: 1.25rem;
  margin-bottom: 2rem;
  opacity: 0.9;
}

.cta-button {
  display: inline-block;
  background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
  color: #007DBB;
  padding: 1rem 2rem;
  border-radius: 1rem;
  text-decoration: none;
  font-family: var(--font-arabic);
  font-weight: 500;
  font-size: 1.0625rem;
  transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  box-shadow: 0 4px 15px rgba(0, 125, 187, 0.2);
  position: relative;
  overflow: hidden;
  border: 2px solid transparent;
  background-clip: padding-box;
}

.cta-button::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(0, 125, 187, 0.1), transparent);
  transition: left 0.5s;
}

.cta-button:hover::before {
  left: 100%;
}

.cta-button:hover {
  transform: translateY(-0.5px);
  box-shadow: 0 6px 20px rgba(0, 125, 187, 0.25);
  background: #FDFDFD;
}

/* Categories Section */
.categories-section {
  padding: 4rem 0;
  background: #FDFDFD;
}

.section-title {
  font-size: 2.5rem;
  font-weight: 600;
  text-align: center;
  margin-bottom: 3rem;
  color: #111827;
  font-family: var(--font-arabic);
  letter-spacing: -0.02em;
}

.categories-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 2rem;
}

.category-card {
  background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
  padding: 2rem;
  border-radius: 1rem;
  text-align: center;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  cursor: pointer;
  position: relative;
  overflow: hidden;
  border: 1px solid rgba(0, 125, 187, 0.1);
}

.category-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #007DBB, #BFD72C);
  transform: scaleX(0);
  transition: transform 0.3s ease;
}

.category-card:hover::before {
  transform: scaleX(1);
}

.category-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.category-icon {
  color: #007DBB;
  margin-bottom: 1rem;
}

.category-name {
  font-family: var(--font-arabic);
  font-size: 1.5rem;
  font-weight: 600;
  color: #1f2937;
  margin-bottom: 0.5rem;
}

.category-description {
  font-family: var(--font-arabic);
  color: #6b7280;
  margin-bottom: 1rem;
  line-height: 1.6;
}

.category-products-count {
  font-family: var(--font-arabic);
  color: #BFD72C;
  font-weight: 500;
}

/* Featured Products Section */
.featured-products-section {
  padding: 4rem 0;
}

.products-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 2rem;
  margin-bottom: 2rem;
}

.product-card {
  background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
  border-radius: 1rem;
  overflow: hidden;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  cursor: pointer;
  position: relative;
  border: 1px solid rgba(0, 125, 187, 0.1);
  display: flex;
  flex-direction: column;
  height: 100%;
}

.product-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 3px;
  background: linear-gradient(90deg, #007DBB, #BFD72C);
  transform: scaleX(0);
  transition: transform 0.3s ease;
}

.product-card:hover::before {
  transform: scaleX(1);
}

.product-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.product-title {
  font-family: var(--font-arabic);
  font-size: 1.125rem;
  font-weight: 600;
  color: #1f2937;
  margin-bottom: 0.5rem;
}

.product-info {
  padding: 1rem;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}

.product-description {
  font-family: var(--font-arabic);
  color: #6b7280;
  font-size: 0.875rem;
  line-height: 1.5;
  margin-bottom: 1rem;
  flex-grow: 1;
}

.product-meta {
  display: flex;
  justify-content: space-between;
  font-size: 0.75rem;
  color: #9ca3af;
}

.view-all-button {
  display: inline-block;
  background: #007DBB;
  color: white;
  padding: 0.6875rem 1.375rem;
  border-radius: 1rem;
  text-decoration: none;
  font-family: var(--font-arabic);
  font-weight: 400;
  font-size: 1.0625rem;
  transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  box-shadow: 0 2px 8px rgba(0, 125, 187, 0.15);
}

.view-all-button:hover {
  background: #005A85;
  transform: translateY(-0.5px);
  box-shadow: 0 4px 12px rgba(0, 125, 187, 0.25);
}

/* Contact Section */
.contact-section {
  background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
  color: white;
  padding: 2rem 0;
  position: relative;
  overflow: hidden;
}

.contact-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.02)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.02)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.01)"/><circle cx="10" cy="60" r="0.5" fill="rgba(255,255,255,0.01)"/><circle cx="90" cy="40" r="0.5" fill="rgba(255,255,255,0.01)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
  opacity: 0.3;
}

.contact-content {
  text-align: center;
  position: relative;
  z-index: 1;
  max-width: 600px;
  margin: 0 auto;
}

.contact-title {
  font-family: var(--font-arabic);
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 1rem;
  background: linear-gradient(135deg, #ffffff 0%, #cbd5e1 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.contact-text {
  font-family: var(--font-arabic);
  font-size: 1.125rem;
  margin-bottom: 2rem;
  opacity: 0.9;
  line-height: 1.6;
}

.contact-actions {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
  justify-content: center;
}

.contact-button {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem 1.5rem;
  border-radius: 0.75rem;
  text-decoration: none;
  font-family: var(--font-arabic);
  font-weight: 500;
  font-size: 1rem;
  transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  position: relative;
  overflow: hidden;
}

.contact-button.primary {
  background: linear-gradient(135deg, #BFD72C 0%, #A5C41F 100%);
  color: #111827;
  box-shadow: 0 4px 15px rgba(191, 215, 44, 0.3);
}

.contact-button.primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(191, 215, 44, 0.4);
}

.contact-button.whatsapp {
  background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
  color: white;
  box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
}

.contact-button.whatsapp:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4);
}

.whatsapp-icon {
  width: 1.25rem;
  height: 1.25rem;
}



/* Skeleton Loading Styles */
.categories-skeleton {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1.5rem;
  margin-top: 2rem;
}

.category-skeleton-card {
  background: white;
  border-radius: 0.75rem;
  padding: 1.5rem;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  text-align: center;
  animation: skeleton-pulse 1.5s ease-in-out infinite;
}

.category-skeleton-icon {
  width: 3rem;
  height: 3rem;
  background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
  background-size: 200% 100%;
  animation: skeleton-shimmer 1.5s infinite;
  border-radius: 0.5rem;
  margin: 0 auto 1rem;
}

.category-skeleton-title {
  height: 1.5rem;
  background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
  background-size: 200% 100%;
  animation: skeleton-shimmer 1.5s infinite;
  border-radius: 0.25rem;
  margin-bottom: 0.75rem;
  width: 80%;
  margin-left: auto;
  margin-right: auto;
}

.category-skeleton-description {
  height: 0.875rem;
  background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
  background-size: 200% 100%;
  animation: skeleton-shimmer 1.5s infinite;
  border-radius: 0.25rem;
  margin-bottom: 0.5rem;
  width: 100%;
}

.category-skeleton-description:last-of-type {
  width: 60%;
  margin-left: auto;
  margin-right: auto;
}

.category-skeleton-count {
  height: 0.75rem;
  background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
  background-size: 200% 100%;
  animation: skeleton-shimmer 1.5s infinite;
  border-radius: 0.25rem;
  width: 40%;
  margin: 0.75rem auto 0;
}

.products-skeleton {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 1.5rem;
  margin-top: 2rem;
}

.product-skeleton-card {
  background: white;
  border-radius: 0.5rem;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  animation: skeleton-pulse 1.5s ease-in-out infinite;
}

.product-skeleton-image {
  width: 100%;
  height: 12rem;
  background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
  background-size: 200% 100%;
  animation: skeleton-shimmer 1.5s infinite;
}

.product-skeleton-content {
  padding: 1rem;
}

.product-skeleton-title {
  height: 1.25rem;
  background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
  background-size: 200% 100%;
  animation: skeleton-shimmer 1.5s infinite;
  border-radius: 0.25rem;
  margin-bottom: 0.75rem;
  width: 80%;
}

.product-skeleton-description {
  height: 0.875rem;
  background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
  background-size: 200% 100%;
  animation: skeleton-shimmer 1.5s infinite;
  border-radius: 0.25rem;
  margin-bottom: 0.5rem;
  width: 100%;
}

.product-skeleton-description:last-of-type {
  width: 60%;
}

.product-skeleton-meta {
  display: flex;
  justify-content: space-between;
  margin-bottom: 1rem;
}

.product-skeleton-meta-item {
  height: 0.75rem;
  background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
  background-size: 200% 100%;
  animation: skeleton-shimmer 1.5s infinite;
  border-radius: 0.25rem;
  width: 30%;
}

@keyframes skeleton-shimmer {
  0% {
    background-position: -200% 0;
  }
  100% {
    background-position: 200% 0;
  }
}

@keyframes skeleton-pulse {
  0%, 100% {
    opacity: 1;
  }
  50% {
    opacity: 0.8;
  }
}

/* Responsive Design */
/* Large screens */
@media (min-width: 1200px) {
  .container {
    max-width: 1200px;
  }
  
  .categories-grid {
    grid-template-columns: repeat(4, 1fr);
  }
  
  .products-grid {
    grid-template-columns: repeat(4, 1fr);
  }
}

/* Medium screens */
@media (max-width: 1024px) {
  .container {
    padding: 0 1rem;
  }
  
  .hero-title {
    font-size: 2.5rem;
  }
  
  .categories-grid {
    grid-template-columns: repeat(3, 1fr);
  }
  
  .products-grid {
    grid-template-columns: repeat(3, 1fr);
  }
}

/* Tablets */
@media (max-width: 768px) {
  .hero-title {
    font-size: 2rem;
  }
  
  .hero-subtitle {
    font-size: 1rem;
  }
  
  .section-title {
    font-size: 2rem;
  }
  
  .categories-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
  }
  
  .products-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
  }
  
  .categories-skeleton {
    grid-template-columns: repeat(2, 1fr);
  }
  
  .products-skeleton {
    grid-template-columns: repeat(2, 1fr);
  }
  
  .category-card {
    padding: 1rem;
  }
  
  .product-card {
    margin-bottom: 1rem;
  }
}

/* Mobile phones */
@media (max-width: 640px) {
  .container {
    padding: 0 0.75rem;
  }
  
  .hero-section {
    padding: 3rem 1rem;
    min-height: 50vh;
  }
  
  .contact-title {
    font-size: 1.75rem;
  }
  
  .contact-actions {
    justify-content: center;
    flex-direction: column;
    gap: 0.75rem;
  }
  
  .contact-button {
    width: 100%;
    justify-content: center;
  }
  
  .hero-title {
    font-size: 1.75rem;
    line-height: 1.2;
    margin-bottom: 0.75rem;
  }
  
  .hero-subtitle {
    font-size: 0.9rem;
    margin-bottom: 1.5rem;
    line-height: 1.4;
  }
  
  .section-title {
    font-size: 1.75rem;
    margin-bottom: 1.5rem;
  }
  
  .categories-grid {
    grid-template-columns: 1fr;
    gap: 0.75rem;
  }
  
  .products-grid {
    grid-template-columns: 1fr;
    gap: 0.75rem;
  }
  
  .categories-skeleton {
    grid-template-columns: 1fr;
  }
  
  .products-skeleton {
    grid-template-columns: 1fr;
  }
  
  .category-card {
    padding: 0.75rem;
  }
  
  .category-icon svg {
    width: 2rem;
    height: 2rem;
  }
  
  .category-name {
    font-size: 1rem;
  }
  
  .category-description {
    font-size: 0.8rem;
  }
  
  .product-card {
    margin-bottom: 0.75rem;
  }
  
  .product-title {
    font-size: 1rem;
  }
  
  .product-description {
    font-size: 0.8rem;
  }
  
  .hero-button {
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
  }
  
  .view-all-button {
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
  }
  
  .contact-button {
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
  }
}

/* Extra small screens */
@media (max-width: 480px) {
  .container {
    padding: 0 0.5rem;
  }
  
  .hero-section {
    padding: 2rem 0.75rem;
    min-height: 45vh;
  }
  
  .hero-title {
    font-size: 1.5rem;
    line-height: 1.1;
    margin-bottom: 0.5rem;
  }
  
  .hero-subtitle {
    font-size: 0.85rem;
    margin-bottom: 1.25rem;
    line-height: 1.3;
  }
  
  .section-title {
    font-size: 1.5rem;
    margin-bottom: 1rem;
  }
  
  .category-card {
    padding: 0.5rem;
    min-height: auto;
  }
  
  .product-card {
    margin-bottom: 0.5rem;
    min-height: auto;
  }
  
  .hero-button {
    padding: 0.4rem 0.8rem;
    font-size: 0.85rem;
    min-height: 44px; /* Touch target size */
  }
  
  .view-all-button {
    padding: 0.4rem 0.8rem;
    font-size: 0.85rem;
    min-height: 44px;
  }
  
  .contact-button {
    padding: 0.4rem 0.8rem;
    font-size: 0.85rem;
    min-height: 44px;
  }
}
</style>
