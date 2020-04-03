@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Encaminhar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Solicitação</a></li>
              <li class="breadcrumb-item active">Encaminhar</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
                <!-- general form elements disabled -->
                <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Encaminhar para Técnico</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <form role="form" action="{{ route('solicitacao.atribuir') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Cliente</label>
                            <input type="text" class="form-control" name="cliente" value="{{ $solicitacao->nome_razaosocial }}" disabled>
                        </div>
                        </div>
                        <div class="col-sm-4">
                        <!-- select -->
                        <div class="form-group">
                            <label>Serviço</label>
                        <input type="text" class="form-control" name="servico_id" value="{{$solicitacao->categoriaServico->descricao}}" disabled>
                        </div>
                        </div>

                        <div class="col-sm-4">
                            <!-- select -->
                            <div class="form-group">
                                <label>Equipe</label>
                                <select multiple class="form-control" name="equipe[]" required>
                                    @foreach( $tecnicos as $tecnico)
                                        <option value="{{ $tecnico->id}}">{{ $tecnico->name }} {{ $tecnico->sobrenome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                          <!-- select -->
                          <div class="form-group">
                              <label>Informações do Ticket</label>
                          <textarea class="form-control" name="obs" disabled> {{ $solicitacao->obs }} </textarea>
                          </div>
                        </div>
                    </div>
                </div>
                    <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info float-right">Atribuir Equipe</button>
                </div>
                <!-- /.card-body -->
                </div>
                    <input type="hidden" name="solicitacao_id" value="{{$solicitacao->id}}"/>
                </form>
            <!-- /.card -->
            <!-- general form elements disabled -->
              </div>
            </div>

        </section>
    </div>
</div>

@endsection
