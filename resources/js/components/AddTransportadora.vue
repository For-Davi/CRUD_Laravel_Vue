<template>
    <div>
        <h4 class="text-center">Adicionar fornecedor</h4>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <form @submit.prevent="addTransportadora" class="mb-5 row ">
                    <div class="form-group col-md-12 mb-2">
                        <label>Nome</label>
                        <input type="text" class="form-control" v-model="transportadora.nome">
                    </div>
                    <div class="form-group col-md-12 mb-2">
                        <label>CEP da transportadora</label>
                        <input type="text" class="form-control" v-model="cepInput.transportadora" @blur="handleCep">
                    </div>
                    <div class="form-group col-md-12 mb-2">
                        <label>Endereço da transportadora</label>
                        <input type="text" class="form-control" v-model="transportadora.endereco">
                    </div>
                    <div class="form-group col-md-6 mb-2">
                        <label>Cidade da transportadora</label>
                        <input type="text" class="form-control" v-model="transportadora.cidade">
                    </div>
                    <div class="form-group col-md-6 mb-2">
                        <label>UF da transportadora</label>
                        <input type="text" class="form-control" v-model="transportadora.uf" maxlength="2" minlength="2">
                    </div>
                    <div class="form-group col-md-6 mb-2">
                        <label>Limite de crédito</label>
                        <input type="text" class="form-control" v-model="transportadora.limite_credito">
                    </div>
                    <div class="form-group col-md-6 mb-2">
                        <label>Data de análise de crédito</label>
                        <input type="text" class="form-control" v-model="transportadora.data_analise_credito">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 text-white">Adicionar transportadora</button>
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
            cepInput: {},
            cepData :{},
        }
    },
    methods: {
         async addTransportadora() {

            const partesData = this.transportadora.data_analise_credito.split('/');
            const dataObj = new Date(`20${partesData[0]}`, partesData[1] - 1, partesData[2]);
            this.transportadora.data_analise_credito = dataObj.toISOString().split('T')[0];

            this.transportadora.limite_credito = parseInt(this.transportadora.limite_credito);
            
            try {
                await this.$axios.get('/sanctum/csrf-cookie')
                
                this.$axios.post('/api/transportadora/add', this.transportadora)
                        .then(response => {
                            this.$router.push({name: 'transportadora'});
                        })
                        .catch(function (error) {
                            console.error(error);
                        });
            } catch (error) {
                console.log(error);
            }
                
        },
        async handleCep(){
            try {
                  const response = await axios.get(`https://viacep.com.br/ws/${this.cepInput.transportadora}/json`);
                  this.cepData = response.data;
                  this.transportadora.endereco = this.cepData.logradouro;
                  this.transportadora.cidade = this.cepData.localidade;
                  this.transportadora.uf = this.cepData.uf;
                
                } catch(error){
                  console.log(error);
                }
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
