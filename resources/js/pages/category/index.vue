<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Category List</h5>
                        <router-link :to="{ name:'create-category' }" class="btn btn-sm btn-primary">Create Category</router-link>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="width:100px">ID</th>
                                    <th>Category Name</th>
                                    <th>Slug</th>
                                    <th style="width:170px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="category in categories" :key="category.id">
                                    <td style="width:100px"> {{ category.id }} </td>
                                    <td> {{ category.name }} </td>
                                    <td> {{ category.slug }} </td>
                                    <td style="width:170px">
                                        <!-- <router-link :to="{ name:'edit-category', params: {slug: category.slug} }" class="btn btn-sm btn-info">Edit</router-link> -->
                                        <router-link :to="{ name:'edit-category', params: {id: category.id} }" class="btn btn-sm btn-info">Edit</router-link>
                                        <a @click.prevent="deleteCategory(category.id)" href="#" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
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
        data() {
            return {
                categories: [],
            }
        },
        methods: {
            loadCategories() {
                axios.get('/api/category').then(response => {
                    this.categories = response.data;
                });
            },
            deleteCategory(id) {
                axios.delete(`/api/category/${id}`).then(() => {
                    this.$toast.success({
                        title:'Success!',
                        message:'Category deleted successfully!!',
                    })
                })
                this.loadCategories();
            }
        },
        mounted() {
            this.loadCategories();
        }
    }
</script>
