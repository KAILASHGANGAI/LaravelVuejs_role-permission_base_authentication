<template>
  <div class="card-body table-responsive">
    <h5 class="card-title">All Staffs Details</h5>

    <DataTable
                 :data="staffs"
                :columns="columns"
                           
                           
                        >
   
      <thead>
        <tr>
          <th scope="col">S.N</th>
          <th scope="col">Image</th>
          <th scope="col">Name</th>
          <th scope="col">Address</th>
          <th scope="col">Phone</th>
          <th scope="col">Email</th>
          <th scope="col">Experience</th>
          <th scope="col">Date_of_Birth</th>
          <th scope="col">Salary</th>
          <th scope="col">Gender</th>
          <th scope="col">Category</th>
          <th scope="col">Blood_Group</th>
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>

        </tr>
      </thead>
     </DataTable>


  </div>
</template>
<script>
import router from '../../../../adminrouter';
import store from '../../../../adminstore';

export default {
  data() {
    return {
      staffs: [],
      columns: [
                    { data: 'id' },
                    {
                      data:'images',
                      render: function (data) {
                        return  `<img src="${'/'+data}" alt="" height="50">`;
                        }
                    },
                    {data:'name'},
                    {data:'address'},
                    {data:'contact'},
                    {data:'email'},
                    {data:'experience'},
                    {data:'dob'},
                    {data:'salary'},
                    {data:'gender'},
                    {data:'staff_category'},
                    {data:'bloodgroup'},
                    
                    {
                        data: 'id',
                        render: function (data) {
                        return  `<button data-id="${data}" class="btn btn-info" id="edit">Edit</button>`;
                        }
                    },
                    {
                        data: 'id',
                        render: function (data) {
                        return `<button data-id="${data}" class="btn btn-danger" id="delete">Delete</button>`;
                        }
                    },
                    
    ]
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
    $(document).on('click',this.handel);
  },
  // mounted(){
  //           $(document).on('click','#edit',function(){
  //               let id = $(this).data('id');
  //               router.push("/admin/staffs/edit/" + id);
  //           })
            
  //       },
  methods: {
    handel(event){
      if (event.target && event.target.id === 'delete') {
        let id = event.target.getAttribute('data-id');
        // console.log(event.target.getAttribute('data-id'))
        this.deleteStaff(id); // Call the defined method within Vue instance
      }
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
        router.push("/admin/staff-details");
        console.log(res);
      });
    },
  },
};
</script>