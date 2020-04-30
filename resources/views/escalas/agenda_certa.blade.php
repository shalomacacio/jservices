@extends('layouts.master')

@section('css')
<!-- Bootgrid -->
<link rel="stylesheet" href="/dist/plugins/bootgrid/jquery.bootgrid.css">
@stop

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">

      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>AGENDA</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Solicitacoes</a></li>
            <li class="breadcrumb-item active"> Agenda </li>
          </ol>
        </div>
      </div>
      @include('escalas.search_form2')
      @include('escalas.widget')
    </div><!-- /.container-fluid -->

    {{-- alerts --}}
    @include('layouts.alerts')
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-info">
            <div class="card-header">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Serviços</h3>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <table id="grid-basic" class="table table-condensed table-hover table-striped">
                <thead>
                  <tr>
                    <th data-column-id="cliente">Cliente</th>
                    <th data-column-id="descricao">Serviço</th>
                    <th data-column-id="atendente">Atend/Vendedor</th>
                    <th data-column-id="turno">Turno</th>
                    <th data-column-id="tecnico">Técnico</th>
                    <th data-column-id="status">Status</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($solicitacoes as $solicitacao)
                  <tr>
                    <td>{{ $solicitacao->cliente }}</td>
                    <td>{{ $solicitacao->descricao }}</td>
                    <td>{{ $solicitacao->funcionario }}</td>
                    <td>@if( $solicitacao->turno == 1 ) MANHÃ @else TARDE @endif</td>
                    <td>{{ $solicitacao->tecnico }}</td>
                    <td> {{ $solicitacao->status }} </td>
                  </tr>
                @endforeach
                </tbody>
              </table>

            </div>
            <!-- /.card-body -->
            <!-- /.card-footer -->
            <div class="card-footer clearfix">
              <div class="row">
                <!-- /.col -->
                <div class="col-3">
                  <p class="lead">Serviços Por  Atendente</p>
                  <div class="table-responsive">
                    <table class="table">
                      @foreach ($porAtend as $funcionario => $item )
                      <tr>
                        <th style="width:50%">{{ $funcionario }}:</th>
                      <td>{{ $item->count() }}</td>
                      </tr>
                      @endforeach
                    </table>
                  </div>
                </div>
                <!-- /.col -->
                <!-- /.col -->
                <div class="col-3">
                  <p class="lead">Total Por Serviço</p>
                  <div class="table-responsive">
                    <table class="table">
                      @foreach ($porServ as $servico => $item )
                      <tr>
                        <th style="width:50%">{{ $servico }}:</th>
                      <td>{{ $item->count() }}</td>
                      </tr>
                      @endforeach
                    </table>
                  </div>
                </div>
                <!-- /.col -->
                <!-- /.col -->
                <div class="col-3">
                  <p class="lead">Total Por Tecnico</p>
                  <div class="table-responsive">
                    <table class="table">
                      @foreach ($porTec as $tecnico => $item )
                      <tr>
                        <th style="width:50%">{{ $tecnico }}:</th>
                        <td>{{ $item->count() }}</td>
                      </tr>
                      @endforeach
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
      </div><!-- /.row -->

  </section>
</div>
</div>

@endsection

@section('javascript')
<!-- Bootgrid -->
<script src="/dist/plugins/bootgrid/jquery.bootgrid.js"></script>

<script type="text/javascript">
$("#grid-basic").bootgrid({
  columnSelection: false,
    keepSelection: false,
    navigation: 1,
    rowCount	: -1,
    labels: {
        all: "Tudo",
        loading: "Aguardando...",
        noResults: "Nenhum resultado encontrado!",
        refresh: "Refresh",
        search: "Filtro"
    }
});
</script>
@stop
