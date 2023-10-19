<template>
    <h3>Marks Lasere of students</h3>


    <button v-print="'#printMe'">Print local range</button>

    <div class="container" id="printMe">
        <div class="text-center">
            <h5 class="text-center">{{ exam.exam_type }}</h5>
            <span>Faculty: {{ exam.faculty.faculty_name }}</span> <br>
            <span>semester: {{ exam.semester.semester_years }}</span>
        </div>
        <table class="table border text-center w-100">
            <tr>
                <th>S.N</th>
                <th>Students Name</th>
                <th v-for="(sub, index) in subjects_data" :key="index">
                    {{ sub.subjects }}
                </th>
                <th>Total</th>
                <th>G.P.A</th>
                <th>Grade</th>
                <th>Remarks</th>
                <th>Ranks</th>


            </tr>
            <tr v-for="(data, index) in datas" :key="index">
                <td>{{ ++index }}</td>
                <td>{{ data.name }}</td>

                <td v-for="(obtain, inx) in data.marks" :key="inx">
                    <span v-if="obtain.marks >= obtain.subject.passmarks">
                        {{ obtain.marks }} + {{ obtain.practical }}
                    </span>
                    <span  v-else> {{ obtain.marks }} + {{ obtain.practical }}</span>
                </td>
                <td>{{ totalMarks(--index) }}</td>
                <td>{{ getGpa(index) }}</td>
                <td>{{ getgrade(index) }}</td>
                <td>{{ remarks(index) }}</td>
                <td>{{ rank(data.id) }}</td>

            </tr>


        </table>
    </div>
</template>

<script>
import axios from "axios";
// import PrintJS from 'print-js';
import store from '../../../../adminstore';

export default {
    data() {
        return {
            datas: [],
            subjects_data: [],
            exam: [],
            marks_arra: [],
            ranksget: []
        };
    },
    props: ["id"],
    created() {
        // if (!User.loggedIn()) {
        //     router.push("/admin/login")
        // }
        this.getDatas();
    },

    methods: {
        printMe() {
            // const print = printJS({
            //     printable: 'myDiv',
            //     type: 'html',
            //     landscape: true,
            //     doubleSided: false,
            //     targetStyles: ['*'],
            //     fitContentWidth: false,
            // });
            // print.font_size = '5px';
            // print.print()
        },
        rank(id) {
            return this.ranksget.find(
                (data) => data.student_id === id
            ).rank;

        },
        totalMarks(index) {
            let sum = 0;
            this.datas[index].marks.forEach((mark) => {
                sum = sum + mark.marks + mark.practical;
            });
            this.marks_arra.push(sum)


            return sum;
        },
        getGpa(e) {
            let sum = 0;
            let total = 0;
            this.datas[e].marks.forEach((mark) => {
                sum = sum + mark.marks;
                total = total + mark.subject.fullmarks

            });
            let percerntage = sum / total * 100;
            let gpa = percerntage.toFixed(2) / 25
            return gpa.toFixed(2);

        },
        getgrade(e) {
            let gpa = this.getGpa(e);
            if (gpa <= 4 && gpa > 3.6) {
                return "A+";
            } else if (gpa <= 3.6 && gpa > 3.2) {
                return "A";

            } else if (gpa <= 3.2 && gpa > 2.8) {
                return "B+";

            } else if (gpa <= 2.8 && gpa > 2.4) {
                return "B";

            } else if (gpa <= 2.4 && gpa > 2.0) {
                return "C+"
            } else if (gpa <= 2.0 && gpa > 1.6) {
                return "C"
            } else if (gpa <= 1.6 && gpa > 1.4) {
                return "D+"
            } else if (gpa <= 1.4 && gpa > 0) {
                return "NG"
            } else {
                return "Not qualified"
            }


        },
        remarks(e) {
            var grade = this.getgrade(e);
            console.log(grade)
            if (grade === 'A+') {
                return "Outstanding";
            } else if (grade === 'A') {
                return "Excellent";

            } else if (grade === 'B+') {
                return "Very Good";

            } else if (grade === 'B') {
                return "Good";

            } else if (grade === 'C+') {
                return "Satisfactory"
            } else if (grade === 'C') {
                return "Acceptable"
            } else if (grade === 'D+') {
                return "Basic"
            } else if (grade === 'NG') {
                return "Not Grade"
            } else {
                return "Not Qualified"
            }
        },
        getDatas() {
            axios.get("/api/get-marks-lasers/" + this.id, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + store.getters.getAdminToken,
                },
            }).then((res) => {
                this.datas = res.data.data;
                this.subjects_data = res.data.subjects;
                this.exam = res.data.exam;
                this.ranksget = res.data.ranks
            }).catch((error) => {
                router.push('/admin/login');
                localStorage.clear()
                toast.fire({
                    icon: "error",
                    title: error.response.data.message
                })
            })
        },
    },
};
</script>
<style scoped>
.table,
tr,
th,
td {
   
    padding: 2px;
}
</style>
