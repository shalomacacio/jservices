@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pesquisar Minhas Comissões</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Comissao</a></li>
              <li class="breadcrumb-item active">Pesquisar</li>
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
          <h3 class="card-title">Comissões por Período</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form role="form" action="{{ route('comissao.search') }}" method="GET">
            <div class="row">
              <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                  <label>Data Início:</label>
                  <input type="date" class="form-control" name="dt_inicio" required>
                </div>
              </div>
              <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                  <label>Data Fim:</label>
                  <input type="date" class="form-control" name="dt_fim" required>
                </div>
              </div>
            </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary float-right">Pesquisar</button>
        </div>
        <!-- /.card-body -->
      </form>
      </div>

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Comissões </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Data</th>
                <th>Cliente</th>
                <th>Serviço </th>
                <th>Colaborador</th>
                <th>Valor</th>
                <th>Ações </th>
              </tr>
            </thead>
            <tbody>
              @isset($comissaos )
                @foreach ($comissaos as $comissao)
                    <tr>
                        <td>{{ $comissao->id }}</td>
                        <td>{{ $comissao->dt_referencia }}</td>
                        <td>{{ $comissao->solicitacao->mkPessoa->nome_razaosocial }}</td>
                        <td>{{ $comissao->user->name}} {{ $comissao->user->sobrenome}}</td>
                        <td>{{ $comissao->comissao_vlr}}</td>
                        <td>
                            <form action="{{ route('comissao.autorizar', $comissao->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-danger"  type="submit"  onclick="return confirm('Anular Comissao ?')"   name = "flg_autorizado" value="3" >Anular</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
              @endisset
            </tbody>
          </table>
        </div>
        <!-- /.card -->
    </div>
    </section>
</div>

@endsection
