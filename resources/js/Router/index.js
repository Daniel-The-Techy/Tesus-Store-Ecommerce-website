import { createRouter, createWebHistory } from "vue-router";
import App from '../components/App.vue';
import Main from '../components/Main.vue';
import Test from '../components/Test.vue';
import FourOhFour from '../components/FourOhFour.vue';
import Header from '../components/Header.vue'
import Cart from '../components/Cart.vue'
import Search from '../components/ProductSearch.vue'
import Register from '../components/Register.vue'
import Login from '../components/Login.vue'
import Footer from '../components/Footer.vue'
import Account from '../components/Account/Home.vue'
import Category from '../components/Category.vue'
import Product from '../components/Product.vue'
//import AccountHome from '../components/Account/Account.vue'
import Address from '../components/Account/Address.vue'
import Profile from '../components/Account/Profile.vue'
import PasswordUpdate from '../components/Account/ChangePassword.vue'
import Wishlist from '../components/Account/wishlist.vue'
import Checkout from '../components/checkOut.vue'
import { UserStore } from "../Store/UserStore";

const router= createRouter({
  history:createWebHistory(),
  routes:[
    {
        path:'/dashboard',
        name:'App',
        component:App,
    },
   
   

    {
        path:'/Header',
        name:'Header',
        component:Header,
        children:[

            {
                
                    path:'/Main',
                    name:'main',
                    component:Main
                
            
            },

            {
                
                path:'/Carts',
                name:'Carts',
                component:Cart
            
        
        },

        {
                
            path:'/Search/:ProductName',
            name:'Search',
            props:true,
            component:Search
          },

          {
                
            path:'/Register',
            name:'Register',
            meta:{is_Guest:true},
            component:Register
          },

          {
                
            path:'/Checkout',
            name:'Checkout',
            component:Checkout
          },

          {
                
            path:'/Login',
            name:'Login',
            meta:{is_Guest:true},
            component:Login
          },
    
          {
                
            path:'/Account/Home',
            name:'Account',
            meta:{requireAuth:true},
            component:Account
          },

         

          {
                
            path:'/Account/Profile',
            name:'Profile',
            meta:{requireAuth:true},
            component:Profile
          },

          {
                
            path:'/Account/Address',
            name:'Address',
            meta:{requireAuth:true},
            component:Address
          },

          {
                
            path:'/Account/ResetPassword',
            name:'Password',
            meta:{requireAuth:true},
            component:PasswordUpdate
          },

          {   
            path:'/Account/Wishlist',
            name:'Wishlist',
            meta:{requireAuth:true},
            component:Wishlist
          },
            
          {
                
            path:'Category/:name',
            name:'Category',
            component:Category
          },

          {
                
            path:'/Product/:slug',
            name:'Product',
            component:Product
          },


        ],

     
      },

  

    {
      path:'/footer',
      name:'Footer',
      component:Footer
    }

  ]

  })


  router.beforeEach((to, from, next)=>{
    const store=UserStore();
    if(!store.token && to.meta.requireAuth){
       next('/Login')
    }else if(store.token && (to.meta.is_Guest)){
      next('Account')
    }else{
      next()
    }
 })


 

export default router;