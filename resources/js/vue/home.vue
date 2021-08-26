<template>
	<div class="row">
		<div class="col-md-3 nodecoration">
			<router-link to="/books" class="nav-link custom-card" style="padding-top:30px;padding-bottom:30px;background-color:#f2f2f2;color:grey">
				<center>All Books</center>
				<center>{{books.allbooks}}</center>
			</router-link>
		</div>
		<div class="col-md-3 nodecoration">
			<router-link to="/books" class="nav-link custom-card" style="padding-top:30px;padding-bottom:30px;background-color:#f2f2f2;color:grey">
				<center>Available Books</center>
				<center>{{books.available}}</center>
			</router-link>
		</div>
		<div class="col-md-3 nodecoration">
			<router-link to="/books" class="nav-link custom-card" style="padding-top:30px;padding-bottom:30px;background-color:#f2f2f2;color:grey">
				<center>Un Available Books</center>
				<center>{{books.unavailable}}</center>
			</router-link>
		</div>
		<div class="col-md-3 nodecoration">
			<router-link to="/users" class="nav-link custom-card" style="padding-top:30px;padding-bottom:30px;background-color:#f2f2f2;color:grey">
				<center>Users</center>
				<center>{{users}}</center>
			</router-link>
		</div>
	</div>
</template>
<script>
	export default {
        data() {
            return {
                books: {
                	allbooks: 0,
                	available: 0,
                	unavailable: 0,
                },
                users: 0
            }
        },
        mounted(){
            this.getbooksinfo()
            this.getusersnumber()
        },
        methods: {
            getbooksinfo() {
                this.axios
                    .get(`http://127.0.0.1:8000/api/getbooksinfo`)
                    .then((response) => {
                    	// alert(JSON.stringify(response))
                        if (response.data.success) {
	                        this.books = response.data;
	                    }
                    });
            },
            getusersnumber() {
                this.axios
                .get(`/api/getusersnumber`)
                .then((response) => {
                   	if (response.data.success) {
	                    this.users = response.data.users;
	                }
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