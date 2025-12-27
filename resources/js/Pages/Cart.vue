<script setup>
import { computed } from 'vue'
import { router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const props = defineProps({
  items: Array
})

const updateQty = (item, qty) => {
  router.patch(route('cart.update', item.id), {
    quantity: qty
  }, { preserveScroll: true })
}

const removeItem = (itemId) => {
  router.delete(route('cart.destroy', itemId), {
    preserveScroll: true
  })
}

const checkout = () => {
  router.post(route('checkout.store'))
}

const total = computed(() =>
  props.items.reduce(
    (sum, item) => sum + item.product.price * item.quantity,
    0
  ).toFixed(2)
)
</script>

<template>
  <AuthenticatedLayout>
    <div class="py-6 max-w-5xl mx-auto">
      <div v-if="items.length === 0" class="text-center text-gray-500">
        Your cart is empty.
      </div>

      <div v-else class="bg-white shadow rounded">
        <table class="w-full">
          <thead>
            <tr class="border-b">
              <th class="p-3 text-left">Product</th>
              <th class="p-3">Price</th>
              <th class="p-3">Qty</th>
              <th class="p-3">Total</th>
              <th class="p-3"></th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="item in items" :key="item.id" class="border-b">
              <td class="p-3">{{ item.product.name }}</td>
              <td class="p-3 text-center">${{ item.product.price }}</td>
              <td class="p-3 text-center">
                <input
                  type="number"
                  min="1"
                  :max="item.product.stock_quantity"
                  class="w-16 border rounded text-center"
                  :value="item.quantity"
                  @change="updateQty(item, $event.target.value)"
                />
              </td>
              <td class="p-3 text-center">
                ${{ (item.product.price * item.quantity).toFixed(2) }}
              </td>
              <td class="p-3 text-center">
                <button
                  class="text-red-600 hover:underline"
                  @click="removeItem(item.id)"
                >
                  Remove
                </button>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="p-4 flex justify-between items-center">
          <div class="font-semibold text-lg">
            Total: ${{ total }}
          </div>

          <button
            class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700"
            @click="checkout"
          >
            Checkout
          </button>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
