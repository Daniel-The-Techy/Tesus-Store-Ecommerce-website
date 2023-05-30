<template>

<div class="Container min-h-[50vh] grid grid-row md:grid-cols-12 items-start pb-16 pt-4 gap-6">

<div class="col-span-8 bg-white w-full shadow-sm rounded-sm border border-gray-200 p-4 ">
    <h3 class="text-lg font-medium capitalize mb-4">Checkout</h3>
   
    <div class="space-y-4" v-if="!isOnline" >
        <h5 class="text-gray-400 test-xs">If you have an account with us <router-link :to="{name:'Login'}"
         class="text-orange-600">Login here</router-link></h5>
         <hr>
         <div class="mt-3">
           <h3 class="text-gray-400 text-base">Register Account</h3>
          <router-link :to="{name:Register}" class="text-orange-600 text-xs ">Register Your Account</router-link>
          </div>
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
             text-gray-600 text-sm rounded-md focus:ring-0 focus:border-primary placeholder-gray-400">
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
            <button class="px-8 py-3 text-white bg-green-400">Continue</button>
        </div>
        </form>
        </div>

        <!----Shipping Details-->
        <div v-else>
        <div class="mt-4" v-if="visible">
            <h4 class="text-center text-3xl font-medium mb">Shipping details</h4>
            <small class="text-orange-600">* If you have already put in your Order details skip this and  proceed to confirm orders</small>
            <hr class="mb-2">
            <form @submit.prevent="saveData">
                <div>
            <label for="company" class="text-gray-600">firstName</label>
            <input type="text" name="firstName" v-model="orderDetails.firstName"
             class="block w-full border border-gray-300 px-4 py-3
             text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
        </div>

        <div>
            <label for="company" class="text-gray-600">lastName</label>
            <input type="text" name="laseName" v-model="orderDetails.lastName"
             class="block w-full border border-gray-300 px-4 py-3
             text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
        </div>
        <div>
            <label for="company" class="text-gray-600">Phone Number</label>
            <input type="number" name="Phone Number" v-model="orderDetails.phone_Number"
             class="block w-full border border-gray-300 px-4 py-3
             text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
        </div>
        <div>
            <label for="region" class="text-gray-600">Country/Region</label>
            <input type="text" name="Country" v-model="orderDetails.country"
             class="block w-full border border-gray-300 px-4 py-3
             text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
        </div>
        <div class="grid grid-row md:grid-cols-2 gap-4">
        <div>
            <label for="address" class="text-gray-600"> Address 1</label>
            <input type="text" name="address" v-model="orderDetails.Address_1"
            class="block w-full border border-gray-300 px-4 py-3 
            text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
        </div>

        <div>
            <label for="address" class="text-gray-600"> Address 2</label>
            <input type="text" name="address" v-model="orderDetails.Address_2"
             class="block w-full border border-gray-300 px-4 py-3 
            text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
        </div>
        </div>

        <div>
            <label for="city" class="text-gray-600">City</label>
            <input type="text" name="city" id="city" v-model="orderDetails.city"
            class="block w-full border border-gray-300 px-4 py-3 
            text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
        </div>

        <div>
            <label for="city" class="text-gray-600">Company</label>
            <input type="text"  id="city" v-model="orderDetails.company"
            class="block w-full border border-gray-300 px-4 py-3 
            text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
        </div>
        <div>
            <label for="phone" class="text-gray-600">State</label>
            <input type="text" v-model="orderDetails.State"
            class="block w-full border border-gray-300 px-4 py-3
             text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
        </div>
      
        <div>
            <label for="company" class="text-gray-600">PostalCode</label>
            <input type="number" v-model="orderDetails.Postal_Code"
            class="block w-full border border-gray-300 px-4 py-3
             text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
        </div>

        <div class="mt-4"> 
            <button class="px-8 py-3 text-white bg-green-400">Continue</button>
        </div>
    </form>
        
    </div>

    <div else>
        <h2>Proceed to confirm Order</h2>
    
    </div>
    </div>

    


</div>

<div class="col-span-8 md:col-span-4 border border-gray-200 bg-white shadow-sm  p-4 rounded">
  
    <h4 class="text-gray-800 text-lg mb-4 font-medium uppercase" >order summary</h4>
    <form @submit.prevent="saveOrder">
    <div class="space-y-2">
        <div class="paymentype">
            <p class="text-xl font-medium tracking-wider text-gray-400">Select Payment type</p>
            <select class="border border-gray-400 text-white px-3 py-4 w-full bg-gray-300" v-model="customerOrder.paymentType">
                <option class="text-white font-medium">Select Payment type</option>
                <option>Cash on Delivery</option>
            </select>
        </div>

        <div class="shippingType">
            <p class="text-xl font-medium tracking-wider text-gray-400">Select Shipping type</p>
            <select class="border border-gray-400 text-white px-3 py-4 w-full bg-gray-300">
                <option class="text-white font-medium">Free</option>
            </select>
        </div>

        <div class="specialNote mt-2">
            <textarea placeholder="Write a note about your order"
             class="text-sm border border-gray-500 text-gray-500 w-full px-4 py-2 h-[20vh]" v-model="customerOrder.OrderNote"></textarea>
        </div>
       
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
       
        <p>{{ Math.round(Total) }}</p>

    </div>

    <div class="flex justify-between border-b border-gray-200 mt-1 text-gray-800 font-medium py-3 uppercas">
        <p>shipping</p>
        <p>Free</p>
    </div>

    <div class="flex justify-between text-gray-800 font-medium py-3 uppercas">
        <p class="font-semibold">Total</p>
        <p>{{ Math.round(Total) }}</p>
    </div>

    <div class="flex items-center mb-4 mt-2">
        <input type="checkbox" name="aggrement" id="aggrement"
            class="text-primary focus:ring-0 rounded-sm cursor-pointer w-3 h-3">
        <label for="aggrement" class="text-gray-600 ml-3 cursor-pointer text-sm">I agree to the <a href="#"
                class="text-primary">terms & conditions</a></label>
    </div>

    <button
        class="block w-full py-3 px-4 text-center  cursor-pointer text-white bg-red-600 border border-primary rounded-md  transition font-medium">Place
        Confirm order</button>
    </form>
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
import {useOrderStore} from "../Store/OrderStore"
import { useRouter } from "vue-router";


const store=UserStore()
const CartStore=useCartStore();
const OrderStore=useOrderStore();
const router=useRouter()

const model=ref({
    firstname:'',
    lastname:'',
    email:'',
    password_confirmation:'',
})


const orderDetails=ref({
    firstName:'',
    lastName:'',
    phone_Number:null,
    company:'',
    Address_1:'',
    Address_2:'',
    city:'',
    country:'',
    State:'',
    Postal_Code:null,
})

const customerOrder=ref({
    paymentType:'',
    OrderNote:'',
})





const Carts=computed(() => CartStore.cart)




const Total=computed(() => CartStore.cart.reduce((sum, product) => sum + product.price*product.quantity , 0))



CartStore.getCart()

const isOnline=computed(()=>store.isOnline)




let visible=computed(()=> OrderStore.visibility)



function saveCustomer(){
    store.Register(model.value)
    .then(()=>{
         store.getUser()
        console.log('Registration completed successfully')
    })
}

function saveData(){
    OrderStore.orderDetails(orderDetails.value)
}


function saveOrder(){
    OrderStore.customerOrder(customerOrder.value)
    .then(()=> {
        router.push(
            {
                name:'Order_Confirmation'
        
        })
        CartStore.getCart()
    })
}
console.log(model.value)

store.getUser()


</script>