<template>
    <div class="Container mt-5">
        <div class="w-full md:w-[60%] mx-auto shadow px-6 py-7 rounded overflow-hidden">
            <h2 class="text-2xl uppercase font-medium mb-1">update Password</h2>
            <p class="text-gray-600 mb-6 text-sm">
                Change Password
            </p>

        
            <form @submit.prevent="resestPassword">
        <div class="space-y-2">
           
                        <label for="password" class="text-gray-600 mb-2 block">Password</label>
                        <input type="password" name="password" id="password" v-model="password"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="*******">
                    </div>
                    <div>
                        <label for="confirm" class="text-gray-600 mb-2 block">Confirm password</label>
                        <input type="password" name="confirm" id="confirm"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="*******">
                    </div>

                    <div class="mt-4">
                    <button type="submit"
                        class="block w-full py-2 text-center text-white bg-green-500 border border-primary rounded hover:bg-black 
                         transition uppercase font-roboto font-medium">Update
                        Password</button>
                </div>
            </form>
    </div>

    </div>
    <div class="ml-8 mt-2">
<router-link :to="{name:'Account'}" class="bg-green-500 text-white px-8 py-2 rounded  cursor-pointer">back</router-link>
</div>

<Footer/>
</template>

<script setup>
import {UserStore} from '../../Store/UserStore'
import {ref} from 'vue'
import Footer from '../Footer.vue';

const store=UserStore()

let password=ref('')

console.log(password.value)

function resestPassword(){
 store.updatePassword(password.value)
}




</script>