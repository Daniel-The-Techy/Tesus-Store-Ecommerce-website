<template>
    <!-- login -->
    <div class="contain py-16">
        <div class="max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden">
            <h2 class="text-2xl uppercase font-medium mb-1">Create an account</h2>
            <p class="text-gray-600 mb-6 text-sm">
                Register for new customer
            </p>
            <form @submit.prevent=saveUser  autocomplete="off">
                
    <div v-if="errors" class="bg-red-500 text-white py-2 px-4 pr-0 rounded font-bold mb-4 shadow-lg">
            <div v-for="(v, k) in errors" :key="k">
               <p  v-for="error in v" :key="error" class="text-sm">
                     {{ error }}
                    
                     
      </p>
                </div>
                </div>

                <div class="space-y-2">
                    <div>
                        <label for="name" class="text-gray-600 mb-2 block">first Name</label>
                        <input type="text" name="name" id="name" v-model="model.firstname"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="fulan fulana">
                    </div>

                    <div>
                        <label for="name" class="text-gray-600 mb-2 block">last Name</label>
                        <input type="text" name="name" id="name" v-model="model.lastname"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="fulan fulana">
                    </div>

                    <div>
                        <label for="email" class="text-gray-600 mb-2 block">Email address</label>
                        <input type="email" name="email" id="email" v-model="model.email"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="youremail.@domain.com">
                    </div>
                    <div>
                        <label for="password" class="text-gray-600 mb-2 block">Password</label>
                        <input type="password" name="password" id="password" v-model="model.password"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="*******">
                    </div>
                    <div>
                        <label for="confirm" class="text-gray-600 mb-2 block">Confirm password</label>
                        <input type="password" name="confirm" id="confirm" v-model="model.password_confirmation"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="*******">
                    </div>
                </div>
                <div class="mt-6">
                    <div class="flex items-center">
                        <input type="checkbox" name="aggrement" id="aggrement"
                            class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                        <label for="aggrement" class="text-gray-600 ml-3 cursor-pointer">I have read and agree to the <a
                                href="#" class="text-primary">terms & conditions</a></label>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit"
                        class="block w-full py-2 text-center text-white bg-green-500 border border-primary rounded hover:bg-black  transition uppercase font-roboto font-medium">create
                        account</button>
                </div>
            </form>

         

            <p class="mt-4 text-center text-gray-600">Already have account? <a href="/Login"
                    class="text-primary">Login now</a></p>
        </div>
    </div>
    <!-- ./login -->

  <Footer/>
    <!-- copyright -->
    <div class="bg-gray-800 py-4">
        <div class="container flex items-center justify-between">
            <p class="text-white">&copy; Tesus Store - All Right Reserved</p>
            <div>
                <img src="../assets/images/methods.png" alt="methods" class="h-5">
            </div>
        </div>
    </div>
    <!-- ./copyright -->
</template>

<script setup>

import Footer from '../components/Footer.vue'
import {UserStore} from '../Store/UserStore'
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';
import { useCartStore } from '../Store/CartStore';


const store=UserStore();
const router=useRouter()
const CartStore=useCartStore()

const errors=ref('');
//const User=UserStore()

const model={
    'firstname':'',
    'lastname':'',
    'email':'',
    'password':'',
    'password_confirmation':''
}

function saveUser(){
    store.Register(model)
    .then(()=>{
        router.push({
            name:'Account'
        })
         store.getUser()
        CartStore.getCart()
        console.log('Registration completed successfully')
    })
    .catch((e) => {
      errors.value=e.response.data.errors
      console.log(errors.value)
    })
}


</script>