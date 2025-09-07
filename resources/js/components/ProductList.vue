<template>
  <div class="products-container">
    <div class="products-header">
      <h2 class="text-2xl font-bold text-gray-800 mb-6">{{ i18n.t('products') }}</h2>
      <div class="search-filter">
        <input 
          v-model="searchQuery" 
          type="text" 
          :placeholder="i18n.t('search_placeholder')"
          class="search-input"
        >
        <select v-model="selectedCategory" class="category-select">
          <option value="">{{ i18n.t('all_categories') }}</option>
          <option v-for="category in categories" :key="category.id" :value="category.slug">
            {{ category.name }}
          </option>
        </select>
      </div>
    </div>

    <div class="products-grid">
      <div 
        v-for="product in filteredProducts" 
        :key="product.id" 
        class="product-card"
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
          <router-link 
            :to="`/product/${product.slug}`" 
            class="view-product-btn"
          >
            {{ i18n.t('view_details') }}
          </router-link>
        </div>
      </div>
    </div>

    <!-- Skeleton Loading State -->
    <div v-if="loading" class="skeleton-loader">
      <div class="skeleton-grid">
        <div v-for="n in 6" :key="n" class="skeleton-card">
          <div class="skeleton-image"></div>
          <div class="skeleton-content">
            <div class="skeleton-title"></div>
            <div class="skeleton-description"></div>
            <div class="skeleton-meta">
              <div class="skeleton-meta-item"></div>
              <div class="skeleton-meta-item"></div>
            </div>
            <div class="skeleton-button"></div>
          </div>
        </div>
      </div>
    </div>

    <div v-if="!loading && filteredProducts.length === 0" class="no-products">
      {{ i18n.t('no_products') }}
    </div>
  </div>
</template>

<script>
import i18n from '../i18n/index.js'

export default {
  name: 'ProductList',
  data() {
    return {
      products: [],
      categories: [],
      loading: true,
      searchQuery: '',
      selectedCategory: '',
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
          product.short_description.toLowerCase().includes(this.searchQuery.toLowerCase())
        )
      }

      // Filter by category
      if (this.selectedCategory) {
        filtered = filtered.filter(product => 
          product.category?.slug === this.selectedCategory
        )
      }

      return filtered
    }
  },
  async mounted() {
    await this.loadProducts()
    await this.loadCategories()
    this.loading = false
  },
  methods: {
    async loadProducts() {
      try {
        const response = await fetch(`/api/v1/products?locale=${i18n.currentLanguage}`)
        const data = await response.json()
        this.products = data.data || []
      } catch (error) {
        console.error('Error loading products:', error)
        this.products = []
      }
    },
    async loadCategories() {
      try {
        const response = await fetch(`/api/v1/categories?locale=${i18n.currentLanguage}`)
        const data = await response.json()
        this.categories = data.data || []
      } catch (error) {
        console.error('Error loading categories:', error)
        this.categories = []
      }
    }
  }
}
</script>

<style scoped>
/* Global mobile fixes */
* {
  box-sizing: border-box;
}

.products-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 2rem;
  -webkit-overflow-scrolling: touch;
  overflow-x: hidden;
  width: 100%;
  box-sizing: border-box;
}

.products-header {
  margin-bottom: 2rem;
}

.search-filter {
  display: flex;
  gap: 1rem;
  margin-bottom: 2rem;
  padding: 1.5rem;
  background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
  border-radius: 1rem;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  border: 1px solid rgba(0, 125, 187, 0.1);
}

.search-input, .category-select {
  padding: 0.5rem;
  border: 1px solid #d1d5db;
  border-radius: 0.375rem;
  font-size: 0.875rem;
  font-family: var(--font-arabic);
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  background-color: white;
}

.search-input {
  flex: 1;
  min-width: 200px;
}

.products-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 2rem;
}

.product-card {
  border: 1px solid rgba(0, 125, 187, 0.1);
  border-radius: 0.75rem;
  overflow: hidden;
  transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  position: relative;
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
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
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
  flex-grow: 1;
}

.product-meta {
  display: flex;
  justify-content: space-between;
  margin-bottom: 1rem;
  font-size: 0.75rem;
  color: #9ca3af;
}

