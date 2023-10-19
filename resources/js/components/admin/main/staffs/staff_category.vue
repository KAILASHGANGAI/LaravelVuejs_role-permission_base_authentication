<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 mx-auto">
                <div class="card ">
                    <div class="card-" >
                        <h4 class="p-4">Staff Category
                        <div class="pl-4 pt-2">
                           <small v-if="errors.category_name" class="text-danger">{{ errors.category_name[0] }}</small>

                            <form @submit.prevent="save" method="post" class="d-flex">
                            <input type="text" v-model="category" class="form-control w-50">
                            <button type="submit" class="btn btn-success ml-2">Save</button>
                        </form>
                        </div>
                    </h4>
                    </div>
                    <div class="card-">
                        <table class="table" border="0">
                            <tr>
                                <th>S.N</th> <th>Category</th> <th>Action</th>
                            </tr>
                            <tr v-for="(item , index) in categories" :key="index">
                                <td>{{ ++index }}</td>
                                    <td>{{ item.category_name }}</td>
                                    <td>
                                        <button @click="deletecategory(item.id)" class="btn btn-danger">Delete</button>
                                    </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
import axios from 'axios';
import store from '../../../../adminstore';

export default{
    data(){
        return{
            category:"",
            categories:[],
            errors: {}
        }
    },
    created(){
        this.getdata()
    },
    methods:{
        getdata(){
            axios.get('/api/staff-category/index').then((res)=>{
                console.log(res)
                    this.categories = res.data
            })
        },
        save(){
            let data ={
                'category_name':this.category
            }
            console.log(data)
            axios.post('/api/staff-category/store',data,{
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " +store.getters.getAdminToken,
                },
            }).then((res)=>{
                this.category=""
                    this.getdata()
                    toast.fire({
                    icon:"success",
                    title:res.data.status
                })

            }).catch((error) => this.errors = error.response.data.errors)
        },
        deletecategory(index){
            axios.delete('/api/staff-category/'+index+'/delete').then((res)=>{
                this.getdata()
                    toast.fire({
                    icon:"success",
                    title:res.data.status
                })
                this.categories = this.categories.filter(categories => {
                    return categories.id != index
                    })
            })
        }
    }
}

</script>