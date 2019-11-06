@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Serviços</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Serviços</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <!-- general form elements disabled -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Novo Serviço</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form role="form" action="{{ route('servico.store') }}" method="POST">
                @csrf
                  <div class="row">

                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Serviço</label>
                        <input type="text" class="form-control" name="descricao" placeholder="Nome do serviço ...">
                      </div>
                    </div>

                    <!-- checkbox -->
                    <div class="col-sm-12">
                    <div class="form-group">
                      <div class="form-check">
                        <input class="form-check-input" name="flg_comissao" type="checkbox" value="0">
                        <label class="form-check-label">Gera Comissão ?</label>
                      </div>
                    </div>
                    </div>

                  </div>
              </div>
              <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">Adicionar</button>
                    </div>
                </form>

            </div>
            <!-- /.card -->
            <!-- general form elements disabled -->
              </div>
            </div>
        </section>
    </div>
</div>

@endsection
