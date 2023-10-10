<template>
  <div class="">
    <h5>Class Sheduling</h5>

    <div class="d-flex select">
      <div class="form-group">
        <label for="id">Course <samp style="color: red">*</samp> :</label><br />
        <select name="course" id="course" v-model="faculty" required>
          <option value="null">Choose Faculty</option>
          <option v-for="faculty in facultys" :key="faculty.id" :value="faculty.faculty_name">{{ faculty.faculty_name }}
          </option>

        </select>
      </div>
      <div class="form-group px-4">
        <label for="">
          Select Semester / year <samp style="color: red">*</samp>
        </label>
        <br />
        <select name="semester" v-model="semester" required>
          <option value=" ">Select Semester</option>
          <option :value="sem.semester_years" v-for="sem in sems" :key="sem.id">{{ sem.semester_years }}</option>
        </select>
      </div>
      <div class="form-group">
        <label for="id">Section <samp style="color: red">*</samp> :</label><br>
        <select v-model="section">

          <option value=" ">--section--</option>

          <option :value="section.section_name" v-for="section in sections" :key="section.id">{{ section.section_name }}
          </option>

        </select>
      </div>
      <div>
        <button class="float-right mx-5 px-5 my-3 btn-success" type="submit" @click="save()">
          save
        </button>
      </div>
    </div>
    <hr>
    <div class="container-fluid ">

      <div v-for="index in counts" :key="index" class="row">
        {{ index }}
        <div class="col-md-3">
          <label for="">Teacher</label>
          <input type="text" name="teacher" id="" required v-model="teachers[index]" />
        </div>
        <div class="col-md-3">
          <label for="">Subject</label>
          <input type="text" name="teacher" id="" required v-model="subjects[index]" />
        </div>
        <div class="col-md-2">
          <label for="Starting Time">Start Time</label>
          <input type="time" name="" id="" required v-model="starttimes[index]" />
        </div>
        <div class="col-md-2">
          <label for="Starting Time">End Time</label>
          <input type="time" name="" id="" required v-model="endtimes[index]" />
        </div>
      </div>
    </div>
    <button class="btn btn-success my-3" @click="count()">+</button>
    <button class="btn btn-danger my-3" @click="decrease()">-</button>
  </div>
</template>
<script>
import router from '../../../../adminrouter';
export default {

  data() {
    return {
      facultys: [],
      sems: [],
      sections: [],
      period_no: '',

      teachers: [],
      subjects: [],
      starttimes: [],
      endtimes: [],
      faculty: '',
      semester: '',
      section: '',
      counts: '',
    };

  },
  created() {
    // if (!User.loggedIn()) {
    //   router.push("/admin/login")
    // }
    //get api data
    axios.get("/api/periods/create", {
      headers: {
        "Content-Type": "application/json",
        Authorization: "Bearer " + localStorage.getItem("token"),
      },
    }).then((res) => {
      console.log(res);
      this.facultys = res.data.faculty,
        this.sems = res.data.sem,
        this.sections = res.data.section

    }).catch((error) => {
      router.push('/admin/login');
      toast.fire({
        icon: "error",
        title: error.response.data.message
      })
    })
  },
  methods: {
    count() {
      this.counts++;

    },
    decrease() {
      this.counts--;

    },
    save() {
      let period = {
        faculty: this.faculty,
        semester: this.semester,
        section: this.section,
        period_no: this.counts,
        teacher: this.teachers.toString(),
        subject: this.subjects.toString(),
        starttime: this.starttimes.toString(),
        endtime: this.endtimes.toString()

      }

      axios.post('/api/periods', period, {
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
      }).then((res) => {
        router.push("/admin/period-details");
      }).catch((error) => {
      router.push('/admin/login');
      localStorage.clear()
      toast.fire({
        icon: "error",
        title: error.response.data.message
      })
    })
    }
  },
};
</script>
<style scoped>
table,
th,
tr,
td {
  text-align: center;
  border: 1px solid blue;
}

input[type="text"] {
  width: 100%;
  height: 20px;
  color: red;
}

input[type="time"] {
  width: 100%;
  height: 20px;
  color: blue;
}
</style>