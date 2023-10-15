<template>
  <div class="card-body table-responsive">
    <h5 class="card-title">All Staffs Details</h5>

    <table class="table table-border table-responsive">
      <thead>
        <tr>
          <th scope="col">S.N</th>
          <th scope="col">Image</th>
          <th scope="col">Name</th>
          <th scope="col">Address</th>
          <th scope="col">Phone</th>
          <th scope="col">Email</th>
          <th scope="col">Password</th>
          <th scope="col">Experience</th>
          <th scope="col">Date_of_Birth</th>
          <th scope="col">Salary</th>
          <th scope="col">Gender</th>
          <th scope="col">Category</th>
          <th scope="col">Blood_Group</th>
          <th scope="col">Action</th>

        </tr>
      </thead>
      <tbody>
        <tr v-for="(staff, index) in staffs" :key="index">
          <td>{{+ + index }}</td>
          <td><img :src="'/' + staff.images" alt="" height="50"></td>
          <td>{{ staff.name }}</td>
          <td>{{ staff.address }}</td>
          <td>{{ staff.contact }}</td>
          <td>{{ staff.email }}</td>
          <td>{{ staff.password }}</td>
          <td>{{ staff.experience }}</td>
          <td>{{ staff.dob }}</td>
          <td>{{ staff.salary }}</td>
          <td>{{ staff.gender }}</td>
          <td>{{ staff.staff_category }}</td>
          <td>{{ staff.bloodgroup }}</td>
          <td class="float-end">
            <button class="btn-success" @click="EditStaff(staff.id)">
           Edit
            </button>
            <button class="btn-danger" @click="deleteStaff(staff.id)">
              Delete
            </button>
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
      staffs: [],
    };
  },
  created() {
    // if (!User.loggedIn()) {
    //   router.push("/admin/login")
    // }
    axios.get("/api/staffs", {
      headers: {
        "Content-Type": "application/json",
        Authorization: "Bearer " +store.getters.getAdminToken,
      },
    }).then((res) => {
      console.log(res);
      this.staffs = res.data;
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
    EditStaff(index) {
      router.push("/admin/staffs/edit/" + index);
    },
    deleteStaff(index) {
      axios.delete("/api/staffs/" + index, {
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " +store.getters.getAdminToken,
        },
      }).then((res) => {
        this.staffs = this.staffs.filter(staffs => {
          return staffs.id != index
        })
        router.push("/admin/Staffs");
        console.log(res);
      });
    },
  },
};
</script>