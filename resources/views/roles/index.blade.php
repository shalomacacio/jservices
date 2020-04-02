@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Grupo</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Grupos</a></li>
            <li class="breadcrumb-item active">Novo Grupo</li>
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
          <h3 class="card-title">Novo Serviço</h3>
        </div>
        <form role="form" action="{{ route('roles.store') }}" method="POST">
          @csrf
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              @include('roles.form')
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
              <h3 class="card-title">Grupos Cadastrados</h3>
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

                    <th style="width: 120px">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($roles as $role)
                  <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>

                    <td>
                      <form action="{{route('roles.destroy', $role->id)}}" method="POST">
                      <a class="btn btn-info btn-sm" href="{{route('roles.edit', $role->id)}}"><i class="fas fa-edit"></i></a>
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Excluir Usuário ?')"><i class="fas fa-trash"></i></button>
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
