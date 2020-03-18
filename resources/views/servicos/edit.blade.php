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
            <h3 class="card-title">Editar Serviço</h3>
          </div>
          <form role="form" action="{{ route('servicos.update', $servico->id) }}" method="POST">
          <!-- /.card-header -->
          <div class="card-body">
            @csrf
            @method('PUT')
           <div class="row">

              <div class="col-sm-3">
                <div class="form-group">
                  <label>Categoria</label>
                  <select class="form-control" name="categoria_servico_id" required>
                    <option value="{{ $servico->categoria_servico_id}}">{{ $servico->categoriaServico->descricao}}</option>
                    @foreach( $categorias as $categoria)
                      <option value="{{ $categoria->id}}">{{ $categoria->descricao}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                  <label>Serviço</label>
                <input type="text" class="form-control" name="descricao" value="{{$servico->descricao}}" required>
                </div>
              </div>

              <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                  <label>Valor</label>
                  <input type="text" class="form-control" name="servico_vlr"  value="{{$servico->servico_vlr}}" >
                </div>
              </div>

              <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                  <label>Pontos</label>
                  <input type="text" class="form-control" name="pontuacao"  value="{{$servico->pontuacao}}"  >
                </div>
              </div>

              <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                  <label>Comissão Atendimento</label>
                  <input type="text" class="form-control" name="comissao_atendimento"  value="{{$servico->comissao_atendimento}}"  >
                </div>
              </div>


              <div class="col-sm-1">
                  <!-- checkbox -->
                  <div class="form-group">
                    <br/>
                    @foreach($tipoComissaos as $tipo)
                    <div class="form-check">
                    <input class="form-check-input" name="tipo_comissao_atendimento"
                    value="{{$tipo->id}}" type="checkbox" @if($tipo->id == $servico->tipo_comissao_atendimento) checked @endif>
                    <label class="form-check-label">{{ $tipo->descricao }}</label>
                    </div>
                    @endforeach
                  </div>
                </div>

              <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                  <label>Comissão Equipe</label>
                  <input type="text" class="form-control" name="comissao_equipe"  value="{{$servico->comissao_equipe}}" >
                </div>
              </div>

              <div class="col-sm-1">
                  <!-- checkbox -->
                  <div class="form-group">
                    <br/>
                    @foreach($tipoComissaos as $tipo)
                    <div class="form-check">
                    <input class="form-check-input" name="tipo_comissao_equipe"
                    value="{{$tipo->id}}" type="checkbox" @if($tipo->id == $servico->tipo_comissao_equipe) checked @endif >
                    <label class="form-check-label">{{ $tipo->descricao }}</label>
                    </div>
                    @endforeach
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
    </section>
</div>

@endsection
