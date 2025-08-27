<template>
  <div class="products-container">
    <div class="products-header">
      <h2 class="text-2xl font-bold text-gray-800 mb-6">منتجاتنا</h2>
      <div class="search-filter">
        <input 
          v-model="searchQuery" 
          type="text" 
          placeholder="ابحث عن منتج..."
          class="search-input"
        >
        <select v-model="selectedCategory" class="category-select">
          <option value="">جميع الفئات</option>
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
          <router-link 
            :to="`/product/${product.slug}`" 
            class="view-product-btn"
          >
            عرض التفاصيل
          </router-link>
        </div>
      </div>
    </div>

    <div v-if="loading" class="loading">
      جاري التحميل...
    </div>

    <div v-if="!loading && filteredProducts.length === 0" class="no-products">
      لا توجد منتجات
    </div>
  </div>
</template>

<script>
export default {
  name: 'ProductList',
  data() {
    return {
      products: [],
      categories: [],
      loading: true,
      searchQuery: '',
      selectedCategory: ''
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
        const response = await fetch('/api/v1/products')
        const data = await response.json()
        this.products = data.data || []
      } catch (error) {
        console.error('Error loading products:', error)
        this.products = []
      }
    },
    async loadCategories() {
      try {
        const response = await fetch('/api/v1/categories')
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
.products-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 2rem;
}

.products-header {
  margin-bottom: 2rem;
}

.search-filter {
  display: flex;
  gap: 1rem;
  margin-bottom: 1rem;
}

.search-input, .category-select {
  padding: 0.5rem;
  border: 1px solid #d1d5db;
  border-radius: 0.375rem;
  font-size: 0.875rem;
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
  border: 1px solid #e5e7eb;
  border-radius: 0.5rem;
  overflow: hidden;
  transition: transform 0.2s, box-shadow 0.2s;
  background: white;
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

.view-product-btn {
  display: inline-block;
  background: #3b82f6;
  color: white;
  padding: 0.5rem 1rem;
  border-radius: 0.375rem;
  text-decoration: none;
  font-size: 0.875rem;
  transition: background 0.2s;
}

.view-product-btn:hover {
  background: #2563eb;
}

.loading, .no-products {
  text-align: center;
  padding: 2rem;
  color: #6b7280;
  font-size: 1.125rem;
}
</style>
