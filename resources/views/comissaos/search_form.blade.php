<div class="row">
  <div class="col-md-12 col-sm-12 col-12">
    <div class="callout callout-info">
      <center>
        <form action="{{ route('comissao.minhasComissoes')}}" method="GET">
          <div class="input-group input-group-sm" style="width: 200px;">
            <input type="date" name="dt_fim" class="form-control" placeholder="Search" @isset($request) value="{{\Carbon\Carbon::parse($request->dt_fim)->format('Y-m-d')}}" @endisset required>
            <div class="input-group-append">
              <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
            </div>
          </div>
        </form>
      </center>
    </div>
  </div>
</div>
