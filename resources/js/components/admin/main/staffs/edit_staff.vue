<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Update Staff Details</h5>

            <!-- Multi Columns Form -->
            <div class="row g-3">
              <div class="col-md-12">
                <input type="text" class="form-control" id="inputName5" placeholder=" Name" v-model="name" />
              </div>
              <div class="col-md-6">
                <input type="email" class="form-control" id="inputEmail5" placeholder="Email" v-model="email" />
              </div>
              <div class="col-md-6">
                <input type="text" class="form-control" id="inputPassword5" placeholder="Phone Number" v-model="phone" />
              </div>
              <div class="col-12">
                <input type="text" class="form-control" id="inputAddres5s" placeholder="Full Address" v-model="address" />
              </div>

              <div class="col-md-4">
                <input type="text" class="form-control" id="experience" placeholder="Experience" v-model="experience" />
              </div>
              <div class="col-md-4">
                <input type="number" class="form-control" id="salary" placeholder="Salary" v-model="salary" />
              </div>
              <div class="col-md-4">
                <label for="">Date of Birth:</label>
                <input type="date" class="form-control" id="dob" placeholder="Date of birth" v-model="dob" />
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
                <label for="inputState" class="form-label">Staff Category</label>
                <select id="inputState" class="form-select" v-model="category">
                  <option selected="">Choose...</option>
                  <option :value="catagory.id" v-for="catagory in categories" :key="catagory.id">
                    {{ catagory.category_name }}
                  </option>
                </select>
                {{}}
              </div>
              <div class="col-md-3">
                <div class="">
                  <label for="gender"> Gender :</label>
                  <div class="form-check mx-3">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="m"
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
                <input type="file" name="image" id="image" @change="changeImg" />
                <img v-if="see_img" :src="see_img" alt="" srcset="" height="100" />
              </div>

              <div class="col-md-4">
                <label for="image"> Education :</label> <br />
                <input type="file" name="image" id="" @change="EducationImg" multiple />

                <img v-if="education_imgs" :src="education_img" alt="" srcset="" height="100" />
              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-secondary mx-3 float-end" @click="saveData()">
                  save
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
      categories: [],
      name: "",
      address: "",
      phone: "",
      email: "",
      dob: "",
      salary: "",
      experience: "",
      gender: "",
      blood: "",
      category: "",
      education: "",
      img: "",
      eduImages: [],
      ids: '',
      education_imgs: '',
      see_img: ''

    };
  },
  props: ['id'],
  created() {
    // if (!User.loggedIn()) {
    //   router.push("/admin/login")
    // }
    axios.get("/api/staffs/create", {
      headers: {
        "Content-Type": "application/json",
        Authorization: "Bearer " +store.getters.getAdminToken,
      },
    }).then((res) => {
      //console.log(res);
      this.bloods = res.data.blood;
      this.categories = res.data.category;
    }).catch((error) => {
      router.push('/admin/login');
      localStorage.clear()

      toast.fire({
        icon: "error",
        title: error.response.data.message
      })
    })
    axios.get("/api/staffs/" + this.id + "/edit", {
      headers: {
        "Content-Type": "application/json",
        Authorization: "Bearer " +store.getters.getAdminToken,
      },
    }).then((res) => {

      let staffs = res.data;

      this.name = staffs.name,
        this.address = staffs.address,
        this.phone = staffs.contact,
        this.email = staffs.email,
        this.dob = staffs.dob,
        this.salary = staffs.salary,
        this.experience = staffs.experience,
        this.gender = staffs.gender,
        this.blood = staffs.bloodgroup,
        this.category = staffs.staff_category,
        this.education_imgs = staffs.education,
        this.see_img = "/" + staffs.images
      //   this.categories = res.data.category;
    });
  },
  methods: {
    changeImg(event) {
      let file = event.target.files[0];
      let reader = new FileReader();
      reader.onload = (event) => {
        this.img = event.target.result;
      };
      reader.readAsDataURL(file);
      console.log(file);
    },
    EducationImg(e) {
      this.eduImages = [];
      let fileList = Array.prototype.slice.call(e.target.files)
      fileList.forEach(f => {
        let reader = new FileReader();
        let that = this;

        reader.onload = function (e) {
          that.eduImages.push(e.target.result);
        }
        reader.readAsDataURL(f);

      });
    },

    saveData() {
      let data = {
        name: this.name,
        address: this.address,
        phone: this.phone,
        email: this.email,
        dob: this.dob,
        salary: this.salary,
        experience: this.experience,
        gender: this.gender,
        blood: this.blood,
        category: this.category,
        education: this.eduImages,
        images: this.img
      };
      axios.patch("http://127.0.0.1:8000/api/staffs/" + this.id, data, {
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " +store.getters.getAdminToken,
        },
      }).then((Response) => {
        router.push("/admin/staff-details");
        // toast.fire({
        //     icon:"succcess",
        //     title:"product added successfully"
        // })
        console.log(Response);
      });
    },
  },
};
</script>
