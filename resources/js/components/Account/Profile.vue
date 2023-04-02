<template>
    <div class="Container py-16">
        <div class="w-full md:w-[50%] mx-auto shadow px-6 py-7 rounded overflow-hidden">
            <h2 class="text-2xl uppercase font-medium mb-1">Profile information</h2>

            <p class="mt-2 font-bold text-gray-400">Your personal details</p>

            <form @submit.prevent="updateUser"  autocomplete="off" >

                <div class="space-y-2 pt-4">
                    <div>
                        <label for="name" class="text-gray-600 mb-2 block">First Name</label>
                        <input type="text" name="name" id="name" v-model="model.firstName"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="fulan fulana">
                    </div>

                    <div>
                        <label for="name" class="text-gray-600 mb-2 block">last Name</label>
                        <input type="text" name="name" id="name" v-model="model.lastName"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="fulan fulana">
                    </div>

                    <div>
                        <label for="email" class="text-gray-600 mb-2 block">Email address</label>
                        <input type="email" name="email" id="email" v-model="model.email"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="youremail.@domain.com">
                    </div>
                   
                    
                </div>

                <div class="mt-4">
                    <label class="block text-sm  font-medium text-gray-700">Image</label>
                    <div class="mt-1 flex items-center">
                        <img :src=model.image_url v-if="model.image_url" class="w-64 h-48 object-cover">
                        <svg xmlns="http://www.w3.org/2000/svg" v-else fill="none" viewBox="0 0 24 24" 
                        stroke-width="1.5" stroke="currentColor" class="w-16 h-24 text-gray-500">
  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
</svg>

                    <button type="button" class="relative overflow-hidden ml-5 bg-white py-2 px-3 
                    border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium
                     text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500
                    ">
                    <input type="file" class="absolute left:0 top:0 right:0 bottom:0 opacity-0 cursor-pointer" @change="onImageChoose"/>
                    Change</button>
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
</div>
</div>

 <div class="ml-8 mt-2">
<router-link :to="{name:'Account'}" class="bg-green-500 text-white px-8 py-2 rounded  cursor-pointer">back</router-link>
</div>

<Footer/>

</template>

<script setup>

import {computed, ref, watch} from 'vue'
import {UserStore} from '../../Store/UserStore'
import { useRouter } from 'vue-router';
import Footer from '../Footer.vue';

const store=UserStore()
const router=useRouter()

store.getUser()

let model=ref({
    firstName:'',
    lastName:'',
    email:'',
    image:null,
    image_url:null
});


watch(() =>store.profile.data, (newVal, oldval) => {

       model.value=JSON.parse(JSON.stringify(newVal))
    })
  
    




function updateUser(){
    store.updateUsers(model.value)
    .then(() => {
        router.push({
            name:'Account'
        })
    })
}


function onImageChoose(e){
    let file=e.target.files[0];

    const reader=new FileReader()

    reader.onload=()=> {
        model.value.image=reader.result
        model.value.image_url=reader.result
    }
    reader.readAsDataURL(file)
}

</script>