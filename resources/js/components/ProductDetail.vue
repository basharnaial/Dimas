<template>
  <div class="product-detail-container" :dir="i18n.isRTL() ? 'rtl' : 'ltr'">
    <div v-if="loading" class="loading">
      {{ i18n.t('loading') }}
    </div>

    <div v-else-if="product" class="product-detail">
      <!-- Breadcrumb -->
      <nav class="breadcrumb mb-6">
        <router-link to="/" class="breadcrumb-item">{{ i18n.t('home') }}</router-link>
        <span class="breadcrumb-separator">/</span>
        <router-link to="/products" class="breadcrumb-item">{{ i18n.t('products') }}</router-link>
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
            <span class="product-category">{{ i18n.t('category') }}: {{ product.category?.name }}</span>
          </div>

          <div class="product-description">
            <h3 class="description-title">{{ i18n.t('product_description') }}</h3>
            <p>{{ product.short_description }}</p>
          </div>

          <!-- Action Buttons -->
          <div class="product-actions">
            <button @click="contactWhatsApp" class="whatsapp-btn">
              <svg class="whatsapp-icon" viewBox="0 0 24 24" fill="white">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
              </svg>
              {{ i18n.t('contact_us') }}
            </button>
            


      

            <div class="share-container">
              <button class="share-btn">
                <svg class="share-icon" viewBox="0 0 24 24" fill="white">
                  <path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.50-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92 1.61 0 2.92-1.31 2.92-2.92s-1.31-2.92-2.92-2.92z"/>
                </svg>
                <span>{{ i18n.t('share') }}</span>
              </button>
          
              
              <!-- Share Menu -->
              <div class="share-menu">
                <div class="share-options">
              <button @click="shareToFacebook" class="share-option facebook" title="Facebook">
                <svg viewBox="0 0 24 24" fill="white">
                  <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
              </button>
              
              <button @click="shareToTwitter" class="share-option twitter" title="Twitter">
                <svg viewBox="0 0 24 24" fill="white">
                  <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                </svg>
              </button>
              
              <button @click="shareToLinkedIn" class="share-option linkedin" title="LinkedIn">
                <svg viewBox="0 0 24 24" fill="white">
                  <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                </svg>
              </button>
              
              <button @click="shareToWhatsApp" class="share-option whatsapp" title="WhatsApp">
                <svg viewBox="0 0 24 24" fill="white">
                  <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                </svg>
              </button>
              
              <button @click="copyLink" class="share-option copy-link" :title="i18n.t('copy_link')">
                <svg viewBox="0 0 24 24" fill="white">
                  <path d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z"/>
                </svg>
              </button>
                </div>
              </div>
            </div>
          </div>

          <div v-if="product.long_description" class="product-long-description">
            <h3 class="description-title">{{ i18n.t('additional_details') }}</h3>
            <p>{{ product.long_description }}</p>
          </div>

          <!-- Dynamic Option Tables -->
                  <div v-if="product.option_tables && product.option_tables.length > 0" class="product-option-tables">
          <div v-for="(table, tableIndex) in product.option_tables" :key="tableIndex" class="option-table">
            <h3 v-if="getTableTitle(table)" class="table-title">{{ getTableTitle(table) }}</h3>
            <p v-if="getTableDescription(table)" class="table-description">{{ getTableDescription(table) }}</p>
            <div class="table-wrapper">
              <table class="option-data-table">
                <thead>
                  <tr>
                    <th v-for="(column, colIndex) in getTableColumns(table)" :key="colIndex" class="table-header">
                      {{ column }}
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(row, rowIndex) in table.rows" :key="rowIndex" class="table-row">
                    <td v-for="(column, colIndex) in getTableColumns(table)" :key="colIndex" class="table-cell">
                      {{ row[colIndex] || '-' }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        
        </div>
      </div>

      <!-- Related Products -->
      <div v-if="relatedProducts.length > 0" class="related-products">
          <h3 class="section-title">{{ i18n.t('related_products') }}</h3>
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
                {{ i18n.t('view_product') }}
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- <div v-else class="not-found">
      {{ i18n.t('product_not_found') }}
    </div> -->

  </div>
</template>

<script>
import i18n from '../i18n/index.js'

export default {
  name: 'ProductDetail',
  data() {
    return {
      product: null,
      relatedProducts: [],
      loading: true,
      selectedImage: null,
      i18n
    }
  },
  async mounted() {
    await this.loadProduct()
    this.loading = false
    
    // Listen for language changes using Vue 3 approach
    if (this.$root && this.$root.$emit) {
      // Create a listener for language changes
      this.languageChangeHandler = (newLanguage) => {
        this.loadProduct() // Reload product data with new language
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
    async loadProduct() {
      try {
        const slug = this.$route.params.slug
        const response = await fetch(`/api/v1/products/${slug}?locale=${i18n.currentLanguage}`)
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
    },
    getTableTitle(table) {
      if (!table) return null
      return i18n.currentLanguage === 'ar' 
        ? (table.title || null)
        : (table.title_en || table.title || null)
    },
    getTableDescription(table) {
      if (!table) return null
      return i18n.currentLanguage === 'ar' 
        ? (table.description || null)
        : (table.description_en || table.description || null)
    },
    getTableColumns(table) {
      if (!table) return []
      return i18n.currentLanguage === 'ar' 
        ? (table.columns || [])
        : (table.columns_en || table.columns || [])
    },
    
    // WhatsApp Contact
    contactWhatsApp() {
      const phoneNumber = '+966503402000'
      const message = i18n.currentLanguage === 'ar' 
        ? `مرحباً، أود الاستفسار عن المنتج: ${this.product.name}\n\nرابط المنتج: ${window.location.href}`
        : `Hello, I would like to inquire about the product: ${this.product.name}\n\nProduct link: ${window.location.href}`
      
      const whatsappUrl = `https://wa.me/${phoneNumber.replace('+', '')}?text=${encodeURIComponent(message)}`
      window.open(whatsappUrl, '_blank')
    },
    
    // Social Media Sharing
    shareToFacebook() {
      const url = encodeURIComponent(window.location.href)
      const facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`
      window.open(facebookUrl, '_blank', 'width=600,height=400')
    },
    
    shareToTwitter() {
      const url = encodeURIComponent(window.location.href)
      const text = encodeURIComponent(`${this.product.name} - ${this.product.short_description}`)
      const twitterUrl = `https://twitter.com/intent/tweet?url=${url}&text=${text}`
      window.open(twitterUrl, '_blank', 'width=600,height=400')
    },
    
    shareToLinkedIn() {
      const url = encodeURIComponent(window.location.href)
      const linkedinUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${url}`
      window.open(linkedinUrl, '_blank', 'width=600,height=400')
    },
    
    shareToWhatsApp() {
      const message = i18n.currentLanguage === 'ar'
        ? `اطلع على هذا المنتج: ${this.product.name}\n\n${window.location.href}`
        : `Check out this product: ${this.product.name}\n\n${window.location.href}`
      
      const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(message)}`
      window.open(whatsappUrl, '_blank')
    },
    
    // Copy Link
    async copyLink() {
      try {
        await navigator.clipboard.writeText(window.location.href)
        alert(i18n.currentLanguage === 'ar' ? 'تم نسخ الرابط!' : 'Link copied!')
      } catch (err) {
        // Fallback for older browsers
        const textArea = document.createElement('textarea')
        textArea.value = window.location.href
        document.body.appendChild(textArea)
        textArea.select()
        document.execCommand('copy')
        document.body.removeChild(textArea)
        alert(i18n.currentLanguage === 'ar' ? 'تم نسخ الرابط!' : 'Link copied!')
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

/* Product Actions */
.product-actions {
  position: relative;
  display: flex;
  gap: 1rem;
  margin: 2rem 0;
  flex-wrap: wrap;
}

.whatsapp-btn {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  background: #25D366;
  color: white;
  padding: 0.875rem 1.75rem;
  border: none;
  border-radius: 50px;
  font-weight: 600;
  font-size: 1rem;
  cursor: pointer;
  transition: all 0.3s ease;
}

.whatsapp-btn:hover {
  background: #1FAD58;
  transform: translateY(-1px);
}

.whatsapp-icon {
  width: 1.25rem;
  height: 1.25rem;
}

.share-btn {
  position: relative;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  background: #f3f4f6;
  color: #374151;
  padding: 0.875rem 1.75rem;
  border: 1px solid #e5e7eb;
  border-radius: 50px;
  font-weight: 600;
  font-size: 1rem;
  cursor: pointer;
  transition: all 0.3s ease;
}

.share-btn:hover {
  background: #e5e7eb;
  border-color: #d1d5db;
}

.share-icon {
  width: 1.25rem;
  height: 1.25rem;
}

/* Share Container */
.share-container {
  position: relative;
}

/* Share Menu */
.share-menu {
  position: absolute;
  top: 100%;
  left: 0;
  margin-top: 0.5rem;
  z-index: 50;
  opacity: 0;
  visibility: hidden;
  transform: translateY(-10px);
  transition: all 0.3s ease;
}

.share-container:hover .share-menu {
  opacity: 1;
  visibility: visible;
  transform: translateY(0);
}

.share-options {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  background: white;
  border: 1px solid #e5e7eb;
  border-radius: 50px;
  padding: 0.75rem 1rem;
  white-space: nowrap;
}

.share-option {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 2.5rem;
  height: 2.5rem;
  border: none;
  border-radius: 50%;
  cursor: pointer;
  transition: all 0.2s ease;
  text-decoration: none;
}

.share-option svg {
  width: 1.25rem;
  height: 1.25rem;
}

.share-option.facebook {
  background: #1877F2;
  color: white;
}

.share-option.facebook:hover {
  background: #166FE5;
  transform: scale(1.1);
}

.share-option.twitter {
  background: #1DA1F2;
  color: white;
}

.share-option.twitter:hover {
  background: #1A91DA;
  transform: scale(1.1);
}

.share-option.linkedin {
  background: #0A66C2;
  color: white;
}

.share-option.linkedin:hover {
  background: #095BA6;
  transform: scale(1.1);
}

.share-option.whatsapp {
  background: #25D366;
  color: white;
}

.share-option.whatsapp:hover {
  background: #1FAD58;
  transform: scale(1.1);
}

.share-option.copy-link {
  background: #6B7280;
  color: white;
}

.share-option.copy-link:hover {
  background: #4B5563;
  transform: scale(1.1);
}

/* Responsive */
@media (max-width: 768px) {
  .product-actions {
    flex-direction: column;
    align-items: stretch;
  }
  
  .whatsapp-btn,
  .share-container {
    width: 100%;
  }
  
  .whatsapp-btn,
  .share-btn {
    justify-content: center;
  }
  
  .share-menu {
    left: 50%;
    transform: translateX(-50%) translateY(-10px);
  }
  
  .share-container:hover .share-menu {
    transform: translateX(-50%) translateY(0);
  }
  
  .share-options {
    justify-content: center;
  }
}

/* Dynamic Option Tables Styles */
.product-option-tables {
  margin-top: 2rem;
  margin-bottom: 2rem;
}

.option-table {
  margin-bottom: 2rem;
  background: #f9fafb;
  border-radius: 0.5rem;
  padding: 1.5rem;
  border: 1px solid #e5e7eb;
}

.table-title {
  font-size: 1.25rem;
  font-weight: 600;
  color: #1f2937;
  margin-bottom: 0.5rem;
  padding-bottom: 0.5rem;
  border-bottom: 2px solid #3b82f6;
  display: inline-block;
}

.table-description {
  font-size: 0.875rem;
  color: #6b7280;
  margin-bottom: 1rem;
  line-height: 1.5;
}

.table-wrapper {
  overflow-x: auto;
  border-radius: 0.5rem;
  box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
}

.option-data-table {
  width: 100%;
  border-collapse: collapse;
  background: white;
  border-radius: 0.5rem;
  overflow: hidden;
}

.table-header {
  background: #3b82f6;
  color: white;
  font-weight: 600;
  text-align: right;
  padding: 0.875rem 1rem;
  border-bottom: 1px solid #2563eb;
  font-size: 0.875rem;
  white-space: nowrap;
}

.table-row {
  transition: background-color 0.2s ease;
}

.table-row:nth-child(even) {
  background: #f8fafc;
}

.table-row:hover {
  background: #e0f2fe;
}

.table-cell {
  padding: 0.875rem 1rem;
  text-align: right;
  border-bottom: 1px solid #e5e7eb;
  color: #374151;
  font-size: 0.875rem;
  vertical-align: top;
  line-height: 1.5;
  word-wrap: break-word;
}

.table-row:last-child .table-cell {
  border-bottom: none;
}

/* Responsive table styles */
@media (max-width: 640px) {
  .table-wrapper {
    font-size: 0.75rem;
  }
  
  .table-header,
  .table-cell {
    padding: 0.5rem 0.75rem;
  }
  
  .table-title {
    font-size: 1.125rem;
  }
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
