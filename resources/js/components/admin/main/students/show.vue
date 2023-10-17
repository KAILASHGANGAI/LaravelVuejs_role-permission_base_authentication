<template>


    <div class="">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Students Details</h6>
            </div>
            <div class="card-body table-responsive p-6 text-gray-900">
               
                <DataTable
                            :data="students"
                            :columns="columns"
                           
                           
                        >
                            <thead>
                                <tr>
                                <th>RollNo</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Phone_no</th>
                                <th>DOB</th>
                                <th>Email</th>
                                <th>Faculty</th>
                                <th>Section</th>
                                <th>Semester/Years</th>
                                <th>Tuitionfee</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                </tr>
                            </thead>
                           
                        </DataTable>

            </div>
        </div>

    </div>
</template>
<script>
    import router from '../../../../adminrouter';
    import store from '../../../../adminstore';
    export default {

        data() {
           
            return {
                
                columns: [
                    { data: 'id' },
                     {
                      data:'images',
                      render: function (data) {
                        return  `<img src="${'/'+data}" alt="" height="50">`;
                        }
                    },
                    { data: 'name' },
                    { data: 'address' },
                    { data: 'phone_no' },
                    { data: 'DOB' },
                    { data: 'email' },
                    { data: 'faculty.faculty_name' },
                    { data: 'section.section_name' },
                    { data: 'nationality' },
                    { data: 'tuitionfee' },
                   
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
                   
                   
                ],
                students: [],
                student_edit_data: "",
            };
            
        },
        
        created() {
           
            axios.get("/api/students", {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + store.state.admintoken,
                },
            }).then((res) => {
                console.log(res);
                this.students = res.data.students;
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
                   
             deleteStudent(index) {
                axios.delete("/api/students/" + index, {
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " +store.getters.getAdminToken,
                    },
                }).then((res) => {
                    this.students = this.students.filter(students => {
                        return students.id != index
                    })
                    router.push("/admin/students");
                    console.log(res);
                });
            },
        },
        mounted(){
            $(document).on('click','#edit',function(){
                let id = $(this).data('id');
                router.push("/admin/students/edit/" + id);
            })
            // $(document).on('click','#delete',function(){
            //     let id = $(this).data('id');
            //     this.deleteStudent(id);
            // })
        },
    };
</script>
<style scoped>
    .img {
        height: 40px;
        width: 40px;
    }
</style>
