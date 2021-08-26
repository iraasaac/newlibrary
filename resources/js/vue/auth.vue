<template>
   <div class="wrapper">
        <div class="form">
            <div class="card custom-card">
                <div class="custom-card-header">
                    <h6 class="text-white">Login</h6>
                </div>
                <div class="card-body">
                    <form @submit.prevent="login">
                        <div class="alert alert-danger" role="alert" v-if="error !== null">
                            {{ error }}
                        </div>
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" v-model="email">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" v-model="password">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn bg-green form-control btn-sm btn-curve text-white">Login</button>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
    .wrapper {
        width: 100%
    }
    .form {
        width: 300px;
        margin: auto;
        background-color:red
    }
</style>
<script>
    export default {
        data(){
            return {
                email: "",
                password: "",
                error: null
            }
        },
        methods:{
            login(){
                this.axios.get('/sanctum/csrf-cookie').then(response => {
                    // alert(JSON.stringify(this.user.email));
                    this.axios.post('api/login',  {
                        email: this.email,
                        password: this.password
                    })
                    .then(response => {
                        if (response.data.success) {
                            this.$router.go('/books')
                            // this.error = response.data.message
                        } else {
                            this.error = response.data.message
                        }
                    })
                    .catch( (err) => {
                        this.error = err;
                    });
                })
            }
        },
        beforeRouteEnter(to, from, next) {
            if (window.Laravel.isLoggedin) {
                return next('/');
            }
            next();
        }
    }
</script>