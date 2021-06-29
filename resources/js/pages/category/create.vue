<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Create Category</h5>
                        <router-link :to="{ name:'category-list' }" class="btn btn-sm btn-primary">Back</router-link>
                    </div>
                    <div class="card-body">
                        <form class="w-50 mx-auto" @submit.prevent="createCategory">
                            <div class="mb-3">
                                <label class="form-label">Category Name</label>
                                <input type="text" v-model="categoryForm.name" name="name" class="form-control" :class="{ 'is-invalid':categoryForm.errors.has('name') }">
                                <has-error :form="categoryForm" field="name"></has-error>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-sm btn-success">Create Category</button>
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
    export default {
        data() {
            return {
                categoryForm: new Form({
                    name: '',
                }),
            }
        },
        methods: {
            createCategory() {
                this.categoryForm.post('/api/category').then(({data}) => {
                    this.categoryForm.name = '';

                    this.$toast.success({
                        title:'Success!',
                        message:'Category created successfully!!',
                    });
                });
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
