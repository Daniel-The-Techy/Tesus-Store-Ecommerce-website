<template>
    <div class="col-span-1 bg-white px-4 pb-6 shadow rounded overflow-hidden hidden md:block">
          <div class="divide-y divide-gray-200 space-y-5">
              <div>
                  <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Categories</h3>
                  <div class="space-y-2">
                      <div class="flex items-center" v-for="category in categorys" :key="category.id" >
                          
                          <input type="checkbox" name="cat-1" id="cat-1"
                              class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                              
                              <router-link :to="{name:'Category', params:{name:category.id} }">
                          <label for="cat-1" class="text-gray-600 ml-3 cursor-pointer">{{ category.name }}</label>
                        </router-link>
                          <div class="ml-auto text-gray-600 text-sm">({{ countProductByCategory(category.id)  }})</div>
                      </div>
                      
                     
                  </div>
              </div>

              <div class="pt-4">
                  <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Brands</h3>
                  <div class="space-y-2">
                      <div class="flex items-center">
                          <input type="checkbox" name="brand-1" id="brand-1"
                              class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                          <label for="brand-1" class="text-gray-600 ml-3 cusror-pointer">Cooking Color</label>
                          <div class="ml-auto text-gray-600 text-sm">(15)</div>
                      </div>
                      <div class="flex items-center">
                          <input type="checkbox" name="brand-2" id="brand-2"
                              class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                          <label for="brand-2" class="text-gray-600 ml-3 cusror-pointer">Magniflex</label>
                          <div class="ml-auto text-gray-600 text-sm">(9)</div>
                      </div>
                      <div class="flex items-center">
                          <input type="checkbox" name="brand-3" id="brand-3"
                              class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                          <label for="brand-3" class="text-gray-600 ml-3 cusror-pointer">Ashley</label>
                          <div class="ml-auto text-gray-600 text-sm">(21)</div>
                      </div>
                      <div class="flex items-center">
                          <input type="checkbox" name="brand-4" id="brand-4"
                              class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                          <label for="brand-4" class="text-gray-600 ml-3 cusror-pointer">M&D</label>
                          <div class="ml-auto text-gray-600 text-sm">(10)</div>
                      </div>
                      <div class="flex items-center">
                          <input type="checkbox" name="brand-5" id="brand-5"
                              class="text-primary focus:ring-0 rounded-sm cursor-pointer">
                          <label for="brand-5" class="text-gray-600 ml-3 cusror-pointer">Olympic</label>
                          <div class="ml-auto text-gray-600 text-sm">(10)</div>
                      </div>
                  </div>
              </div>

              <div class="pt-4">
                  <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium">Price</h3>
                  <div class="mt-4 flex items-center">
                      <input type="text" name="min" id="min"
                          class="w-full border-gray-300 focus:border-primary rounded focus:ring-0 px-3 py-1 text-gray-600 shadow-sm"
                          placeholder="min">
                      <span class="mx-3 text-gray-500">-</span>
                      <input type="text" name="max" id="max"
                          class="w-full border-gray-300 focus:border-primary rounded focus:ring-0 px-3 py-1 text-gray-600 shadow-sm"
                          placeholder="max">
                  </div>
              </div>





          </div>
          </div>
</template>

<script setup>

import { computed, onMounted, ref } from 'vue';
import {useProductStore} from '../Store/ProductStore'
import { storeToRefs } from 'pinia';

const store=useProductStore();
onMounted(store.getCategory())

const categorys=computed(()=> store.category)

const {countProductByCategory}=storeToRefs(store)

</script>