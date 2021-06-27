<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Category - {{ categoryForm.name }} </h5>
                        <router-link :to="{ name:'category-list' }" class="btn btn-sm btn-primary">Back</router-link>
                    </div>
                    <div class="card-body">
                        <form class="w-50 mx-auto" @submit.prevent="updateCategory">
                            <div class="mb-3">
                                <label class="form-label">Category Name</label>
                                <input type="text" v-model="categoryForm.name" name="name" class="form-control" :class="{ 'is-invalid':categoryForm.errors.has('name') }">
                                <has-error :form="categoryForm" field="name"></has-error>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-sm btn-success">Update Category</button>
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
            updateCategory() {
                let id = this.$route.params.id;
                this.categoryForm.put(`/api/category/${id}`).then(() => {
                    this.$toast.success({
                        title:'Success!',
                        message:'Category updated successfully!!',
                    })
                })
            },

            loadCategory() {
                let id = this.$route.params.id;
                // console.log(id);

                axios.get(`/api/category/${id}/edit`).then(response => {
                    // console.log(response);
                    this.categoryForm.name = response.data.name;
                });

                // axios.get('/api/category/'+id+'/edit').then(response => {
                //     console.log(response);
                // });

            },
        },
        mounted() {
            this.loadCategory();
        }
    }
</script>

<style lang="scss" scoped>

</style>
