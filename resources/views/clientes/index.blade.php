@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cliente</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Cliente</a></li>
              <li class="breadcrumb-item active">Novo Cliente</li>
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
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
                <!-- general form elements disabled -->
                <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Novo Cliente</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <form role="form" action="{{ route('clientes.store') }}" method="POST">
                    @csrf

                    <div class="row">
                      <div class="col-12 col-sm-12 col-md-3">
                            <label>Codigo</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <button type="button" id="search" class="btn btn-info"><i class="fas fa-search">
                                    </i></button>
                                </div>
                                <!-- /btn-group -->
                                <input type="text" class="form-control"  name="codpessoa" id="codpessoa">
                              </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-9">
                        <!-- text input -->
                          <div class="form-group">
                              <label>Nome / Razão Social</label>
                              <input type="text" class="form-control" name="nome_razaosocial" id="typeahead"  required>
                          </div>
                        </div>


                    </div><!-- /.row -->

                    <div class="row">

                      <div class="col-12 col-sm-12 col-md-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Data Nascimento</label>
                          <input type="date" class="form-control" name="dt_nascimento" id="dt_nascimento"  required>
                        </div>
                      </div>

                      <div class="col-12 col-sm-12 col-md-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>CPF</label>
                          <input type="text" class="form-control" name="cpf" id="cpf"  required>
                        </div>
                      </div>

                      <div class="col-12 col-sm-12 col-md-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Telefone</label>
                          <input type="text" class="form-control" name="tel" id="tel"  required>
                        </div>
                      </div>

                      <div class="col-12 col-sm-12 col-md-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Celular</label>
                          <input type="text" class="form-control" name="cel" id="cel"  required>
                        </div>
                      </div>
                    </div>

                    <div class="row">

                      <div class="col-12 col-sm-12 col-md-5">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Endereco</label>
                          <input type="text" class="form-control" name="endereco" id="endereco" required>
                        </div>
                      </div>

                      <div class="col-12 col-sm-12 col-md-1">
                        <!-- text input -->
                        <div class="form-group">
                          <label>N°</label>
                          <input type="text" class="form-control" name="num" id="num" required>
                        </div>
                      </div>

                      <div class="col-12 col-sm-12 col-md-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Bairro</label>
                          <input type="text" class="form-control" name="bairro" id="bairro" required>
                        </div>
                      </div>

                      <div class="col-12 col-sm-12 col-md-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Cidade</label>
                          <input type="text" class="form-control" name="cidade" id="cidade" required>
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
                <input type="hidden" value="{{Auth::user()->id}}" name="user_id" />
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
                                <h3 class="card-title">Clientes</h3>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table class="table table-sm table-striped table-hover table-bordered " >
                            <thead>
                              <tr>
                                <th class="d-none d-sm-table-cell"style="width: 100px">Data </th>
                                <th>Cliente</th>
                                <th class="d-none d-sm-table-cell" style="width: 100px">CPF </th>
                                <th style="width: 100px">Ações </th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($clientes as $cliente)
                              <tr>
                                <td class="d-none d-sm-table-cell" >{{ \Carbon\Carbon::parse($cliente->created_at)->format('d/m/Y') }}</td>
                                <td>{{ $cliente->nome_razaosocial }}</td>
                                <td class="d-none d-sm-table-cell" >{{ $cliente->cpf }}</td>
                                <td>
                                  <form action="{{route('clientes.destroy', $cliente->id)}}" method="POST">
                                    <a class="btn btn-info" href="{{route('clientes.edit', $cliente->id)}}"  ><i class="fas fa-edit"></i></a>
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger"  type="submit"  onclick="return confirm('Excluir Cliente ?')"><i class="fas fa-trash"></i></button>
                                  </form>
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                          <ul class="pagination pagination-sm m-0 float-right">
                            {{-- {{ $comissaos->render() }} --}}
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
