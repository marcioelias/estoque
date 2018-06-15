webpackJsonp([2],{

/***/ 156:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(157);


/***/ }),

/***/ 157:
/***/ (function(module, exports, __webpack_require__) {

var entrada_estoque = __webpack_require__(158);

var leads = new Vue({
    el: '#entrada_estoque_produtos',
    components: {
        entrada_estoque: entrada_estoque
    }
});

/***/ }),

/***/ 158:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(3)
/* script */
var __vue_script__ = __webpack_require__(159)
/* template */
var __vue_template__ = __webpack_require__(163)
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/EntradaEstoqueItemsComponent.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key.substr(0, 2) !== "__"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] EntradaEstoqueItemsComponent.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-c5957a84", Component.options)
  } else {
    hotAPI.reload("data-v-c5957a84", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 159:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* WEBPACK VAR INJECTION */(function($) {/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__modal_vue__ = __webpack_require__(160);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__modal_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__modal_vue__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//



/* harmony default export */ __webpack_exports__["default"] = ({
    name: 'entrada_estoque',
    components: {
        modal: __WEBPACK_IMPORTED_MODULE_0__modal_vue___default.a
    },
    data: function data() {
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
        };
    },

    props: ['produtosData', 'oldData'],
    watch: {
        oldData: function oldData() {
            this.$refs.confirmDelete;
        }
    },
    computed: {
        produtosDisponiveisOrdenados: function produtosDisponiveisOrdenados() {
            function compare(a, b) {
                if (a.produto_descricao < b.produto_descricao) return -1;
                if (a.produto_descricao > b.produto_descricao) return 1;
                return 0;
            }

            return this.produtosDisponiveis.sort(compare);
        }
    },
    mounted: function mounted() {
        this.produtosDisponiveis = this.produtosData;
        if (this.oldData !== null) {
            for (var i = 0; i < this.oldData.length; i++) {
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
    updated: function updated() {
        $(this.$refs.inputProdutos).selectpicker('refresh');
    },

    methods: {
        validarItem: function validarItem() {
            if (this.produto_id == '' || this.produto_id <= 0) {
                this.errors.inputProdutos = true;
                this.errors.inputProdutosMsg = 'Nenhum Produto selecionado.';
                return false;
            } else {
                this.errors.inputProdutos = false;
                this.errors.inputProdutosMsg = '';
            }

            if (this.quantidade == '' || this.quantidade <= 0) {
                this.errors.inputQuantidade = true;
                this.errors.inputQuantidadeMsg = 'Informe a quantidade do produto.';
                return false;
            } else {
                this.errors.inputQuantidade = false;
                this.errors.inputQuantidadeMsg = '';
            }

            if (this.valorUnitario == '' || this.valorUnitario <= 0) {
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
        confirmDelete: function confirmDelete(index) {
            this.deleteIndex = index;
        },
        cancelDelete: function cancelDelete(index) {
            this.deleteIndex = false;
        },
        addProduto: function addProduto() {
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
        editItem: function editItem(index) {
            var item = this.items[index];
            this.quantidade = item.quantidade;
            this.valorUnitario = item.valor_unitario;
            this.desconto = item.valor_desconto;
            this.acrescimo = item.valor_acrescimo;
            this.produto_id = item.id;
            this.editing = true;
            this.editingIndex = index;
        },
        updateProduto: function updateProduto() {
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
        deleteItem: function deleteItem() {
            this.removerProduto(this.items[this.deleteIndex].id);
            this.$delete(this.items, this.deleteIndex);
        },
        limparFormulario: function limparFormulario() {
            this.produtoSelecionado = false;
            this.quantidade = '';
            this.valorUnitario = '';
            this.desconto = '';
            this.acrescimo = '';
            this.$refs.inputProdutos.focus();
        },
        totalQuantidade: function totalQuantidade() {
            var result = 0;
            for (var i = 0; i < this.items.length; i++) {
                result += this.items[i].quantidade;
            }
            return result;
        },
        totalValor: function totalValor() {
            var result = 0;
            for (var i = 0; i < this.items.length; i++) {
                result += this.items[i].valor_unitario;
            }
            return result;
        },
        totalDesconto: function totalDesconto() {
            var result = 0;
            for (var i = 0; i < this.items.length; i++) {
                result += this.items[i].valor_desconto;
            }
            return result;
        },
        totalAcrescimo: function totalAcrescimo() {
            var result = 0;
            for (var i = 0; i < this.items.length; i++) {
                result += this.items[i].valor_acrescimo;
            }
            return result;
        },
        getProdutoById: function getProdutoById(id) {
            var result = 0;
            for (var i = 0; i < this.produtosData.length; i++) {
                if (this.produtosData[i].id == id) {
                    result = this.produtosData[i];
                    break;
                }
            }
            return result;
        },
        getProdutoIndexById: function getProdutoIndexById(id) {
            var result = 0;
            for (var i = 0; i < this.produtosData.length; i++) {
                if (this.produtosData[i].id == id) {
                    result = i;
                    break;
                }
            }
            return result;
        },
        getProdutoSelecionadoById: function getProdutoSelecionadoById(id) {
            var result = 0;
            for (var i = 0; i < this.produtosSelecionados.length; i++) {
                if (this.produtosSelecionados[i].id == id) {
                    result = this.produtosSelecionados[i];
                    break;
                }
            }
            return result;
        },
        getProdutoSelecionadoIndexById: function getProdutoSelecionadoIndexById(id) {
            var result = 0;
            for (var i = 0; i < this.produtosSelecionados.length; i++) {
                if (this.produtosSelecionados[i].id == id) {
                    result = i;
                    break;
                }
            }
            return result;
        },
        incluirProduto: function incluirProduto(id) {
            this.produtosSelecionados.push(this.getProdutoById(id));
            this.$delete(this.produtosDisponiveis, this.getProdutoIndexById(id));
        },
        removerProduto: function removerProduto(id) {
            this.produtosDisponiveis.push(this.getProdutoSelecionadoById(id));
            this.$delete(this.produtosSelecionados, this.getProdutoSelecionadoIndexById(id));
        }
    }
});
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(2)))

/***/ }),

/***/ 160:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(3)
/* script */
var __vue_script__ = __webpack_require__(161)
/* template */
var __vue_template__ = __webpack_require__(162)
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/modal.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key.substr(0, 2) !== "__"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] modal.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-a5b30f46", Component.options)
  } else {
    hotAPI.reload("data-v-a5b30f46", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 161:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'modal',

  methods: {
    cancel: function cancel() {
      this.$emit('cancel');
    },
    confirm: function confirm() {
      this.$emit('confirm');
    }
  },
  props: ['modalTitle', 'modalText']
});

/***/ }),

/***/ 162:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("transition", { attrs: { name: "modal-fade" } }, [
    _c(
      "div",
      {
        staticClass: "modal fade",
        attrs: {
          id: "confirmDelete",
          role: "dialog",
          "aria-labelledby": "confirmDeleteLabel",
          "aria-hidden": "true"
        }
      },
      [
        _c("div", { staticClass: "modal-dialog" }, [
          _c("div", { staticClass: "modal-content modal-default" }, [
            _c("div", { staticClass: "modal-header" }, [
              _c(
                "button",
                {
                  staticClass: "close",
                  attrs: {
                    type: "button",
                    "data-dismiss": "modal",
                    "aria-hidden": "true"
                  }
                },
                [_vm._v("×")]
              ),
              _vm._v(" "),
              _c("div", { staticClass: "row" }, [
                _c("div", { staticClass: "col-sm-1" }, [
                  _c("span", { staticClass: "glyphicon glyphicon-alert" })
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "col" }, [
                  _c("h4", { staticClass: "modal-title" }, [
                    _c("strong", [_vm._v(_vm._s(this.modalTitle))])
                  ])
                ])
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "modal-body" }, [
              _c("p", [
                _vm._v(
                  "\n              " +
                    _vm._s(this.modalText) +
                    "                  \n            "
                )
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "modal-footer" }, [
              _c(
                "button",
                {
                  staticClass: "btn btn-danger",
                  attrs: {
                    type: "button",
                    "data-dismiss": "modal",
                    id: "confirm"
                  },
                  on: { click: _vm.confirm }
                },
                [_vm._v("Remover")]
              ),
              _vm._v(" "),
              _c(
                "button",
                {
                  staticClass: "btn btn-primary",
                  attrs: { type: "button", "data-dismiss": "modal" },
                  on: { click: _vm.cancel }
                },
                [_vm._v("Cancelar")]
              )
            ])
          ])
        ])
      ]
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-a5b30f46", module.exports)
  }
}

/***/ }),

/***/ 163:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "panel panel-default" },
    [
      _vm._m(0),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "panel-body", staticStyle: { padding: "0 !important" } },
        [
          _c(
            "table",
            {
              staticClass:
                "table table-condensed table-striped table-bordered table-hover",
              staticStyle: { "margin-bottom": "0 !important" }
            },
            [
              _vm._m(1),
              _vm._v(" "),
              _c(
                "transition-group",
                { tag: "tbody", attrs: { name: "fade" } },
                _vm._l(_vm.items, function(item, index) {
                  return _c("tr", { key: index }, [
                    _c("td", { staticClass: "col-md-1 pool-right" }, [
                      _vm._v(
                        "\n                        " +
                          _vm._s(item.id) +
                          "\n                        "
                      ),
                      _c("input", {
                        attrs: {
                          type: "hidden",
                          name: "items[" + index + "][produto_id]"
                        },
                        domProps: { value: item.id }
                      })
                    ]),
                    _vm._v(" "),
                    _c("td", { staticClass: "col-md-6" }, [
                      _vm._v(
                        "\n                        " +
                          _vm._s(item.produto_descricao) +
                          "\n                    "
                      )
                    ]),
                    _vm._v(" "),
                    _c("td", { staticClass: "col-md-1 text-right" }, [
                      _vm._v(
                        "\n                        " +
                          _vm._s(item.quantidade) +
                          "\n                        "
                      ),
                      _c("input", {
                        attrs: {
                          type: "hidden",
                          name: "items[" + index + "][quantidade]"
                        },
                        domProps: { value: item.quantidade }
                      })
                    ]),
                    _vm._v(" "),
                    _c("td", { staticClass: "col-md-1 text-right" }, [
                      _vm._v(
                        "\n                        " +
                          _vm._s(item.valor_unitario) +
                          "\n                        "
                      ),
                      _c("input", {
                        attrs: {
                          type: "hidden",
                          name: "items[" + index + "][valor_unitario]"
                        },
                        domProps: { value: item.valor_unitario }
                      })
                    ]),
                    _vm._v(" "),
                    _c("td", { staticClass: "col-md-1 text-right" }, [
                      _vm._v(
                        "\n                        " +
                          _vm._s(item.valor_desconto) +
                          "\n                        "
                      ),
                      _c("input", {
                        attrs: {
                          type: "hidden",
                          name: "items[" + index + "][valor_desconto]"
                        },
                        domProps: { value: item.valor_desconto }
                      })
                    ]),
                    _vm._v(" "),
                    _c("td", { staticClass: "col-md-1 text-right" }, [
                      _vm._v(
                        "\n                        " +
                          _vm._s(item.valor_acrescimo) +
                          "\n                        "
                      ),
                      _c("input", {
                        attrs: {
                          type: "hidden",
                          name: "items[" + index + "][valor_acrescimo]"
                        },
                        domProps: { value: item.valor_acrescimo }
                      })
                    ]),
                    _vm._v(" "),
                    _c("td", { staticClass: "col-md-1" }, [
                      _c(
                        "button",
                        {
                          directives: [
                            {
                              name: "show",
                              rawName: "v-show",
                              value: !_vm.editing,
                              expression: "!editing"
                            }
                          ],
                          staticClass: "btn-xs btn-warning",
                          attrs: { type: "button" },
                          on: {
                            click: function($event) {
                              _vm.editItem(index)
                            }
                          }
                        },
                        [
                          _c("span", {
                            staticClass: "glyphicon glyphicon-edit"
                          })
                        ]
                      ),
                      _vm._v(" "),
                      _c(
                        "button",
                        {
                          directives: [
                            {
                              name: "show",
                              rawName: "v-show",
                              value: !_vm.editing,
                              expression: "!editing"
                            }
                          ],
                          staticClass: "btn-xs btn-danger",
                          attrs: {
                            type: "button",
                            "data-toggle": "modal",
                            "data-target": "#confirmDelete"
                          },
                          on: {
                            click: function($event) {
                              _vm.confirmDelete(index)
                            }
                          }
                        },
                        [
                          _c("span", {
                            staticClass: "glyphicon glyphicon-trash"
                          })
                        ]
                      )
                    ])
                  ])
                })
              ),
              _vm._v(" "),
              this.items.length > 0
                ? _c("tfoot", [
                    _c("tr", { staticClass: "success" }, [
                      _c("td", { staticClass: "col-md-1" }, [
                        _c("strong", [_vm._v(_vm._s(this.items.length))])
                      ]),
                      _vm._v(" "),
                      _c("td", { staticClass: "col-md-6" }),
                      _vm._v(" "),
                      _c("td", { staticClass: "col-md-1 text-right" }, [
                        _c("strong", [_vm._v(_vm._s(this.totalQuantidade()))])
                      ]),
                      _vm._v(" "),
                      _c("td", { staticClass: "col-md-1 text-right" }, [
                        _c("strong", [_vm._v(_vm._s(this.totalValor()))])
                      ]),
                      _vm._v(" "),
                      _c("td", { staticClass: "col-md-1 text-right" }, [
                        _c("strong", [_vm._v(_vm._s(this.totalDesconto()))])
                      ]),
                      _vm._v(" "),
                      _c("td", { staticClass: "col-md-1 text-right" }, [
                        _c("strong", [_vm._v(_vm._s(this.totalAcrescimo()))])
                      ]),
                      _vm._v(" "),
                      _c("td", { staticClass: "col-md-2" })
                    ])
                  ])
                : _vm._e()
            ]
          )
        ]
      ),
      _vm._v(" "),
      _c("div", { staticClass: "panel-footer" }, [
        _c("div", { staticClass: "row" }, [
          _c(
            "div",
            {
              class: {
                "col-md-7": true,
                " has-error": this.errors.inputProdutos
              },
              staticStyle: {
                "padding-right": "0 !important",
                "padding-left": "0 !important"
              }
            },
            [
              _c(
                "select",
                {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.produto_id,
                      expression: "produto_id"
                    }
                  ],
                  ref: "inputProdutos",
                  staticClass: "form-control selectpicker",
                  attrs: {
                    "data-live-search": "true",
                    name: "inputProdutos",
                    id: "inputProdutos"
                  },
                  on: {
                    change: function($event) {
                      var $$selectedVal = Array.prototype.filter
                        .call($event.target.options, function(o) {
                          return o.selected
                        })
                        .map(function(o) {
                          var val = "_value" in o ? o._value : o.value
                          return val
                        })
                      _vm.produto_id = $event.target.multiple
                        ? $$selectedVal
                        : $$selectedVal[0]
                    }
                  }
                },
                [
                  _c("option", { attrs: { selected: "", value: "false" } }, [
                    _vm._v(" Nada Selecionado ")
                  ]),
                  _vm._v(" "),
                  _vm._l(_vm.produtosDisponiveisOrdenados, function(
                    produto,
                    index
                  ) {
                    return _c(
                      "option",
                      { key: index, domProps: { value: produto.id } },
                      [_vm._v(_vm._s(produto.produto_descricao))]
                    )
                  })
                ],
                2
              ),
              _vm._v(" "),
              _c(
                "span",
                {
                  staticClass: "help-block",
                  attrs: { "v-if": this.errors.inputProdutos }
                },
                [_c("strong", [_vm._v(_vm._s(this.errors.inputProdutosMsg))])]
              )
            ]
          ),
          _vm._v(" "),
          _c(
            "div",
            {
              class: {
                "col-md-1": true,
                " has-error": this.errors.inputQuantidade
              },
              staticStyle: {
                "padding-right": "0 !important",
                "padding-left": "0 !important"
              }
            },
            [
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model.number",
                    value: _vm.quantidade,
                    expression: "quantidade",
                    modifiers: { number: true }
                  }
                ],
                ref: "inputQuantidade",
                staticClass: "form-control",
                attrs: {
                  type: "number",
                  min: "0,000",
                  max: "9999999999,999",
                  step: "any",
                  name: "inputQuantidade",
                  id: "inputQuantidade"
                },
                domProps: { value: _vm.quantidade },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.quantidade = _vm._n($event.target.value)
                  },
                  blur: function($event) {
                    _vm.$forceUpdate()
                  }
                }
              }),
              _vm._v(" "),
              _c(
                "span",
                {
                  staticClass: "help-block",
                  attrs: { "v-if": this.errors.inputQuantidade }
                },
                [_c("strong", [_vm._v(_vm._s(this.errors.inputQuantidadeMsg))])]
              )
            ]
          ),
          _vm._v(" "),
          _c(
            "div",
            {
              class: {
                "col-md-1": true,
                " has-error": this.errors.inputValorUnitario
              },
              staticStyle: {
                "padding-right": "0 !important",
                "padding-left": "0 !important"
              }
            },
            [
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model.number",
                    value: _vm.valorUnitario,
                    expression: "valorUnitario",
                    modifiers: { number: true }
                  }
                ],
                ref: "inputValorUnitario",
                staticClass: "form-control",
                attrs: {
                  type: "number",
                  min: "0,000",
                  max: "9999999999,999",
                  step: "any",
                  name: "inputValorUnitario",
                  id: "inputValorUnitario"
                },
                domProps: { value: _vm.valorUnitario },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.valorUnitario = _vm._n($event.target.value)
                  },
                  blur: function($event) {
                    _vm.$forceUpdate()
                  }
                }
              }),
              _vm._v(" "),
              _c(
                "span",
                {
                  staticClass: "help-block",
                  attrs: { "v-if": this.errors.inputValorUnitario }
                },
                [
                  _c("strong", [
                    _vm._v(_vm._s(this.errors.inputValorUnitarioMsg))
                  ])
                ]
              )
            ]
          ),
          _vm._v(" "),
          _c(
            "div",
            {
              class: {
                "col-md-1": true,
                " has-error": this.errors.inputDesconto
              },
              staticStyle: {
                "padding-right": "0 !important",
                "padding-left": "0 !important"
              }
            },
            [
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model.number",
                    value: _vm.desconto,
                    expression: "desconto",
                    modifiers: { number: true }
                  }
                ],
                ref: "inputDesconto",
                staticClass: "form-control",
                attrs: {
                  type: "number",
                  min: "0,000",
                  max: "9999999999,999",
                  step: "any",
                  name: "inputDesconto",
                  id: "inputDesconto"
                },
                domProps: { value: _vm.desconto },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.desconto = _vm._n($event.target.value)
                  },
                  blur: function($event) {
                    _vm.$forceUpdate()
                  }
                }
              }),
              _vm._v(" "),
              _c(
                "span",
                {
                  staticClass: "help-block",
                  attrs: { "v-if": this.errors.inputDesconto }
                },
                [_c("strong", [_vm._v(_vm._s(this.errors.inputDescontoMsg))])]
              )
            ]
          ),
          _vm._v(" "),
          _c(
            "div",
            {
              class: {
                "col-md-1": true,
                " has-error": this.errors.inputAcrescimo
              },
              staticStyle: {
                "padding-right": "0 !important",
                "padding-left": "0 !important"
              }
            },
            [
              _c("input", {
                directives: [
                  {
                    name: "model",
                    rawName: "v-model.number",
                    value: _vm.acrescimo,
                    expression: "acrescimo",
                    modifiers: { number: true }
                  }
                ],
                ref: "inputAcrescimo",
                staticClass: "form-control",
                attrs: {
                  type: "number",
                  min: "0,000",
                  max: "9999999999,999",
                  step: "any",
                  name: "inputAcrescimo",
                  id: "inputAcrescimo"
                },
                domProps: { value: _vm.acrescimo },
                on: {
                  input: function($event) {
                    if ($event.target.composing) {
                      return
                    }
                    _vm.acrescimo = _vm._n($event.target.value)
                  },
                  blur: function($event) {
                    _vm.$forceUpdate()
                  }
                }
              }),
              _vm._v(" "),
              _c(
                "span",
                {
                  staticClass: "help-block",
                  attrs: { "v-if": this.errors.inputAcrescimo }
                },
                [_c("strong", [_vm._v(_vm._s(this.errors.inputAcrescimoMsg))])]
              )
            ]
          ),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-1" }, [
            _c(
              "button",
              {
                directives: [
                  {
                    name: "show",
                    rawName: "v-show",
                    value: !_vm.editing,
                    expression: "!editing"
                  }
                ],
                staticClass: "btn btn-success",
                attrs: { type: "button" },
                on: { click: _vm.addProduto }
              },
              [_c("span", { staticClass: "glyphicon glyphicon-plus" })]
            ),
            _vm._v(" "),
            _c(
              "button",
              {
                directives: [
                  {
                    name: "show",
                    rawName: "v-show",
                    value: _vm.editing,
                    expression: "editing"
                  }
                ],
                staticClass: "btn btn-success",
                attrs: { type: "button" },
                on: { click: _vm.updateProduto }
              },
              [_c("span", { staticClass: "glyphicon glyphicon-ok" })]
            )
          ])
        ])
      ]),
      _vm._v(" "),
      _c("modal", {
        attrs: {
          "modal-title": "Corfirmação",
          "modal-text": "Confirma a remoção deste Item?"
        },
        on: { cancel: _vm.cancelDelete, confirm: _vm.deleteItem }
      })
    ],
    1
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "panel-heading" }, [
      _c("strong", [_vm._v("Produtos")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("tr", { staticClass: "primary" }, [
        _c("th", { staticClass: "col-md-1" }, [_vm._v("Id")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-md-6" }, [_vm._v("Produto")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-md-1" }, [_vm._v("Qtd")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-md-1" }, [_vm._v("Vlr. Un.")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-md-1" }, [_vm._v("Vlr. Desc.")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-md-1" }, [_vm._v("Vlr. Acres.")]),
        _vm._v(" "),
        _c("th", { staticClass: "col-md-1" }, [_vm._v("Ações")])
      ])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-c5957a84", module.exports)
  }
}

/***/ }),

/***/ 3:
/***/ (function(module, exports) {

/* globals __VUE_SSR_CONTEXT__ */

// this module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle

module.exports = function normalizeComponent (
  rawScriptExports,
  compiledTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier /* server only */
) {
  var esModule
  var scriptExports = rawScriptExports = rawScriptExports || {}

  // ES6 modules interop
  var type = typeof rawScriptExports.default
  if (type === 'object' || type === 'function') {
    esModule = rawScriptExports
    scriptExports = rawScriptExports.default
  }

  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (compiledTemplate) {
    options.render = compiledTemplate.render
    options.staticRenderFns = compiledTemplate.staticRenderFns
  }

  // scopedId
  if (scopeId) {
    options._scopeId = scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = injectStyles
  }

  if (hook) {
    var functional = options.functional
    var existing = functional
      ? options.render
      : options.beforeCreate
    if (!functional) {
      // inject component registration as beforeCreate hook
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    } else {
      // register for functioal component in vue file
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return existing(h, context)
      }
    }
  }

  return {
    esModule: esModule,
    exports: scriptExports,
    options: options
  }
}


/***/ })

},[156]);