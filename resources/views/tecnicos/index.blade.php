@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Técnico</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Cadastro</a></li>
              <li class="breadcrumb-item active">Novo Técnico</li>
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
                    <h3 class="card-title">Novo Técnico</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <form role="form" action="{{ route('tecnico.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="nome" placeholder="primeiro nome..." required>
                        </div>
                        </div>

                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Sobrenome</label>
                                <input type="text" class="form-control" name="sobrenome" placeholder="sobrenome..." required>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="email...">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Telefone</label>
                                <input type="text" class="form-control" name="telefone" placeholder="telefone..."required>
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
                                <h3 class="card-title">Técnicos</h3>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th style="width: 10px">#</th>
                                <th>NOME</th>
                                <th style="width: 40px">EMAIL</th>
                                <th style="width: 40px">TELEFONE </th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($tecnicos as $tecnico)
                                    <tr>
                                        <td>{{ $tecnico->id }}</td>
                                        <td>{{ $tecnico->nome }} {{ $tecnico->sobrenome }}</td>
                                        <td>{{ $tecnico->email }}</td>
                                        <td>{{ $tecnico->telefone }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                          <ul class="pagination pagination-sm m-0 float-right">
                                {{-- {{ $tecnicos->render() }} --}}
                          </ul>
                        </div>
                      </div>
                      <!-- /.card -->
                    </div>
            </div><!-- /.row -->
        </section>
    </div>
</div>

@endsection
