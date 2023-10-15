<template>
  <section class="container-fluid">
    <div class="card w-75 border table p-5">
      <table class="border table w-50 h-50" id="myDiv" width="50%">
        <tr>

          <div class="d-flex text-center justify-content-between">
            <img :src="'../../' + details.logo" class="img" alt="" />

            <div>
              <p class="card-title text-center m-0 pb-0 pt-0">
                {{ details.school_name }}
              </p>
              <span class="address">{{ details.address }}, {{ details.phone }}</span> <br>
              <span class="address">Email: {{ details.email }}</span>
            </div>
            <div class="text-end pt-4">

              <span>PAN :{{ details.pan_number }}</span>
              <br />
              <span>Receipt No. : {{ payment.id }}</span>
            </div>
          </div>
        </tr>

        <tr class=" text-left">
          <div class="">
            <span class="p-2">Name : {{ student.name }}</span>
            <span class="p-2">Roll No. : {{ student.id }}</span><br />

            <span>faculty : {{ student.faculty.faculty_name }}, {{ student.semester.semester_years }}</span><br />

            <span>Date : {{ payment.created_at.split('T')[0] }}</span>
            <br />
          </div>

        </tr>
        <tr>
          <table class="table w-100">
            <tr>
              <th>S.N</th>
              <th>Fee</th>
              <th>Discount (Rs.)</th>
              <th>Amount (Rs.)</th>
            </tr>
            <tr>
              <td>1</td>
              <td>{{ payment.fee_type }}</td>
              <td>{{ payment.discount }}</td>
              <td>{{ payment.deposited }}</td>
            </tr>
            <tr colspan="2" class="borders">
              <td colspan="3" class="text-right">Total Amount Received :</td>
              <td>{{ payment.deposited }} /-</td>
            </tr>

            <tr colspan="4">
              <td colspan="4" class="cir">
                <span>Due left:
                  <span class="float-right">{{ student.tuitionfee - totalpayed }} /-</span></span>
              </td>
            </tr>


          </table>
          <div class="float-right py-3">
            <span class="float-end">signature</span>
          </div>
        </tr>
      </table>

    </div>

    <button type="button" id="print" class="btn btn-primary float-right mr-5" @click="myfunction()">
      print now
    </button>
  </section>
</template>
<script>
// import PrintJS from 'print-js';
import router from '../../../../adminrouter';
import store from '../../../../adminstore';

export default {
  data() {
    return {
      student: '',
      payment: '',
      totalpayed: 0,
      details: '',
    }
  },
  props: ['id'],
  created() {
    axios.get("/api/general-details/", {
      headers: {
        "Content-Type": "application/json",
        Authorization: "Bearer " + store.getters.getAdminToken
      }
    }).then((res) => {
      this.details = res.data
    }).catch((error) => {
      router.push('/admin/login');
      localStorage.clear()
      toast.fire({
        icon: "error",
        title: error.response.data.message
      })
    })

    axios.get("/api/payment/bill/" + this.id, {
      headers: {
        "Content-Type": "application/json",
        Authorization: "Bearer " + store.getters.getAdminToken
      }
    }).then((res) => {
      console.log(res.data.student.payments);
      this.student = res.data.student,
        this.payment = res.data.payments

      res.data.student.payments.forEach(element => {
        this.totalpayed = this.totalpayed + element.deposited
      });

      console.log(this.totalpayed)
    });
  },
  
  methods: {
    myfunction() {
      //     const print = printJS({
      //   printable: 'myDiv',
      // type: 'html',
      //   landscape: true,
      //   doubleSided: false,
      //   targetStyles: ['*'],
      //   fitContentWidth: false,
      //   columns: 2,
      //   pageSize: 'A4',
      // });

      // print.print()
    }
  }

};
</script>

<style scoped>
.img {
  height: 90px;
  width: 90px;
}

/* .address {
  font-size: 12px;
} */

@page {
  size: auto;
  /* auto is the initial value */

  /* this affects the margin in the printer settings */
  margin: 20mm 20mm 20mm 20mm;
}

tr,
td,
th {
  padding: 12px;
}

.borders {
  /* border-top: 2px solid black; */
  padding: 12px;
}

.cir {
  border: 1px solid red;
  border-radius: 7px;
  padding: 4px;
}
.table{
  font-size: 9px;
  line-height: 20px;
}

</style>