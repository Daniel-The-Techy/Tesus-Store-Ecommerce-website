import axiosClient from "../axios";
import { defineStore} from 'pinia'
import {reactive, computed} from 'vue'




export const useOrderStore = defineStore('Order', {
    // convert to a function
    
    state: () => ({

        visibility:true,
     

     
        
    }),

    getters:{
    
    },

    actions: {
      
        updateCustomerAddress(data){
            return axiosClient.post('/updateCustomerAddress', data)
            .then(()=>{
              console.log('updated successfully');
            })
          },

          orderDetails(data){
            return axiosClient.post('/OrderDetails', data)
            .then(()=> {
                this.visibility=false
            })
          },

          customerOrder(data){
             return axiosClient.post('/order', data)
          }
      
        
     



      }
      // mutations can now become actions, instead of `state` as first argument use `this`

      
    
    
  });