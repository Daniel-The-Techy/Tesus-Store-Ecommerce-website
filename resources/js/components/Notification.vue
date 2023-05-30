<template>
    <div class="fixed w-[300px] right-4 top-5 sm:top:15 md:top-20 text-center py-2 px-6 rounded-sm text-white animate-fade-in-down" 
    :class="[notification.type=='success' ? 'bg-emerald-500' :'bg-red-500']" v-if="notification.show">
    {{ notification.message }}
    </div>
</template>

<script setup>
import { useProductStore } from '../Store/ProductStore';
import { computed } from 'vue';

const store=useProductStore()

const notification=computed(() =>store.notifications )



</script>