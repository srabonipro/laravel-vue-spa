<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <router-link class="navbar-brand" :to="{ name:'home' }">Site Logo</router-link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{ name:'home' }">Home</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{ name:'category-list' }">Category</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{ name:'product-list' }">Product</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{ name:'login' }">Login</router-link>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" @click.prevent="logout">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
    export default {
        methods: {
            logout() {
                // console.log('logout button clicked');

                axios.post('/logout').then(response => {
                    // console.log('success');
                    this.$router.push({ name: 'login' });

                    this.$toast.success({
                        title:'Success!',
                        message: "You're successfully logged out!!",
                    });
                });
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>
