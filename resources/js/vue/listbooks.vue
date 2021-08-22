<template>
	<div>
		<div class="custom-card">
			<div class="custom-card-header">
				<b class="text-white card-title">Library Books</b>
				<router-link to="/createbook">
					<span class="card-btn bg-green"><i class="material-icons text-white">add</i></span>
				</router-link>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-hover table-bordered table-condensed">
						<thead>
				            <tr>
				                <th>Code</th>
				                <th>Title</th>
				                <th>Author</th>
				                <th>Availability</th>
				                <th>Action</th>
				            </tr>
				        </thead>
		                <tbody v-if="books.length > 0">
		                    <tr v-for="(book,key) in books" :key="key">
		                        <td>{{ book.book_code }}</td>
		                        <td>{{ book.book_title }}</td>
		                        <td>{{ book.book_author }}</td>
		                        <td v-if="book.book_availability > 0">Available</td>
		                        <td v-else>Not Available</td>
		                        <td>
		                            <router-link :to='{name:"editbook",params:{id:book.id}}' class="btn bg-green small-btn">Edit</router-link>
		                            <button type="button" @click="deletebook(book.id)" class="btn btn-danger small-btn">Delete</button>
		                        </td>
		                    </tr>
		                </tbody>
		                <tbody v-else>
		                    <tr>
		                        <td colspan="5" align="center">No Book Found.</td>
		                    </tr>
		                </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
	    name:"books",
	    data(){
	        return {
	            books:[]
	        }
	    },
	    mounted(){
	        this.getBooks()
	    },
	    methods:{
	        async getBooks(){
	            await this.axios.get('/api/books').then(response=>{
	                this.books = response.data
	            }).catch(error=>{
	                console.log(error)
	                this.books = []
	            })
	        },
	        deletebook(id){
	            if(confirm("Are you sure to delete this book ?")){
	                this.axios.delete(`/api/deletebook/${id}`).then(response=>{
	                    this.getBooks()
	                }).catch(error=>{
	                    console.log(error)
	                })
	            }
	        }
	    }	
	}
</script>