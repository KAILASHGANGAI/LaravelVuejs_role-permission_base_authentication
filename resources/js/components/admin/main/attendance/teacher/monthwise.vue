<template>
    <h4>Monthwise Attendance of Teachers 
        <input type="month" @change="getmonth" id="">
    <button class="btn btn-info mx-4" v-print="'#printMe'">Print</button>
    </h4>
    


    <div class="attendance-container  table-responsive mt-3" >
        
      <div id="printMe">
        <h4 class="card-title text-center" v-if="!data.month">Current Month</h4>
        <h4 class="card-title text-center" v-if="data.month">{{ data.month+'-'+data.year }}</h4>
        <table  >
       
        <thead>
            <tr>
                <th>S.N</th>
                <th>Staff Names</th>
                <th  class="name-col" v-for="day in no_of_days" :key="day">{{ day }}</th>
             </tr>
        </thead>
        <tbody id="tbody">
            <tr v-for="(item, index) in attendances">
                <td>{{ ++index }}</td>
                <td>{{ item.name }}</td>
                <td  class="name-col" v-for="day in no_of_days" :key="day"> <input type="checkbox"  disabled  :checked="checkdate(day, item.attendance)"  id=""></td>
            </tr>
        </tbody>
      </table>
      </div>
    </div>
  

</template>

<script>
import axios from 'axios';

export default{
    data(){
        return{
            attendances:[],
             months: {
                    1: 31,
                    2: 28,
                    3: 31,
                    4: 30,
                    5: 31,
                    6: 30,
                    7: 31,
                    8: 30,
                    9: 30,
                    10: 31,
                    11: 30,
                    12: 31
                    },
                    no_of_days:30,
                    data:{
                        month:null,
                        year:null
                    }
        }
    },
    created(){
       
        this.getdata()
    },
    methods:{
        getdata(){
            axios.post('/api/attendance/teacher/bymonth',this.data).then((res)=>{
            this.attendances = res.data
            
        });
        },
        checkdate(e, a) {
            let b = String(e).padStart(2, '0');
            let result = null;
            a.forEach(element => {
                let c = element.date.split('-')[2];
                if (b === c && element.status === 1) {
                    result = c;
                }
            });
            return result;
        },
        getmonth(event){
            const selectedDate = new Date(event.target.value + '-01');
            const year = selectedDate.getFullYear();
            const month = selectedDate.getMonth() + 1;
            this.no_of_days =  this.months[month] 
            this.data.month = month;
            this.data.year = year;
            this.getdata();
            
        }
    }
}
</script>
<style scoped>

table {
  border-collapse: collapse;
}
th {
  background-color: #001f3f;
  color: #fff;
  padding: 0.5em 1em;
}

td {
  border-top: 1px solid #eee;
  padding: 0.5em 1em;
}

input {
  cursor: pointer;
}


</style>