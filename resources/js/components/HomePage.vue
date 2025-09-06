<template>
  <div class="home-page">
    <!-- Hero Section -->
    <section class="hero-section">
      <div class="hero-content">
        <h1 class="hero-title">{{ i18n.t('welcome_title') }}</h1>
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
        <div class="categories-grid">
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
    <section v-if="featuredProducts.length > 0" class="featured-products-section">
      <div class="container">
        <h2 class="section-title">{{ i18n.t('featured_products') }}</h2>
        <div class="products-grid">
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
        <div class="text-center mt-8">
          <router-link to="/products" class="view-all-button">
            {{ i18n.t('view_all_products') }}
          </router-link>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
      <div class="container">
        <h2 class="section-title">{{ i18n.t('contact_section_title') }}</h2>
        <p class="contact-text">{{ i18n.t('contact_section_text') }}</p>
        <router-link to="/contact" class="contact-button">
          {{ i18n.t('contact_now') }}
        </router-link>
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
      i18n
    }
  },
  async mounted() {
    await this.loadCategories()
    await this.loadFeaturedProducts()
    this.loading = false
    
    // Listen for language changes
    this.$root.$on('languageChanged', (newLanguage) => {
      this.loadCategories()
      this.loadFeaturedProducts()
    })
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
}

.hero-content {
  max-width: 800px;
  margin: 0 auto;
}

.hero-title {
  font-family: var(--font-arabic);
  font-size: 3rem;
  font-weight: 700;
  margin-bottom: 1rem;
}

.hero-subtitle {
  font-family: var(--font-arabic);
  font-size: 1.25rem;
  margin-bottom: 2rem;
  opacity: 0.9;
}

.cta-button {
  display: inline-block;
  background: white;
  color: #007DBB;
  padding: 1rem 2rem;
  border-radius: 1rem;
  text-decoration: none;
  font-family: var(--font-arabic);
  font-weight: 400;
  font-size: 1.0625rem;
  transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  box-shadow: 0 4px 12px rgba(0, 125, 187, 0.15);
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
  background: white;
  padding: 2rem;
  border-radius: 1rem;
  text-align: center;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: transform 0.2s, box-shadow 0.2s;
  cursor: pointer;
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
  background: white;
  border-radius: 1rem;
  overflow: hidden;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: transform 0.2s, box-shadow 0.2s;
  cursor: pointer;
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

.product-description {
  font-family: var(--font-arabic);
  color: #6b7280;
  font-size: 0.875rem;
  line-height: 1.5;
  margin-bottom: 1rem;
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
  background: #111827;
  color: white;
  padding: 4rem 0;
  text-align: center;
}

.contact-text {
  font-family: var(--font-arabic);
  font-size: 1.25rem;
  margin-bottom: 2rem;
  opacity: 0.9;
}

.contact-button {
  display: inline-block;
  background: #BFD72C;
  color: #111827;
  padding: 0.6875rem 1.375rem;
  border-radius: 1rem;
  text-decoration: none;
  font-family: var(--font-arabic);
  font-weight: 500;
  font-size: 1.0625rem;
  transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  box-shadow: 0 2px 8px rgba(191, 215, 44, 0.15);
}

.contact-button:hover {
  background: #A5C41F;
  transform: translateY(-0.5px);
  box-shadow: 0 4px 12px rgba(191, 215, 44, 0.25);
}

/* Responsive */
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
    grid-template-columns: 1fr;
  }
  
  .products-grid {
    grid-template-columns: 1fr;
  }
}
</style>
