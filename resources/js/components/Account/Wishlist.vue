<template>
            <!-- wishlist -->
            <div class="Container">
            <div class="grid grid-row md:grid-cols-12  gap-24 pt-4 pb-16">
                
            <AccountSidebar/>
            

        <div class="col-span-9 space-x-4">
            <div v-if="wishlist">
            <div v-for="item in wishlist" :key="item.id">
            <div class="flex items-center justify-between border gap-6 p-4 border-gray-200 rounded mb-3">
                <div class="w-28">
                    <img src="../assets/images/products/product6.jpg" alt="product 6" class="w-full">
                </div>
                <div class="w-1/3">
                    <h2 class="text-gray-800 text-xl font-medium uppercase">{{ item.title }}</h2>
                    <p class="text-gray-500 text-sm">Availability: <span class="text-green-600">In Stock</span></p>
                </div>
                <div class="text-primary text-lg font-semibold">{{ item.price }}</div>
                <button
                    class="px-6 py-2 text-center text-sm text-white bg-red-500 border border-primary rounded  transition uppercase font-roboto font-medium">add
                    to cart</button>

                <div class="text-gray-600 cursor-pointer hover:text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    @click="removeWislist(item.id)"
                    
                    stroke="currentColor"
                     class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
</svg>
                </div>
            </div>
            </div>

           

          

        
        </div>
        <div v-else class="mt-5">
                <h2 class="text-center text-3xl text-bold">Wishlist is empty</h2>
            </div>
       </div>
       
       </div>
      
       <div class="ml-8 mt-2">
  <router-link :to="{name:'Account'}" class="bg-green-500 text-white px-8 py-2 rounded  cursor-pointer">back</router-link>
</div>
        </div>
        

      
     
    <Footer/>
      

        
        <!-- ./wishlist -->
    

</template>
<script setup>
import AccountSidebar from "./AccountSidebar.vue";
import { UserStore } from "../../Store/UserStore";
import { computed } from "vue";
import { useProductStore } from "../../Store/ProductStore";
import Footer from "../Footer.vue";

const User=UserStore();
const store=useProductStore()


User.getWishlist()


const wishlist=computed(() => User.Wishlist)


console.log(wishlist)

function removeWislist(id){
   User.deleteWishlist(id)
.then(() => {
    User.getWishlist()
    store.notify(
        {
            'type':'success',
            'message':'Wislist deleted successfully'
        }
    )
})
}





</script>