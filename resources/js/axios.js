import axios from "axios";
//import { useAuthUserStore } from "./Store/ProductStore";
import { UserStore } from "./Store/UserStore";

//const store=useAuthUserStore();

const axiosClient=axios.create({
    baseURL:'https://TesusStore.test/api'

})

axiosClient.interceptors.request.use(config => {
    config.headers.Authorization=`Bearer ${UserStore().token}`
    return config;
})



export default axiosClient;