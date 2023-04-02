<template>

<div class="Container grid grid-row md:grid-cols-12 items-start pb-16 pt-4 gap-6">

<div class="col-span-8 border border-gray-200 p-4 rounded">
    <h3 class="text-lg font-medium capitalize mb-4">Checkout</h3>
    <div class="space-y-4">
        <form @submit.prevent="saveCustomer">
        <div>
          <h5 class="text-center mb-2">Account details</h5>
          <hr>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="first-name" class="text-gray-600">First Name <span
                        class="text-primary">*</span></label>
                <input type="text" name="first-name" id="first-name" v-model="model.firstname"
                class="block w-full border border-gray-300 px-4 py-3
                 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
            </div>
            <div>
                <label for="last-name" class="text-gray-600">Last Name <span
                        class="text-primary">*</span></label>
                <input type="text" name="last-name" id="last-name" v-model="model.lastname"
                 class="block w-full border border-gray-300 px-4 py-3
                 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
            </div>
        </div>

        <div class="grid gris-row md:grid-cols-2 gap-4">
        <div>
            <label for="email" class="text-gray-600">Email address</label>
            <input type="email" name="email" id="email" v-model="model.email"
             class="block w-full border border-gray-300 px-4 py-3
             text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
        </div>

        <div>
            <label for="email" class="text-gray-600">Password</label>
            <input type="password" v-model="model.password"
              class="block w-full border border-gray-300 px-4 py-3
             text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
        </div>
        </div>

        <div>
            <label for="email" class="text-gray-600">password_confirmation</label>
            <input type="password" v-model="model.password_confirmation" name="password_confirmation"
              class="block w-full border border-gray-300 px-4 py-3
             text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
        </div>
        </div>

        <div class="mt-4">
            <h4 class="text-center mb">Shipping details</h4>
            <hr class="mb-2">
        <div>
            <label for="company" class="text-gray-600">Phone Number</label>
            <input type="number" name="Phone Number" v-model="model.phone_Number"
             class="block w-full border border-gray-300 px-4 py-3
             text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
        </div>
        <div>
            <label for="region" class="text-gray-600">Country/Region</label>
            <input type="text" name="Country" v-model="model.country"
             class="block w-full border border-gray-300 px-4 py-3
             text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
        </div>
        <div class="grid grid-row md:grid-cols-2 gap-4">
        <div>
            <label for="address" class="text-gray-600"> Address 1</label>
            <input type="text" name="address" v-model="model.Address_1"
            class="block w-full border border-gray-300 px-4 py-3 
            text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
        </div>

        <div>
            <label for="address" class="text-gray-600"> Address 2</label>
            <input type="text" name="address" v-model="model.Address_2"
             class="block w-full border border-gray-300 px-4 py-3 
            text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
        </div>
        </div>

        <div>
            <label for="city" class="text-gray-600">City</label>
            <input type="text" name="city" id="city" v-model="model.city"
            class="block w-full border border-gray-300 px-4 py-3 
            text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
        </div>

        <div>
            <label for="city" class="text-gray-600">Company</label>
            <input type="text"  id="city" v-model="model.company"
            class="block w-full border border-gray-300 px-4 py-3 
            text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
        </div>
        <div>
            <label for="phone" class="text-gray-600">State</label>
            <input type="text" v-model="model.State"
            class="block w-full border border-gray-300 px-4 py-3
             text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
        </div>
      
        <div>
            <label for="company" class="text-gray-600">PostalCode</label>
            <input type="number" v-model="model.Postal_Code"
            class="block w-full border border-gray-300 px-4 py-3
             text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
        </div>

        <div class="mt-4"> 
            <button class="px-8 py-3 text-white bg-green-400">Continue</button>
        </div>
        
    </div>
</form>
    </div>


</div>

<div class="col-span-8 md:col-span-4 border border-gray-200 p-4 rounded">
  
    <h4 class="text-gray-800 text-lg mb-4 font-medium uppercase" >order summary</h4>
    <div class="space-y-2">
       
        <div class="flex justify-between"  v-for="item in Carts" :key="item.id">
            <div>
                <h5 class="text-gray-800 font-medium">{{ item.title }}</h5>
                <p class="text-sm text-gray-600">shipping:free</p>
            </div>
            <p class="text-gray-600">
                x{{ item.quantity }}
            </p>
            <p class="text-gray-800 font-medium">${{ item.price }}</p>
        </div>
       
    </div>

    <div class="flex justify-between border-b border-gray-200 mt-1 text-gray-800 font-medium py-3 uppercas">
        <p>subtotal</p>
       
        <p>{{ Total }}</p>

    </div>

    <div class="flex justify-between border-b border-gray-200 mt-1 text-gray-800 font-medium py-3 uppercas">
        <p>shipping</p>
        <p>Free</p>
    </div>

    <div class="flex justify-between text-gray-800 font-medium py-3 uppercas">
        <p class="font-semibold">Total</p>
        <p>{{ Total }}</p>
    </div>

    <div class="flex items-center mb-4 mt-2">
        <input type="checkbox" name="aggrement" id="aggrement"
            class="text-primary focus:ring-0 rounded-sm cursor-pointer w-3 h-3">
        <label for="aggrement" class="text-gray-600 ml-3 cursor-pointer text-sm">I agree to the <a href="#"
                class="text-primary">terms & conditions</a></label>
    </div>

    <a href="#"
        class="block w-full py-3 px-4 text-center  cursor-pointer text-white bg-red-600 border border-primary rounded-md  transition font-medium">Place
        order</a>
</div>
</div>




<!-- ./wrapper -->

<Footer/>
</template>

<script setup>

import { UserStore } from "../Store/UserStore";
import { ref, computed } from "vue";
import {useCartStore} from '../Store/CartStore'
import Footer from "./Footer.vue";


const store=UserStore()
const CartStore=useCartStore();

const model=ref({
    firstname:'',
    lastname:'',
    email:'',
    password_confirmation:'',
    phone_Number:null,
    company:'',
    Address_1:'',
    Address_2:'',
    city:'',
    country:'',
    State:'',
    Postal_Code:null,
})





const Carts=computed(() => CartStore.cart)




const Total=computed(() => CartStore.cart.reduce((sum, product) => sum + product.price*product.quantity , 0))



CartStore.getCart()




function saveCustomer(){
    store.checkOut(model.value)
    .then(()=>{
         store.getUser()
        console.log('Registration completed successfully')
    })
}
console.log(model.value)

store.getUser()


</script>