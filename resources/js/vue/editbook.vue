<template>
    <div class="row">
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="custom-card-header">
                    <h6 class="text-white">Edit Book</h6>
                </div>
                <div class="card-body">
                    <form @submit.prevent="updateBook">
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
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Available</label>
                                    <select class="form-control" v-model="book.book_availability" required>
                                    	<option value="1">Yes</option>
                                    	<option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn form-control bg-green btn-sm btn-curve text-white">Update Book</button>
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
                book: {}
            }
        },
        mounted(){
            this.showbook()
        },
        methods: {
            showbook() {
                this.axios
                    .get(`http://127.0.0.1:8000/api/editbook/${this.$route.params.id}`)
                    .then((response) => {
                        this.book = response.data;
                    });
            },
            updateBook() {
                this.axios
                    .post(`/api/updatebook/${this.$route.params.id}`, this.book)
                    .then((response) => {
                        this.$router.push({name: 'books'});
                    });
            }
        }
	}
</script>