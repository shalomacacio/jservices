<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Observação</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" id="formCancelar">
        @csrf
        @method('PUT')
      <div class="modal-body">

        <div class="col-12 col-sm-12 col-md-12">
          <!-- text input -->
          <div class="form-group">
          <textarea class="form-control" name="obs" rows="3" placeholder="Descreva o motivo" required></textarea>
          </div>
        </div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" >Cancelar Solicitação</button>
        <input type="hidden" name="status_solicitacao_id" value="4" />
      </div>
    </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
