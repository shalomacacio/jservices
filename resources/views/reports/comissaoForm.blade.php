@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pesquisar </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Pesquisar</a></li>
              <li class="breadcrumb-item active">Solicitacoes</li>
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
          <form role="form" action="{{ route('reports.comissoes') }}" method="GET">
            <div class="row">
              <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                  <label>Data Início</label>
                  <input type="date" class="form-control" name="dt_inicio" required>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Data Fim</label>
                  <input type="date" class="form-control" name="dt_fim" required>
                </div>
              </div>
              <div class="col-sm-4">
                <!-- select -->
                <div class="form-group">
                  <label>Colaborador</label>
                  <select class="form-control" name="funcionario_id">
                    <option value="0">-- TODOS --</option>
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-sm-4">
                <!-- checkbox -->
                <div class="form-group">

                  <div class="form-check">
                    <input type="checkbox" name="roles[]" value="2" />
                    <label class="form-check-label">Atendimento</label>
                  </div>

                  <div class="form-check">
                    <input type="checkbox" name="roles[]" value="5" />
                    <label class="form-check-label">Tecnico</label>
                  </div>

                  <div class="form-check">
                    <input type="checkbox" name="roles[]" value="8" />
                    <label class="form-check-label">Consultor</label>
                  </div>

                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-4">
                <!-- checkbox -->
                <div class="form-group">

                  <div class="form-check">
                    <input type="checkbox" name="flags[]" value="1" />
                    <label class="form-check-label"> Autorizados</label>
                  </div>

                  <div class="form-check">
                    <input type="checkbox" name="flags[]" value="0" />
                    <label class="form-check-label">Não Autorizados</label>
                  </div>

                  <div class="form-check">
                    <input type="checkbox" name="flags[]" value="3" />
                    <label class="form-check-label">Aguardando</label>
                  </div>

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
