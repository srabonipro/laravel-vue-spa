<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Product List</h5>
                        <router-link :to="{ name:'create-product' }" class="btn btn-sm btn-primary">Create Product</router-link>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="width:100px">ID</th>
                                    <th>Product Name</th>
                                    <th>Slug</th>
                                    <th style="width:170px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in products" :key="product.id">
                                    <td style="width:100px"> {{ product.id }} </td>
                                    <td> {{ product.name }} </td>
                                    <td> {{ product.slug }} </td>
                                    <td style="width:170px">
                                        <router-link :to="{ name:'edit-product', params: {id: product.id} }" class="btn btn-sm btn-info">Edit</router-link>
                                        <a @click.prevent="deleteProduct(product.id)" href="#" class="btn btn-sm btn-danger">Delete</a>
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
                products: [],
            }
        },
        methods: {
            loadProducts() {
                axios.get('/api/product').then(response => {
                    this.products = response.data;
                });
            },
            deleteProduct(id) {
                axios.delete(`/api/product/${id}`).then(() => {
                    this.$toast.success({
                        title:'Success!',
                        message:'Product deleted successfully!!',
                    })
                })
                this.loadProducts();
            }
        },
        mounted() {
            this.loadProducts();
        }
    }
</script>
