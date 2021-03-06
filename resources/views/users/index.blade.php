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
    @include('layouts.alerts')
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="col-md-12">
        <!-- general form elements disabled -->
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">Novo Usuário</h3>
          </div>
          <form role="form" action="{{ route('users.store') }}" method="POST">
          <!-- /.card-header -->
          <div class="card-body">
            @csrf
            <div class="row">

              <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                  <label>Nome</label>
                  <input type="text" class="form-control" name="name" placeholder="Nome do usuarios ..." required>
                </div>
              </div>

              <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                  <label>Sobrenome</label>
                  <input type="text" class="form-control" name="sobrenome" placeholder="da Silva  ..." required>
                </div>
              </div>

              <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email" placeholder="fulano@jnetce.com.br" required>
                </div>
              </div>

              <div class="col-sm-2">
                <!-- text input -->
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password" required >
                </div>
              </div>

              <div class="col-sm-1">
                <!-- text input -->
                <div class="form-group">
                  <label>Pontos</label>
                  <input type="text" class="form-control" name="max_ponto" >
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

      <div class="row">
        <div class="col-md-12">
          <div class="card">

            <div class="card-header">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Usuários Cadastrados</h3>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                  <th style="width: 10px">#</th>
                  <th>Nome</th>
                  <th>Email</th>
                  <th>Grupos</th>
                  <th style="width: 170px">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                  <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }} {{ $user->sobrenome }}</td>
                    <td>{{ $user->email}}</td>
                    <td>
                      @foreach ($user->roles as $role)
                      {{ $role->name }} <br>
                      @endforeach
                    </td>
                    <td>
                      <form action="{{route('users.destroy', $user->id)}}" method="POST">
                        <a class="btn btn-info" href="{{route('users.edit', $user->id)}}"  ><i class="fas fa-edit"></i></a>
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
