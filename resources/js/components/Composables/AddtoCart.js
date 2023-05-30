import {useCartStore} from '../../Store/CartStore'
import { useProductStore } from '../../Store/ProductStore'
import { UserStore } from '../../Store/UserStore'

export default function UseCartComposable(){

    const CartStore=useCartStore()
    const store=useProductStore()
    const User=UserStore()

    function inserToCart(id, quantity=null){
        CartStore.insertToCart(id, quantity)
        .then(() => {
            CartStore.getCart()
         store.notify(
            {
                'type':'success',
                'message':'product added to Cart Successfully'
            }
         )
        
        })
    }


    function insertToWishlist(id){
        User.addWishlist(id)
        .then(() => {
            User.getWishlist()
            store.notify(
                {
                'type':'success',
                'message':'Product added to wishlist'
            }
            )
        })
        .catch(() =>{
            store.notify(
                {
                'type':'danger',
                'message':'Register to your account to add to wishlist'
            }
            )
        })
    }


    return {
        inserToCart,
        insertToWishlist
    }
}