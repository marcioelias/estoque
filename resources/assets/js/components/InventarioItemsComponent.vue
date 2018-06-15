<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col col-xs-1 col-sm-1 col-md-1">ID</div>
                <div class="col col-xs-7 col-sm-7 col-md-9">Produto</div>
                <!-- <div class="col col-xs-2 col-sm-2 col-md-2">Qtd Estoque</div> -->
                <div class="col col-xs-4 col-sm-4 col-md-2">Qtd Contada</div>
                <!-- <div class="col col-xs-1 col-sm-1 col-md-1">Ajustado</div> -->
            </div>
        </div>
        <div class="panel-body" style="padding: 0px 15px !important">
            <div v-bind:class="['row', (index % 2 === 0) ? 'bg-info' : 'bg-warning']" v-for="(item, index) in items" :key="index">
                <div class="col col-xs-1 col-sm-1 col-md-1" style="padding-top: 3px">{{ item.produto.id }}</div>
                <div class="col col-xs-7 col-sm-7 col-md-9" style="padding-top: 3px">{{ item.produto.produto_descricao }}</div>
                <!-- <div class="col col-xs-2 col-sm-2 col-md-2" style="padding-top: 3px">{{ item.qtd_estoque }}</div> -->
                <div class="col col-xs-4 col-sm-4 col-md-2">
                    <input type="text" class="form-control input-sm" :name="'items['+item.id+'][qtd_contada]'" :readonly="item.ajustado == 1">
                </div>
                <!-- <div class="col col-xs-1 col-sm-1 col-md-1" style="padding-top: 3px">
                    <input type="checkbox" :name="'items['+item.id+'][ajustado]'" :id="'items['+item.id+'][ajustado]'" v-model="item.ajustado" :value="item.ajustado"> -->
                    <!-- <input type="checkbox" v-model="items[index].ajustado" :name="'items['+item.id+'][ajustado]'" :id="'items['+item.id+'][ajustado]'" data-toggle="toggle" 
                            data-width="55" data-on="Sim" data-off="Não" data-size="mini" data-onstyle="success" 
                            data-offstyle="default" :value="items[index].ajustado" /> --> 
                <!-- </div> -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'inventario_estoque',
        components: {
        },
        data() {
            return {
                items: []
            }
        },
        props: [
            'itemsData',
        ],
        mounted() {
            this.items = this.itemsData;
        }
    }
</script>