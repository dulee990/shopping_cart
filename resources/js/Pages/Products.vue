<script setup>
import { computed } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import PublicLayout from '@/Layouts/PublicLayout.vue'

const props = defineProps({
  products: Object
})

const page = usePage()
const user = computed(() => page.props.auth?.user)

const addToCart = (productId) => {
  if (!user.value) {
    router.get(route('login'))
    return
  }

  router.post(route('cart.store'), {
    product_id: productId,
    quantity: 1
  }, {
    preserveScroll: true
  })
}

const hasPagination = computed(() => props.products?.last_page > 1)
</script>

<template>
  <PublicLayout>
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Products</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <div
        v-for="product in products.data"
        :key="product.id"
        class="bg-white shadow rounded p-5"
      >
        <h3 class="font-semibold text-lg">{{ product.name }}</h3>

        <p class="text-gray-600 mt-1">${{ product.price }}</p>

        <p
          class="text-sm mt-1"
          :class="product.stock_quantity <= 5 ? 'text-red-600' : 'text-gray-500'"
        >
          Stock: {{ product.stock_quantity }}
        </p>

        <button
          class="mt-4 w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 disabled:opacity-50"
          :disabled="product.stock_quantity === 0"
          @click="addToCart(product.id)"
        >
          {{ user ? 'Add to cart' : 'Login to add' }}
        </button>

        <p v-if="!user" class="mt-2 text-xs text-gray-500 text-center">
          You must be logged in to add items to your cart.
        </p>
      </div>
    </div>

    <div v-if="hasPagination" class="mt-10 flex flex-col items-center gap-3">
      <div class="text-sm text-gray-600">
        Page <span class="font-semibold">{{ products.current_page }}</span>
        of <span class="font-semibold">{{ products.last_page }}</span>
      </div>

      <div class="flex items-center gap-2">
        <button
          class="px-4 py-2 border rounded disabled:opacity-50"
          :disabled="!products.prev_page_url"
          @click="router.get(products.prev_page_url, {}, { preserveScroll: true })"
        >
          Prev
        </button>

        <button
          class="px-4 py-2 border rounded disabled:opacity-50"
          :disabled="!products.next_page_url"
          @click="router.get(products.next_page_url, {}, { preserveScroll: true })"
        >
          Next
        </button>
      </div>
    </div>
  </PublicLayout>
</template>
