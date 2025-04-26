import axios from "axios";
import {getCookie} from "@/js/cookies.ts";

const base = 'http://eshop-api.test/api'

// Cookie stuff
const api = axios.create({
  headers: {
    'Content-Type': 'application/jsonsss',
    Authorization: `${getCookie('token') || ''}`
  }
});

api.interceptors.request.use((config) => {
  const token = getCookie('token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});


export const getAllProducts = async () => {
  try {
    const response = await api.get(`${base}/product`);
    return response.data;
  } catch (error) {
    console.log('We didn\'t fetch our data! :(', error)
  }
}

export const getProduct = async (id) => {
  try {
    const response = await api.get(`${base}/product/${id}`);

    return response.data;

  } catch (error) {
    console.log('We didn\'t fetch our data! :(', error)
  }
}

export const addProductToCart = async (id: int) => {
  try {
    const response = await api.post(`${base}/cart`, {
      'product_id': id
    })

    return response.data;

  } catch (error) {
    console.log('We didn\'t send your data! :(', error)
  }
}

export const getCart = async () => {
  try {
    const response = await api.get(`${base}/cart`)

    return response;
  }catch(error) {
    console.log('We didn\'t fetch our data! :(', error)
  }
}

export const loginUser = async (email: string, password: string) => {
  try {
    const response = await api.post(`${base}/login`, {
      "email": email,
      "password": password
    })

    return response.data;

  } catch (error) {
    console.log('Failed to login. ', error)
  }
}
