import {ref} from "vue";
import {getCookie} from "@/js/cookies.ts";

export const userLogged = ref(false);

export const checkAuth = () => {
  const token = getCookie('token');
  userLogged.value = !!token;
}

export const logoutUser = (router) => {
  document.cookie = "token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  userLogged.value = false;

  router.push('/');
}
