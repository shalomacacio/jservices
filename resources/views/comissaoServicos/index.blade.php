@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Comissão Serviço</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Cadastros</a></li>
              <li class="breadcrumb-item active">Nova Comissão Serviço</li>
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
            <h3 class="card-title">Nova comissão Serviço</h3>
          </div>
          <form role="form" action="{{ route('comissaoServicos.store') }}" method="POST">
          <!-- /.card-header -->
          <div class="card-body">
            @csrf
            <div class="row">

              <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                  <label>Descrição</label>
                  <input type="text" class="form-control" name="descricao" placeholder="Nome do serviço ..." required>
                </div>
              </div>

              <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                  <label>Valor</label>
                  <input type="text" class="form-control" name="vlr" placeholder="" >
                </div>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <label>Tipo Comissão </label>
                  <select class="form-control" name="tipo_comissao_id" required>
                    @foreach( $tipoComissaos as $tipo)
                      <option value="{{ $tipo->id}}">{{ $tipo->descricao}}</option>
                    @endforeach
                  </select>
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
                <h3 class="card-title">Comissões Cadastradas</h3>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
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
                  @foreach ($comissaoServicos as $comissao)
                  <tr>
                    <td>{{ $comissao->id }}</td>
                    <td>{{ $comissao->descricao }}</td>
                    <td>@if($comissao->tipo_comissao_id == 1){{ $comissao->tipoComissao->descricao }}@endif {{ $comissao->vlr }} @if($comissao->tipo_comissao_id == 2){{ $comissao->tipoComissao->descricao }}@endif </td>
                    <td>
                    <form action="{{route('comissaoServicos.destroy', $comissao->id)}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger float-right" onclick="return confirm('Deseja excluir ?')" ><i class="fas fa-trash">
                      </i></button>
                    </form>
                    <a type="button" class="btn btn-warning float-left" href="{{route('comissaoServicos.edit', $comissao->id)}}" ><i class="fas fa-edit">
                    </i> </a>
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
