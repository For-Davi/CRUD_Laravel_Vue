<template>
    <div>
        <h4 class="text-center">Todas as transportadoras</h4><br/>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Endereco</th>
                <th>Cidade</th>
                <th>UF</th>
                <th>Limite de Crédito</th>
                <th>Data de análise</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="transportadora in transportadoras" :key="transportadora.id">
                <td>{{ transportadora.id }}</td>
                <td>{{ transportadora.nome }}</td>
                <td>{{ transportadora.endereco }}</td>
                <td>{{ transportadora.cidade }}</td>
                <td>{{ transportadora.uf }}</td>
                <td>{{ transportadora.limite_credito}}</td>
                <td>{{ transportadora.data_analise_credito }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edittransportadora', params: { id: transportadora.id }}" class="btn btn-primary">Editar
                        </router-link>
                        <button class="btn btn-danger" @click="deleteTransportadora(transportadora.id)">Deletar</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-info" @click="this.$router.push({name: 'addtransportadora'})">Cadastrar transportadora</button>
        
    </div>
</template>

<script>
export default {
    data() {
        return {
            transportadoras: []
        }
    },
    mounted() {
        this.initializeAxios();
    },
    methods:
    {
        deleteTransportadora(id) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.delete(`/api/transportadora/delete/${id}`)
                    .then(response => {
                        let i = this.transportadoras.map(item => item.id).indexOf(id);
                        this.transportadoras.splice(i, 1)
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            });
        },
        async initializeAxios() {
        try {
            
            this.$axios.defaults.xsrfCookieName = 'XSRF-TOKEN';
            
            await this.$axios.get('/sanctum/csrf-cookie');
            
           
            const response = await this.$axios.get('/api/transportadora');

            this.transportadoras = response.data;
        } catch (error) {
            console.error(error);
        }
    }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            this.$router.push({name: 'home'});
            
        }
        next();
    }
};
</script>
