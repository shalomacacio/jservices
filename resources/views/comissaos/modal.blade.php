<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Motivo</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('comissao.nAutorizar', $comissao->id)}}" method="POST">
        @csrf
        @method('PUT')
      <div class="modal-body">

        <div class="col-12 col-sm-12 col-md-12">
          <!-- text input -->
          <div class="form-group">
            <textarea class="form-control" name="motivo" rows="3" placeholder="Ex: não assinou termo "></textarea>
          </div>
        </div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary"  name = "flg_autorizado" value="0">Não Autorizar</button>
      </div>
    </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
