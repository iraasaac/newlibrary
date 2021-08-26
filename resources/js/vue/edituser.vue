<template>
    <div class="row">
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="custom-card-header">
                    <h6 class="text-white">Edit User</h6>
                </div>
                <div class="card-body">
                    <form @submit.prevent="updateuser">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>User Names</label>
                                    <input required type="text" class="form-control" v-model="user.name" placeholder="Ex: Aizo Kini">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>User Email</label>
                                    <input required type="email" class="form-control" v-model="user.email" placeholder="Ex: aizokini@gmail.com">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>User Password</label>
                                    <input required type="password" class="form-control" v-model="user.password" placeholder="*******">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn bg-green form-control btn-sm btn-curve text-white">Save User</button>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
	export default {
        data() {
            return {
                user: {}
            }
        },
        mounted(){
            this.showuser()
        },
        methods: {
            showuser() {
                this.axios
                    .get(`http://127.0.0.1:8000/api/edituser/${this.$route.params.id}`)
                    .then((response) => {
                        this.user = response.data;
                    });
            },
            updateuser() {
                this.axios
                .post(`/api/updateuser/${this.$route.params.id}`, this.user)
                .then((response) => {
                    this.$router.push({name: 'users'});
                });
            }
        },
        beforeRouteEnter(to, from, next) {
            if (!window.Laravel.isLoggedin) {
                window.location.href = "/";
            }
            next();
        }
	}
</script>