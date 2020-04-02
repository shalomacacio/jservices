@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ordem de Serviço </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Ordem de Serviço</a></li>
              <li class="breadcrumb-item active">Nova OS</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      {{-- alerts --}}
    @include('layouts.alerts')
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
                <!-- general form elements disabled -->
                <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Nova Solicitação</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <form role="form" action="{{ route('solicitacao.update' , $solicitacao->id )}}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                      <div class="col-12 col-sm-12 col-md-2">
                            <label>Codigo</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <button type="button" id="search" class="btn btn-info"><i class="fas fa-search">
                                    </i></button>
                                </div>
                                <!-- /btn-group -->
                                <input type="text" class="form-control"  name="codpessoa" value="{{$solicitacao->codpessoa}}" id="codpessoa" >
                              </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-4">
                        <!-- text input -->
                          <div class="form-group">
                              <label>Cliente</label>
                              <input type="text" class="form-control" name="cliente" id="cliente" value="{{$solicitacao->cliente->nome_razaosocial}}" disabled>
                          </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-2">
                          <!-- select -->
                          <div class="form-group">
                              <label>Categoria</label>
                              <input type="text" class="form-control" name="categoria_servico_id" id="categoria_servico_id" value="{{$solicitacao->servico->categoriaServico->descricao}}" disabled>
                          </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-2">
                          <!-- select -->
                          <div class="form-group">
                              <label>Serviço</label>
                              <input type="text" class="form-control" name="servico_id" id="servico_id" value="{{$solicitacao->servico->descricao}}" disabled>

                          </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-2">
                          <!-- text input -->
                          <div class="form-group">
                              <label>Valor</label>
                              <input type="text" class="form-control" name="servico_vlr" id="servico_vlr" value="{{$solicitacao->servico_vlr}}"  disabled>
                          </div>
                          </div>
                    </div><!-- /.row -->
                    <div class="row">
                      <div class="col-12 col-sm-12 col-md-2">
                      <!-- select -->
                        <div class="form-group">
                          <label>Tecnologia</label>
                          <input type="text" class="form-control" name="tecnologia_id" id="tecnologia_id" value="{{$solicitacao->tecnologia->descricao}}" disabled>
                        </div>
                      </div>

                      <div class="col-12 col-sm-12 col-md-2">
                        <!-- select -->
                        <div class="form-group">
                            <label>Forma de Pag</label>
                            <input type="text" class="form-control" name="tecnologia_id" id="tecnologia_id" value="{{$solicitacao->tipoPagamento->descricao}}" disabled>
                        </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-2">
                        <!-- select -->
                        <div class="form-group">
                            <label>Equipamentos</label>
                            <input type="text" class="form-control" name="tipo_aquisicao_id" id="tipo_aquisicao_id" value="{{$solicitacao->tipoAquisicao->descricao}}" disabled>
                        </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-3">
                          <!-- select -->
                          <div class="form-group">
                              <label>Como coheceu ?</label>
                              <input type="text" class="form-control" name="tipo_midia_id" id="tipo_midia_id" value="{{$solicitacao->tipoMidia->descricao}}" disabled>

                          </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-3">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Agendar para:<param name="" value=""></label>
                                <input type="date" class="form-control" name="dt_agendamento" value="{{\Carbon\Carbon::parse($solicitacao->dt_agendamento)->format('Y-m-d') }}"  disabled>
                            </div>
                          </div>


                            <div class="col-12 col-sm-12 col-md-5">
                            <!-- textarea -->
                            <label>Endereço</label>
                            <div class="form-group">
                              <!-- /btn-group -->
                            <input type="text" class="form-control"  name="endereco"  id="endereco" value="{{ $solicitacao->cliente->endereco }}" disabled>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-1">
                          <!-- text input -->
                          <div class="form-group">
                              <label>Num</label>
                              <input type="text" class="form-control"  name="num"  id="num" value="{{ $solicitacao->cliente->num }}" disabled>                          </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-3">
                          <!-- text input -->
                          <div class="form-group">
                              <label>Bairro</label>
                              <input type="text" class="form-control"  name="bairro"  id="bairro" value="{{ $solicitacao->cliente->bairro }}" disabled>                          </div>
                        </div>


                        <div class="col-12 col-sm-12 col-md-3">
                          <!-- text input -->
                          <div class="form-group">
                              <label>Cidade</label>
                              <input type="text" class="form-control"  name="cidade"  id="cidade" value="{{ $solicitacao->cliente->cidade }}" disabled>                          </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12">
                          <div class="form-group">
                            <label>Observação</label>
                            <textarea class="form-control" name="obs" rows="1" placeholder="Observação ..." disabled></textarea>
                          </div>
                        </div>
                    </div>
                </div>
                    <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info float-right">Integrar</button>
                </div>
                <!-- /.card-body -->
                </div>
                <input type="hidden" value="{{Auth::user()->id}}" name="user_id" />
                <input type="hidden"  name="comissao_atendimento" />
                <input type="hidden"  name="comissao_equipe" />
                <input type="hidden"  name="comissao_supervisor" />
                </form>
            <!-- /.card -->
            <!-- general form elements disabled -->
              </div>
            </div>
        </section>
    </div>
</div>

@endsection
