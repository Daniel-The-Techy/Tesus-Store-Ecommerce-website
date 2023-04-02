<template>
 <!-- account wrapper -->
 <div class="grid grid-row md:grid-cols-12  gap-24 pt-4 pb-16" >

<!-- sidebar -->

<AccountSidebar :data="User"/>

<div class="col-span-9 md:grid grid-cols-3 h-[20vh] gap-4 hidden" v-for="item in User" :key="item.id" >

<div class="shadow rounded bg-white px-4 pt-6 pb-8" >
    <div class="flex items-center justify-between mb-4">
        <h3 class="font-medium text-gray-800 text-lg">Personal Profile</h3>
        <router-link :to="{name:'Profile'}" class="text-primary">Edit</router-link>
    </div>
    <div class="space-y-1">
        <h4 class="text-gray-700 font-medium">{{ item.name }}</h4>
        <p class="text-gray-800">{{ item.email }}</p>
        <p class="text-gray-800">0811 8877 988</p>
    </div>
</div>

<div class="shadow rounded bg-white px-4 pt-6 pb-8">
    <div class="flex items-center justify-between mb-4">
        <h3 class="font-medium text-gray-800 text-lg">Shipping address</h3>
        <router-link :to="{name:'Address'}" class="text-primary">Edit</router-link>
        </div>
    <div class="space-y-1">
        <h4 class="text-gray-700 font-medium">{{ item.firstName }}</h4>
        <p class="text-gray-800">{{ item.Address_1}}</p>
        <p class="text-gray-800">{{ item.Postal_Code ?? 'Na' }}</p>
        <p class="text-gray-800">{{ item.number ?? 'Na' }}</p>
    </div>
</div>

<div class="shadow rounded bg-white px-4 pt-6 pb-8">
    <div class="flex items-center justify-between mb-4">
        <h3 class="font-medium text-gray-800 text-lg">Billing address</h3>
        <router-link :to="{name:'Address'}" class="text-primary">Edit</router-link>
    </div>
    <div class="space-y-1">
        <h4 class="text-gray-700 font-medium">{{ item.firstName }}</h4>
        <p class="text-gray-800">Medan, North Sumatera</p>
        <p class="text-gray-800">{{ item.Postal_Code ?? 'Na'}}</p>
        <p class="text-gray-800">{{ item.number ?? 'Na' }}</p>
    </div>
</div>

</div>
<!-- ./info -->

<!-- info -->


</div>
<!-- ./account wrapper -->

<Footer/>
</template>

<script setup>

import AccountSidebar from '../Account/AccountSidebar.vue'
import { UserStore } from '../../Store/UserStore';
import { computed } from 'vue';
import Footer from '../Footer.vue';


const store=UserStore()

store.getUser()

const User=computed(() => store.profile);

console.log(User)

</script>
