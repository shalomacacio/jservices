@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Reagendar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Solicitação</a></li>
              <li class="breadcrumb-item active">Reagendar</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
                <!-- general form elements disabled -->
                <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Reagendar Solicitacao</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <form role="form" action="{{ route('solicitacao.reatribuir') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Cliente</label>
                            <input type="text" class="form-control" name="cliente" value="{{$solicitacao->nome_razaosocial}}" disabled>
                        </div>
                        </div>
                        <div class="col-sm-4">
                        <!-- select -->
                        <div class="form-group">
                            <label>Serviço</label>
                        <input type="text" class="form-control" name="categoria_servico_id" value="{{$solicitacao->categoriaServico->descricao}}" disabled>
                        </div>
                        </div>

                        <div class="col-sm-4">
                          <!-- select -->
                          <div class="form-group">
                              <label>Data Agendamento</label>
                          <input type="date" class="form-control" name="dt_agendamento" value="{{ \Carbon\Carbon::parse($solicitacao->dt_agendamento)->format('Y-m-d')}}" >
                          </div>
                          </div>
                    </div>
                </div>
                    <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info float-right">Reagendar</button>
                </div>
                <!-- /.card-body -->
                </div>
                    <input type="hidden" name="solicitacao_id" value="{{$solicitacao->id}}"/>
                </form>
            <!-- /.card -->
            <!-- general form elements disabled -->
              </div>
            </div>

        </section>
    </div>
</div>

@endsection
