<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"> <h3>Dashboard</h3> {{ message }} </div>
                    <div class="card-body">
                        Welcome, {{ user.name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            user() {
                return this.$store.getters.getUser;
                // console.log(this.$store.getters.getUser);
            },

            message() {
                return this.$store.getters.getMessage;
            }
        }


    }
</script>

<style lang="scss" scoped>

</style>
