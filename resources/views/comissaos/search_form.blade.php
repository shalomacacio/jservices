<div class="row">
  <div class="col-md-12 col-sm-12 col-12">
    <div class="callout callout-info">

        <form action="{{ route('comissao.autorizarComissoes')}}" method="GET">
          <div class="row">
            <div class="col-6">
                <div class="pull-right input-group-sm" style="width: 200px;">
                  <select class="form-control" name="grupo" >
                    <option value="">--Selecione--</option>
                    <option value="1">SERVIÇOS</option>
                    <option value="2">SUPORTE</option>
                    <option value="3">CANCELAMENTO</option>
                    <option value="4">VEND EQUIPAMENTO</option>
                  </select>
                </div>
            </div>
            <div class="col-6">
              <div class="input-group input-group-sm" style="width: 200px;">
                <input type="date" name="dt_fim" class="form-control" placeholder="Search" @isset($request) value="{{\Carbon\Carbon::parse($request->dt_fim)->format('Y-m-d')}}" @endisset required>
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                </div>
              </div>
            </div>
          </div>
        </form>
    </div>
  </div>
</div>
