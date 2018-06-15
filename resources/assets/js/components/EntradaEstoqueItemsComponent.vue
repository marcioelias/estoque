<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>Produtos</strong>
        </div>
        <div class="panel-body" style="padding: 0 !important;">
            <table class="table table-condensed table-striped table-bordered table-hover" style="margin-bottom:0 !important;">
                <thead>
                    <tr class="primary">
                        <th class="col-md-1">Id</th>
                        <th class="col-md-6">Produto</th>
                        <th class="col-md-1">Qtd</th>
                        <th class="col-md-1">Vlr. Un.</th>
                        <th class="col-md-1">Vlr. Desc.</th>
                        <th class="col-md-1">Vlr. Acres.</th>
                        <th class="col-md-1">Ações</th>
                    </tr>
                </thead>
                <tbody name="fade" is="transition-group">
                    <tr v-for="(item, index) in items" :key="index">
                        <td class="col-md-1 pool-right">
                            {{ item.id }}
                            <input type="hidden" :name="'items['+index+'][produto_id]'" :value="item.id">
                        </td>
                        <td class="col-md-6">
                            {{ item.produto_descricao }}
                        </td>
                        <td class="col-md-1 text-right">
                            {{ item.quantidade }}
                            <input type="hidden" :name="'items['+index+'][quantidade]'" :value="item.quantidade">    
                        </td>
                        <td class="col-md-1 text-right">
                            {{ item.valor_unitario }}
                            <input type="hidden" :name="'items['+index+'][valor_unitario]'" :value="item.valor_unitario">    
                        </td>
                        <td class="col-md-1 text-right">
                            {{ item.valor_desconto }}
                            <input type="hidden" :name="'items['+index+'][valor_desconto]'" :value="item.valor_desconto">    
                        </td>
                        <td class="col-md-1 text-right">
                            {{ item.valor_acrescimo }}
                            <input type="hidden" :name="'items['+index+'][valor_acrescimo]'" :value="item.valor_acrescimo">    
                        </td>
                        <td class="col-md-1">
                            <button type="button" class="btn-xs btn-warning" @click="editItem(index)" v-show="!editing">
                                <span class="glyphicon glyphicon-edit"></span>
                            </button>
                            <button type="button" class="btn-xs btn-danger" @click="confirmDelete(index)" data-toggle="modal" data-target="#confirmDelete" v-show="!editing">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </td>
                    </tr>
                </tbody>
                <tfoot v-if="this.items.length > 0">
                    <tr class="success">
                        <td class="col-md-1"><strong>{{ this.items.length }}</strong></td>
                        <td class="col-md-6"></td>
                        <td class="col-md-1 text-right"><strong>{{ this.totalQuantidade() }}</strong></td>
                        <td class="col-md-1 text-right"><strong>{{ this.totalValor() }}</strong></td>
                        <td class="col-md-1 text-right"><strong>{{ this.totalDesconto() }}</strong></td>
                        <td class="col-md-1 text-right"><strong>{{ this.totalAcrescimo() }}</strong></td>
                        <td class="col-md-2"></td>
                    </tr>
                </tfoot>
            </table>
            <!-- <div class="success">
                <div class="col-md-1">num_itens</div>
                <div class="col-md-4"></div>
                <div class="col-md-2">qtd_total</div>
                <div class="col-md-2">valor_total</div>
                <div class="col-md-1">desconto</div>
                <div class="col-md-1">acrescimo</div>
                <div class="col-md-2"></div>
            </div> -->
        </div>
        <div class="panel-footer">
            <div class="row">
                <div v-bind:class="{'col-md-7': true, ' has-error': this.errors.inputProdutos}" style="padding-right: 0 !important; padding-left: 0 !important;">
                    <select ref="inputProdutos" v-model="produto_id" data-live-search="true" class="form-control selectpicker" name="inputProdutos" id="inputProdutos">
                        <option selected value="false"> Nada Selecionado </option>
                        <option v-for="(produto, index) in produtosDisponiveisOrdenados" :value="produto.id" :key="index">{{ produto.produto_descricao }}</option>
                    </select>
                     <span class="help-block" :v-if="this.errors.inputProdutos">
                        <strong>{{ this.errors.inputProdutosMsg }}</strong>
                    </span>
                </div>
                <div v-bind:class="{'col-md-1': true, ' has-error': this.errors.inputQuantidade}" style="padding-right: 0 !important; padding-left: 0 !important;">
                    <input type="number" min="0,000" max="9999999999,999" step="any" ref="inputQuantidade" v-model.number="quantidade" class="form-control" name="inputQuantidade" id="inputQuantidade">
                    <span class="help-block" :v-if="this.errors.inputQuantidade">
                        <strong>{{ this.errors.inputQuantidadeMsg }}</strong>
                    </span>
                </div>
                <div v-bind:class="{'col-md-1': true, ' has-error': this.errors.inputValorUnitario}" style="padding-right: 0 !important; padding-left: 0 !important;">
                    <input type="number" min="0,000" max="9999999999,999" step="any" ref="inputValorUnitario" v-model.number="valorUnitario" class="form-control" name="inputValorUnitario" id="inputValorUnitario">
                    <span class="help-block" :v-if="this.errors.inputValorUnitario">
                        <strong>{{ this.errors.inputValorUnitarioMsg }}</strong>
                    </span>
                </div>
                <div v-bind:class="{'col-md-1': true, ' has-error': this.errors.inputDesconto}" style="padding-right: 0 !important; padding-left: 0 !important;">
                    <input type="number" min="0,000" max="9999999999,999" step="any" ref="inputDesconto" v-model.number="desconto" class="form-control" name="inputDesconto" id="inputDesconto">
                    <span class="help-block" :v-if="this.errors.inputDesconto">
                        <strong>{{ this.errors.inputDescontoMsg }}</strong>
                    </span>
                </div>
                <div v-bind:class="{'col-md-1': true, ' has-error': this.errors.inputAcrescimo}" style="padding-right: 0 !important; padding-left: 0 !important;">
                    <input type="number" min="0,000" max="9999999999,999" step="any" ref="inputAcrescimo" v-model.number="acrescimo" class="form-control" name="inputAcrescimo" id="inputAcrescimo">
                    <span class="help-block" :v-if="this.errors.inputAcrescimo">
                        <strong>{{ this.errors.inputAcrescimoMsg }}</strong>
                    </span>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-success" @click="addProduto" v-show="!editing">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                    <button type="button" class="btn btn-success" @click="updateProduto" v-show="editing">
                        <span class="glyphicon glyphicon-ok"></span>
                    </button>
                </div>
            </div>
        </div>
        <modal @cancel="cancelDelete" @confirm="deleteItem" :modal-title="'Corfirmação'" :modal-text="'Confirma a remoção deste Item?'" />
    </div>
