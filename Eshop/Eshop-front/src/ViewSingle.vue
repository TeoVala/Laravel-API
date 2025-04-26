<template>
  <div v-if="product" class="flex flex-col mt-10 mb-20 mx-auto gap-y-3">
    <img :src="product.image_url" alt="product.title"
         class="self-center h-[200px] w-[450px] object-cover object-center mb-4 rounded">

    <h2 class="text-2xl font-bold mb-3">{{ product.title }} </h2>

    <h4 class="text-xl text-gray-500 mb-4">Price: {{ product.price }}</h4>

    <div class="mb-6">
      {{ product.description }}
    </div>

    <form @submit.prevent="addToCart" class="flex justify-center">
      <button v-if="userLogged"
              class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded text-sm">
        Add to Cart
      </button>
    </form>

  </div>
</template>

<script setup lang="ts">
import {onMounted, ref} from "vue";
import {useRoute} from "vue-router";
import {addProductToCart, getProduct} from "@/services/api.ts";
import {userLogged} from "@/js/auth.ts";

const route = useRoute();

const productId = route.params.productId
const product = ref(null);

onMounted(() => {
  if (productId) {
    getProduct(productId).then((res) => {
        product.value = res[0];
      }
    )
  }

});

function addToCart() {
  addProductToCart(productId).then((res) => {
    console.log(res);
  })
}

</script>

<style scoped>

</style>
