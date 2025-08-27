<template>
  <div class="product-detail-container">
    <div v-if="loading" class="loading">
      جاري التحميل...
    </div>

    <div v-else-if="product" class="product-detail">
      <!-- Breadcrumb -->
      <nav class="breadcrumb mb-6">
        <router-link to="/" class="breadcrumb-item">الرئيسية</router-link>
        <span class="breadcrumb-separator">/</span>
        <router-link to="/products" class="breadcrumb-item">المنتجات</router-link>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-current">{{ product.name }}</span>
      </nav>

      <div class="product-content">
        <!-- Product Images -->
        <div class="product-images">
          <div class="main-image">
            <img 
              :src="selectedImage || product.images?.[0]?.url || product.hero_image_url || '/images/placeholder.jpg'" 
              :alt="product.name"
              class="w-full h-96 object-cover rounded-lg"
            >
          </div>
          <div v-if="product.images && product.images.length > 1" class="image-thumbnails">
            <img 
              v-for="(image, index) in product.images" 
              :key="index"
              :src="image.url" 
              :alt="`${product.name} - صورة ${index + 1}`"
              @click="selectedImage = image.url"
              :class="['thumbnail', { active: selectedImage === image.url }]"
            >
          </div>
        </div>

        <!-- Product Info -->
        <div class="product-info">
          <h1 class="product-title">{{ product.name }}</h1>
          
          <div class="product-meta">
            <span class="product-sku">SKU: {{ product.sku }}</span>
            <span class="product-category">الفئة: {{ product.category?.name }}</span>
          </div>

          <div class="product-description">
            <h3 class="description-title">الوصف</h3>
            <p>{{ product.short_description }}</p>
          </div>

          <div v-if="product.long_description" class="product-long-description">
            <h3 class="description-title">تفاصيل إضافية</h3>
            <p>{{ product.long_description }}</p>
          </div>

          <div class="product-actions">
            <button class="contact-btn">
              <span>تواصل معنا</span>
            </button>
            <button class="share-btn">
              <span>مشاركة</span>
            </button>
          </div>
        </div>
      </div>

      <!-- Related Products -->
      <div v-if="relatedProducts.length > 0" class="related-products">
        <h3 class="section-title">منتجات مشابهة</h3>
        <div class="related-grid">
          <div 
            v-for="related in relatedProducts" 
            :key="related.id" 
            class="related-card"
          >
            <img 
              :src="related.images?.[0]?.url || related.hero_image_url || '/images/placeholder.jpg'" 
              :alt="related.name"
              class="w-full h-32 object-cover rounded"
            >
            <div class="related-info p-3">
              <h4 class="related-title">{{ related.name }}</h4>
              <router-link 
                :to="`/product/${related.slug}`" 
                class="view-related-btn"
              >
                عرض المنتج
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div v-else class="not-found">
      المنتج غير موجود
    </div>
  </div>
</template>

<script>
export default {
  name: 'ProductDetail',
  data() {
    return {
      product: null,
      relatedProducts: [],
      loading: true,
      selectedImage: null
    }
  },
  async mounted() {
    await this.loadProduct()
    this.loading = false
  },
  methods: {
    async loadProduct() {
      try {
        const slug = this.$route.params.slug
        const response = await fetch(`/api/v1/products/${slug}`)
        const data = await response.json()
        this.product = data.data || data
        
        if (this.product.images && this.product.images.length > 0) {
          this.selectedImage = this.product.images[0].url
        }
        
        // Load related products from same category
        if (this.product.category) {
          await this.loadRelatedProducts()
        }
      } catch (error) {
        console.error('Error loading product:', error)
        this.product = null
      }
    },
    async loadRelatedProducts() {
      try {
        const response = await fetch(`/api/v1/products?category=${this.product.category.slug}&per_page=4`)
        const data = await response.json()
        this.relatedProducts = (data.data || []).filter(p => p.id !== this.product.id)
      } catch (error) {
        console.error('Error loading related products:', error)
        this.relatedProducts = []
      }
    }
  }
}
</script>

<style scoped>
.product-detail-container {
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

.product-content {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 3rem;
  margin-bottom: 3rem;
}

.product-images {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.main-image img {
  border: 1px solid #e5e7eb;
}

.image-thumbnails {
  display: flex;
  gap: 0.5rem;
}

.thumbnail {
  width: 80px;
  height: 80px;
  object-fit: cover;
  border: 2px solid transparent;
  border-radius: 0.375rem;
  cursor: pointer;
  transition: border-color 0.2s;
}

.thumbnail:hover, .thumbnail.active {
  border-color: #3b82f6;
}

.product-title {
  font-size: 2rem;
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 1rem;
}

.product-meta {
  display: flex;
  gap: 1rem;
  margin-bottom: 1.5rem;
  font-size: 0.875rem;
  color: #6b7280;
}

.description-title {
  font-size: 1.125rem;
  font-weight: 600;
  color: #374151;
  margin-bottom: 0.5rem;
}

.product-description, .product-long-description {
  margin-bottom: 1.5rem;
}

.product-description p, .product-long-description p {
  color: #4b5563;
  line-height: 1.6;
}

.product-actions {
  display: flex;
  gap: 1rem;
  margin-top: 2rem;
}

.contact-btn, .share-btn {
  padding: 0.75rem 1.5rem;
  border: none;
  border-radius: 0.375rem;
  font-size: 0.875rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s;
}

.contact-btn {
  background: #3b82f6;
  color: white;
}

.contact-btn:hover {
  background: #2563eb;
}

.share-btn {
  background: #f3f4f6;
  color: #374151;
  border: 1px solid #d1d5db;
}

.share-btn:hover {
  background: #e5e7eb;
}

.related-products {
  border-top: 1px solid #e5e7eb;
  padding-top: 2rem;
}

.section-title {
  font-size: 1.5rem;
  font-weight: 600;
  color: #1f2937;
  margin-bottom: 1.5rem;
}

.related-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 1.5rem;
}

.related-card {
  border: 1px solid #e5e7eb;
  border-radius: 0.5rem;
  overflow: hidden;
  transition: transform 0.2s;
}

.related-card:hover {
  transform: translateY(-2px);
}

.related-title {
  font-size: 1rem;
  font-weight: 500;
  color: #1f2937;
  margin-bottom: 0.5rem;
}

.view-related-btn {
  color: #3b82f6;
  text-decoration: none;
  font-size: 0.875rem;
}

.view-related-btn:hover {
  text-decoration: underline;
}

.loading, .not-found {
  text-align: center;
  padding: 3rem;
  color: #6b7280;
  font-size: 1.125rem;
}

@media (max-width: 768px) {
  .product-content {
    grid-template-columns: 1fr;
    gap: 2rem;
  }
  
  .product-actions {
    flex-direction: column;
  }
}
</style>
