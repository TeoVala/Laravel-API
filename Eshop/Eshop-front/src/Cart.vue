<template>
  <div class="container mx-auto p-4">
    <h2 class="text-2xl font-semibold mb-6">Your Cart</h2>
    <!-- Cart items section -->
    <div v-if="cartItems && cartItems.length > 0" class="grid grid-cols-1 gap-6">
      <div v-for="item in cartItems" :key="item.id" class="flex justify-between items-center border-b border-gray-200 pb-4">
        <div class="flex items-center">
          <img :src="item.image_url" alt="product image" class="w-24 h-24 object-cover mr-4" />
          <div class="flex flex-col">
            <h5 class="text-lg font-semibold">{{ item.title }}</h5>
            <p class="text-sm text-gray-500">{{ item.description }}</p>
            <p class="text-sm text-gray-700">Price: ${{ item.price }}</p>
          </div>
        </div>
        <div class="flex items-center gap-4">
          <button
            @click="removeFromCart(item.id)"
            class="bg-red-600 text-white text-sm px-3 py-1 rounded hover:bg-red-700">
            Remove
          </button>
        </div>
      </div>
    </div>

    <!-- Cart empty state -->
    <div v-else class="flex items-center justify-center w-full h-64">
      <p class="text-xl text-gray-500">Your cart is empty</p>
    </div>

    <!-- Cart summary section -->
    <div v-if="cartItems && cartItems.length > 0" class="flex justify-between items-center mt-6 bg-gray-100 p-4 rounded-lg">
      <div class="text-lg font-semibold">Total: ${{ totalPrice }}</div>
      <button
        @click="checkout"
        class="bg-blue-600 text-white text-sm px-4 py-2 rounded hover:bg-blue-700">
        Proceed to Checkout
      </button>
    </div>
  </div>
</template>

<script setup lang="ts">
import {onMounted, ref} from "vue";
import {getCart} from "@/services/api.ts";
import {userLogged} from "@/js/auth.ts";
import {useRouter} from "vue-router";

const cartItems = ref(null);
const totalPrice = ref(0);

const router = useRouter();

onMounted(()=> {

  if(!userLogged.value) {
    router.replace('/');
  }

  if (!cartItems.value) {
    getCart().then((res) => {
        cartItems.value = res.data.products;

        for(const i in cartItems.value) {
          totalPrice.value += cartItems.value[i].price;
        }

    });
  }
});

</script>


<style scoped>

</style>
