<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Add Students Details</h5>
            <!-- Multi Columns Form -->

            <div class="row g-3">
              <div class="col-md-12">
                <input type="text" class="form-control" id="inputName5" placeholder="Student Name"
                  v-model="studentname" />
                <small v-if="errors.studentname" class="text-danger">{{ errors.name[0] }}</small>
              </div>
              <div class="col-md-6">
                <input type="email" class="form-control" id="inputEmail5" placeholder="Email" v-model="email" />

                <small v-if="errors.email" class="text-danger">{{ errors.email[0] }}</small>
              </div>
              <div class="col-md-6">
                <input type="text" class="form-control" id="phone" placeholder="Phone Number" v-model="phone" />
                <small v-if="errors.phone" class="text-danger">{{ errors.phone[0] }}</small>

              </div>
              <div class="col-12">
                <input type="text" class="form-control" id="inputAddres5s" placeholder="Full Address" v-model="address" />
                <small v-if="errors.address" class="text-danger">{{ errors.address[0] }}</small>

              </div>
              <div class="col-md-4">
                <label for="">Date of Birth:</label>
                <input type="date" class="form-control" id="studentdob" placeholder="" v-model="studentdob" />
                <small v-if="errors.studentdob" class="text-danger">{{ errors.studentdob[0] }}</small>

              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" id="nationality" placeholder="Nationality"
                  v-model="nationality" />
                <small v-if="errors.nationality" class="text-danger">{{ errors.nationality[0] }}</small>

              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" id="tuitionfee" placeholder="tuition fee" v-model="tuitionfee" />
                <small v-if="errors.tuitionfee" class="text-danger">{{ errors.tuitionfee[0] }}</small>

              </div>
              <div class="col-md-4">
                <label for="inputState" class="form-label">Blood Group</label>
                <select id="inputState" class="form-select" v-model="blood">
                  <option selected="">Choose...</option>
                  <option :value="blood.id" v-for="blood in bloods" :key="blood.id">
                    {{ blood.blood_group }}
                  </option>
                </select>
                <small v-if="errors.blood" class="text-danger">{{ errors.blood[0] }}</small>

              </div>
              <div class="col-md-4">
                <label for="inputState" class="form-label">Faculty</label>
                <select id="inputState" class="form-select" v-model="faculty">
                  <option selected="">Choose...</option>
                  <option :value="faculty.id" v-for="faculty in faculties" :key="faculty.id">
                    {{ faculty.faculty_name }}
                  </option>
                </select>
                <small v-if="errors.faculty" class="text-danger">{{ errors.faculty[0] }}</small>

              </div>
              <div class="col-md-4">
                <label for="inputState" class="form-label">Semester / Years</label>
                <select id="inputState" class="form-select" v-model="sem">
                  <option selected="">Choose...</option>
                  <option :value="sem.id" v-for="sem in sems" :key="sem.id">
                    {{ sem.semester_years }}
                  </option>
                </select>
                <small v-if="errors.sem" class="text-danger">{{ errors.sem[0] }}</small>

              </div>
              <div class="col-md-4">
                <label for="inputState" class="form-label">Section</label>
                <select id="inputState" class="form-select" v-model="section">
                  <option selected="">Choose...</option>
                  <option :value="section.id" v-for="section in sections" :key="section.id">
                    {{ section.section_name }}
                  </option>
                </select>
                <small v-if="errors.section" class="text-danger">{{ errors.section[0] }}</small>

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
                  <small v-if="errors.gender" class="text-danger">{{ errors.gender[0] }}</small>

                </div>
              </div>

              <input type="file" name="image" id="image" @change="changeImg">

              <div class="text-center">
                <button type="submit" class="btn btn-primary float-end" @click="addStudents()">
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
      email: "",
      phone: "",
      address: "",
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

      errors: {}

    };
  },
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

  },

  methods: {
    changeImg(event) {
      let file = event.target.files[0];
      let reader = new FileReader();
      reader.onload = event => {
        this.img = event.target.result
      };
      reader.readAsDataURL(file)
      console.log(event)
    },

    addStudents() {
      let student = {
        studentname: this.studentname,
        email: this.email,
        phone: this.phone,
        address: this.address,
        studentdob: this.studentdob,
        nationality: this.nationality,
        blood: this.blood,
        faculty: this.faculty,
        section: this.section,
        sem: this.sem,
        gender: this.gender,
        tuitionfee: this.tuitionfee,
        photo: this.img,
      };
      axios.post("/api/students", student, {
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " +store.getters.getAdminToken,
        },
      })
        .then((Response) => {

          toast.fire({
            icon: "succcess",
            title: "Student added successfully"
          })
          router.push("/admin/add_guardian");
          console.log(Response);
        }).catch((error) => (this.errors = error.response.data.errors))
    },
  },
};
</script>