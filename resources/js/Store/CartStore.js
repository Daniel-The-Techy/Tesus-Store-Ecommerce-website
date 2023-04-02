import axiosClient from "../axios";
import { defineStore} from 'pinia'
import { useProductStore } from "./ProductStore";
import { UserStore } from "./UserStore";
import { storeToRefs } from "pinia";
import { onMounted, toRaw } from "vue";


//

export const useCartStore = defineStore('Cart', {
    // convert to a function
    
    state: () => ({
      cart:[],
         shipping:{
            standardShipping:10,
            basicShipping:5
         },


        
    }),

    getters:{

           sumCart(){
           return this.cart.reduce((sum, data)=> sum + data.quantity, 0)
           },

    

         
    },

    actions: {
     
      GetUserId(){
        const store=UserStore()
        let show=storeToRefs(store)
         store.getUser()
       return show.Userid.value;
      },


      GetAuthenticatedUser(){
        const store=UserStore()
        return store.token
    
      },

        async getCart(){
          let response;
          if(this.GetAuthenticatedUser()){
           response= axiosClient.get('Carts')
           .then(({data})=> {
              this.updateCarts(data)
           })
           }else{
            response= axiosClient.get('GuestCarts')
            .then(({data})=> {
               this.updateCarts(data)
           })
          }
           return response
        },



       
        async insertToCart(id, quantity){
         console.log(this.GetUserId())
          return axiosClient.post('/addToCart', {id:id, Authid:this.GetUserId(), quantity:quantity})
          .then(({data}) => {
            // this.updateCart(data)
             return data
          })
        },
        async increaseQuantity(id){
          return axiosClient.post('/updateQuantity/' + id)
          .then(({data})=> {
            return data
          })
        },

        async deleteCart(id){
          return axiosClient.get('/deleteCart/' + id)
          .then(()=>{
            this.getCart();
          })
        },
      

        updateCarts(payload){
         this.cart=payload.data;
       //   this.cart.push(payload.data);
        },
     



      }
      // mutations can now become actions, instead of `state` as first argument use `this`

      
    
    
  });