.view-product-btn {
  display: inline-block;
  background: #3b82f6;
  color: white;
  padding: 0.5rem 1rem;
  border-radius: 0.375rem;
  text-decoration: none;
  font-family: var(--font-arabic);
  font-size: 0.875rem;
  transition: background 0.2s;
  margin-top: auto;
  text-align: center;
}

.view-product-btn:hover {
  background: #2563eb;
}

.loading, .no-products {
  text-align: center;
  padding: 2rem;
  color: #6b7280;
  font-family: var(--font-arabic);
  font-size: 1.125rem;
}

/* Skeleton Loading Styles */
.skeleton-loader {
  padding: 1rem;
}

.skeleton-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 1.5rem;
  padding: 1rem;
}

.skeleton-card {
  background: white;
  border-radius: 0.5rem;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  animation: skeleton-pulse 1.5s ease-in-out infinite;
}

.skeleton-image {
  width: 100%;
  height: 12rem;
  background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
  background-size: 200% 100%;
  animation: skeleton-shimmer 1.5s infinite;
}

.skeleton-content {
  padding: 1rem;
}

.skeleton-title {
  height: 1.25rem;
  background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
  background-size: 200% 100%;
  animation: skeleton-shimmer 1.5s infinite;
  border-radius: 0.25rem;
  margin-bottom: 0.75rem;
  width: 80%;
}

.skeleton-description {
  height: 0.875rem;
  background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
  background-size: 200% 100%;
  animation: skeleton-shimmer 1.5s infinite;
  border-radius: 0.25rem;
  margin-bottom: 0.5rem;
  width: 100%;
}

.skeleton-description:last-of-type {
  width: 60%;
}

.skeleton-meta {
  display: flex;
  justify-content: space-between;
  margin-bottom: 1rem;
}

.skeleton-meta-item {
  height: 0.75rem;
  background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
  background-size: 200% 100%;
  animation: skeleton-shimmer 1.5s infinite;
  border-radius: 0.25rem;
  width: 30%;
}

.skeleton-button {
  height: 2rem;
  background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
  background-size: 200% 100%;
  animation: skeleton-shimmer 1.5s infinite;
  border-radius: 0.375rem;
  width: 40%;
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
  
  .products-grid {
    grid-template-columns: repeat(4, 1fr);
  }
  
  .skeleton-grid {
    grid-template-columns: repeat(4, 1fr);
  }
}

/* Medium screens */
@media (max-width: 1024px) {
  .container {
    padding: 0 1rem;
  }
  
  .products-grid {
    grid-template-columns: repeat(3, 1fr);
  }
  
  .skeleton-grid {
    grid-template-columns: repeat(3, 1fr);
  }
}

/* Tablets */
@media (max-width: 768px) {
  .container {
    padding: 0 1rem;
  }
  
  .products-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
  }
  
  .skeleton-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
  }
  
  .product-card {
    margin-bottom: 1rem;
  }
  
  .search-filter {
    flex-direction: column;
    align-items: stretch;
    gap: 1rem;
  }
  
  .search-input {
    width: 100%;
  }
  
  .category-select {
    width: 100%;
  }
}

/* Mobile phones */
@media (max-width: 640px) {
  .products-container {
    padding: 1rem 0.75rem;
  }
  
  .products-grid {
    grid-template-columns: 1fr;
    gap: 0.75rem;
  }
  
  .skeleton-grid {
    grid-template-columns: 1fr;
    gap: 0.75rem;
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
  
  .product-meta {
    font-size: 0.7rem;
  }
  
  .view-product-btn {
    padding: 0.4rem 0.8rem;
    font-size: 0.8rem;
    min-height: 44px; /* Touch target size */
  }
  
  .search-filter {
    gap: 0.75rem;
  }
  
  .search-input {
    padding: 0.5rem;
    font-size: 0.9rem;
  }
  
  .category-select {
    padding: 0.5rem;
    font-size: 0.9rem;
  }
}

/* Extra small screens */
@media (max-width: 480px) {
  .products-container {
    padding: 0.75rem 0.5rem;
  }
  
  .product-card {
    margin-bottom: 0.5rem;
  }
  
  .product-image img {
    height: 10rem;
  }
  
.product-info {
  padding: 1rem;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}
  
  .product-title {
    font-size: 0.9rem;
  }
  
  .product-description {
    font-size: 0.75rem;
  }
}
</style>
