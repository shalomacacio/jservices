<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Motivo</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formNautorizar" method="POST">
          @csrf
          @method('PUT')
        <div class="modal-body">

          <div class="col-12 col-sm-12 col-md-12">
            <!-- text input -->
            <div class="form-group">
              <textarea class="form-control" name="obs" id="obs" rows="3" ></textarea>
            </div>
          </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary"  name = "status_comissao" value="2">Não Autorizar</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
