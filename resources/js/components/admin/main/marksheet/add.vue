<template>
  <h3>Add Marks of students</h3>
  <div class="d-flex select">

    <div class="form-group">
      <label for="id">Course <samp style="color: red">*</samp> :</label><br />
      <select name="course" id="course" v-model="form.faculty" required>
        <option value="null">Choose Faculty</option>
        <option v-for="facultyItem in facultys" :key="facultyItem.id" :value="facultyItem.id">
          {{ facultyItem.faculty_name }}
        </option>
      </select>
    </div>
    <div class="form-group px-4">
      <label for="">
        Select Semester / year <samp style="color: red">*</samp>
      </label>
      <br />
      <select name="semester" id="semester" v-model="form.semester" required>
        <option value=" ">Select Semester</option>
        <option :value="sem.id" v-for="sem in sems" :key="sem.id">
          {{ sem.semester_years }}
        </option>
      </select>
    </div>
    <button class="btn btn-warning" @click="getDatas()">Get Datas</button>

    <div v-if="subjects.length" class="form-group px-4">
      <label for="">
        Subjects <samp style="color: red">*</samp>
      </label>
      <br />
      <select name="subjects" id="subjects" v-model="marks.subject" @change="resetmarks" required>
        <option value=" ">Select Subjects</option>
        <option :value="sem.id" v-for="sem in subjects" :key="sem.id">
          {{ sem.subjects }}
        </option>
      </select>
    </div>

    <div v-if="subjects_filter.length">
  
      <span>fullmarks: {{ subjects_filter[0].fullmarks }}</span> <br>
      <span>passmarks: {{ subjects_filter[0].passmarks }}</span> <br>
      <span>practical_fullmarks: {{ subjects_filter[0].practical_fullmarks }}</span> <br>
      <span>practical_passmarks: {{ subjects_filter[0].practical_passmarks }}</span> <br>
    </div>
  </div>
  <hr />

  <div class="container">
    <table class="table">
      <tr>
        <th>Roll</th>
        <th>Name</th>
        <th>Marks</th>
        <th>Practical</th>
      </tr>
      <tr v-for="(stu, index) in students" :key="index">
        <td>{{ stu.id }}</td>
        <td>{{ stu.name }}</td>
        <td v-if="marks.subject"> <input type="text" v-model="marks.getmarks[index]" required></td>
        <td v-if="marks.subject"> <input type="text" v-model="marks.getPractical[index]" required></td>
      </tr>
      <button v-if="marks.subject" @click="saveMarks()" class="btn btn-success">Save</button>
    </table>
  </div>
</template>
  
<script>
import axios from 'axios';
export default {

  data() {
    return {
      facultys: [],
      sems: [],
      subjects: [],
      students: [],
      form: {
        faculty: null,
        semester: null,
      },
      marks: {
        subject: '',
        exam_type: this.id,
        getmarks: [],
        getPractical: [],
        student_id: []

      },
      subjects_filter:[],
      subj:[],
      fm:null,
      pm:null,
      pt_fm:null,
      pt_pm:null,


    };
  },
  props: ['id'],
  created() {
    // if (!User.loggedIn()) {
    //   router.push("/admin/login")
    // }
    axios.get("/api/periods/create", {
      headers: {
        "Content-Type": "application/json",
        Authorization: "Bearer " + localStorage.getItem("token"),
      },
    }).then((res) => {

      this.facultys = res.data.faculty;
      this.sems = res.data.sem;
    });
    axios.get("/api/getclass/details" + this.id, {
      headers: {
        "Content-Type": "application/json",
        Authorization: "Bearer " + localStorage.getItem("token"),
      },
    }).then((res) => {
      console.log(res);

    });
  },
  methods: {
    resetmarks(e){
      var sub = e.target.value
       this.demo(sub)
      console.log(this.subjects_filter)
    },
    demo(sub){
      this.subjects_filter = this.subjects.filter(subje=>{
       return subje.id == sub
      })
    },

    getDatas() {
      axios.post('/api/get-students-subjects', this.form, {
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
      }).then((res) => {
        this.subjects = res.data.subjects,
          this.students = res.data.students
      }).catch((error) => {
        router.push('/admin/login');
        localStorage.clear()
        toast.fire({
          icon: "error",
          title: error.response.data.message
        })
      })
    },
    saveMarks() {
      this.marks.student_id = this.students
      axios.post('/api/store-marks', this.marks, {
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
      }).then((res) => {
        toast.fire({
          icon: "succcess",
          title: res.data.status
        });
      })
    },

  }


};
</script>
  