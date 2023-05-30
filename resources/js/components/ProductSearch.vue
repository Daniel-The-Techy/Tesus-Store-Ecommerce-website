<template>
    <!-- shop wrapper -->
    <div class="Container  grid grid-cols-4 gap-6 pt-4 pb-16 item-start">
     <!-- sidebar -->
     
 <Categorys/>
 
     

   
  

       <!-- products -->
       <div class="col-span-3">
         <div v-if="message" class="bg-green-600 rounded-md w-full md:w-[30%] overflow-hidden mb-2 py-2 text-center md:ml-auto">
 <p class="text-white">{{ message }}</p>
</div>
         <div class="flex items-center mb-4 ">
             
        
             <select name="sort" id="sort" @change="selected($event)"
                 class="w-44 text-sm text-gray-600 py-3 px-4 border-gray-300 shadow-sm rounded focus:ring-primary focus:border-primary">
                 <option value="">Default sorting</option>
                 <option value="price-low-to-high">Price low to high</option>
                 <option value="price-high-to-low">Price high to low</option>
                 <option value="latest">Latest product</option>
             </select>

             <div class="flex gap-2 ml-auto">
                 <div
                     class="border border-primary w-10 h-9 flex items-center justify-center text-white bg-primary rounded cursor-pointer">
                     <i class="fa-solid fa-grip-vertical"></i>
                 </div>
                 <div
                     class="border border-gray-300 w-10 h-9 flex items-center justify-center text-gray-600 rounded cursor-pointer">
                     <i class="fa-solid fa-list"></i>
                 </div>


             </div>
         </div>
         

         

         <div class="mb-3 text-bold w-full text-2xl">
         <h4>{{ store.SearchData.length }} Products meet the Search Criteria</h4>
         </div>

         <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 w-[130%] md:w-full">
             <div v-for="item in Search" :key="item.id">
             <div class="bg-white shadow rounded overflow-hidden group ">
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
                 <div class="flex">
             <button
      class="block w-1/2 py-1 text-center text-white bg-orange-600 border border-primary rounded-b
       hover:bg-black hover:text-primary transition" @click="addToCart(item.id)">Add
                     to cart</button>

                     <button @click="createWishlist(item.id)"
         class="block w-1/2 py-1 text-center text-white bg-orange-600 border border-primary rounded-b
          hover:bg-black hover:text-primary transition">   
          Add to Wishlist</button>

                     </div>
             </div>
             </div>

           



         </div>
     </div>
     <!-- ./products -->
    
 </div>

 <Notification/>
 <Footer/>
 
</template>

<script setup>

import { computed, defineProps, onMounted, watch,ref } from 'vue';
import Categorys from '../components/Categorys.vue'
import { useProductStore } from '../Store/ProductStore';
import { useCartStore } from '../Store/CartStore';
import Notification from './Notification.vue';
import { useRoute } from 'vue-router';
import Footer from './Footer.vue';
import UseCartComposable from './Composables/AddtoCart'


const store=useProductStore()
const CartStore=useCartStore()
const route=useRoute()

const {inserToCart, insertToWishlist}=UseCartComposable()

const props=defineProps({
    ProductName:{
         required:true,
         type:String
    }
})



watch(() =>route.params.ProductName, (newVal, oldval) => {
      
       store.Search(newVal)
    })
 
    onMounted(store.Search(props.ProductName))
  

const Search=computed(() =>store.SearchData);



function addToCart(id){
   inserToCart(id)
}

function createWishlist(id){
    insertToWishlist(id)
}




</script>