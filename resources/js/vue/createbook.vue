<template>
    <div class="row">
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="custom-card-header">
                    <h6 class="text-white">Add Book</h6>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Book Title</label>
                                    <input type="text" class="form-control" v-model="book.book_title">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Book Author</label>
                                    <input type="text" class="form-control" v-model="book.book_author">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn bg-green form-control btn-sm btn-curve text-white">Save Book</button>
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
	    data(){
	        return {
	            book:{}
	        }
	    },
	    methods:{
	        async create(){
	        	// alert(JSON.stringify(this.book));
	            await this.axios.post('/api/createbook',this.book).then(response=>{
	                this.$router.push({name:"books"})
	            }).catch(error=>{
	                console.log(error)
	            })
	        }
	    }
	}
</script>