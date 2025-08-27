<template>
  <div class="home-page">
    <!-- Hero Section -->
    <section class="hero-section">
      <div class="hero-content">
        <h1 class="hero-title">مرحباً بكم في موقع ديماس</h1>
        <p class="hero-subtitle">اكتشفوا منتجاتنا المميزة وخدماتنا المتطورة</p>
        <router-link to="/products" class="cta-button">
          تصفح المنتجات
        </router-link>
      </div>
    </section>

    <!-- Categories Section -->
    <section class="categories-section">
      <div class="container">
        <h2 class="section-title">أقسامنا</h2>
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
              {{ category.products_count || 0 }} منتج
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Featured Products Section -->
    <section v-if="featuredProducts.length > 0" class="featured-products-section">
      <div class="container">
        <h2 class="section-title">منتجات مميزة</h2>
        <div class="products-grid">
          <div 
            v-for="product in featuredProducts" 
            :key="product.id" 
            class="product-card"
            @click="goToProduct(product.slug)"
          >
            <div class="product-image">
              <img 
                :src="product.images?.[0]?.path || '/images/placeholder.jpg'" 
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
            عرض جميع المنتجات
          </router-link>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
      <div class="container">
        <h2 class="section-title">تواصل معنا</h2>
        <p class="contact-text">هل لديك استفسار؟ نحن هنا لمساعدتك</p>
        <router-link to="/contact" class="contact-button">
          راسلنا الآن
        </router-link>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: 'HomePage',
  data() {
    return {
      categories: [],
      featuredProducts: [],
      loading: true
    }
  },
  async mounted() {
    await this.loadCategories()
    await this.loadFeaturedProducts()
    this.loading = false
  },
  methods: {
    async loadCategories() {
      try {
        const response = await fetch('/api/v1/categories')
        const data = await response.json()
        this.categories = data.data || []
      } catch (error) {
        console.error('Error loading categories:', error)
        this.categories = []
      }
    },
    async loadFeaturedProducts() {
      try {
        const response = await fetch('/api/v1/products?per_page=6')
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
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  padding: 6rem 2rem;
  text-align: center;
}

.hero-content {
  max-width: 800px;
  margin: 0 auto;
}

.hero-title {
  font-size: 3rem;
  font-weight: 700;
  margin-bottom: 1rem;
}

.hero-subtitle {
  font-size: 1.25rem;
  margin-bottom: 2rem;
  opacity: 0.9;
}

.cta-button {
  display: inline-block;
  background: white;
  color: #667eea;
  padding: 1rem 2rem;
  border-radius: 0.5rem;
  text-decoration: none;
  font-weight: 600;
  font-size: 1.125rem;
  transition: transform 0.2s;
}

.cta-button:hover {
  transform: translateY(-2px);
}

/* Categories Section */
.categories-section {
  padding: 4rem 0;
  background: #f8fafc;
}

.section-title {
  font-size: 2.5rem;
  font-weight: 700;
  text-align: center;
  margin-bottom: 3rem;
  color: #1f2937;
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
  color: #667eea;
  margin-bottom: 1rem;
}

.category-name {
  font-size: 1.5rem;
  font-weight: 600;
  color: #1f2937;
  margin-bottom: 0.5rem;
}

.category-description {
  color: #6b7280;
  margin-bottom: 1rem;
  line-height: 1.6;
}

.category-products-count {
  color: #667eea;
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
  font-size: 1.125rem;
  font-weight: 600;
  color: #1f2937;
  margin-bottom: 0.5rem;
}

.product-description {
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
  background: #667eea;
  color: white;
  padding: 1rem 2rem;
  border-radius: 0.5rem;
  text-decoration: none;
  font-weight: 600;
  transition: background 0.2s;
}

.view-all-button:hover {
  background: #5a67d8;
}

/* Contact Section */
.contact-section {
  background: #1f2937;
  color: white;
  padding: 4rem 0;
  text-align: center;
}

.contact-text {
  font-size: 1.25rem;
  margin-bottom: 2rem;
  opacity: 0.9;
}

.contact-button {
  display: inline-block;
  background: #667eea;
  color: white;
  padding: 1rem 2rem;
  border-radius: 0.5rem;
  text-decoration: none;
  font-weight: 600;
  transition: background 0.2s;
}

.contact-button:hover {
  background: #5a67d8;
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
