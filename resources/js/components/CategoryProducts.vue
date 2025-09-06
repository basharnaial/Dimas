<template>
  <div class="category-products-container">
    <div v-if="loading" class="loading">
      {{ i18n.t('loading') }}
    </div>

    <div v-else-if="category" class="category-products">
      <!-- Breadcrumb -->
      <nav class="breadcrumb mb-6">
        <router-link to="/" class="breadcrumb-item">{{ i18n.t('home') }}</router-link>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-current">{{ category.name }}</span>
      </nav>

      <!-- Category Header -->
      <div class="category-header mb-8">
        <h1 class="category-title">{{ category.name }}</h1>
        <p v-if="category.description" class="category-description">
          {{ category.description }}
        </p>
        <div class="category-stats">
          <span class="products-count">{{ products.length }} {{ i18n.t('product_count') }}</span>
        </div>
      </div>

      <!-- Search and Filter -->
      <div class="search-filter mb-6">
        <input 
          v-model="searchQuery" 
          type="text" 
          :placeholder="currentLanguage === 'ar' ? 'ابحث في منتجات هذا القسم...' : 'Search in this category products...'"
          class="search-input"
        >
        <select v-model="sortBy" class="sort-select">
          <option value="name">{{ currentLanguage === 'ar' ? 'ترتيب حسب الاسم' : 'Sort by Name' }}</option>
          <option value="created_at">{{ currentLanguage === 'ar' ? 'ترتيب حسب التاريخ' : 'Sort by Date' }}</option>
          <option value="sku">{{ currentLanguage === 'ar' ? 'ترتيب حسب SKU' : 'Sort by SKU' }}</option>
        </select>
      </div>

      <!-- Products Grid -->
      <div v-if="filteredProducts.length > 0" class="products-grid">
        <div 
          v-for="product in filteredProducts" 
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
              <span class="product-sku">{{ product.sku }}</span>
              <span class="product-date">{{ formatDate(product.created_at) }}</span>
            </div>
            <div class="product-actions">
              <button class="view-product-btn">
                {{ currentLanguage === 'ar' ? 'عرض التفاصيل' : 'View Details' }}
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- No Products -->
      <div v-else-if="!loading" class="no-products">
        <div class="no-products-content">
          <svg class="no-products-icon" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" clip-rule="evenodd" />
          </svg>
          <h3>{{ currentLanguage === 'ar' ? 'لا توجد منتجات في هذا القسم' : 'No products in this category' }}</h3>
          <p>{{ currentLanguage === 'ar' ? 'جرب البحث بكلمات مختلفة أو تصفح الأقسام الأخرى' : 'Try searching with different keywords or browse other categories' }}</p>
          <router-link to="/" class="back-home-btn">
            {{ currentLanguage === 'ar' ? 'العودة للرئيسية' : 'Back to Home' }}
          </router-link>
        </div>
      </div>

      <!-- Back to Categories -->
      <div class="back-to-categories">
        <router-link to="/" class="back-link">
          {{ currentLanguage === 'ar' ? '← العودة لجميع الأقسام' : '← Back to All Categories' }}
        </router-link>
      </div>
    </div>

    <div v-else class="not-found">
      {{ i18n.t('category_not_found') }}
    </div>
  </div>
</template>

<script>
import i18n from '../i18n/index.js'

