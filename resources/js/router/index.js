import { createRouter, createWebHistory } from 'vue-router'
import HomePage from '../components/HomePage.vue'
import ProductList from '../components/ProductList.vue'
import ProductDetail from '../components/ProductDetail.vue'
import CategoryProducts from '../components/CategoryProducts.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomePage,
    meta: { title: 'الرئيسية' }
  },
  {
    path: '/products',
    name: 'products',
    component: ProductList,
    meta: { title: 'جميع المنتجات' }
  },
  {
    path: '/category/:slug',
    name: 'category',
    component: CategoryProducts,
    meta: { title: 'منتجات القسم' }
  },
  {
    path: '/product/:slug',
    name: 'product',
    component: ProductDetail,
    meta: { title: 'تفاصيل المنتج' }
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    } else {
      return { top: 0 }
    }
  }
})

// Update page title
router.beforeEach((to, from, next) => {
  if (to.meta.title) {
    document.title = `${to.meta.title} - ${document.title.split(' - ')[0]}`
  }
  next()
})

export default router
