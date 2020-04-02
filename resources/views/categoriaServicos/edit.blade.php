@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar Categoria Serviço</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Cadastros</a></li>
              <li class="breadcrumb-item active">Editar Categoria Serviço</li>
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
            <h3 class="card-title">Editar Categoria</h3>
          </div>
          <form role="form" action="{{ route('categoriaServicos.update', $categoriaServico->id) }}" method="POST">
            @csrf
            @method('PUT')
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">

              <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                  <label>Descricao</label>
                <input type="text" class="form-control" name="descricao" placeholder="descricao" value="{{$categoriaServico->descricao}}" required>
                </div>
              </div>

              <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                  <label>Pontuação</label>
                  <input type="text" class="form-control" name="pontuacao" value="{{$categoriaServico->pontuacao}}"   required>
                </div>
              </div>

            </div><!-- /.row -->
          </div><!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary float-right">Concluir</button>
          </div>
          </form>
        </div><!-- /.card warning-->
      </div><!-- /.col-m12 -->
    </section>
</div>

@endsection
