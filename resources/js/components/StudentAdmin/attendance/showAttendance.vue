<template>
    <div>
        <h4>Attendance Details of Current Month </h4>
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Preasent</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ data.present_count
 }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Absent</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ data.absent_count }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                       Total School day</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ data.present_count + data.absent_count }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <table class="table">
                <tr>
                        <th>S.N</th> <th>Date</th> <th>Stataus</th>
                </tr>
                <tr v-for="(item, index) in data.attendance" :key="index">
                    <td>{{ ++index }}</td>
                    <td>{{  item.created_at.split('T')[0]}}</td>
                    <td v-if="item.status == 1">{{ 'Preasent' }}</td>
                    <td v-else>{{'Absent' }}</td>
                </tr>
            </table>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                data: [],
            }
        },
        created() {
            axios.get('/api/student/attendance').then((res) => {
                this.data = res.data
                console.log(res)
            })
        }
    }
</script>
