<script setup>
import { computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import Dropdown from '@/Components/Dropdown.vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import NavLink from '@/Components/NavLink.vue'

const page = usePage()
const user = computed(() => page.props.auth?.user)
const cartCount = computed(() => page.props.cartCount ?? 0)
</script>

<template>
  <div class="min-h-screen bg-gray-100">
    <nav class="border-b border-gray-100 bg-white">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
          <div class="flex items-center gap-6">
            <Link :href="route('products')" class="flex items-center gap-2">
              <ApplicationLogo class="h-8 w-8 fill-current text-gray-500" />
              <span class="font-semibold text-gray-800">Shopping Cart</span>
            </Link>

            <div class="hidden sm:flex sm:items-center">
              <NavLink
                :href="route('products')"
                :active="route().current('products.*')"
              >
                Products
              </NavLink>
            </div>
          </div>

          <!-- Right side -->
          <div class="flex items-center gap-4">
            <!-- Guest -->
            <template v-if="!user">
              <Link
                v-if="route().has('login')"
                :href="route('login')"
                class="text-sm text-gray-700 hover:underline"
              >
                Login
              </Link>

              <Link
                v-if="route().has('register')"
                :href="route('register')"
                class="text-sm text-gray-700 hover:underline"
              >
                Register
              </Link>
            </template>

            <!-- Auth -->
            <template v-else>
              <!-- Cart icon -->
              <Link
                :href="route('cart')"
                class="relative inline-flex items-center text-gray-500 hover:text-gray-700"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-6 w-6"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="2"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.293 2.293A1 1 0 007.618 17H17m0 0a1 1 0 100 2 1 1 0 000-2zm-10 0a1 1 0 100 2 1 1 0 000-2z"
                  />
                </svg>

                <span
                  v-if="cartCount > 0"
                  class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full h-5 min-w-[20px] flex items-center justify-center px-1"
                >
                  {{ cartCount }}
                </span>
              </Link>

              <!-- User dropdown -->
              <Dropdown align="right" width="48">
                <template #trigger>
                  <span class="inline-flex rounded-md">
                    <button
                      type="button"
                      class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                    >
                      {{ user.name }}

                      <svg
                        class="-me-0.5 ms-2 h-4 w-4"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                          clip-rule="evenodd"
                        />
                      </svg>
                    </button>
                  </span>
                </template>

                <template #content>
                  <DropdownLink :href="route('profile.edit')">Profile</DropdownLink>
                  <DropdownLink :href="route('logout')" method="post" as="button">
                    Log Out
                  </DropdownLink>
                </template>
              </Dropdown>
            </template>
          </div>
        </div>
      </div>
    </nav>

    <main class="py-8">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <slot />
      </div>
    </main>
  </div>
</template>
