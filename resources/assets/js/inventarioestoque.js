let inventario_estoque = require('./components/InventarioItemsComponent.vue');

const leads = new Vue({
    el: '#inventario_estoque_items',
    components:{
        inventario_estoque,
    }
});
