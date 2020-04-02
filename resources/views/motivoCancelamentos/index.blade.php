@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Motivo Cancelamento</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Cadastros</a></li>
              <li class="breadcrumb-item active">Motivo Cancelamento</li>
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
            <h3 class="card-title">Motivo Cancelamento</h3>
          </div>
          <form role="form" action="{{ route('motivoCancelamento.store') }}" method="POST">
            @csrf
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Descricao</label>
                    <input type="text" class="form-control" name="descricao" placeholder="descricao" required>
                  </div>
                </div>
              </div><!-- /.row -->
            </div><!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary float-right">Adicionar</button>
            </div>

          </form>
        </div><!-- /.card warning-->
      </div><!-- /.col-m12 -->

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Categorias Cadastradas</h3>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                  <th style="width: 10px">#</th>
                  <th>Descrição</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($motivoCancelamentos as $motivo)
                  <tr>
                    <td>{{ $motivo->id }}</td>
                    <td>{{ $motivo->descricao }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div><!-- /.card-body -->
          </div><!-- /.card -->
        </div><!-- /.col-m12 -->
      </div><!-- /.row -->
    </section>
</div>
@endsection
