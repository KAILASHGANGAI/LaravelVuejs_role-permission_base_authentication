<template>

    <section class="container-fluid card-body ">
        <div class="table-responsive">
            <h4 class="card-title">Accounts Details</h4>
            <DataTable :data="datas" :columns="columns" > 
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone_no</th>
                        <th scope="col">faculty</th>
                        <!-- <th scope="col">Semester/Year</th>
                        <th scope="col">Section</th> -->
                        <th scope="col">Deposited</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Due_Left</th>
                        <!-- <th scope="col">Payment_method</th> -->
                        <th scope="col">Fee_type</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead> 
            </DataTable>
            <!-- <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone_no</th>
                        <th scope="col">faculty</th>
                        <th scope="col">Semester/Year</th>
                        <th scope="col">Section</th>
                        <th scope="col">Deposited</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Due_Left</th>
                        <th scope="col">Payment_method</th>
                        <th scope="col">Fee_type</th>
                        <th scope="col">DAte</th>
                    </tr>
                </thead>              
                <tbody>
                    <tr v-for="(data, index) in datas" :key="index">
                        <th scope="row">{{ ++index }}</th>
                        <td>{{ data.students.name }}</td>   
                        <td>{{ data.students.phone_no }}</td>
                        <td>{{ data.students.faculty.faculty_name }}</td>
                        <td>{{ data.students.semester.semester_years }}</td>
                        <td>{{ data.students.section.section_name }}</td>
                        <td>{{ data.deposited }}</td>
                        <td>{{ data.discount }}</td>
                        <td>{{ data.left_due }}</td>
                        <td>{{ data.payment_method }}</td>
                        <td>{{ data.fee_type }}</td>
                        <td>{{ data.created_at.split("T")[0] }}</td>
                    </tr>
                </tbody>
            </table> -->
        </div>
    </section>
</template>
<script>
import axios from "axios";
import router from '../../../../adminrouter';   
import store from '../../../../adminstore';


export default {
    data() {
        return {
            datas: [],
            columns:[
                {data:'id'},
                {data:'students.name'},
                {data:'students.phone_no'},
                {data:'students.faculty.faculty_name'},
                // {data:'students.semester.semester_years'},
                // {data:'students.section.section_name'},
                {data:'deposited'},
                {data:'discount'},
                {data:'left_due'},
                // {data:'payment_method'},
                {data:'fee_type'},
                {data:'created_at'},
            ]
        };
    },
    created() {
    //   if (!User.loggedIn()) {
    //     this.$router.push({name: '/admin/'})
    //   }
    
        axios
            .get("/api/get-payment-records", {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + store.getters.getAdminToken,
                },
            })
            .then((res) => {
                this.datas = res.data;
            })
            .catch((error) => {
                console.log(error);
                toast.fire({
                    icon: "error",
                    title: error.response.data.message,
                });
            });
    },
};
</script>
