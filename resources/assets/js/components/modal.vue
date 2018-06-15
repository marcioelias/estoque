<template>
    <transition name="modal-fade">
        <div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content modal-default">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="row">
                    <div class="col-sm-1"><span class="glyphicon glyphicon-alert"></span></div>
                    <div class="col"><h4 class="modal-title"><strong>{{this.modalTitle}}</strong></h4></div>
                </div>
              </div>
              <div class="modal-body">
                <p>
                  {{ this.modalText }}                  
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="confirm" @click="confirm">Remover</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" @click="cancel">Cancelar</button>        
              </div>
            </div>
          </div>
        </div>
    </transition>
</template>

<script>
  export default {
    name: 'modal',

    methods: {
      cancel() {
        this.$emit('cancel');
      },
      confirm() {
        this.$emit('confirm');
      }
    },
    props: [
      'modalTitle',
      'modalText'
    ]
  };
</script>