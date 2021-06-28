<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Product</h5>
                        <router-link :to="{ name:'product-list' }" class="btn btn-sm btn-primary">Back</router-link>
                    </div>
                    <div class="card-body">
                        <form class="w-50 mx-auto" @submit.prevent="saveProduct">
                            <div class="mb-3">
                                <label class="form-label">Product Title</label>
                                <input type="text" v-model="productForm.title" name="title" class="form-control" :class="{ 'is-invalid':productForm.errors.has('title') }">
                                <has-error :form="productForm" field="title"></has-error>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" v-model="productForm.price" name="price" class="form-control" :class="{ 'is-invalid':productForm.errors.has('price') }">
                                <has-error :form="productForm" field="price"></has-error>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" rows="4" v-model="productForm.description" class="form-control" :class="{ 'is-invalid':productForm.errors.has('description') }"></textarea>
                                <has-error :form="productForm" field="description"></has-error>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="mb-3">
                                        <label for="image">Product Image</label>
                                        <input type="file" id="image" class="form-control-file" @change="onImageChange" :class="{ 'is-invalid':productForm.errors.has('image') }">
                                        <has-error :form="productForm" field="image"></has-error>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div style="width:100%; max-height:150px; overflow:hidden">
                                        <img :src="image" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-sm btn-success">Update Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Form } from 'vform'
import { objectToFormData } from 'object-to-formdata'

    export default {
        data() {
            return {
                productForm: new Form({
                    title: '',
                    price: '',
                    description: '',
                    image: '',
                    _method: 'put',
                }),
                image: '',
            }
        },
        methods: {
            loadProduct() {
                let id = this.$route.params.id;
                // console.log(id);

                axios.get(`/api/product/${id}/edit`).then(response => {
                    // console.log(response);
                    this.productForm.title = response.data.title;
                    this.productForm.price = response.data.price;
                    this.productForm.description = response.data.description;
                    this.image = 'http://127.0.0.1:8000/'+response.data.image;
                });
            },
            saveProduct() {
                let id = this.$route.params.id;
                this.productForm.post('/api/product/'+id, {
                    transformRequest: [function (data, headers) {
                        return objectToFormData(data)
                    }],
                    onUploadProgress: e => {
                        console.log(e);
                    }
                }).then(({data}) => {
                    this.image = 'http://127.0.0.1:8000/'+ data.image;

                    this.$toast.success({
                        title:'Success!',
                        message:'Product updated successfully!!',
                    })
                })
            },

            onImageChange(e) {
                const file = e.target.files[0]
                this.productForm.image = file
            }
        },
        mounted() {
            this.loadProduct();
        }
    }
</script>

<style lang="scss" scoped>

</style>
