import { createStore } from "vuex";
const store = createStore({
    state:{
        //get data from local store or define variables
        token : localStorage.getItem('token') || 0
    },
    mutations:{
        //update variables
        UPDATE_TOKEN(state, payload){
            state.token = payload
        }
    },
    actions:{
        //action to be performed 
        setToken(context , payload){
            localStorage.setItem('token', payload)
            context.commit('UPDATE_TOKEN', payload)
        },
        removeToken(contex){
            localStorage.removeItem('token')
            contex.commit(UPDATE_TOKEN, 0)
        }

    },
    getters:{
        //get state variable value
        getToken : function(state){
            return state.token
        }
    }
})
export default store