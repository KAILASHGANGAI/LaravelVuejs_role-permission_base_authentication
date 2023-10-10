<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        <h3>classes</h3>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#class">
          Class / semesters / years
        </button>
        <!-- The Modal -->
        <div class="modal" id="class">
          <div class="modal-dialog">
            <div class="modal-content">
              <!-- Modal Header -->

              <div class="modal-header">
                <h4 class="modal-title">Add classes </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <div class="container">
                  <form method="post" @submit.prevent="saveClass()">
                    <div class="forms my-1" v-for="index in counts" :key="index">
                      {{ index }} <input type="text" v-model="form.classes[index]" id="" />
                    </div>
                    <span class="btn btn-success " @click="count()">
                      +
                    </span>
                    <span class="btn btn-danger " @click="decrease()">
                      -
                    </span>
                    <input type="submit" class="btn btn-success" value="save" data-bs-dismiss="modal">
                  </form>
                </div>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                  Close
                </button>
              </div>
            </div>
          </div>
        </div>
        <ol>
          <li v-for="(data, index) in cdata" :key="index">{{ data.semester_years }} <span @click="deleteclass(data.id)"><i
                class="bi bi-x-lg"></i></span></li>
        </ol>
      </div>
      <div class="col-sm-3">
        <h3>sections</h3>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sections">
          Sections
        </button>
        <!-- The Modal -->
        <div class="modal" id="sections">
          <div class="modal-dialog">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Add Sections</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <div class="container">
                  <form method="post" @submit.prevent="saveSection()">
                   
                    <span class="btn btn-success " @click="count()">
                      +
                    </span>
                    <span class="btn btn-danger " @click="decrease()">
                      -
                    </span>
                    <input type="submit" class="btn btn-success" data-bs-dismiss="modal" value="save">
                    <div class="forms my-1" v-for="index in counts" :key="index">
                      {{ index }} <input type="text" v-model="form.sections[index]" id="" />
                    </div>
                  </form>
                </div>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                  Close
                </button>
              </div>
            </div>
          </div>
        </div>
        <ol>
          <li v-for="(data, index) in sdata" :key="index">{{ data.section_name }} <span @click="deletesection(data.id)"><i
                class="bi bi-x-lg"></i></span></li>
        </ol>
      </div>
      <div class="col-sm-3">
        <h3>faculty</h3>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#faculty">
          faculty / cources
        </button>
        <!-- The Modal -->
        <div class="modal" id="faculty">
          <div class="modal-dialog">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Add faculty</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <div class="container">
                  <form method="post" @submit.prevent="saveFaculty()">
                    

                    <span class="btn btn-success " @click="count()">
                      +
                    </span>
                    <span class="btn btn-danger " @click="decrease()">
                      -
                    </span>
                    <input type="submit" class="btn btn-success" value="save" data-bs-dismiss="modal">
                    <div class="forms my-1" v-for="index in counts" :key="index">
                      {{ index }} <input type="text" v-model="form.faculties[index]" id="" />
                    </div>
                  </form>
                </div>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                  Close
                </button>
              </div>
            </div>
          </div>
        </div>
        <ol>
          <li v-for="(data, index) in fdata" :key="index">{{ data.faculty_name }} <span @click="deletefaculty(data.id)"><i
                class="bi bi-x-lg"></i></span></li>
        </ol>
      </div>
      <div class="col-sm-3">
        <h3>Blood</h3>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Blood">
          Blood
        </button>
        <!-- The Modal -->
        <div class="modal" id="Blood">
          <div class="modal-dialog">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Add Blood</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <div class="container">
                  <form method="post" @submit.prevent="saveBlood()">

                    <span class="btn btn-success " @click="count()">
                      +
                    </span>
                    <span class="btn btn-danger " @click="decrease()">
                      -
                    </span>
                    <input type="submit" class="btn btn-success" value="save" data-bs-dismiss="modal">
                    <div class="forms my-1" v-for="index in counts" :key="index">
                      {{ index }} <input type="text" v-model="form.bloods[index]" id="" />
                    </div>
                  </form>
                </div>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                  Close
                </button>
              </div>
            </div>
          </div>
        </div>
        <ol>
          <li v-for="(data, index) in bdata" :key="index">{{ data.blood_group }} <span @click="deleteblood(data.id)"><i
                class="bi bi-x-lg"></i></span></li>
        </ol>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios';
