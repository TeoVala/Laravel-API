<template>

<!--  <button @click="productDropDown = !productDropDown" id="dropdownDefaultButton"-->
<!--          class="text-white bg-blue-700 hover:bg-blue-800 mt-2 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"-->
<!--          type="button">-->
<!--    Products object-->
<!--    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"-->
<!--         viewBox="0 0 10 6">-->
<!--      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"-->
<!--            d="m1 1 4 4 4-4"/>-->
<!--    </svg>-->
<!--  </button>-->

<!--  &lt;!&ndash; Dropdown menu &ndash;&gt;-->
<!--  <div v-if="productDropDown" id="dropdown"-->
<!--       class="z-10 bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-full dark:bg-white-700">-->
<!--    Products:{{ products }}-->
<!--  </div>-->

  <!--  Main content  -->
  <div v-if="products" class="grid grid-cols-3 gap-x-8 gap-y-12 pt-10">
    <div v-for="product in products" :key="product.id">
      <div
        class="flex flex-col h-full bg-white shadow-sm border border-gray-200 rounded-lg overflow-hidden">
        <img :src="product.image_url" :alt=" product.title"
             class="w-full object-cover" style="height: 315px;">
        <div class="p-4 text-center flex flex-col justify-between flex-grow">
          <h5 class="text-lg font-semibold text-left mb-2">{{ product.title }}</h5>
          <div class="flex justify-between mt-4">

            <button v-if="userLogged"
                    @click="addToCart(product.id)"
              class="bg-green-600 text-white text-sm px-3 py-1 rounded hover:bg-green-700">
              Add to Cart
            </button>

            <router-link :to="`/product/${product.id}`"
              class="bg-blue-600 text-white text-sm px-3 py-1 rounded hover:bg-blue-700">
              View Product
            </router-link >
          </div>
        </div>
      </div>
    </div>

  </div>


  <div v-else
       class="flex items-center justify-center rounded-lg w-full h-[50vh]">
    <div role="status">
      <svg aria-hidden="true"
           class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
           viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
          fill="currentColor"/>
        <path
          d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
          fill="currentFill"/>
      </svg>
      <span class="sr-only">Loading...</span>
    </div>
  </div>

  <!--  Main content END -->
</template>

<script setup lang="ts">

import {onMounted, ref} from "vue";
import {addProductToCart, getAllProducts} from "@/services/api.ts";
import {userLogged} from "@/js/auth.ts";
import {getCookie} from "@/js/cookies.ts";

const products = ref(null);
const productDropDown = ref(false);

onMounted(() => {
  if (!products.value) {
    getAllProducts().then((res) => {
        products.value = res[0];

      }
    )
  }
});

function addToCart(productId) {
  addProductToCart(productId).then((res) => {
    console.log(res);
  })
}


</script>
