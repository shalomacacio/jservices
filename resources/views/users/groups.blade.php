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
              <li class="breadcrumb-item"><a href="#">Cadastros</a></li>
              <li class="breadcrumb-item active">Novo Serviço</li>
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
        <form role="form" action="{{ route ('user.groups.store')}}" method="POST" >
          <!-- /.card-header -->
          <div class="card-body">
            @csrf
           <div class="row">

              <div class="col-sm-3">
                <div class="form-group">
                  <label>Categoria</label>
                  <select class="form-control" name="role_id" required>
                    @foreach( $roles as $role)
                      <option value="{{ $role->id}}">{{ $role->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-sm-12">
              <!-- checkbox -->
              @foreach($permissions as $permission)

              {{-- @if(($loop->iteration%3) == 0 ) --}}
              <div class="col-sm-6">
                <!-- checkbox -->
                <div class="form-group clearfix">

                  <div class="icheck-primary d-inline">
                  <input type="checkbox" id="permissions" name="permissions[]" value="{{$permission->id}}">
                    <label for="permissions"> {{ $permission->readable_name}} </label>
                  </div>

                  {{-- <div class="icheck-primary d-inline">
                    <input type="checkbox" id="checkboxPrimary2">
                    <label for="checkboxPrimary2"> {{ $permission->readable_name}}  </label>
                  </div>

                  <div class="icheck-primary d-inline">
                    <input type="checkbox" id="checkboxPrimary3" disabled>
                    <label for="checkboxPrimary3">Deletar</label>
                  </div> --}}

                </div>
              </div>
              {{-- @endif --}}
              @endforeach
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
              <table class="table table-bordered">
                <thead>
                  <tr>
                  <th>Grupo</th>
                  <th>Permissoes</th>
                  <th style="width: 170px">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($roles as $role)
                  <tr>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->name }}</td>
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
