import { defineStore } from "pinia";
import axiosClient from "../axios";


export const UserStore = defineStore('User', {
    // convert to a function
    
    state: () => ({
      user:[],
      profile:[],
      Wishlist:[],
      Userid:'',
      token:sessionStorage.getItem('token'),
      isAuthenticated:false
    }),

    getters:{
      getId(){
           return this.profile.filter((user) => user.id)
      },

      wishlistCount: (state) =>{
        return state.Wishlist.length
      },


      loggedIn (){
        return  this.profile
      },

      getUserId(state){
        return this.Userid
              }
     
    },

    actions: {
      
      addWishlist(id){
        return axiosClient.post('/Wishlist/Create', {Product_id:id})
        .then((data) =>{
              return data
        })
    },

    checkOut(value){
      return axiosClient.post('/checkOut', value)
        .then(({data}) => {
           this.updateCustomer(data)
          this.Userid=data.data.id
          return data
        })
    },

    getWishlist(){
      return axiosClient.get('/Wishlist/Show')
      .then(({data}) => {
        this.updateWishlist(data)
        return data
      })
    },

    async deleteWishlist(id){
      return axiosClient.delete('wishlistDelete/' + id)
      .then(()=> {
         this.clearWislist()
      })
    },


      updatePassword(password){
        return axiosClient.put('/updatePassword', {Password:password})
        .then(() =>{
          console.log('Password updated successfully')
        })
      },

      async updateUsers(info){
         delete info.image_url
       return  axiosClient.post('/updateCustomer', info)
         .then(()=>{
          this.getUser()
          console.log('updated successfully');
         })
      },
     


    
    async  getUser(){
      this.profile=[]
        return axiosClient.get('/customer')
        .then(({data})=>{
        // this.updateProfile(data)
        this.Userid=data.data.id
    //this.Userid=''
        // this.isAuthenticated=true
        this.profile=data
          return data
        })
        .catch(()=>{
          this.isAuthenticated=false
        })
      },

      async Register(user){
     return axiosClient.post('/customer/Create', user)
     .then(({data})=> {
        this.updateCustomer(data)
        this.Userid=data.data.id
        console.log(this.Userid)
        return data
      })
    },

    updateCustomerAddress(data){
      return axiosClient.post('/updateCustomerAddress', data)
      .then(()=>{
        console.log('updated successfully');
      })
    },

     async Login(user){
        return axiosClient.post('/CustomerLogin', user)
        .then(({data})=>{
            this.updateCustomer(data)
            return data
        })
     },

     Logout(){
      return axiosClient.get('/Logout')
      .then(() =>{
        this.clearCustomer()
      })
     },


     updateCustomer(payload){
        this.profile=payload.data
        this.User_id=payload.data.id
        this.token=payload.token
        sessionStorage.setItem('token', this.token)
     },

     updateProfile(payload){
      this.profile=payload.data
     },

     updateWishlist(payload){
      this.Wishlist=payload
     },
     
     clearWislist(){
      this.Wishlist=[]
     },

     clearCustomer(){
      this.user=[]
      this.User_id=null
      this.token=null
      sessionStorage.clear()
     }

       
      }
      // mutations can now become actions, instead of `state` as first argument use `this`

      
    
    
  });