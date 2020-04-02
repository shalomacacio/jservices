@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Escala</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Cadastro</a></li>
              <li class="breadcrumb-item active">Nova Escala</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
                <!-- general form elements disabled -->
                <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Nova Escala</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <form role="form" action="{{ route('escalas.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Data:</label>
                            <input type="date" class="form-control" name="dt_escala"  required>
                        </div>
                        </div>

                        <div class="col-sm-4">
                            <!-- select -->
                            <div class="form-group">
                                <label>Colaboradores</label>
                                <select multiple class="form-control" name="users[]" required>
                                    @foreach( $users as $user)
                                        <option value="{{ $user->id}}">{{ $user->name }} {{ $user->sobrenome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info float-right">Adicionar</button>
                </div>
                <!-- /.card-body -->
                </div>
                </form>
            <!-- /.card -->
            <!-- general form elements disabled -->
              </div>
            </div>

            <div class="row">
            <div class="col-md-12">
              <div class="card">

                <div class="card-header">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title">Escalas Cadastradas</h3>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                      <th>Data</th>
                      <th>Colaboradores</th>
                      <th>Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($escalas as $escala)
                      <tr>
                        <td>{{ \Carbon\Carbon::parse($escala->dt_escala)->format('d/m/Y') }}</td>
                        <td>
                          @foreach ($escala->users as $user)
                            {{$user->name}} {{$user->sobrenome}}  /
                          @endforeach
                        </td>
                        <td>
                          <form action="{{route('escalas.destroy', $escala->id)}}" method="POST">
                            <a class="btn btn-sm btn-info" href="{{route('escalas.edit', $escala->id)}}"  ><i class="fas fa-edit"></i></a>
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"  type="submit"  onclick="return confirm('Excluir Escala ?')"><i class="fas fa-trash"></i></button>
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
</div>

@endsection
