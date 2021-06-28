<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Create Product</h5>
                        <router-link :to="{ name:'product-list' }" class="btn btn-sm btn-primary">Back</router-link>
                    </div>
                    <div class="card-body">
                        <form class="w-50 mx-auto" @submit.prevent="createProduct">
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
                            <div class="mb-3">
                                <label for="image">Product Image</label>
                                <input type="file" id="image" class="form-control-file" @change="onImageChange" :class="{ 'is-invalid':productForm.errors.has('image') }">
                                <has-error :form="productForm" field="image"></has-error>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-sm btn-success">Create Product</button>
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
                }),
            }
        },
        methods: {
            createProduct(event) {
                this.productForm.post('/api/product', {
                    transformRequest: [function (data, headers) {
                        return objectToFormData(data)
                    }],
                    onUploadProgress: e => {
                        console.log(e);
                    }
                }).then(() => {
                    event.target.reset();

                    this.$toast.success({
                        title:'Success!',
                        message:'Product created successfully!!',
                    })
                })
            },

            onImageChange(e) {
                const file = e.target.files[0]
                this.productForm.image = file
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
