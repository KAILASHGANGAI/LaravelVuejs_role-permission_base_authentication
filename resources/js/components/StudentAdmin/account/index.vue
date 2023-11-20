<template>
    <div class="card">
        <div class="card-title">
            <h4 class="mx-4 py-4"><u>Payments</u></h4>
           <div class="mx-4">
            Total To Be Paied : {{ payments.tuitionfee }} <br>
            Total Paied:    {{paied}}    <br>
           <p v-if="payments.tuitionfee - paied >=0"> Total Remaining :  {{ payments.tuitionfee- paied }}</p>
           <p v-if="payments.tuitionfee - paied <=0"> Total Advance Payment :  {{ paied-payments.tuitionfee  }}</p>
           </div>
        </div>
          <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                      
                        <th scope="col">Deposited</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Due_Left</th>
                        <th scope="col">Payment_method</th>
                        <th scope="col">Fee_type</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>              
                <tbody>
                    <tr v-for="(data, index) in payments.payment" :key="index">
                        <th scope="row">{{ ++index }}</th>
                      
                        <td>{{ data.deposited }}</td>
                        <td>{{ data.discount }}</td>
                        <td>{{ data.left_due }}</td>
                        <td>{{ data.payment_method }}</td>
                        <td>{{ data.fee_type }}</td>
                        <td>{{ data.created_at.split("T")[0] }}</td>
                        
                    </tr>
                </tbody>
            </table> 
    </div>
</template>
<script>
import axios from 'axios';
import store from '../../../adminstore';
import router from '../../../adminrouter';

export default {
   data(){
    return{
        payments:[],
    }
   },
   created(){
    axios.get("/api/student/payments", {
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " + store.getters.getAdminToken,
            },
        }).then((res) => {
            this.payments = res.data
        }).catch((error) => {
            router.push('/admin/login');
            localStorage.clear()
            toast.fire({
                icon: "error",
                title: error.response.data.message
            })
        })
   },
   computed:{
        paied(){
            let sum = 0;
            for (let i = 0; i < this.payments.payment.length; i++) {
                sum += (parseFloat(this.payments.payment[i].deposited +this.payments.payment[i].discount  ));
            }
         return sum;
        }
   }
};
</script>