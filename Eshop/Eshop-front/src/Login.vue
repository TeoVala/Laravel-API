<template>
  <div class="flex items-center justify-center py-12 px-4">

    <div v-if="!toggleView" class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
      <h2 class="text-2xl font-bold text-center mb-6">Login</h2>

      <form @submit.prevent="login">
        <div class="mb-4">
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
          <input id="email" type="email" name="email" required autofocus
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="mb-6">
          <label for="password"
                 class="block text-sm font-medium text-gray-700 mb-1">Password</label>
          <input id="password" type="password" name="password" required
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="flex items-center justify-between mb-4">
          <div class="flex items-center">
            <input id="remember" type="checkbox" name="remember"
                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
            <label for="remember" class="ml-2 block text-sm text-gray-900">Remember me</label>
          </div>

          <a @click="toggleView = !toggleView"
             class="cursor-pointer text-sm text-blue-600 hover:underline">
            No account? Register
          </a>
        </div>

        <div>
          <button type="submit"
                  class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">
            Login
          </button>
        </div>
      </form>
    </div>

    <div v-else class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
      <h2 class="text-2xl font-bold text-center mb-6">Register</h2>

      <form>
        <div class="mb-4">
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
          <input id="email" type="email" name="email" required autofocus
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="mb-6">
          <label for="password"
                 class="block text-sm font-medium text-gray-700 mb-1">Password</label>
          <input id="password" type="password" name="password" required
                 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="flex items-center justify-between mb-4">
          <div class="flex items-center">
            <input id="remember" type="checkbox" name="remember"
                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
            <label for="remember" class="ml-2 block text-sm text-gray-900">Remember me</label>
          </div>

          <a @click="toggleView = !toggleView"
             class="cursor-pointer text-sm text-blue-600 hover:underline">
            Back to login
          </a>
        </div>

        <div>
          <button type="submit"
                  class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">
            Login
          </button>
        </div>
      </form>
    </div>

  </div>

</template>

<script setup lang="ts">
import {ref} from "vue";
import {loginUser} from "@/services/api.ts";
import {useRouter} from "vue-router";
import {createCookie} from "@/js/cookies.ts";
import {userLogged} from "@/js/auth.ts";

const toggleView = ref(false);

const router = useRouter()

function login(event) {
  const formData = new FormData(event.target);

  loginUser(formData.get('email'), formData.get('password'))
    .then((res) => {
      createCookie('token', res.token_type +' '+ res.access_token)

      userLogged.value = true;

      router.replace('/');
    })
}
</script>

<style scoped>

</style>
