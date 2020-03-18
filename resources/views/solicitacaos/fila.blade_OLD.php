@extends('layouts.master')

@section('css')
<!-- Bootgrid -->
<link rel="stylesheet" href="/dist/plugins/bootgrid/jquery.bootgrid.css">
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Fila de Atendimento</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Solicitação</a></li>
              <li class="breadcrumb-item active">Fila </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->

      @if(Session::has('message'))
      <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-check"></i>Sucesso</h5>
          {{Session::get('message')}}
      </div>
      @elseif($errors->any())
      <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-check"></i>Erro</h5>
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
            <div class="row">
                    <div class="col-md-12">
                      <div class="card card-info">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</h3>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <div class="table-responsive">
                          <table id="grid-basic" class="table table-condensed table-hover table-striped">
                            <thead>
                              <tr>
                                <th data-column-id="data">Data</th>
                                <th data-column-id="cliente">Cliente</th>
                                <th data-column-id="descricao">Serviço</th>
                                <th data-column-id="atendente">Atend/Vendedor</th>
                                <th data-column-id="turno">Turno</th>
                                <th data-column-id="tecnico">Equipe</th>
                                <th data-column-id="status">Status</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach ($solicitacaos as $solicitacao)
                              <tr>
                                <td>{{ \Carbon\Carbon::parse($solicitacao->dt_agendamento)->format('d-m') }}</td>
                                <td>{{ $solicitacao->nome_razaosocial }}</td>
                                <td>{{ $solicitacao->categoriaServico->descricao }}</td>
                                <td>{{ $solicitacao->user->name }}</td>
                                <td>@if( $solicitacao->turno == 1 ) MANHÃ @else TARDE @endif</td>
                                <td>
                                  @foreach ($solicitacao->users as $tecnico)
                                    {{$tecnico->name }}
                                  @endforeach
                                </td>
                                <td> {{ $solicitacao->statusSolicitacao->descricao }} </td>

                              </tr>
                            @endforeach
                            </tbody>
                          </table>
                          </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                          <ul class="pagination pagination-sm m-0 float-right">
                                {{ $solicitacaos->render() }}
                          </ul>
                        </div>
                      </div>
                      <!-- /.card -->
                    </div>
        </section>
    </div>
</div>

@endsection

@section('javascript')
<!-- Bootgrid -->
<script src="/dist/plugins/bootgrid/jquery.bootgrid.js"></script>

<script type="text/javascript">
  $("#grid-basic").bootgrid({
    // columnSelection: true,
    // keepSelection: true,
    // navigation: 1,
    // rowCount	: 20,
      labels: {
          all: "Tudo",
          loading: "Aguardando...",
          noResults: "Nenhum resultado encontrado!",
          refresh: "Refresh",
          search: "Filtro"
      },
      formatters: {
        "commands": function(column, row)
        {
            return "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-pencil\"></span></button> " +
                "<button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-trash-o\"></span></button>";
        }
      }
  });
  </script>

@stop
