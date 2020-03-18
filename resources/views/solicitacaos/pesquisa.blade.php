@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Solicitacoes</h1>
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
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">Pesquisar Solicitações </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form role="form" action="{{ route('solicitacoes.resultPesquisa') }}" method="GET">
            <div class="row">
              <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                  <label>Data Início</label>
                  <input type="date" class="form-control" name="dt_inicio" >
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Data Fim</label>
                  <input type="date" class="form-control" name="dt_fim" >
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label> Cliente </label>
                  <input type="text" class="form-control" name="nome_cliente" >
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-sm-4">
                <!-- checkbox -->
                <div class="form-group">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipo_pesquisa" value="1" checked>
                    <label class="form-check-label">Por Data</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipo_pesquisa" value="2">
                    <label class="form-check-label">Por Nome</label>
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

