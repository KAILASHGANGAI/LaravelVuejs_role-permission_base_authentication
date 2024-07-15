<template>
    <div class="">
       
    </div>
    <div>
        <router-view></router-view>
    </div>
</template>

<script>
export default{
    data(){
        return{

        }
    },
    created(){  
            this.checkExpiration();
    },  
    methods:{
        checkExpiration() {
      const expireAt = localStorage.getItem('expire_at');
      console.log(expireAt);
      if (expireAt) {
        const now = new Date().getTime();
        console.log(now);
        console.log(now-expireAt)
        if (now > expireAt) {
          localStorage.clear();
          router.push('/login')
        } 
      }else{
        localStorage.clear();
        router.push('/login')
      }
    }
    }
}
</script>
