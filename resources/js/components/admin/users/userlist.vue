<template>
    <h6>Users List</h6>
   <div class=" container d-flex justify-content-between">
    <div class="form-group">
        <input type="text" v-model="search" id="" placeholder="Global Search...">
    </div>
    <div class="form-group">
        <select id='number-dd'  @change.prevent="numberofitem" v-model='params.no_item'>
        <option value='10'>10</option>
        <option value='20'>20</option>
        <option value='50'>50</option>
        <option value='100'>100</option>
    </select>
    </div>
   </div>
    <table class="table">
        <thead>
            <tr>
                <th>S.N</th>
                <th>
                    <a href="#" @click.prevent="changeSort('name')">Name</a>
                    <span v-if="this.params.sort_field == 'name' && this.params.sort_direction == 'asc'"><i
                            class="fa-solid fa-arrow-up-short-wide"></i></span>
                    <span v-if="this.params.sort_field == 'name' && this.params.sort_direction == 'desc'"><i
                            class="fa-solid fa-arrow-down-wide-short"></i></span>
                </th>
                <th>
                    <a href="#" @click.prevent="changeSort('email')">Email</a>
                    <span v-if="this.params.sort_field == 'email' && this.params.sort_direction == 'asc'"><i
                            class="fa-solid fa-arrow-up-short-wide"></i></span>
                    <span v-if="this.params.sort_field == 'email' && this.params.sort_direction == 'desc'"><i
                            class="fa-solid fa-arrow-down-wide-short"></i></span>

                </th>
                <th>
                    <a href="#" @click.prevent="changeSort('created_at')">Created At</a>
                    <span v-if="this.params.sort_field == 'created_at' && this.params.sort_direction == 'asc'"><i
                            class="fa-solid fa-arrow-up-short-wide"></i></span>
                    <span v-if="this.params.sort_field == 'created_at' && this.params.sort_direction == 'desc'"><i
                            class="fa-solid fa-arrow-down-wide-short"></i></span>

                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td><input type="text" v-model="params.name"></td>
                <td><input type="text" v-model="params.email"></td>
                <td><input type="text" v-model="params.created_at"></td>
            </tr>
            <tr v-for="(data, index) in datas" :key="index">
                <td>{{ ++index }}</td>
                <td>{{ data.name }}</td>
                <td>{{ data.email }}</td>
                <td>{{ data.created_at }}</td>
            </tr>
        </tbody>
    </table>

  <!-- <div class="pagination">
    <button>{{firstpage }}</button>
    <button>{{currentpage}}</button>
    <button>{{lastPage }}</button>
  </div> -->

  <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item" @click.prevent="paginationPre" >
      <a class="page-link" href="#"  aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    
    <li class="page-item"><a class="page-link" href="#">{{ currentpage }}</a></li>
   
    <li class="page-item" @click.prevent="paginationNex" >
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav>
</template>
<script>

export default {
    name: "users",
    data() {
        return {
            datas: [],
            params: {
                sort_field: 'created_at',
                sort_direction: 'desc',
                no_item:10,
                name: '',
                email: '',
                created_at: '',
                
            },
            search: '',
            currentpage:'',
            lastPage:'',
            firstpage:'',
        }
    },
    created() {
        this.getresults()

    },
    watch: {
        params: {
            handler() {
                this.getresults()
            },
            deep: true
        },
        search(val, old) {

            if (val.length >= 4 || old.length >= 4) {
                this.getresults()
            } else {
                this.getresults()
            }
        }
    },
    methods: {
        paginationNex(){
            if (this.currentpage == this.lastPage) {
                let page = this.currentpage;
            this.getresults(page)

                
            }else{
                let page = this.currentpage + 1;
            this.getresults(page)

            }
            
        }, 
        paginationPre(){
            let page = this.currentpage - 1;
            if (page != this.firstpage) {
                
            }else{
                let page = 1;
            }
            this.getresults(page)
        },
        changeSort(field) {
            if (this.params.sort_field === field) {
                this.params.sort_direction =
                    this.params.sort_direction === 'asc' ? 'desc' : 'asc';


            } else {
                this.params.sort_direction = 'asc';
                this.params.sort_field = field;

            }
            this.getResults();
        },
        getresults(page = 1) {
            axios.get('/api/admin/users', {
                params: {
                    page,
                    search: this.search.length >= 4 ? this.search : '',
                    ...this.params
                }
            }).then((res) => {
                console.log(res)
                this.datas = res.data.data
                this.currentpage = res.data.current_page;
                    this.lastPage = res.data.last_page
                    this.firstpage = res.data.from
            }).catch(({ response }) => {
                console.error(response)
            })
        }

    }
}

</script>