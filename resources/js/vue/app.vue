<template>
	<div class="wrapper">
		<div class="header" v-if="isLoggedIn">
			<b class="title">LIBRARY</b>
			<a href="javascript:;" @click="logout" class="logout">
				<i class="material-icons">power_settings_new</i>
			</a>
		</div>
		<div class="sidebar" v-if="isLoggedIn">
            <router-link to="/index" class="nav-item nav-link" active-class="active-class"><i class="material-icons menu-icon">computer</i> Home</router-link>
            <router-link to="/books" class="nav-item nav-link" active-class="active-class"><i class="material-icons menu-icon">library_books</i> Books</router-link>
            <router-link to="/createbook" class="nav-item nav-link" active-class="active-class"><i class="material-icons menu-icon">add</i> Add Book</router-link>
            <router-link to="/users" class="nav-item nav-link" active-class="active-class"><i class="material-icons menu-icon">people</i> Users</router-link>
		</div>
		<div class="body">
			<router-view />
		</div>
	</div>
</template>
<script>
export default {
    name: "App",
    data() {
        return {
            isLoggedIn: false,
        }
    },
    created() {
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        }
    },
    methods: {
        logout(e) {
            console.log('ss')
            e.preventDefault()
            this.axios.get('/sanctum/csrf-cookie').then(response => {
                this.axios.post('/api/logout')
                .then(response => {
                    if (response.data.success) {
                        window.location.href = "/login"
                    } else {
                        console.log(response)
                    }
                })
                .catch(function (error) {
                    console.error(error);
                });
            })
        }
    },
}
</script>