import router from '../../../../adminrouter';

export default {
  data() {
    return {
      form: {
        classes: [],
        sections: [],
        faculties: [],
        bloods: [],
      },
      counts: 0,
      fdata: null,
      cdata: null,
      sdata: null,
      bdata: null
    };
  },
  created() {
    // if (!User.loggedIn()) {
    //   router.push("/admin/login")
    // }
    this.getclass(),
      this.getfaculty(),
      this.getsection(),
      this.getbloods()


  },
  methods: {
    getclass() {
      axios.get('/api/classes', {
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
      }).then((res) => {
        this.cdata = res.data
      }).catch((error) => {
      router.push('/admin/login');

      toast.fire({
        icon: "error",
        title: error.response.data.message
      })
    })
    },
    getsection() {
      axios.get('/api/sections', {
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
      }).then((res) => {
        this.sdata = res.data
      }).catch((error) => {
      router.push('/admin/login');
      localStorage.clear()

      toast.fire({
        icon: "error",
        title: error.response.data.message
      })
    })
    },
    getfaculty() {
      axios.get('/api/faculties', {
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
      }).then((res) => {
        this.fdata = res.data
      })
    },
    getbloods() {
      axios.get('/api/bloods', {
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
      }).then((res) => {
        this.bdata = res.data
      })
    },
    count() {
      this.counts++;
    },
    decrease() {
      if (this.counts > 1) {
        this.counts--;

      }
    },
    saveClass() {
      this.form.sections = null;
      this.form.faculties = null;
      axios.post('/api/classes', this.form, {
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
      }).then((res) => {
        this.getclass()

        toast.fire({
          icon: "succcess",
          title: res.data.status
        })
        this.form.classes = null;
        router.push('/admin/settings')

      })
    },
    saveSection() {
      this.form.classes = null;
      this.form.faculties = null;
      axios.post('/api/sections', this.form, {
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
      }).then((res) => {
        toast.fire({
          icon: "succcess",
          title: res.data.status
        })
        this.getsection()
        this.form.sections = null;


      })
    },
    saveFaculty() {
      this.form.sections = null;
      this.form.classes = null;
      axios.post('/api/faculties', this.form, {
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
      }).then((res) => {
        this.getfaculty()
        toast.fire({
          icon: "succcess",
          title: res.data.status
        })
        this.form.faculties = null;
        router.push('/admin/settings')

      })
    },
    saveBlood() {
      this.form.sections = null;
      this.form.classes = null;
      axios.post('/api/bloods', this.form, {
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
      }).then((res) => {
        this.getbloods()
        toast.fire({
          icon: "succcess",
          title: res.data.status
        })
        this.form.bloods = null;
        router.push('/admin/settings')

      })
    },
    deleteclass(index) {
      axios.delete('/api/classes/' + index, {
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
      }).then((res) => {
        this.cdata = this.cdata.filter(cdata => {
          return cdata.id != index
        })
      })

    },
    deletesection(index) {
      axios.delete('/api/sections/' + index, {
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
      }).then((res) => {
        this.sdata = this.sdata.filter(sdata => {
          return sdata.id != index
        })
      })

    },
    deletefaculty(index) {
      axios.delete('/api/faculties/' + index, {
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
      }).then((res) => {
        this.fdata = this.fdata.filter(fdata => {
          return fdata.id != index
        })
      })

    },
    deleteblood(index) {
      axios.delete('/api/bloods/' + index, {
        headers: {
          "Content-Type": "application/json",
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
      }).then((res) => {
        this.bdata = this.bdata.filter(bdata => {
          return bdata.id != index
        })
      })

    },
  },
};
</script>
