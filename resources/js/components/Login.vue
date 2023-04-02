<template>
     <!-- login -->
     <div class="contain py-16">
        <div class="max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden">
            <h2 class="text-2xl uppercase font-medium mb-1">Login</h2>
            <p class="text-gray-600 mb-6 text-sm">
                welcome back customer
            </p>
            <form @submit.prevent="LoginUser" autocomplete="off">
                <div v-if="errors" class="bg-red-500 text-white flex item-center justify-betwen py-2 px-4 pr-0 rounded font-bold mb-4 shadow-lg">
                     {{ errors}}
                    </div>
                    

                <div class="space-y-2">
                    <div>
                        <label for="email" class="text-gray-600 mb-2 block">Email address</label>
                        <input type="email" name="email" id="email" v-model="user.Email" required
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="youremail.@domain.com">
                    </div>
                    <div>
                        <label for="password" class="text-gray-600 mb-2 block">Password</label>
                        <input type="password" name="password" id="password" v-model="user.password" required
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="*******">
                    </div>
                </div>
                <div class="flex items-center justify-between mt-6">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember"
                            class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                        <label for="remember" class="text-gray-600 ml-3 cursor-pointer">Remember me</label>
                    </div>
                    <a href="#" class="text-primary">Forgot password</a>
                </div>
                <div class="mt-4">
                    <button type="submit"
                        class="block w-full py-2 text-center text-white bg-blue-600 border border-primary rounded hover:bg-black  transition uppercase font-roboto font-medium">Login</button>
                </div>
            </form>

         

            <p class="mt-4 text-center text-gray-600">Don't have account? <a href="/Register"
                    class="text-primary">Register
                    now</a></p>
        </div>
    </div>
    <!-- ./login -->

  <Footer/>

    <!-- copyright -->
    <div class="bg-gray-800 py-4">
        <div class="container flex items-center justify-between">
            <p class="text-white">&copy; TailCommerce - All Right Reserved</p>
            <div>
                <img src="../assets/images/methods.png" alt="methods" class="h-5">
            </div>
        </div>
    </div>
    <!-- ./copyright -->

</template>
<script setup>

import Footer from '../components/Footer.vue'
import { UserStore } from '../Store/UserStore';
import {useRouter} from 'vue-router'
import {ref} from 'vue'

const store=UserStore()
const router=useRouter()
const errors=ref('')

const user=ref({
    'Email':'',
    'password':''
});

function LoginUser(){
    store.Login(user.value)
    .then(() => {
        router.push(
            {
                name:'Account'
        
        })
    })
    .catch((e) => {
      errors.value=e.response.data.error
    })
}

</script>