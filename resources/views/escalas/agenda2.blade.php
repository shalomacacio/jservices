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
                    <th data-column-id="os" data-width="80px">O.S</th>
                    <th data-column-id="cliente" data-width="300px">Cliente</th>
                    <th data-column-id="descricao">Serviço</th>
                    <th data-column-id="atendente">Atend/Vendedor</th>
                    <th data-column-id="turno">Turno</th>
                    <th data-column-id="tecnico">Técnico</th>
                    <th data-column-id="status">Status</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($ordens as $os)
                  <tr>
                    <td> {{ $os->codos}}</td>
                    <td> @if($os->mkPessoa) {{ $os->mkPessoa->nome_razaosocial }} @endif</td>
                    <td>{{ $os->mkOsTipo->descricao }}</td>
                    <td>@if($os->consultor) {{ $os->consultor->nome_razaosocial }}@endif</td>
                    <td>
                      @if( $os->hora_ent_lab < 12 )
                        Manhã
                      @else
                        Tarde
                      @endif
                    </td>
                    {{-- <td>@isset($os->tecnico->nome_razaosocial){{ $os->tecnico->nome_razaosocial }}@endisset</td> --}}

                      @switch($os->status)
                        @case(1)
                        <td><code>Aberto</code></td>
                        @break
                        @case(2)
                        <td>Encaminhado</td>
                        @break
                        @case(3)dat
                        <td>Encerrado</td>
                        @break
                      @endswitch

                  </tr>
                @endforeach
                </tbody>
              </table>

            </div>
            <!-- /.card-body -->
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
