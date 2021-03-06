@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="/dist/plugins/select2/select2.min.css">
<link rel="stylesheet" href="/dist/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@stop

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pesquisar Contratos </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">relatorio</a></li>
              <li class="breadcrumb-item active">contratos</li>
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
          <h3 class="card-title">Filtro de Contratos </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form role="form" action="{{ route('reports.relContCanc') }}" method="GET">
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
            </div>
            {{-- row flags --}}
            {{-- <div class="row">
              <div class="col-sm-4">
                <!-- checkbox -->
                <div class="form-group">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipo_pesquisa" value="1" checked>
                    <label class="form-check-label">Por Data Adesão</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipo_pesquisa" value="2">
                    <label class="form-check-label">Por Data Encerramento</label>
                  </div>
                </div>
              </div>
            </div> --}}
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary float-right">Pesquisar</button>
        </div>
      </form>
      </div>
    </div>
    </section>
</div>

@endsection


@section('javascript')
<!-- Bootgrid -->
<script src="/dist/plugins/select2/select2.full.min.js"></script>

<script type="text/javascript">
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
</script>
@stop

