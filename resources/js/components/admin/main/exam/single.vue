<template>
    <div class="card p-2">
        <h1 class="card-title">Exam details</h1>
        <div class="d-flex justify-content-between">
           
            <div class="">
                <span> Faculty:{{ data.faculty.faculty_name }}</span> <br>
                <span> Semester/Yrs :{{ data.semester.semester_years }}</span> <br>
            </div>
            <div>
                <span>Section :{{ data.section.section_name }}</span> <br>
                <span>Exam Type : {{ data.exam_type }}</span> <br>
            </div>
            <div>
               
                <span>Date :{{ data.date }}</span> <br>
                <span>Time: {{ data.time }}</span> <br>
            </div>
           
          
        </div>
        <hr>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 ">
                    <form @submit.prevent="save">
                        <div class="row shadow p-2">
                            <p class="text-center">PLease add a question with options and correct answer !!</p>

                            <div class="form-group col-sm-12">
                                <label for="">Question</label>
                                <input type="text" class="form-control" v-model="form.questions" id="" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Option1</label>
                                <input type="text" class="form-control" v-model="form.option1" id="">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Option2</label>
                                <input type="text" class="form-control" v-model="form.option2" id="">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Option3</label>
                                <input type="text" class="form-control" v-model="form.option3" id="">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Option4</label>
                                <input type="text" class="form-control" v-model="form.option4" id="">
                            </div>
                            <div class="form-group">
                                <label for="">Trueoption</label>
                                <input type="text" class="form-control" v-model="form.trueoption" id="">
                            </div>
                            <button class="btn btn-success mt-3" type="submit">Save</button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-6">
                    <div class="shadow p-2">
                        <h1 class="card-title">Questions</h1>
                        <details v-for="(que, index) in data.ques" :key="index">
                            <span>{{+ + index }}</span>
                            <summary>{{ que.questions }}</summary>
                            <ol>
                                <li>{{ que.option1 }}</li>
                                <li>{{ que.option2 }}</li>
                                <li>{{ que.option3 }}</li>
                                <li>{{ que.option4 }}</li>
                                <span class="text-success">Ans:{{ que.trueoption }}</span>


                            </ol>
                        </details>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import store from '../../../../adminstore';

export default {

    data() {
        return {
            data: '',

            form: {
                exams_id: this.id,
                questions: '',
                option1: '',
                option2: '',
                option3: '',
                option4: '',
                trueoption: '',
            }
        }
    },
    props: ['id'],
    created() {
        // if (!User.loggedIn()) {
        //     router.push("/admin/login")
        // }
        axios.get('/api/exams/' + this.id, {
            headers: {
                "Content-Type": "application/json",
                Authorization: "Bearer " + store.getters.getAdminToken,
            },
        }).then((res) => {
            console.log(res)
            this.data = res.data
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
        save() {
            // axios.post("/api/questions", this.form,  {
            // headers: {
            //     "Content-Type": "application/json",
            //     Authorization: "Bearer " + store.getters.getAdminToken,
            // },
            //   }).then((res) => {
            //     console.log(res)
            // })
        }
    }
}
</script>
