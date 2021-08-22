<template>
	<div class="wrapper">
		<div class="header">
			<b class="title">LIBRARY</b>
			<i class="material-icons logout">power_settings_new</i>
		</div>
		<div class="sidebar">
            <router-link to="/index" class="nav-item nav-link" active-class="active-class"><i class="material-icons menu-icon">computer</i> Home</router-link>
            <router-link to="/books" class="nav-item nav-link" active-class="active-class"><i class="material-icons menu-icon">library_books</i> Books</router-link>
            <router-link to="/createbook" class="nav-item nav-link" active-class="active-class"><i class="material-icons menu-icon">add</i> Add Book</router-link>
            <router-link to="/students" class="nav-item nav-link" active-class="active-class"><i class="material-icons menu-icon">edit</i> Students</router-link>
            <router-link to="/lend" class="nav-item nav-link" active-class="active-class"><i class="material-icons menu-icon">account_balance</i> Lend Book</router-link>
		</div>
		<div class="body">
			<router-view />
		</div>
	</div>
</template>

<script>
	export default {}
</script>