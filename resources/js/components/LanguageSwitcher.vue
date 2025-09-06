<template>
  <div class="language-switcher">
    <button 
      @click="toggleLanguage" 
      class="language-btn"
      :title="i18n.t('language')"
    >
      <span class="language-icon">🌐</span>
      <span class="language-text" style="color:white">{{ getOtherLanguageLabel() }}</span>
    </button>
  </div>
</template>

<script>
import i18n from '../i18n/index.js'

export default {
  name: 'LanguageSwitcher',
  data() {
    return {
      i18n
    }
  },
  methods: {
    toggleLanguage() {
      const newLanguage = i18n.currentLanguage === 'ar' ? 'en' : 'ar'
      
      if (i18n.setLanguage(newLanguage)) {
        // Emit event to parent components
        this.$emit('language-changed', newLanguage)
        
        // Trigger all registered language change handlers
        if (this.$root && this.$root.languageChangeHandlers) {
          this.$root.languageChangeHandlers.forEach(handler => {
            try {
              handler(newLanguage)
            } catch (error) {
              console.error('Error in language change handler:', error)
            }
          })
        }
        
        // Emit specific event for MainLayout to reload categories
        if (this.$parent && this.$parent.loadFooterCategories) {
          this.$parent.loadFooterCategories()
        }
        
        // Force Vue to re-render by updating the router
        this.$router.go(0)
      }
    },
    
    getOtherLanguageLabel() {
      // إظهار اللغة الأخرى المتاحة للتبديل إليها
      if (i18n.currentLanguage === 'ar') {
        return 'En'
      } else {
        return 'ع'
      }
    }
  }
}
</script>

<style scoped>
.language-switcher {
  position: relative;
}

.language-btn {
  display: flex;
  align-items: center;
  gap: 0.25rem;
  padding: 0.5rem 0.75rem;
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: var(--radius-md);
  color: var(--gray-600);
  font-size: 0.875rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  white-space: nowrap;
}

.language-btn:hover {
  background: rgba(255, 255, 255, 0.15);
  border-color: rgba(255, 255, 255, 0.3);
  color: var(--gray-800);
  transform: translateY(-1px);
}

.language-icon {
  font-size: 0.875rem;
}

.language-text {
  font-weight: 500;
  font-size: 0.8rem;
  white-space: nowrap;
}

/* Dark theme for header */
.medical-header .language-btn {
  background: rgba(0, 125, 187, 0.1);
  border-color: rgba(0, 125, 187, 0.2);
  color: var(--gray-700);
}

.medical-header .language-btn:hover {
  background: rgba(0, 125, 187, 0.15);
  border-color: rgba(0, 125, 187, 0.3);
  color: var(--primary);
}
</style>
