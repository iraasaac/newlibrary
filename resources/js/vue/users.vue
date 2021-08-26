<template>
	<div class="row">
		<div class="col-md-4">
            <div class="card custom-card">
                <div class="custom-card-header">
                    <h6 class="text-white">Add User</h6>
                </div>
                <div class="card-body">
                    <form @submit.prevent="register">
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
		<div class="col-md-8">
			<div class="custom-card">
				<div class="custom-card-header">
					<b class="text-white card-title">Library Users</b>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-condensed">
							<thead>
					            <tr>
					                <th>Code</th>
					                <th>Name</th>
					                <th>Email</th>
					                <th>Action</th>
					            </tr>
					        </thead>
			                <tbody v-if="users.length > 0">
			                    <tr v-for="(user,key) in users" :key="key">
			                        <td>{{ key+1 }}</td>
			                        <td>{{ user.name }}</td>
			                        <td>{{ user.email }}</td>
			                        <td>
			                            <router-link :to='{name:"edituser",params:{id:user.id}}' class="btn bg-green small-btn">Edit</router-link>
			                            <button type="button" @click="deleteuser(user.id)" class="btn btn-danger small-btn">Delete</button>
			                        </td>
			                    </tr>
			                </tbody>
			                <tbody v-else>
			                    <tr>
			                        <td colspan="5" align="center">No User Found.</td>
			                    </tr>
			                </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
	    name:"users",
	    data(){
	        return {
	        	user:{},
	            users:[]
	        }
	    },
	    mounted(){
	        this.getusers()
	    },
	    methods:{
	        async getusers(){
	            await this.axios.get('/api/users').then(response=>{
	                this.users = response.data
	            }).catch(error=>{
	                console.log(error)
	                this.users = []
	            })
	        },
	        deleteuser(id){
	            if(confirm("Are you sure to delete this user ?")){
	                this.axios.delete(`/api/deleteuser/${id}`).then(response=>{
	                    this.getusers()
	                }).catch(error=>{
	                    console.log(error)
	                })
	            }
	        },
	        async register(){
	        	// alert(JSON.stringify(this.user));
	            await this.axios.post('/api/register',this.user).then(response=>{
	               this.getusers();
	            }).catch(error=>{
	                console.log(error)
	            })
	        }
	    },
	    beforeRouteEnter(to, from, next) {
	        if (!window.Laravel.isLoggedin) {
	            window.location.href = "/login";
	        }
	        next();
	    }	
	}
</script>