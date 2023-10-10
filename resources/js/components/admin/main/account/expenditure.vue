<template>
    <div>

        <div class="row">
            <router-link to="/admin/store-expenditure" class="btn btn-primary">Add Expense </router-link>

        </div>
        <br>
        <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Search Here">

        <br>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Expense List</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Details</th>
                                    <th>Amount </th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="expense in expenses" :key="expense.id">
                                    <td> {{ expense.details }} </td>
                                    <td> {{ expense.amount }} </td>
                                    <td> {{ expense.expense_date }} </td>

                                    <td>
                                        <button class="btn btn-sm btn-primary mx-1" @click="Edit(expense.id)">Edit</button>

                                        <button @click="deleteExpense(expense.id)" class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
        <!--Row-->

    </div>
</template>

<script>
import router from '../../../../adminrouter';
export default {

    data() {
        return {
            expenses: [],
            searchTerm: ''
        }
    },
    computed: {
        filtersearch() {
            return this.expenses.filter(expense => {
                return expense.expense_date.match(this.searchTerm)
            })
        }
    },

    methods: {

        allExpense() {
            axios.get('/api/expenditure', {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem('token')
                }
            })
                .then(({
                    data
                }) => (this.expenses = data))
                .catch((error) => {
                    router.push('/admin/login');
                    localStorage.clear()
                    toast.fire({
                        icon: "error",
                        title: error.response.data.message
                    })

                });
        },
        Edit(id) {
            router.push("/admin/edit-expenditure/" + id, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem('token')
                }
            })
        },
        deleteExpense(id) {

            axios.delete('/api/expenditure/' + id, {
                headers: {
                    "Content-Type": "application/json",
                    Authorization: "Bearer " + localStorage.getItem('token')
                }
            }).then((res) => {
                this.expenses = this.expenses.filter(expense => {
                    return expense.id != id
                })
                console.log(res)
            })
        }

    },
    created() {
        this.allExpense();
    }

}
</script>

<style>
#em_photo {
    height: 40px;
    width: 40px;
}
</style>
