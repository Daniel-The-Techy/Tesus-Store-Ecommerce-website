<template>
           <div class="Container">
                <div class="w-full md:w-2/3  mx-auto border border-gray-200 p-4 rounded overflow-hidden">
            <h3 class="text-lg font-medium capitalize mb-4">Address</h3>
            <div class="space-y-4" >
              <div v-for="item in Address" :key="item.id">
                <form @submit.prevent="updateAddress">
                <div>
                    <label for="company" class="text-gray-600">Company</label>
                    <input type="text" name="company" id="company" v-model="model.company"
                     class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
                </div>
                <div>
                    <label for="region" class="text-gray-600">Country/Region</label>
                    <input type="text" name="region" id="region" v-model="model.country"
                     class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
                </div>
                <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="address" class="text-gray-600">Address 1</label>
                    <input type="text" name="address" id="address" v-model="model.Address_1"
                     class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
                </div>

                <div>
                    <label for="address" class="text-gray-600">Address 1</label>
                    <input type="text" name="address" id="address" v-model="model.Address_2"
                     class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
                </div>

                </div>

                <div>
                    <label for="city" class="text-gray-600">City</label>
                    <input type="text" name="city" id="city" v-model="model.city"
                    class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
                </div>
                <div>
                    <label for="phone" class="text-gray-600">Phone number</label>
                    <input type="number" name="phone" id="phone" v-model="model.phone_Number"
                     class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
                </div>

                <div>
                    <label for="company" class="text-gray-600">State</label>
                    <input type="text" name="company" id="company" v-model="model.State"
                     class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
                </div>

                <div>
                    <label for="email" class="text-gray-600">PostalCode</label>
                    <input type="number" name="Postal_code"  v-model="model.Postal_Code"
                    class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400">
                </div>

                <div class="mt-2">
                <button type="submit" class="bg-green-700 w-full py-3 text-white cursor-pointer hover:bg-red-500 ">Save</button>
            </div>
        
        </form>
            </div>
            </div>

      

        </div>
   
      
        <div class="ml-8 mt-2">
<router-link :to="{name:'Account'}" class="bg-green-500 text-white px-8 py-2 rounded  cursor-pointer">back</router-link>
</div>
                </div>

                <Footer/>
        
</template>

<script setup>


import { UserStore } from '../../Store/UserStore';
import { useRouter } from 'vue-router';
import { watch, ref, computed } from 'vue';
import Footer from '../Footer.vue';


const store=UserStore()

let model=ref({
    phone_Number:'',
    company:'',
    Address_1:'',
    Address_2:'',
    city:'',
    country:'',
    State:'',
    Postal_Code:'',
})


watch(() => store.profile.data, (newval, oldval) => {
    model.value=newval
})

console.log(model.value)
store.getUser()
const Address=computed(()=> store.profile)


function updateAddress(){
store.updateCustomerAddress(model.value)
.then(()=> {
    console.log('done')
})
}



</script>


