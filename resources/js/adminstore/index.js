import { createStore } from "vuex";
const store = createStore({
    state:{
        //get data from local store or define variables
        admintoken : localStorage.getItem('admintoken') || 0 ,
        adminuser : localStorage.getItem('adminusername') || 0 ,
     
    },
    mutations:{
        //update variables
        UPDATE_TOKEN(state, payload){
            state.token = payload
        },

        UPDATE_USER(state,payload){
            state.user = payload

        }
    },
    actions:{
        //action to be performed 
        setAdminToken(context , payload){
            localStorage.setItem('admintoken', payload)
            context.commit('UPDATE_TOKEN', payload)
        },
       
        removeAdminToken(contex){
            localStorage.removeItem('admintoken')
            contex.commit('UPDATE_TOKEN', 0)
            
        },
        setAdminUser(context , payload){
            localStorage.setItem('adminusername', payload)
            context.commit('UPDATE_USER', payload)
        },
        removeAdminUser(contex){
            localStorage.removeItem('adminusername')
            contex.commit('UPDATE_USER', 0)
        }
    },
    getters:{
        //get state variable value
        getAdminToken : function(state){
            return state.admintoken
        },
        getAdminUser : function(state){
            return state.adminuser
        },

    }
})
export default store