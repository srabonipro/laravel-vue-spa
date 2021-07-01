<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Login</h5>
                        <router-link :to="{ name:'register' }" class="btn btn-sm btn-primary">Sign up now</router-link>
                    </div>
                    <div class="card-body">
                        <form class="w-50 mx-auto" @submit.prevent="login()">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" v-model="loginForm.email" name="email" class="form-control" :class="{ 'is-invalid':loginForm.errors.has('email') }">
                                <has-error :form="loginForm" field="email"></has-error>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" v-model="loginForm.password" name="password" class="form-control" :class="{ 'is-invalid':loginForm.errors.has('password') }">
                                <has-error :form="loginForm" field="password"></has-error>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-sm btn-success">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Form } from 'vform'

    export default {
        data() {
            return {
                loginForm: new Form({
                    email: 'sraboni@gmail.com',
                    password: 'password',
                }),
            }
        },
        methods: {
            login() {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    // console.log('form submitted');

                    this.loginForm.post('/login').then(response => {
                        // console.log(response);
                        this.getUserData();
                        this.$router.push({ name: 'dashboard' });

                        this.$toast.success({
                            title:'Success!',
                            message: "You're successfully logged in!!",
                        });
                    });
                });
            },

            getUserData() {
                axios.get('/api/user').then(response => {
                    // console.log(response.data);
                    let user = response.data;
                    this.$store.commit('SET_USER', user);
                });
            }
        },

        mounted() {
        }
    }
</script>

<style lang="scss" scoped>

</style>