</template>

<script>
    import modal from './modal.vue';

    export default {
        name: 'entrada_estoque',
        components: {
            modal
        },
        data() {
            return {
                editing: false,
                editingIndex: false,
                items: [],
                produto_id: false,
                quantidade: 1,
                valorUnitario: 0,
                desconto: 0,
                acrescimo: 0,
                isModalVisible: false,
                deleteIndex: false,
                produtosDisponiveis: [],
                produtosSelecionados: [],
                errors: {
                    inputProdutos: false,
                    inputProdutosMsg: '',
                    inputQuantidade: false,
                    inputQuantidadeMsg: '',
                    inputValorUnitario: false,
                    inputValorUnitariodeMsg: '',
                    inputDesconto: false,
                    inputDescontoMsg: '',
                    inputAcrescimo: false,
                    inputAcrescimoMsg: ''
                }
            }
        },
        props: [
            'produtosData',
            'oldData'
        ],
        watch: {
            oldData: function() {
               this.$refs.confirmDelete
            }
        },
        computed: {
            produtosDisponiveisOrdenados: function() {
                function compare(a, b) {
                    if (a.produto_descricao < b.produto_descricao)
                    return -1;
                    if (a.produto_descricao > b.produto_descricao)
                    return 1;
                    return 0;
                }

                return this.produtosDisponiveis.sort(compare);
            }
        },
        mounted() {
            this.produtosDisponiveis = this.produtosData;
            if (this.oldData !== null) {
                for (var i=0; i<this.oldData.length; i++) {  
                    this.items.push({
                        'id': this.oldData[i].produto_id,
                        'produto_descricao': this.getProdutoById(this.oldData[i].produto_id).produto_descricao,
                        'quantidade': Number(this.oldData[i].quantidade),
                        'valor_unitario': Number(this.oldData[i].valor_unitario),
                        'valor_desconto': Number(this.oldData[i].valor_desconto),
                        'valor_acrescimo': Number(this.oldData[i].valor_acrescimo)
                    });
                    this.incluirProduto(this.oldData[i].produto_id);
                }
            }
        },
        updated() {
            $(this.$refs.inputProdutos).selectpicker('refresh');
        },
        methods: {
            validarItem() {
                if ((this.produto_id == '') || (this.produto_id <= 0)) {
                    this.errors.inputProdutos = true;
                    this.errors.inputProdutosMsg = 'Nenhum Produto selecionado.';
                    return false;
                } else {
                    this.errors.inputProdutos = false;
                    this.errors.inputProdutosMsg = '';
                }
                
                if ((this.quantidade == '') || (this.quantidade <= 0)) {
                    this.errors.inputQuantidade = true;
                    this.errors.inputQuantidadeMsg = 'Informe a quantidade do produto.';
                    return false;
                } else {
                    this.errors.inputQuantidade = false;
                    this.errors.inputQuantidadeMsg = '';
                }

                if ((this.valorUnitario == '') || (this.valorUnitario <= 0)) {
                    this.errors.inputValorUnitario = true;
                    this.errors.inputValorUnitarioMsg = 'Informe o Valor Unitário do produto.';
                    return false;
                } else {
                    this.errors.inputValorUnitario = false;
                    this.errors.inputValorUnitarioMsg = '';
                }

                /* if ((this.desconto == '') || (this.desconto < 0)) {
                    this.errors.inputDesconto = true;
                    this.errors.inputDescontoMsg = 'Informe o Valor de Desconto.';
                    return false;
                } else {
                    this.errors.inputDesconto = false;
                    this.errors.inputDescontoMsg = '';
                }

                if ((this.acrescimo == '') || (this.acrescimo < 0)) {
                    this.errors.inputAcrescimo = true;
                    this.errors.inputAcrescimoMsg = 'Informe o Valor de Acréscimo.';
                    return false;
                } else {
                    this.errors.inputAcrescimo = false;
                    this.errors.inputAcrescimoMsg = '';
                } */
                return true;
            },
            confirmDelete(index) {
                this.deleteIndex = index;
            },
            cancelDelete(index) {
                this.deleteIndex = false;
            },
            addProduto() {
                if (this.validarItem()) {
                    this.items.push({
                        'id': this.produto_id,
                        'produto_descricao': this.getProdutoById(this.produto_id).produto_descricao,
                        'quantidade': this.quantidade,
                        'valor_unitario': this.valorUnitario,
                        'valor_desconto': this.desconto,
                        'valor_acrescimo': this.acrescimo
                    });
                    this.incluirProduto(this.produto_id);
                    this.limparFormulario();
                }
            },
            editItem(index) {
                let item = this.items[index];
                this.quantidade = item.quantidade;
                this.valorUnitario = item.valor_unitario;
                this.desconto = item.valor_desconto;
                this.acrescimo = item.valor_acrescimo;
                this.produto_id = item.id;
                this.editing = true;
                this.editingIndex = index;
            },
            updateProduto() {
                this.items[this.editingIndex] = {
                    'id': this.produto_id,
                    'produto_descricao': this.getProdutoById(this.produto_id).produto_descricao,
                    'quantidade': this.quantidade,
                    'valor_unitario': this.valorUnitario,
                    'valor_desconto': this.desconto,
                    'valor_acrescimo': this.acrescimo
                };

                this.editing = false;
                this.editingIndex = false;
                this.limparFormulario();
            },
            deleteItem() {
                this.removerProduto(this.items[this.deleteIndex].id);
                this.$delete(this.items, this.deleteIndex);
            },
            limparFormulario() {
                this.produtoSelecionado = false;
                this.quantidade = '';
                this.valorUnitario = '';
                this.desconto = '';
                this.acrescimo = '';
                this.$refs.inputProdutos.focus();
            },
            totalQuantidade() {
                let result = 0;
                for (var i=0; i<this.items.length; i++) {  
                    result += this.items[i].quantidade;
                }
                return result;
            },
            totalValor() {
                let result = 0;
                for (var i=0; i<this.items.length; i++) {  
                    result += this.items[i].valor_unitario;
                }
                return result;
            },
            totalDesconto() {
                let result = 0;
                for (var i=0; i<this.items.length; i++) {  
                    result += this.items[i].valor_desconto;
                }
                return result;
            },
            totalAcrescimo() {
                let result = 0;
                for (var i=0; i<this.items.length; i++) {  
                    result += this.items[i].valor_acrescimo;
                }
                return result;
            },
            getProdutoById(id) {
                let result = 0;
                for (var i=0; i<this.produtosData.length; i++) {  
                    if (this.produtosData[i].id == id) {
                        result = this.produtosData[i];
                        break;
                    } 
                }
                return result;
            },
            getProdutoIndexById(id) {
                let result = 0;
                for (var i=0; i<this.produtosData.length; i++) {  
                    if (this.produtosData[i].id == id) {
                        result = i;
                        break;
                    } 
                }
                return result;
            },
            getProdutoSelecionadoById(id) {
                let result = 0;
                for (var i=0; i<this.produtosSelecionados.length; i++) {  
                    if (this.produtosSelecionados[i].id == id) {
                        result = this.produtosSelecionados[i];
                        break;
                    } 
                }
                return result;
            },
            getProdutoSelecionadoIndexById(id) {
                let result = 0;
                for (var i=0; i<this.produtosSelecionados.length; i++) {  
                    if (this.produtosSelecionados[i].id == id) {
                        result = i;
                        break;
                    } 
                }
                return result;
            },
            incluirProduto(id) {
                this.produtosSelecionados.push(this.getProdutoById(id));
                this.$delete(this.produtosDisponiveis, this.getProdutoIndexById(id));
            },
            removerProduto(id) {
                this.produtosDisponiveis.push(this.getProdutoSelecionadoById(id));
                this.$delete(this.produtosSelecionados, this.getProdutoSelecionadoIndexById(id));
            }
        }
    }
</script>