<template>
  <div class="d-flex select">
    <div class="form-group">
      <label for="id">Course <samp style="color: red">*</samp> :</label><br />
      <select name="course" id="course" v-model="faculty" required>
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
      <select name="semester" id="semester" v-model="semester" required>
        <option value=" ">Select Semester</option>
        <option :value="sem.id" v-for="sem in sems" :key="sem.id">
          {{ sem.semester_years }}
        </option>
      </select>
    </div>
  </div>
  <hr />
</template>
  
<script>
export default {
  name: "class_identify",
  props: {
    value: {
      type: Object,
      default: () => ({}),
    },
  },
  data() {
    return {
      facultys: [],
      sems: [],
      faculty: null,
      semester: "",
    };
  },
  created() {
    // get api data
    axios.get("/api/periods/create").then((res) => {
      // console.log(res);
      this.facultys = res.data.faculty;
      this.sems = res.data.sem;
      // Set default values from the prop value
      this.faculty = this.value.faculty || null;
      this.semester = this.value.semester || "";
    }).catch((error) => {
      router.push('/admin/login');
      localStorage.clear()
      toast.fire({
        icon: "error",
        title: error.response.data.message
      })
    })
  },

  watch: {
    faculty(newValue) {
      this.$emit("input", {
        faculty: newValue,
        semester: this.semester,
      });
    },
    semester(newValue) {
      this.$emit("input", {
        faculty: this.faculty,
        semester: newValue,
      });
    },
  },
};
</script>
  