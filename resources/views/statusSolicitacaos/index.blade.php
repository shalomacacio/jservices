@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Status Solicitacao</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Cadastros</a></li>
              <li class="breadcrumb-item active">Novo Status</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->

      {{-- alerts --}}
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
      <div class="col-md-12">
        <!-- general form elements disabled -->
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">Novo Status</h3>
          </div>
          <form role="form" action="{{ route('statusSolicitacao.store') }}" method="POST">
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
                  <th style="width: 150px">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($statusSolicitacaos as $status)
                  <tr>
                    <td>{{ $status->id }}</td>
                    <td>{{ $status->descricao }}</td>
                    <td>
                      <form action="{{route('statusSolicitacao.destroy', $status->id)}}" method="POST">
                        <a class="btn btn-info" href="{{route('statusSolicitacao.edit', $status->id)}}"  ><i class="fas fa-edit"></i></a>
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
