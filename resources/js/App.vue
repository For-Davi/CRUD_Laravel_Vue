<template>
    <div class="container">
        <div class="text-center" style="margin: 20px 0px 20px 0px;">
            <span class="text-secondary">CRUD de Fornecedores</span>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">

                <!-- Usuario logado -->
                <div class="navbar-nav" v-if="isLoggedIn">
                    <router-link to="/transportadora" class="nav-item nav-link">Transportadoras</router-link>
                    
                    <a class="nav-item nav-link" style="cursor: pointer;" @click="logout">Logout</a>
                </div>
                
                <!-- Usuario não logado -->
                <div class="navbar-nav" v-else>
                    <router-link to="/" class="nav-item nav-link">Home</router-link>
                    <!-- <router-link to="/login" class="nav-item nav-link">Login</router-link> -->
                    <router-link to="/login" class="nav-item nav-link">Login</router-link>
                    
                    <router-link to="/register" class="nav-item nav-link">Cadastrar
                    </router-link>
                </div>
            </div>
        </nav>
        <br/>
        <router-view/>
    </div>
</template>

<script>
export default {
    name: "App",
    data() {
        return {
            isLoggedIn: false,
        }
    },
    created() {
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        }
    },
    methods: {
        async logout(e) {
            e.preventDefault();
            await this.$axios.get('/sanctum/csrf-cookie');
            const response = await this.$axios.post('/api/logout');
            console.log(response)
            
            if(response.request.status === 200) {
                this.isLoggedIn = false;
                window.location.href = '/';
            }

        },
        removeAllCookies(){
            const cookies = cookies.get();
            Object.keys(cookies).forEach(cookieName => {
            cookies.remove(cookieName);})
        }
        
    }
}
</script>

<!-- Esse arquivo -->
