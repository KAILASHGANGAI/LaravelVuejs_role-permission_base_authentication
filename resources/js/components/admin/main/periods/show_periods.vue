<template>
  <div class="card p-2">
    <h5 class="card-title">Periods</h5>
    <table class="table">
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
            <button class="text-success" @click="view(data.id)">
              <i class="eye"> View </i>
            </button>
            <!-- <button class="text-success" @click="EditPeriod(data.id)">
              <i class="ri-edit-box-fill"></i>
            </button> -->
            <button class="text-danger" @click="deletePeriod(data.id)">
              <i class="ri-delete-bin-2-fill"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
import router from '../../../../adminrouter';
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
        Authorization: "Bearer " + localStorage.getItem("token"),
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
