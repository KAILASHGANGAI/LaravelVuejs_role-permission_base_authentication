<template>
    <section class="container-fluid card ">

        <div class="">

            <div class="line pb-3">
                <span>
                    <h2 class="card-title"><span>Payment form</span></h2>
                </span>
            </div>

            <div class="row student ">

                <div class="form col-sm-8 mx-auto ">
                    <span>Date </span>
                    <hr>

                    <div class="row ">

                        <div class="form-group col-sm-4 ">
                            <label for="">Student Roll no.</label> <br>
                            <input type="number" class="form-control" @input="studentDetail()" v-model="student_roll" id=""
                                required>
                        </div>

                        <div class="form-group col-sm-4">
                            <label for="">Deposite Amount</label> <br>
                            <input type="number" class="form-control" v-model="deposite" id="" required>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="">Discount Amount</label> <br>
                            <input type="number" class="form-control" v-model="discount" id="">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="">Payment Method</label> <br>
                            <select class="form-control" v-model="payment_method" id="" required>
                                <option class="default" default> payment method</option>
                                <option value="cash">Cash</option>
                                <option value="Cheque">cheque</option>
                            </select>
                        </div>

                        <div class='container fee text-center'>
                            <label for="months">---------- Fee Type---------</label><br>
                            <input class="ckech-box" type="checkbox" value="Admission-Fee" v-model="fees" id=""> Admission
                            Fee <br>
                            <input class="ckech-box" type="checkbox" value="Installment" v-model="fees" id=""> Installment
                            <br>
                            <input class="ckech-box" type="checkbox" value="Other" v-model="fees" id=""> Other

                        </div>
                        <div class="float-right py-3">
                            <button class="btn px-3 btn-success" @click="save()">save</button>

                        </div>
                    </div>
                </div>
                <div class="col-sm-4 boder-black">
                    <h3 class="card-title">Details</h3>
                    <span>
                        Name:{{ data.name }} ,<br>
                        Address:{{ data.address }}, <br>
                        Contact no: {{ data.phone_no }}, <br>
                        Tuitionfee :Rs.{{ data.tuitionfee }} <br>
                        <hr>
                        <div v-if="check_me">
                            <span v-if="check_me > 0">
                                Total Remaining: {{ check_me }}
                            </span>
                            <span v-else>
                                Advance Payment: {{ check_me * -1 }}
                            </span>
                        </div>
                    </span>


                </div>

                <div class="details">
                    <table class="table border">
                        <tr>
                            <th>S.N</th>
                            <th>Deposited</th>
                            <th>Discount</th>
                            <th>Payment_method</th>
                            <th>Fee_type</th>
                            <th>Date</th>
                        </tr>
                        <tbody>
                            <tr v-for="(detail, index) in paymentdetails" :key="index">
                                <td>{{ ++index }}</td>
                                <td>{{ detail.deposited }}</td>
                                <td>{{ detail.discount }}</td>
                                <!-- <td>{{ detail.left_due }}</td> -->
                                <td>{{ detail.payment_method }}</td>
                                <td>{{ detail.fee_type }}</td>
                                <td>{{ detail.created_at.split('T')[0] }}</td>
                            </tr>
                            <tr>
                                <td>Total: </td>
                                <td>{{ Total_deposited }} </td>
                                <td>{{ total_discount }} </td>
                                <!-- <td> {{ total_left }}</td> -->
                                <td colspan="4">/- </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
</template>
<script>
import router from '../../../../adminrouter';
import store from '../../../../adminstore';

export default {
    data() {
        return {
            data: '',
            student_roll: '',
            deposite: '',
            discount: '',
            payment_method: '',
            fees: [],
            paymentdetails: []

        }
    },
    computed: {
        Total_deposited() {
            let sum = 0;
            for (let i = 0; i < this.paymentdetails.length; i++) {
                sum += (parseFloat(this.paymentdetails[i].deposited));
            }
            return sum;

        },
        total_discount() {
            let sum = 0;
            for (let i = 0; i < this.paymentdetails.length; i++) {
                sum += (parseFloat(this.paymentdetails[i].discount));
            }
            return sum;

        },
        // total_left(){
        //     let sum=0;
        //     for (let i = 0; i < this.paymentdetails.length; i++) {
        //         sum += (parseFloat(this.paymentdetails[i].left_due));
        //     }
        //     return sum;

        // },
        check_me() {

            return this.data.tuitionfee - (this.Total_deposited + this.total_discount);

        }
    },
    methods: {
        studentDetail() {
            axios.get('/api/payment/' + this.student_roll, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + store.getters.getAdminToken
                }
            }).then((Res) => {
                this.data = Res.data
                this.paymentdetails = Res.data.payment
                console.log(Res)
            });
        },
        save() {
            let payment = {
                roll_no: this.student_roll,
                deposite: this.deposite,
                discount: this.discount,
                payment_method: this.payment_method,
                fee: this.fees.toString(),
                left_due: this.check_me,
            }
            axios.post('/api/payment', payment, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + store.getters.getAdminToken
                }
            }).then((res) => {
                router.push('/admin/payment-bill-print/' + this.student_roll)
                console.log(res)

            }).catch((error) => {
                router.push('/admin/login');
                localStorage.clear()
                toast.fire({
                    icon: "error",
                    title: error.response.data.message
                })
            })
        }
    }

}
</script>

<style scoped>/* .boder-black{
    border: 1px solid black;
} */</style>

