<template>
  <div class="card-body  p-2" style="background: white;">
    <h5 class="card-title">Periods</h5>
    <table class="table table-info">
      <thead>
        <tr>
          <th>S.N</th>
          <th>faculty</th>
          <th>Semester</th>
          <th>Section</th>
          <th>No_of_Period</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(data, index) in datas" :key="index">
          <td>{{ ++index }}</td>
          <td>{{ data.faculty_id }}</td>
          <td>{{ data.semesters_id }}</td>
          <td>{{ data.section_id }}</td>
          <td>{{ data.no_of_periods }}</td>

          <td>
            <button class="btn-success" @click="view(data.id)">
              <i class="eye"> View </i>
            </button>
            <!-- <button class="btn-success" @click="EditPeriod(data.id)">
             Edit
            </button>
            <button class="btn-danger" @click="deletePeriod(data.id)">
             Delete
            </button> -->
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
import router from '../../../../adminrouter';
import store from '../../../../adminstore';

export default {
  data() {
    return {
      datas: [],
    };
  },
  created() {
    // if (!User.loggedIn()) {
    //   router.push("/admin/login")
    // }
    //get api data
    axios.get("/api/periods", {
      headers: {
        "Content-Type": "application/json",
        Authorization: "Bearer " + store.getters.getAdminToken,
      },
    }).then((res) => {
      console.log(res);
      this.datas = res.data;
    }).catch((error) => {
      router.push('/admin/login');
      localStorage.clear()
      toast.fire({
        icon: "error",
        title: error.response.data.message
      })
    })
  },
  methods: {
    view(index) {
      router.push("/admin/periods/single/" + index);
    }
  }
};
</script>
