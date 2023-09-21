<template>
<navbarvue></navbarvue>
<h1>Post</h1> 
<div class="container">
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Veniam natus tempore corrupti eum adipisci vitae sunt impedit non voluptas sequi ducimus exercitationem officia maxime numquam suscipit doloribus quaerat rem, at architecto explicabo officiis alias animi. Quisquam illum repellendus corrupti, ab atque accusantium libero autem dolor quo vero placeat dolorum excepturi voluptatem magni reiciendis qui doloremque, incidunt possimus debitis laboriosam hic, cum nobis? Repudiandae aspernatur alias fuga minus modi molestias sed optio ipsum, earum veniam incidunt natus cupiditate. Unde atque ab corrupti, corporis labore eos facere maxime laborum rerum enim quibusdam repudiandae cumque. Placeat ratione nesciunt fugit esse cum architecto molestias!</p>
</div>
<footervue></footervue>

</template>
<script>
import navbar from '../parts/navbar.vue';
import footer from '../parts/footer.vue';
import { useStore } from 'vuex';
import store from '../../store';
export default{
    setup(){
        const store = useStore();
    },
    components:{
        'navbarvue':navbar,
        'footervue':footer,
    },
    methods:{
       
    }
}
</script>