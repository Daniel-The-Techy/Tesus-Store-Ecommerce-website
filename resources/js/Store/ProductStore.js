import axiosClient from "../axios";
import { defineStore} from 'pinia'
import {reactive, computed} from 'vue'
import { UserStore } from "./UserStore";
import { storeToRefs } from "pinia";



export const useProductStore = defineStore('product', {
    // convert to a function
    state: () => {
        return{
      products:[],
      product:{},
      cart:[],
      Wishlist:[],
      category:[],
      SearchData:[],
      ProductCategory:[],
      notifications:{
        'show':false,
        'type':null,
        'message':null
      },
      
        }
      },

getters:{

  countProductByCategory:(state) => {
 return(Category_id) => state.products.filter((product) => product.Category_id === Category_id)?.length
  },
  
  getCategoryId:(state) => {
      const productCategory=state.category.filter((category) => category.id)
     // return(id) => state.category.find((pro) => pro.id === id)?.name
     return(id) => productCategory.find((pro) => pro.id === id)?.name
  },

  getCartItem(){
    return this.products.find(pro => pro.id ===7)       // return reactive(this.products);
 
},

getLowPriceToHighPrice :() => {
   return this.products.sort((a, b) => a.price - b.price)
 },

 //this.updateSortProduct(sort)
// return this.products;

getAllCart(){
  return this.products;
},

 
},

  
    actions: {

        
    

         getProduct(){
            return axiosClient.get('/Products')
           .then(({data}) => {
             this.updateProducts(data);
              return data;
      })
        },

        HandleSelection(data){
            if(data =="lowPrice"){
              return this.products.sort((a, b)=> b.price - a.price)
            }else if(data == "HighPrice"){
              return this.products.sort((a, b)=> a.price - b.price)
            }else if(data == "LatestProduct"){
              return this.products.sort((a, b)=> b.created_at - b.created_at)
            }

        },


    

        

        async getCart(){
          return axiosClient.get('/Carts')
          .then(({data}) => {
             this.updateCarts(data);
             return data;
       })
      },

      async getCategory(){
        return axiosClient.get('/Category')
        .then(({data}) => {
           this.updateCategory(data);
           return data;
     })
    },

    async Search(name){
      return axiosClient.get('/Search/' + name)
      .then(({data}) =>{
      this.updateCurrentSearch(data);
      return data
      })
    },

    async getCategoryByID(id){
      return axiosClient.get('/Category/' + id)
      .then(({data}) =>{
      this.updateProductCategory(data);
      return data
      })
    },

    getProductBySlug(slug){
      return axiosClient.get('/Product/' + slug)
      .then((data) => {
        this.updateProduct(data)
        return data
      })
    },
  
  
     updateCurrentSearch(payload){
       this.SearchData=payload;
    },
   

        updateCarts(payload){
          this.cart=payload.data;
        },
     

        updateProducts(payload){
            this.products=payload.data;
        },

        updateProduct(payload){
          this.product=payload
        },
        getQuantity(){
          this.products.map((product) =>{
            return product.id;
          })
        },

        updateCategory(payload){
          this.category=payload.category;
        },

        updateProductCategory(payload){
          this.ProductCategory=payload.data
        },


        updateSortProduct(payload){
          this.products=payload;
        },

        notify({type, message}){
          this.notifications.show=true;
          this.notifications.type=type;
          this.notifications.message=message;

          setTimeout(() => {
            this.notifications.show=false;
          }, 5000);
        }

       

      },
      // mutations can now become actions, instead of `state` as first argument use `this`

     
      
    
    
  });