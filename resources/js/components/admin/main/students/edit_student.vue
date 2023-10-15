<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Student Detail Update</h5>

            <!-- Multi Columns Form -->
            <div class="row g-3">
              <div class="col-md-12">
                <input type="text" class="form-control" id="inputName5" placeholder="Student Name"
                  v-model="studentname" />
              </div>
              <div class="col-md-6">
                <input type="email" class="form-control" id="inputEmail5" placeholder="Email" v-model="studentemail" />
              </div>
              <div class="col-md-6">
                <input type="text" class="form-control" id="studentphone" placeholder="Phone Number"
                  v-model="studentphone" />
              </div>
              <div class="col-12">
                <input type="text" class="form-control" id="inputAddres5s" placeholder="Full Address"
                  v-model="studentaddress" />
              </div>
              <div class="col-md-4">
                <label for="">Date of Birth:</label>
                <input type="date" class="form-control" id="studentdob" placeholder="" v-model="studentdob" />
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" id="nationality" placeholder="Nationality"
                  v-model="nationality" />
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" id="tuitionfee" placeholder="tuition fee" v-model="tuitionfee" />
              </div>
              <div class="col-md-4">
                <label for="inputState" class="form-label">Blood Group</label>
                <select id="inputState" class="form-select" v-model="blood">
                  <option selected="">Choose...</option>
                  <option :value="blood.id" v-for="blood in bloods" :key="blood.id">
                    {{ blood.blood_group }}
                  </option>
                </select>
              </div>
              <div class="col-md-4">
                <label for="inputState" class="form-label">Faculty</label>
                <select id="inputState" class="form-select" v-model="faculty">
                  <option selected="">Choose...</option>
                  <option :value="faculty.id" v-for="faculty in faculties" :key="faculty.id">
                    {{ faculty.faculty_name }}
                  </option>
                </select>
              </div>
              <div class="col-md-4">
                <label for="inputState" class="form-label">Semester / Years</label>
                <select id="inputState" class="form-select" v-model="sem">
                  <option selected="">Choose...</option>
                  <option :value="sem.id" v-for="sem in sems" :key="sem.id">
                    {{ sem.semester_years }}
                  </option>
                </select>
              </div>
              <div class="col-md-4">
                <label for="inputState" class="form-label">Section</label>
                <select id="inputState" class="form-select" v-model="section">
                  <option selected="">Choose...</option>
                  <option :value="section.id" v-for="section in sections" :key="section.id">
                    {{ section.section_name }}
                  </option>
                </select>
              </div>
              <div class="col-md-3">
                <div class="">
                  <label for="gender"> Gender :</label>
                  <div class="form-check mx-3">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="m" checked=""
                      v-model="gender" />
                    <label class="form-check-label" for="gridRadios1">
                      Male
                    </label>
                  </div>
                  <div class="form-check mx-3">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="f"
                      v-model="gender" />
                    <label class="form-check-label" for="gridRadios2">
                      Female
                    </label>
                  </div>
                  <div class="form-check mx-3">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="o"
                      v-model="gender" />
                    <label class="form-check-label" for="gridRadios2">
                      Others
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <label for="image"> Image :</label> <br />
                <div class="d-flex">
                  <input class="form-control" type="file" id="image" @change="changeImg" />
                  <img v-if="img" :src="img" alt="" class="" height="100" />
                  <img v-if="imge" :src="imge" alt="" class="" height="100" />
                </div>
              </div>


              <div class="text-center">
                <button type="reset" @click="addStudents()" class="btn btn-secondary mx-3 float-end">
                  Reset
                </button>
                <button type="submit" class="btn btn-primary float-end" @click="updateStudents()">
                  Save
                </button>
              </div>
            </div>
            <!-- End Multi Columns Form -->
          </div>
        </div>
      </div>
    </div>
  </div>
  {student_edit_data}
</template>
<script>
import router from '../../../../adminrouter';
import store from '../../../../adminstore';

export default {
  data() {
    return {
      bloods: [],
      sems: [],
      faculties: [],
      sections: [],
      studentname: "",
      studentemail: "",
      studentphone: "",
      studentaddress: "",
      studentdob: "",
      nationality: "",
      blood: "",
      faculty: "",
      section: "",
      sem: "",
      gender: "",
      photo: "",
      tuitionfee: "",
      previewImage: "",
      img: '',
      imge: '',
      student_edit_data: ''


    };
  },
  props: ['id'],
  created() {
    // if (!User.loggedIn()) {
    //   router.push("/admin/login")
    // }
    axios.get("/api/students/create", {
      headers: {
        "Content-Type": "application/json",
        Authorization: "Bearer " +store.getters.getAdminToken,
      },
    }).then((res) => {
      console.log(res);
      this.bloods = res.data.blood;
      this.sems = res.data.sem;
      this.faculties = res.data.faculty;
      this.sections = res.data.section;
    }).catch((error) => {
      router.push('/admin/login');
      localStorage.clear()

      toast.fire({
        icon: "error",
        title: error.response.data.message
      })
    })

    axios.get("/api/students/" + this.id + "/edit", {
      headers: {
        "Content-Type": "application/json",
        Authorization: "Bearer " +store.getters.getAdminToken,
      },
    }).then((res) => {
      let student_edit_data = res.data;
      this.studentname = student_edit_data.name,
        this.studentemail = student_edit_data.email,
        this.studentphone = student_edit_data.phone_no,
        this.studentaddress = student_edit_data.address,
        this.studentdob = student_edit_data.DOB,
        this.nationality = student_edit_data.nationality,
        this.blood = student_edit_data.blood_group,
        this.faculty = student_edit_data.faculty_id,
        this.section = student_edit_data.section_id,
        this.sem = student_edit_data.semesters_id,
        this.gender = student_edit_data.gender,
        this.tuitionfee = student_edit_data.tuitionfee,
        this.imge = "/" + student_edit_data.image
        //console.log(res);
    });

  },

  methods: {
    changeImg(event) {
      let file = event.target.files[0];
      let reader = new FileReader();
      reader.onload = event => {
        this.img = event.target.result
      };
      reader.readAsDataURL(file)
      //console.log(event)
    },

    updateStudents() {
      let student = {
        studentname: this.studentname,
        studentemail: this.studentemail,
        studentphone: this.studentphone,
        studentaddress: this.studentaddress,
        studentdob: this.studentdob,
        nationality: this.nationality,
        blood: this.blood,
        faculty: this.faculty,
        section: this.section,
        sem: this.sem,
        gender: this.gender,
        tuitionfee: this.tuitionfee,
        photo: this.img,
        id: this.id
      };
      axios
        .patch("http://127.0.0.1:8000/api/students/" + this.id, student, {
          headers: {
            "Content-Type": "application/json",
            Authorization: "Bearer " +store.getters.getAdminToken,
          },
        })
        .then((Response) => {

          router.push("/admin/guardian/edit/" + Response.data[0]);
          // toast.fire({
          //     icon:"succcess",
          //     title:"record added successfully"
          // })
          console.log(Response);
        });
    },
  },
};
</script>