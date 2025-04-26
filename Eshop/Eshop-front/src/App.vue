<template>
  <nav class="bg-white shadow-sm py-3">
    <div class="flex justify-between mx-auto px-4">
      <router-link to="/" class="block text-xl font-semibold text-gray-800">
        Eshop
      </router-link>

      <div class="flex gap-x-2">
        <div v-if="!userLogged">
          <router-link to="/login" class="text-xl font-semibold text-gray-800">
          Login
          </router-link>
        </div>

        <div v-else class="flex gap-x-2">
          <router-link to="/cart" class="text-xl font-semibold text-gray-800">
            Cart
          </router-link>

          <div @click="logoutUser(router)" class="cursor-pointer text-xl font-semibold text-gray-800">
            Logout
          </div>
        </div>
      </div>

    </div>
  </nav>

  <main class="flex flex-col gap-y-4 px-4">
    <router-view/>
  </main>

</template>

<script setup lang="ts">
import {onMounted} from "vue";
import {checkAuth, logoutUser, userLogged} from "@/js/auth.ts";
import {useRouter} from "vue-router";

const router = useRouter();

onMounted(()=>{
  checkAuth();
});
</script>

<style scoped>

</style>
