<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a v-if="$store.getters.getToken == 0" class="nav-link" href="/login">Login</a>
                        

                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/register"
                            v-if="$store.getters.getToken == 0">Register</router-link>

                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/post" v-if="$store.getters.getToken != 0">post</router-link>

                    </li>

                    <li class="nav-item dropdown" v-if="$store.getters.getToken != 0">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $store.getters.getUser }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/admin">Dashboard</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" @click="logout" href="#">Logout</a></li>

                        </ul>
                    </li>

                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
</template>
<script>
import { useStore } from 'vuex';
import router from '../../router';
import store from '../../store';
export default {
    data() {
        return {
        }
    },
    setup() {
        const store = useStore();
    },
    methods: {
        logout() {
            axios.get('/api/logout').then((res) => {
                store.dispatch('removeToken')
                store.dispatch('removeUser')
                window.location = "/"
                console.log(res)
            });
        }
    }


}
</script>