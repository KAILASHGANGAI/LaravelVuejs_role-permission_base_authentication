<template>
    <navbarvue></navbarvue>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">home Component</div>

                    <div class="card-body">
                        I'm an home component.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footervue></footervue>
</template>

<script>
import navbar from '../components/parts/navbar.vue'
import footer from '../components/parts/footer.vue'
    export default {
        components:{
            'navbarvue': navbar,
            'footervue': footer
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