export default {
  name: 'CategoryProducts',
  data() {
    return {
      category: null,
      products: [],
      loading: true,
      searchQuery: '',
      sortBy: 'name',
      i18n
    }
  },
  computed: {
    filteredProducts() {
      let filtered = this.products

      // Filter by search query
      if (this.searchQuery) {
        filtered = filtered.filter(product => 
          product.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
          product.short_description.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
          product.sku.toLowerCase().includes(this.searchQuery.toLowerCase())
        )
      }

      // Sort products
      filtered.sort((a, b) => {
        if (this.sortBy === 'name') {
          return a.name.localeCompare(b.name, 'ar')
        } else if (this.sortBy === 'created_at') {
          return new Date(b.created_at) - new Date(a.created_at)
        } else if (this.sortBy === 'sku') {
          return a.sku.localeCompare(b.sku)
        }
        return 0
      })

      return filtered
    }
  },
  async mounted() {
    await this.loadCategoryAndProducts()
    this.loading = false
    
    // Listen for language changes using Vue 3 approach
    if (this.$root && this.$root.$emit) {
      // Create a listener for language changes
      this.languageChangeHandler = (newLanguage) => {
        this.loadCategoryAndProducts()
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
    async loadCategoryAndProducts() {
      try {
        const slug = this.$route.params.slug
        
        // Load category
        const categoryResponse = await fetch(`/api/v1/categories/${slug}?locale=${i18n.currentLanguage}`)
        const categoryData = await categoryResponse.json()
        this.category = categoryData.data || categoryData

        // Load products for this category
        const productsResponse = await fetch(`/api/v1/products?category=${slug}&locale=${i18n.currentLanguage}`)
        const productsData = await productsResponse.json()
        this.products = productsData.data || []
      } catch (error) {
        console.error('Error loading category and products:', error)
        this.category = null
        this.products = []
      }
    },
    goToProduct(slug) {
      this.$router.push(`/product/${slug}`)
    },
    formatDate(dateString) {
      if (!dateString) return ''
      const date = new Date(dateString)
      return this.currentLanguage === 'ar' 
        ? date.toLocaleDateString('ar-SA')
        : date.toLocaleDateString('en-US')
    }
  }
}
</script>

<style scoped>
.category-products-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 2rem;
}

.breadcrumb {
  display: flex;
  align-items: center;
  font-size: 0.875rem;
  color: #6b7280;
}

.breadcrumb-item {
  color: #3b82f6;
  text-decoration: none;
}

.breadcrumb-item:hover {
  text-decoration: underline;
}

.breadcrumb-separator {
  margin: 0 0.5rem;
}

.breadcrumb-current {
  color: #374151;
  font-weight: 500;
}

.category-header {
  text-align: center;
  padding: 2rem 0;
  border-bottom: 1px solid #e5e7eb;
}

.category-title {
  font-size: 2.5rem;
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 1rem;
}

.category-description {
  font-size: 1.125rem;
  color: #6b7280;
  margin-bottom: 1rem;
  line-height: 1.6;
}

.category-stats {
  display: flex;
  justify-content: center;
  gap: 1rem;
}

.products-count {
  background: #3b82f6;
  color: white;
  padding: 0.5rem 1rem;
  border-radius: 0.375rem;
  font-weight: 500;
}

.search-filter {
  display: flex;
  gap: 1rem;
  align-items: center;
}

.search-input {
  flex: 1;
  padding: 0.75rem;
  border: 1px solid #d1d5db;
  border-radius: 0.375rem;
  font-size: 1rem;
}

.sort-select {
  padding: 0.75rem;
  border: 1px solid #d1d5db;
  border-radius: 0.375rem;
  font-size: 1rem;
  min-width: 200px;
}

.products-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 2rem;
  margin-bottom: 3rem;
}

.product-card {
  border: 1px solid #e5e7eb;
  border-radius: 0.5rem;
  overflow: hidden;
  transition: transform 0.2s, box-shadow 0.2s;
  background: white;
  cursor: pointer;
}

.product-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
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
  margin-bottom: 1rem;
  font-size: 0.75rem;
  color: #9ca3af;
}

.product-actions {
  text-align: center;
}

.view-product-btn {
  background: #3b82f6;
  color: white;
  padding: 0.5rem 1rem;
  border: none;
  border-radius: 0.375rem;
  font-size: 0.875rem;
  cursor: pointer;
  transition: background 0.2s;
}

.view-product-btn:hover {
  background: #2563eb;
}

.no-products {
  text-align: center;
  padding: 4rem 2rem;
}

.no-products-content {
  max-width: 400px;
  margin: 0 auto;
}

.no-products-icon {
  width: 4rem;
  height: 4rem;
  color: #9ca3af;
  margin-bottom: 1rem;
}

.no-products h3 {
  font-size: 1.5rem;
  font-weight: 600;
  color: #374151;
  margin-bottom: 0.5rem;
}

.no-products p {
  color: #6b7280;
  margin-bottom: 1.5rem;
}

.back-home-btn {
  display: inline-block;
  background: #3b82f6;
  color: white;
  padding: 0.75rem 1.5rem;
  border-radius: 0.375rem;
  text-decoration: none;
  font-weight: 500;
  transition: background 0.2s;
}

.back-home-btn:hover {
  background: #2563eb;
}

.back-to-categories {
  text-align: center;
  padding: 2rem 0;
  border-top: 1px solid #e5e7eb;
}

.back-link {
  color: #3b82f6;
  text-decoration: none;
  font-weight: 500;
  font-size: 1.125rem;
}

.back-link:hover {
  text-decoration: underline;
}

.loading, .not-found {
  text-align: center;
  padding: 3rem;
  color: #6b7280;
  font-size: 1.125rem;
}

@media (max-width: 768px) {
  .category-title {
    font-size: 2rem;
  }
  
  .search-filter {
    flex-direction: column;
    align-items: stretch;
  }
  
  .products-grid {
    grid-template-columns: 1fr;
  }
}
</style>
