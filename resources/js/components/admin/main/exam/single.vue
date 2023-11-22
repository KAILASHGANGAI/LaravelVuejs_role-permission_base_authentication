<template>
    <div class="card p-2">
        <h1 class="card-title d-flex">Exam details

            <div class="form-group w-25">
                <select class="form-control" @change="getquestions" name="course" id="course" v-model="form.subject_id"
                    required>
                    <option value="null">Choose Subjects</option>
                    <option v-for="subject in subjects" :key="subjects.id" :value="subject.id">
                        {{ subject.subjects }}
                    </option>
                </select>
            </div>
        </h1>
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
                        <h4 class="card-title">Questions</h4>
                        <span class="text-success">Total number of Questions: {{ questions.length }}</span>

                        <details type="number" v-for="(que, index) in questions" :key="index">

                            <summary>{{ ++index }}. {{ que.questions }}
                                <span class="  btn btn-info btn-circle btn-sm" @click="Edit(que.id)">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </span>
                                <span class="btn btn-danger btn-circle btn-sm" @click="Delete(que.id)">
                                    <i class="fas fa-trash"></i>
                                </span>
                            </summary>
                            <ol class="">
                                <li class="mx-2">{{ que.option1 }}</li>
                                <li class="mx-2">{{ que.option2 }}</li>
                                <li class="mx-2">{{ que.option3 }}</li>
                                <li class="mx-2">{{ que.option4 }}</li>
                            </ol> <br>
                            <span class="text-success">Ans:{{ que.trueoption }}</span>

                        </details>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import store from '../../../../adminstore';

export default {

    data() {
        return {
            data: '',
            qid: null,
            subjects: [],
            questions: [],
            form: {
                exams_id: this.id,
                subject_id: '',
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

        this.getdata()
    },
    methods: {
        Edit(index) {
            axios.get('/api/questions/' + index + '/edit', {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + store.getters.getAdminToken,
                },
            }).then((res) => {
                this.qid = res.data.id
                this.form = res.data
                
            })
        },
        Delete(index) {
            axios.delete('/api/questions/' + index, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + store.getters.getAdminToken,
                },
            }).then((res) => {
                this.getquestions()
                toast.fire({
                    icon: "success",
                    title: res.data.status
                })
            })

        },
        getdata() {
            axios.get('/api/exams/' + this.id, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + store.getters.getAdminToken,
                },
            }).then((res) => {
                console.log(res)
                this.data = res.data.exam
                this.subjects = res.data.subjects
            }).catch((error) => {
                router.push('/admin/login');
                localStorage.clear()
                toast.fire({
                    icon: "error",
                    title: error.response.data.message
                })
            })
        },
        getquestions() {
            let data = {
                'exam_id': this.id,
                'subject_id': this.form.subject_id
            }
            axios.post('/api/getquestions/', data, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + store.getters.getAdminToken,
                },
            }).then((res) => {
                console.log(res)
                this.questions = res.data

            }).catch((error) => {
                router.push('/admin/login');
                localStorage.clear()
                toast.fire({
                    icon: "error",
                    title: error.response.data.message
                })
            })
        },
        save() {
            if (this.qid !== null) {
                axios.patch('/api/questions/' + this.qid, this.form, {
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + store.getters.getAdminToken,
                    },
                }).then((res) => {
                    this.getquestions()
                    this.form.questions = '';
                    this.form.option1 = '';
                    this.form.option2 = '';
                    this.form.option3 = '';
                    this.form.option4 = '';
                    this.form.trueoption = '';
                    this.qid = null;
                    

                    toast.fire({
                        icon: "success",
                        title: res.data.status
                    })
                }).catch((error) => {
                            console.log(error);
                            toast.fire({
                                icon: "error",
                                title: error.response.data.message,
                            });
                        });
            } else {
                axios.post("/api/questions", this.form, {
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + store.getters.getAdminToken,
                    },
                }).then((res) => {
                    this.form.questions = '';
                    this.form.option1 = '';
                    this.form.option2 = '';
                    this.form.option3 = '';
                    this.form.option4 = '';
                    this.form.trueoption = '';
                    this.getquestions()
                    toast.fire({
                        icon: "success",
                        title: res.data.status
                    })
                })
                    .catch((error) => {
                        console.log(error);
                        toast.fire({
                            icon: "error",
                            title: error.response.data.message,
                        });
                    });
            }
        }
    }
}
</script>

<style scoped>
details>summary {
    list-style-type: '▶️';
}

details[open]>summary {
    list-style-type: '🔽';
}

details {
    border: 1px solid gray;
    border-radius: 0.2rem;
    padding: 0.5rem;
}

details[open]>summary {
    margin-bottom: 0.5rem;
}
</style>