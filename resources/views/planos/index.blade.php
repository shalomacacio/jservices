@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Planos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Cadastros</a></li>
              <li class="breadcrumb-item active">Novo Plano</li>
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
            <h3 class="card-title">Novo Serviço</h3>
          </div>
          <form role="form" action="{{ route('planos.store') }}" method="POST">
            @csrf
          <!-- /.card-header -->
          <div class="card-body">

           <div class="row">

              <div class="col-12 col-sm-12 col-md-6">
                <!-- text input -->
                <div class="form-group">
                  <label>Plano</label>
                  <input type="text" class="form-control" name="descricao" required>
                </div>
              </div>

              <div class="col-12 col-sm-12 col-md-3">
                <!-- text input -->
                <div class="form-group">
                  <label>Valor</label>
                  <input type="text" class="form-control" name="vlr_plano" placeholder="" >
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
                <h3 class="card-title">Serviços Cadastrados</h3>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                  <th style="width: 10px">#</th>
                  <th>Descrição</th>
                  <th>Valor</th>
                  <th style="width: 120px">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($planos as $plano)
                  <tr>
                    <td>{{ $plano->id }}</td>
                    <td>{{ $plano->descricao }}</td>
                    <td>{{ $plano->vlr_plano }}</td>
                    <td>
                      <form action="{{route('planos.destroy', $plano->id)}}" method="POST">
                        <a class="btn btn-info btn-sm" href="{{route('planos.edit', $plano->id)}}"  ><i class="fas fa-edit"></i></a>
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"  type="submit"  onclick="return confirm('Excluir Usuário ?')"><i class="fas fa-trash"></i></button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            </div><!-- /.card-body -->
          </div><!-- /.card -->
        </div><!-- /.col-m12 -->
      </div><!-- /.row -->
    </section>
</div>
@endsection
