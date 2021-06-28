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
                                    <th style="width:100px">SL</th>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Slug</th>
                                    <th style="width:170px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(product, index) in products" :key="product.id">
                                    <td style="width:100px"> {{ index+1 }} </td>
                                    <td>
                                        <div style="max-width: 70px; max-height: 70px; overflow:hidden">
                                            <img class="img-fluid" :src="product.image" alt="">
                                        </div>
                                    </td>
                                    <td> {{ product.title }} </td>
                                    <td> {{ product.price }} </td>
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
