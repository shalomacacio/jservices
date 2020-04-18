@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pesquisar Adesão </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">relatorio</a></li>
              <li class="breadcrumb-item active">adesao</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->

      {{-- alerts --}}
      @include('layouts.alerts')
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="col-md-12">
      <!-- general form elements disabled -->
      <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Relatório de Comissões </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form role="form" action="{{ route('reports.relAdesao') }}" method="GET">
            <div class="row">
              <div class="col-sm-2">
                <!-- text input -->
                <div class="form-group">
                  <label>Data Início</label>
                  <input type="date" class="form-control" name="dt_inicio" required>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <label>Data Fim</label>
                  <input type="date" class="form-control" name="dt_fim" required>
                </div>
              </div>
              <div class="col-sm-3">
                <!-- select -->
                <div class="form-group">
                  <label>Consultor</label>
                  <select class="form-control" name="funcionario_id">
                    <option value="0">-- TODOS --</option>
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-sm-3">
                <!-- select -->
                <div class="form-group">
                  <label>Técnico</label>
                  <select class="form-control" name="tecnico_id">
                    <option value="0">-- TODOS --</option>
                    @foreach($tecnicos as $tecnico)
                    <option value="{{$tecnico->id}}">{{$tecnico->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-sm-2">
                <!-- select -->
                <div class="form-group">
                  <label>Serviço</label>
                  <select class="form-control" name="servico_id">
                    <option value="0">-- TODOS --</option>
                    @foreach($servicos as $servico)
                    <option value="{{$servico->id}}">{{$servico->descricao}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

            </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary float-right">Pesquisar</button>
        </div>
        <!-- /.card-body -->
      </form>
      </div>
      <!-- /.card -->
      <!-- general form elements disabled -->
      <!-- /.card -->
    </div>
    </section>
</div>

@endsection
