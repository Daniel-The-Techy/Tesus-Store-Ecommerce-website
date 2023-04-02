<template>
    
<div class="col-span-3">
    <div class="px-4 py-3 shadow flex items-center gap-4" v-for="item in data" :key="item.id">
        <div class="flex-shrink-0">
            <img :src="item.image" alt="profile"
                class="rounded-full w-14 h-14 border border-gray-200 p-1 object-cover">
        </div>
        <div class="flex-grow">
            <p class="text-gray-600">Hello,</p>
            <h4 class="text-gray-800 font-medium">{{ item.firstName}}</h4>
        </div>
    </div>

    <div class="mt-6 bg-white shadow rounded p-4 divide-y divide-gray-200 space-y-4 text-gray-600">
        <div class="space-y-1 pl-8">
            <a href="./Account" class="relative text-primary block font-medium capitalize transition">
                <span class="absolute -left-8 top-0 text-base">
                    <i class="fa-regular fa-address-card"></i>
                </span>
                Manage account
            </a>
            <a href="./Profile" class="relative hover:text-primary block capitalize transition">
                Profile information
            </a>
            <a href="./Address" class="relative hover:text-primary block capitalize transition">
                Manage addresses
            </a>
            <a href="./ResetPassword" class="relative hover:text-primary block capitalize transition">
                Change password
            </a>
        </div>

        <div class="space-y-1 pl-8 pt-4">
            <a href="#" class="relative hover:text-primary block font-medium capitalize transition">
                <span class="absolute -left-8 top-0 text-base">
                    <i class="fa-solid fa-box-archive"></i>
                </span>
                My order history
            </a>
          
            <a href="#" class="relative hover:text-primary block capitalize transition">
                My reviews
            </a>
        </div>

        <div class="space-y-1 pl-8 pt-4">
            <a href="#" class="relative hover:text-primary block font-medium capitalize transition">
                <span class="absolute -left-8 top-0 text-base">
                    <i class="fa-regular fa-credit-card"></i>
                </span>
                Payment methods
            </a>
            <a href="#" class="relative hover:text-primary block capitalize transition">
                voucher
            </a>
        </div>

        <div class="space-y-1 pl-8 pt-4">
            <a href="./Wishlist" class="relative hover:text-primary block font-medium capitalize transition">
                <span class="absolute -left-8 top-0 text-base">
                    <i class="fa-regular fa-heart"></i>
                </span>
                My wishlist
            </a>
        </div>

        <div class="space-y-1 pl-8 pt-4">
            <a href="#" class="relative hover:text-primary block font-medium capitalize transition" @click="invalidate()">
                <span class="absolute -left-8 top-0 text-base">
                    <i class="fa-regular fa-arrow-right-from-bracket"></i>
                </span>
                Logout
            </a>
        </div>

    </div>
</div>
</template>
<!-- ./sidebar -->

<script setup>

import { defineProps } from 'vue';
import { UserStore } from '../../Store/UserStore';
import { useRouter } from 'vue-router';

const store=UserStore()
const router=useRouter()

function invalidate(){
store.Logout()
.then(()=> {
    router.push({
        'name':'Login'
    });
})
}

defineProps({
    data:Object
});


</script>