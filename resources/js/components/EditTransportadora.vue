<template>
    <div>
        <h4 class="text-center">Editar transportadora</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateTransportadora">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" class="form-control" v-model="transportadora.nome">
                    </div><br>
                    <div class="form-group">
                        <label>CEP da transportadora</label>
                        <input type="text" class="form-control" v-model="cep.transportadora">
                    </div><br>
                    <div class="form-group">
                        <label>Endereço da transportadora</label>
                        <input type="text" class="form-control" v-model="transportadora.endereco">
                    </div><br>
                    <div class="form-group">
                        <label>Cidade da transportadora</label>
                        <input type="text" class="form-control" v-model="transportadora.cidade">
                    </div><br>
                    <div class="form-group">
                        <label>UF da transportadora</label>
                        <input type="text" class="form-control" v-model="transportadora.uf" maxlength="2" minlength="2">
                    </div><br>
                    <div class="form-group">
                        <label>Limite de crédito</label>
                        <input type="text" class="form-control" v-model="transportadora.limite_credito">
                    </div><br>
                    <div class="form-group">
                        <label>Data de análise de crédito</label>
                        <input type="text" class="form-control" v-model="transportadora.data_analise_credito">
                    </div><br>
                    <button type="submit" class="btn btn-primary">Atualizar transportadora</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            transportadora: {},
            cep: {}
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/transportadora/edit/${this.$route.params.id}`)
                .then(response => {
                    this.transportadora = response.data;
                    console.log(response);
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        updateTransportadora() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post(`/api/transportadora/update/${this.$route.params.id}`, this.transportadora)
                    .then(response => {
                        window.location.href = '/transportadora';
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = '/';
        }
        next();
    }
}
</script>
