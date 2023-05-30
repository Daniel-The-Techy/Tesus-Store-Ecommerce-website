<template>

<div class="Container  grid grid-cols-4 gap-6 pt-4 pb-16 item-start">

    <categorys/>

  

                <div class="col-span-3">
                    <div class="message">
        <h3 class="text-4xl text-bold">{{ Products.length }} Product is under this Category</h3>
    </div>
    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 w-[130%] md:w-full  ">
                <div v-for="item in Products" :key="item.id">
                <div class="bg-white w-full md:w-[90%] shadow rounded overflow-hidden group ">
                    <div class="relative">
                        <img src='../../assets/product.jpg' alt="product 1" class="w-full">
                        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center 
                        justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                            <a href="#"
                                class="text-white text-lg w-9 h-8 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition"
                                title="view product">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                            <a href="#"
                                class="text-white text-lg w-9 h-8 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition"
                                title="add to wishlist">
                                <i class="fa-solid fa-heart"></i>
                            </a>
                        </div>
                    </div>
                    <div class="pt-4 pb-3 px-4">
                        <router-link :to="{ name: 'Product', params:{ slug: item.slug }}">
                            <h4 class="uppercase font-medium text-xl mb-2 text-gray-800 hover:text-primary transition">
                                {{ item.title }}</h4>
                        </router-link>
                        <div class="text-gray-400 text-sm">
                            <p>{{ item.description.slice(0, 100) }}</p>
                        </div>
                        <div class="flex items-baseline mb-1 space-x-2 mt-2">
                            <p class="text-xl text-primary font-semibold">${{ item.price }}</p>
                            <p class="text-sm text-gray-400 line-through">$55.90</p>
                        </div>
                        <div class="flex items-center">
                            <div class="flex gap-1 text-sm text-yellow-400">
                                <span><i class="fa-solid fa-star"></i></span>
                                <span><i class="fa-solid fa-star"></i></span>
                                <span><i class="fa-solid fa-star"></i></span>
                                <span><i class="fa-solid fa-star"></i></span>
                                <span><i class="fa-solid fa-star"></i></span>
                            </div>
                            <div class="text-xs text-gray-500 ml-3">(150)</div>
                        </div>
                    </div>
                    <input type="hidden" v-model="id">
                    <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
                    class="w-6 h-6 absolute left-2 md:left-10 text-white top-1">
  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
</svg>
</div>

<div class="flex">
                <button
         class="block w-1/2 py-1 text-center text-white bg-orange-600 border border-primary rounded-b
          hover:bg-black hover:text-primary pl-5 transition" @click="addToCart(item.id)">   
          Add
                        to cart</button>
                        <button @click="createWishlist(item.id)"
         class="block w-1/2 py-1 text-center text-white bg-orange-500 border border-primary rounded-b
          hover:bg-black hover:text-primary transition">   
          Add to Wishlist</button>
                </div>
                </div>

                </div>

              



            </div>
            </div>
        </div>

        <Footer/>
        <!-- ./products -->
        <Notification/>
    




</template>

<script setup>

import { useRoute } from 'vue-router';
import { useProductStore } from '../Store/ProductStore';
import {computed, watch} from 'vue';
import { useCartStore } from '../Store/CartStore';
import Notification from './Notification.vue';
import categorys from '../components/Categorys.vue'
import Footer from './Footer.vue';
import UseCartComposable from './Composables/AddtoCart';


const store=useProductStore()

const route=useRoute();

const CartStore=useCartStore();

const id=route.params.name

const {inserToCart, insertToWishlist }=UseCartComposable()

store.getCategoryByID(id)
.then(()=>{
    console.log('....Successful')
})

watch(() =>route.params.name, (newVal, oldval) => {
      
      store.getCategoryByID(newVal)
   })


const Products=computed(() => store.ProductCategory)

function addToCart(id){
   inserToCart(id)
}

function createWishlist(id){
    insertToWishlist(id)
}




</script>