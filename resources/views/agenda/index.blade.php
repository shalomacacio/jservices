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
      @include('agenda.search_form')
      {{-- @include('escalas.widget') --}}
    </div><!-- /.container-fluid -->

    {{-- alerts --}}
    @include('layouts.alerts')
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        @foreach ($comps as $funcionario => $comp)
        <div class="col-md-6">
          <div class="card card-info">
            <div class="card-header">
              <div class="d-flex justify-content-between">
              <h3 class="card-title">{{ $funcionario }} </h3>
              <div class="card-tools">
                {{ $comp->count()}}
              </div>
              </div>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
              <table id="grid-basic" class="table table-condensed table-hover table-striped">
                <thead>
                  <tr>
                    <th data-column-id="cliente" data-width="300px">Cliente</th>
                    <th data-column-id="descricao">Bairro</th>
                    <th data-column-id="descricao">Serviço</th>
                    <th data-column-id="status">Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($comp as $c)
                  <tr
                    @switch($c->ultimo_status_app_mk)
                        @case("001")
                            style="background-color: orange"
                            @break
                        @case("002")
                            style="background-color: palegreen"
                            @break
                        @case("011")
                            style="background-color: red"
                            @break
                        @default
                            style="background-color: gray"
                    @endswitch
                  >
                    <td> {!! \Illuminate\Support\Str::before($c->com_titulo, 'Aberta')  !!} </td>
                    <td title="{{$c->logradouro}} , {{ $c->num_endereco}}">  {{$c->bairro}} </td>
                    <td> {!! \Illuminate\Support\Str::after($c->servico, ')')  !!} </td>
                    <td> {!! \Illuminate\Support\Str::before($c->ultimo_status_app_mk_tx, 'O.S')  !!} </td>
                    <td> {!!  $c->classificacao !!} </td>
                  </tr>
                  <tfoot>
                </tfoot>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        @endforeach
      </div><!-- /.row -->
  </section>
</div>
</div>

@endsection

@section('javascript')
<!-- Bootgrid -->
<script src="/dist/plugins/bootgrid/jquery.bootgrid.js"></script>

{{-- <script type="text/javascript">
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
</script> --}}
@stop
