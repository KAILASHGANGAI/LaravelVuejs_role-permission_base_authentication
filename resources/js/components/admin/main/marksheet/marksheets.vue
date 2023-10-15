<template>
    <!-- <h3>Marks Sheets of students</h3>
    <h5 class="text-center">{{ exam.exam_type }}</h5>
    <span>Faculty: {{ exam.faculty.faculty_name }}</span> <br>
    <span>semester: {{ exam.semester.semester_years }}</span>
    <button @click="printSelectedDiv">Print</button> -->

    <div class="container-fluid">
        <div class="row" id="myDiv">
            
            <div class=" col-6 bg-white fw-bold " v-if="datas.length" v-for="(data, index) in datas" :key="index">
                <div class="m-2 py-2" style="border:2px solid black">

                    <div class="text-center">
                        <span class="card-title m-0" style="font-size:14px;">
                            ALLIANCE FOR INNOVATIVE MANAGEMENT
                        </span> <br>
                        <span class="text-center" style="font-size: 13px;">Biratnagar-9, morang, Nepal 021-577060</span>
                        <br>
                        <div style="font-size: 12px;">
                            <span>GRADESHEET</span> <br>
                            <span> {{ exam.exam_type }}</span>
                        </div>
                    </div>

                    <div class=" text-left px-4" style="font-size: 13px;">
                        <p>Students Name : Mr./Ms. <b> {{ data.name }} </b> <br>
                        <div class="flex justify-content-between">
                            <span>
                                Class : <b>{{ exam.faculty.faculty_name }}</b>
                            </span>
                            <span class="ml-auto">
                                Roll No. : <b>{{ data.id }}</b>
                            </span>
                        </div>
                        </p>
                    </div>

                    <div class=" ">

                        <table class="table w-100" style="border-bottom: none; font-size: 13px;">
                            <colgroup>
                                <col span="1">
                                <col span="1">
                                <col span="1">
                            </colgroup>
                            <tr>
                                <td rowspan="2">S.N</td>
                                <th rowspan="2">Subject</th>
                                <th rowspan="2">CREDIT HOURS</th>
                                <th class="split-column" colspan="2">OBTAIBED GRADE</th>
                                <th rowspan="2">G.P.A</th>
                                <th rowspan="2">GRADE</th>

                            </tr>
                            <tr style="font-weight: bold;">
                                <td class="split-column">TH</td>
                                <td class="split-column">PT</td>
                            </tr>
                            <tr v-for="(obtain, inx) in data.marks" :key="inx">
                                <td>{{ ++inx }}</td>
                                <td>{{ obtain.subject.subjects }}</td>
                                <td>{{ obtain.subject.creadit_hrs }}</td>
                                <td>{{ getSubjectGrade(obtain.marks, obtain.subject.fullmarks) }}</td>
                                <td v-if="obtain.practical">{{ getSubjectGrade(obtain.practical,
                                    obtain.subject.practical_fullmarks) }}</td>
                                <td v-else>-</td>
                                <td>{{ ((getSubjectGpa(obtain.marks, obtain.subject.fullmarks) +
                                    getSubjectGpa(obtain.practical, obtain.subject.practical_fullmarks)) / 2).toFixed(2) }}
                                </td>
                                <td>{{ getSubjectGrade(obtain.marks, obtain.subject.fullmarks, obtain.practical,
                                    obtain.subject.practical_fullmarks) }}</td>

                            </tr>
                            <tr>
                                <td colspan="5">Total GPA </td>
                                <td colspan="2">{{ totalGpa(index) }}</td>
                            </tr>
                            <tr>
                                <td colspan="5">Total Grade </td>
                                <td colspan="2">{{ totalgrade(index) }}</td>
                            </tr>
                            <tr>
                                <td colspan="5">Rank </td>
                                <td colspan="2">{{ rank(data.id) }}</td>
                            </tr>
                            <tr>
                                <td colspan="5">Remarks </td>
                                <td colspan="2">{{ remarks(index) }}</td>
                            </tr>
                            <tr class="small-table " style="border-bottom: none;">
                                <td colspan="7" class="p-4">
                                    <table class="w-100 border-start-0">
                                        <tr>
                                            <th>Grade</th>
                                            <th>Performance</th>
                                            <th>Grade Point</th>
                                        </tr>
                                        <tr>
                                            <td>A+</td>
                                            <td>OutStanding</td>
                                            <td>4.0 - 3.6</td>
                                        </tr>
                                        <tr>
                                            <td>A</td>
                                            <td>Excellent</td>
                                            <td>3.6 - 3.2</td>
                                        </tr>
                                        <tr>
                                            <td>B+</td>
                                            <td>Very Good</td>
                                            <td>3.2 - 2.8</td>
                                        </tr>
                                        <tr>
                                            <td>B</td>
                                            <td>Good</td>
                                            <td> 2.8 - 2.4</td>
                                        </tr>
                                        <tr>
                                            <td>C+</td>
                                            <td>Satisfactory</td>
                                            <td>2.4 - 2.0 </td>
                                        </tr>
                                        <tr>
                                            <td>C</td>
                                            <td>Acceptable</td>
                                            <td>2.0 - 1.6 </td>
                                        </tr>
                                        <tr>
                                            <td>D+</td>
                                            <td>Basic</td>
                                            <td>1.6 - 1.4 </td>
                                        </tr>
                                        <tr>
                                            <td>NG</td>
                                            <td>Not Grade</td>
                                            <td>1.4 - 0 </td>
                                        </tr>
                                        <tr>
                                            <td>NQ</td>
                                            <td>Not qualified </td>
                                            <td> - </td>
                                        </tr>
                                    </table>
                                </td>

                            </tr>

                        </table>
                        <div class=" d-flex w-100 px-4 text-center mt-4"
                            style="justify-content:  space-between; font-size: small;">
                            <div> {{ new Date().toLocaleDateString() }} <br> <span
                                    style="border-top: 1px solid black; width: 100%;">Date</span> </div>
                            <div class="mx-3" style="border-top: 1px solid black;  ">Parents <br> Signature</div>
                            <div class="mx-3" style="border-top: 1px solid black;  ">Class Teacher </div>
                            <div class="mx-3" style="border-top: 1px solid black;  "> Principal <br> Signature</div>
                        </div>
                    </div>
                </div>
            </div>
            <h1 v-else>No Marks Provided</h1>
        </div>
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
            ranksget: [],

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
        getSubjectGpa(marks, full) {
            return ((marks / full) * 100) / 25
        },
        getSubjectGrade(marks, full, pt_marks, pt_full) {
            let gpa_th = this.getSubjectGpa(marks, full);
            let gpa_pt = this.getSubjectGpa(pt_marks, pt_full);
            let gpa
            if (pt_marks) {
                gpa = (gpa_th + gpa_pt) / 2

            } else {
                gpa = gpa_th
            }
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
                return "NQ"
            }
        },
        totalMarks(index) {
            let sum = 0;
            this.datas[index].marks.forEach((mark) => {
                sum = sum + mark.marks;
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
        totalGpa(e) {

            let total_obtained = 0;
            let total = 0;
            this.datas[e].marks.forEach((mark) => {

                total_obtained = total_obtained + mark.marks + mark.practical
                total = total + mark.subject.fullmarks + mark.subject.practical_fullmarks

            });


            let gpa = ((total_obtained / total) * 100) / 25
            return gpa.toFixed(3);

        },
        totalgrade(e) {
            let gpa = this.totalGpa(e);
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
            var grade = this.totalgrade(e);

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
        rank(id) {
            return this.ranksget.find(
                (data) => data.student_id === id
            ).rank;
        },
        printSelectedDiv() {

            const print = printJS({
                printable: 'myDiv',
                type: 'html',
                landscape: true,
                doubleSided: false,
                targetStyles: ['*'],
                fitContentWidth: false,
                columns: 2,
                pageSize: 'A4',
            });

            print.print()
        },


    },



};
</script>
<style scoped>
tr,
th,
td {
    border: 1px solid black;

    padding: 0;
}

.small-table table,
.small-table tr,
.small-table th,
.small-table td {
    border: none;

    line-height: normal;

}
</style>
