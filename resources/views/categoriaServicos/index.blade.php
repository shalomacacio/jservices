@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Categoria Serviço</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Cadastros</a></li>
              <li class="breadcrumb-item active">Nova Categoria Serviço</li>
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
            <h3 class="card-title">Nova Categoria</h3>
          </div>
          <form role="form" action="{{ route('categoriaServicos.store') }}" method="POST">
          <!-- /.card-header -->
          <div class="card-body">
            @csrf
            <div class="row">

              <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                  <label>Descricao</label>
                  <input type="text" class="form-control" name="descricao" placeholder="descricao"  required>
                </div>
              </div>

              <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                  <label>Pontuação</label>
                  <input type="text" class="form-control" name="pontuacao"  required>
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
                  <th>Pontuação</th>
                  <th style="width: 150px">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($categoriaServicos as $categoria)
                  <tr>
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->descricao }}</td>
                    <td>{{ $categoria->pontuacao }}</td>
                    <td>
                      <form action="{{route('categoriaServicos.destroy', $categoria->id)}}" method="POST">
                        <a class="btn btn-info" href="{{route('categoriaServicos.edit', $categoria->id)}}"  ><i class="fas fa-edit"></i></a>
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger"  type="submit"  onclick="return confirm('Excluir Usuário ?')"><i class="fas fa-trash"></i></button>
                      </form>
                    </td>
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
