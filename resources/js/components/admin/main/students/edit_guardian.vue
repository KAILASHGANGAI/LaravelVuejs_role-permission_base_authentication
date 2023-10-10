<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Add guardian/Parents Details</h5>

            <!-- Multi Columns Form -->
            <form class="row g-3">
              <div class="col-md-12">
                <input type="text" class="form-control" id="inputName5" placeholder="Name" v-model="name" />
              </div>
              <div class="col-md-6">
                <input type="email" class="form-control" id="inputEmail5" placeholder="Email" v-model="email" />
              </div>
              <div class="col-md-6">
                <input type="text" class="form-control" id="inputEmail5" placeholder="Phone Number" v-model="phone" />
              </div>
              <div class="col-12">
                <input type="text" class="form-control" id="inputAddres5s" placeholder="Address" v-model="address" />
              </div>
              <div class="col-md-6">
                <label for="image"> Image :</label> <br />
                <div class="d-flex">
                  <input class="form-control" ref="fileInput" type="file" @input="pickFile" />
                  <img v-if="previewImage" :src="previewImage" alt="" class="" height="100" />
                  <img v-if="upimg" :src="upimg" alt="" class="" height="100" />
                </div>
              </div>
              <div class="text-center">
                <button type="reset" class="btn btn-secondary mx-3 float-end" @click="update()">
                  Save
                </button>

              </div>
            </form>
            <!-- End Multi Columns Form -->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import router from '../../../../adminrouter';
export default {
  data() {
    return {
      name: "",
      email: "",
      phone: "",
      address: "",
      photo: "",
      previewImage: "",
      upimg: '',
      stdid: '',
      ids: ''
    };
  },
  props: ['id'],
  created() {
    // if (!User.loggedIn()) {
    //   router.push("/admin/login")
    // }
    axios.get("/api/guardian/" + this.id + "/edit", {
      headers: {
        "Content-Type": "application/json",
        Authorization: "Bearer " + localStorage.getItem("token"),
      },
    }).then((res) => {
      let data = res.data;
      this.name = data.name,
        this.email = data.email,
        this.phone = data.phone_no,
        this.address = data.address,
        this.upimg = "/" + data.image
      // console.log(res);
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
    //image upload and preview methods
    selectImage() {
      this.$refs.fileInput.click();
    },
    pickFile() {
      let input = this.$refs.fileInput;
      let file = input.files;
      if (file && file[0]) {
        let reader = new FileReader();
        reader.onload = (e) => {
          this.previewImage = e.target.result;
        };
        reader.readAsDataURL(file[0]);
        this.$emit("input", file[0]);
      }
    },
    update() {
      let Parents = {
        name: this.name,
        email: this.email,
        phone: this.phone,
        address: this.address,
        photo: this.previewImage,
        id: this.id
      };
      axios.patch("/api/guardian/" + this.id, Parents, {
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
      }).then((Response) => {
        router.push("/admin/students");
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