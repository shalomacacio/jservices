@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Cadastros</a></li>
              <li class="breadcrumb-item active">Novo Usuário</li>
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
            <h3 class="card-title">Novo Usuário</h3>
          </div>
          <form role="form" action="{{ route('users.update', $user->id) }}" method="POST">
          <!-- /.card-header -->
          <div class="card-body">
            @csrf
            @method('PUT')
            <div class="row">

              <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                  <label>Nome</label>
                <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                </div>
              </div>

              <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                  <label>Sobrenome</label>
                  <input type="text" class="form-control" name="sobrenome"  value="{{ $user->sobrenome }}" required>
                </div>
              </div>

              <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email"  value="{{ $user->email }}" required>
                </div>
              </div>

              <div class="col-sm-1">
                <!-- text input -->
                <div class="form-group">
                  <label>Pontos</label>
                  <input type="text" class="form-control" name="max_ponto" value="{{ $user->max_ponto }}" >
                </div>
              </div>

            </div><!-- /.row -->
            <div class="row">
              <div class="col-sm-12">
              <!-- checkbox -->
              @foreach($roles as $role)

              {{-- @if(($loop->iteration%3) == 0 ) --}}
              <div class="col-sm-6">
                <!-- checkbox -->
                <div class="form-group clearfix">

                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="roles" name="roles[]" value="{{$role->id}}" >
                    <label for="roles"> {{ $role->name}} </label>
                  </div>
                </div>
              </div>
              {{-- @endif --}}
              @endforeach
            </div>
            </div>
          </div><!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary float-right">Adicionar</button>
          </div>
          </form>
        </div><!-- /.card warning-->
      </div><!-- /.col-m12 -->
    </section>
</div>

@endsection
