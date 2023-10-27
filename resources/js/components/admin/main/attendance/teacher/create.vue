<template>
    <h4>Create Staff attendance</h4>

    <input type="date" v-model="form.date" class="btn btn-primary m-2" name="date" /> 
    <button type="submit" @click.prevent="save" class="btn btn-success">Save</button>
    <div class="container">
        <table class="table">
            <tr>
                <th>S.N</th> <th>Teacher/Staff</th> <th>Contact</th><th>Action</th>
            </tr>
            <tbody>
                <tr v-for="(item, index) in staffs" :key="index">
                    <td>{{ ++index }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.contact }}</td>
                    <td>
                        <input type="checkbox" v-on:change="changeMyAttendance" :value="item.id">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</template>
<script>
import axios from 'axios';
import store from '../../../../../adminstore';
import router from '../../../../../adminrouter';

export default{
    data(){
        return{
            staffs:[],
            form:{
                date:'',
                attendances: [],
                absent: []
                
            }
        }
    },
    created(){
        axios.get('/api/staffs',{
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " + store.getters.getAdminToken,
            },
        }).then((res)=>{
            this.staffs = res.data
        })
    },
    methods:{
        changeMyAttendance(checked) {
            if (checked.target.checked === false) {
                this.form.attendances = this.form.attendances.filter(element => element != checked.target.value);
                this.form.absent.push(checked.target.value)
            }
            else {
                this.form.attendances.push(checked.target.value)
                this.form.absent = this.form.absent.filter(element => element != checked.target.value);
            }
            // console.log("Attendance")
            // console.log(this.form.attendances)
            // console.log("Absent")

            // console.log(this.form.absent)
        },
        save() {

            axios.post('/api/attendance/teacher', this.form, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + store.getters.getAdminToken,
                },
            }).then((res) => {

                toast.fire({
                icon: "success",
                title: res.data.status
            })
                router.push('/admin/teacher-attendance')
            }).catch((error)=>{
                console.log(error)
                toast.fire({
                icon: "error",
                title: error.response.data.message
            })
            });
            }
    }


}

</script>