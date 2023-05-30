<template>
    <header class="py-4 shadow-sm bg-white">
     <div class="Container flex flex-col md:flex-row  items-center justify-between">
         <a href="index.html">
 <h1 class="mb-3 md:mb-0 text-3xl font-bold"><span class="text-orange-600 text-3xl">TESUS</span> store</h1>
         </a>

         <div class="w-full max-w-xl relative flex mb-3 md:mb-0">
             <span class="absolute left-4 top-3 text-lg  text-gray-400">
                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" className="w-16 h-6 relative left-36">
<path fillRule="evenodd" d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5zm8.25-3.75a.75.75 0 01.75.75v2.25h2.25a.75.75 0 010 1.5h-2.25v2.25a.75.75 0 01-1.5 0v-2.25H7.5a.75.75 0 010-1.5h2.25V7.5a.75.75 0 01.75-.75z" clipRule="evenodd" />
</svg>

             </span>     
             <div class="relative">
             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-4 absolute left-6 top-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
</svg>
</div>

             <input type="text" name="search" id="search" v-model="search"
                 class="w-[80%] md:w-full border border-primary border-r-0 pl-12 py-3 pr-3 rounded-l-md focus:outline-none text-xl"
                 placeholder="search">
                 <div v-if="search !==''">
                 <router-link :to="{ name: 'Search', params: { ProductName: search }}">
             <button
    class="bg-green-500 border border-primary py-5 text-white px-2 md:px-8  rounded-r-md hover:bg-black hover:text-primary transition">Search</button>
                 </router-link>
                </div>
                <div v-else>
                    <button disabled  
    class="bg-red-500 border border-primary text-white py-5 px-2 md:px-8  rounded-r-md hover:bg-black hover:text-primary transition">Search</button> 
                </div>
                
         </div>


         <div class="flex items-center space-x-4">
            
             <a href="#" class="text-center text-gray-700 hover:text-primary transition relative">
                 <div class="text-2xl">
                     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-6">
<path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
</svg>

                 </div>
                 <div class="text-xs leading-3">Wishlist</div>
                 <div
                     class="absolute right-0 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-red-300 text-white text-xs">
                     {{ wishlistCount}}</div>
             </a>
             <a href="#" class="text-center text-gray-700 hover:text-primary transition relative"  >
                 <div class="text-2xl" @click="show=!show" >
                     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 ">
<path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" />
</svg>


                 </div>
                 <div class="text-xs leading-3">Cart</div>
                 <div
                     class="absolute -right-3 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-red-300 text-white text-xs">
                     {{ CartStore.sumCart }} </div>
                   
                     <div v-if="show" class="absolute  bg-white shadow-sm -right-36 md:-right-28 z-10  mt-4 h-[auto] animate-fade-in-down w-[360px]  sm:w-[400px] md:w-[500px] ">
                        <div v-if="CartStore.cart.length !==0" >
                         <div v-for="item in Carts" :key="item.id" class="flex  text-start px-8 md:px-4 mb-6">
                            <img src="../../assets/product.jpg" class="w-12 h-12">
                        <h3 class="ml-4 md:ml-12">{{ item.title }}</h3>
                        <p class="ml-4 md:ml-12">{{ Math.floor(item.price * item.quantity) }}</p>
                        <p class="ml-4 md:ml-12">{{ item.quantity }}</p>
                       
                        <svg xmlns="http://www.w3.org/2000/svg" @click="RemoveCart(item.id)" 
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-8 text-red-400">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
</svg>

                        </div>

                        <div class="flex justify-center mb-3">
                            <a href="/Carts">
                            <button class="bg-green-500 px-5 text-white cursor-pointer py-3">View Cart</button>
                            </a>
                            <button class="ml-8 bg-red-500 text-white cursor-pointer px-5 py-3">Checkout</button>
                        </div>
                       
                           </div>
                           
                           <div v-else class="text-center text-2xl">
                            <p>No Cart Available</p>
                            </div>
                            
                        
                        </div>
             </a>
             <router-link :to="{name: 'Account'}" class="text-center text-gray-700  transition relative">
                 <div class="text-2xl" @click="Accountshow=!Accountshow">
                     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-6">
<path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
</svg>



                 </div>
               
                 <div v-if="User.isAuthenticated">
                 <div class="text-xs leading-3 relative">
                   
                    <p>Account</p>
              
                 </div>
                 </div>

                    <div v-else >
                        <div class="text-xs leading-3">Account</div>
                        <div v-if="Accountshow" class="absolute h-[8vh] px-8 -right-2 rounded-sm bg-white shadow-sm">
                        <p  class="mt-2">
                   <a href='/Register'>Register</a>
                   </p>
                   <p class="mt-2">
                   <a href="/Login" class="hover:text-gray-800">Login</a>
                   </p>
                    </div>
                    </div>

                </router-link> 
                    
           
         </div>
     </div>
 </header>
 <!-- ./header -->

 <!-- navbar -->
 <nav class="bg-gray-800">
     <div class="md:Container flex">
         <div class="px-8 py-4 bg-primary flex items-center cursor-pointer relative group">
             <span class="text-white">
                 <i class="fa-solid fa-bars"></i>
             </span>
             <span class="capitalize ml-2 text-white">All Categories</span>

             <!-- dropdown -->
             <div
                 class="absolute w-full left-0 top-full bg-white shadow-md py-3 divide-y divide-gray-300 divide-dashed opacity-0 group-hover:opacity-100 transition duration-300 invisible group-hover:visible">
                 <div v-for="item in category" :key="item.id">
                 <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                     <img src="../../assets/product.jpg" alt="sofa" class="w-5 h-5 object-contain">
                     <span class="ml-6 text-gray-600 text-sm">{{ item.name }}</span>
                 </a>
                 </div>
               
             </div>
         </div>

         <div class="flex items-center justify-between flex-grow p-0 md:pl-12 ">
             <div class="md:flex items-center space-x-6  capitalize">
                 <a href="#" class="text-gray-200  hover:text-white transition">Home</a>
                 <a href="/Main" class="text-gray-200 hover:text-white transition">Shop</a>
                 <a href="#" class="text-gray-200 hidden md:block hover:text-white transition">About us</a>
                 <a href="#" class="text-gray-200 hidden md:block hover:text-white transition">Contact us</a>
             </div>
             <a href="/Register" class="text-gray-200 hover:text-white transition hidden md:block mr-12 ml-auto ">Register</a>
             <a href="/Login" Class="text-gray-200 hover:text-white transition hidden md:block  mr-12 ">Login</a>
         </div>
     </div>
 </nav>
 <!-- ./navbar -->
 

 <router-view></router-view>
</template>

<script setup>

//import useUtilities from '../Composable/utilities';
import {useProductStore} from '../Store/ProductStore'
import { useCartStore } from '../Store/CartStore';
import {computed, ref, onMounted} from 'vue'
import { UserStore } from '../Store/UserStore';



const store=useProductStore();
const CartStore=useCartStore()
const User=UserStore()


//User.getWishlist()

const wislist=computed(()=> User.Wishlist)





const wishlistCount=computed(() => User.wishlistCount)






let show=ref(false)


let Accountshow=ref(false)
const search=ref('')
const Carts=computed(() => CartStore.cart)

User.getUser();

const set=computed(() => User.Userid)


CartStore.getCart();


onMounted(store.getCategory())

const category=computed(()=> store.category)


function RemoveCart(id){

  CartStore.deleteCart(id)
  .then(() => {
    CartStore.sumCart
 
  })
}


const Cart=computed(() => CartStore.cart.reduce((sum, data)=> sum + data.quantity, 0))

</script>
