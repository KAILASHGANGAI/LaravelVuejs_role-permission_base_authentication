<template>
    <h4>Show Staff attendance 
        <router-link class="btn btn-primary" to="/admin/create-teacher-attendance">Take Attendance</router-link> </h4>          

<input type="month" v-model="formattedDate" @change="getdata" class="btn btn-success mx-2" id="month">
<div class="container pt-4">
         <span>{{ selectedmonth.toString() }}</span>
    <table class="table">
        
        <tr>
            <th>S.N</th> <th>Name</th> <th>Total Preasent</th> <th>Total Absent</th> <th>Working days</th>
        </tr>
        <tr v-for="(item, index) in staffs" :key="index">
            <td>{{ ++index }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.present_count}}</td>
            <td>{{ item.absent_count }}</td>
            <td>{{ item.present_count + item.absent_count }}</td>

        </tr>
    </table>
</div>
   
</template>

<script>
import store from '../../../../../adminstore'

export default{
    data(){
        return{
            staffs:[],
            date: new Date(),
            selectedmonth:'',
            monthNames: [
        'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
        'September', 'October', 'November', 'December'
      ]
        }
    },
    created(){
        axios.get('/api/attendance/teacher/list',{
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " + store.getters.getAdminToken,
            },
        }).then((res)=>{
            console.log(res)
            this.staffs = res.data
        })
    },
    computed:{
        formattedDate() {
      let month = `${this.date.getMonth() + 1}`.padStart(2, '0');
      let year = this.date.getFullYear();
      return `${year}-${month}`;
    }
    },
    methods:{
        getdata(event){
            const selectedDate = new Date(event.target.value + '-01');
            const currentYear = selectedDate.getFullYear();
            const currentMonth = selectedDate.getMonth() + 1;
            let data = {
                'year':currentYear,
                'month':currentMonth 
            }
            
            this.selectedmonth = selectedDate.getFullYear()+"-"+this.monthNames[selectedDate.getMonth()]

            axios.post('/api/attendance/teacher/bydate',data,{
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " + store.getters.getAdminToken,
            },
        }).then((res)=>{
            console.log(res)
            this.staffs = res.data

        })

        }
    }
}
</script>