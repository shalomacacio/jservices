@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Solicitação</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Solicitação</a></li>
              <li class="breadcrumb-item active">Nova Solicitação</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->

      {{-- alerts --}}
      @include('layouts.alerts')
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
                    <h3 class="card-title">Nova Solicitação</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <form id="form" role="form" action="{{ route('solicitacao.store') }}" method="POST">
                    @csrf

                    <div class="row">
                      <div class="col-12 col-sm-12 col-md-2">
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

                        <div class="col-12 col-sm-12 col-md-4">
                          <div class="form-group">
                            <label>Cliente</label>
                             <input type="text" class="form-control" name="nome_razaosocial" id="typeahead" data-provide="typeahead" data-items="4" >
                          </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-2">
                          <!-- select -->
                          <div class="form-group">
                              <label>Vend/Atend</label>
                              <select class="form-control" name="user_atendimento_id" id="user_atendimento_id"  required>
                                <option value="0">-- Selecione --</option>
                                @foreach( $users as $user)
                                      <option value="{{ $user->id}}">{{ $user->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-2">
                            <!-- select -->
                            <div class="form-group">
                                <label>Origem</label>
                                <select class="form-control" name="origem_venda_id" id="origem_venda_id"  required>
                                  <option value="0">-- Selecione --</option>
                                  @foreach( $origens as $origem)
                                        <option value="{{ $origem->id}}">{{ $origem->descricao}}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-2">
                            <!-- select -->
                            <div class="form-group">
                                <label>Categoria</label>
                                <select class="form-control" name="categoria_servico_id" id="categoria_servico_id"  required>
                                  <option value="0">-- Selecione --</option>
                                  @foreach( $categorias as $categoria)
                                        <option value="{{ $categoria->id}}">{{ $categoria->descricao}}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                    </div>
                    <div class="row">
                      <div class="col-12 col-sm-12 col-md-2 plano migracao upgrade" hidden>
                        <!-- select -->
                        <div class="form-group">
                            <label>Plano</label>
                            <select class="form-control" name="plano_id" id="plano_id" >
                                <option value="0">--Selecione--</option>
                                @foreach ($planos as $plano)
                                  <option value={{$plano->id}}>{{$plano->descricao}}</option>
                                @endforeach
                            </select>
                        </div>
                      </div>

                      <div class="col-12 col-sm-12 col-md-2 upgrade" hidden>
                        <!-- select -->
                        <div class="form-group">
                            <label>Plano Anterior</label>
                            <select class="form-control" name="plano_ant_id" id="plano_ant_id" >
                                <option value="0">--Selecione--</option>
                                @foreach ($planos as $plano)
                                  <option value={{ $plano->id }}>{{ $plano->descricao }}</option>
                                @endforeach
                            </select>
                        </div>
                      </div>

                      <div class="col-12 col-sm-12 col-md-2 plano migracao" hidden>
                        <!-- text input -->
                        <div class="form-group">
                            <label>Valor</label>
                            <input type="text" class="form-control" name="vlr_plano" id="vlr_plano"  readonly >
                        </div>
                      </div>

                      <div class="col-12 col-sm-12 col-md-2 upgrade" hidden>
                        <!-- text input -->
                        <div class="form-group">
                            <label>Valor Dif</label>
                            <input type="text" class="form-control" name="vlr_plano_dif" id="vlr_plano_dif"  readonly >
                        </div>
                      </div>

                    <div class="col-12 col-sm-12 col-md-2 plano migracao" hidden>
                    <!-- select -->
                      <div class="form-group">
                        <label>Tecnologia</label>
                        <select class="form-control" name="tecnologia_id">
                          <option value="0">--Selecione--</option>
                          @foreach ($tecnologias as $tecnologia)
                            <option value={{$tecnologia->id}}>{{$tecnologia->descricao}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-2 plano migracao" hidden>
                      <!-- select -->
                      <div class="form-group">
                          <label>Forma Pag</label>
                          <select class="form-control" name="tipo_pagamento_id">
                              <option value="0">--Selecione--</option>
                              @foreach ($tipoPagamentos as $tipo)
                              <option value={{$tipo->id}}>{{$tipo->descricao}}</option>
                            @endforeach
                          </select>
                      </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-2 plano " hidden>
                      <!-- select -->
                      <div class="form-group">
                          <label>Equipamentos</label>
                          <select class="form-control" name="tipo_aquisicao_id">
                              <option value="0">--Selecione--</option>
                              @foreach ($tipoAquisicaos as $tipo)
                                <option value={{$tipo->id}}>{{$tipo->descricao}}</option>
                              @endforeach
                          </select>
                      </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-2 plano " hidden>
                        <!-- select -->
                        <div class="form-group">
                            <label>Como coheceu ?</label>
                            <select class="form-control" name="tipo_midia_id" >
                                <option value="0">--Selecione--</option>
                                @foreach ($tipoMidia as $tipo)
                                  <option value={{$tipo->id}}>{{$tipo->descricao}}</option>
                                @endforeach
                            </select>
                        </div>
                      </div>
                    </div>

                  <div class="row">
                      <div class="col-12 col-sm-12 col-md-8">
                        <!-- textarea -->
                        <div class="form-group">
                        <label>Observação</label>
                        <textarea class="form-control" name="obs" rows="1" placeholder="Observação ..."></textarea>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-4">
                      <!-- text input -->
                      <div class="form-group">
                          <label>Agendar para:<param name="" value=""></label>
                          <input type="date" class="form-control" name="dt_agendamento"  >
                      </div>
                    </div>
                  </div>
                    <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info float-right">Adicionar</button>
                </div>
                <!-- /.card-body -->
                </div>
                <input type="hidden"  name="comissao_atendimento" />
              <input type="hidden"    name="user_id" id="user_id" value="{{ Auth::user()->id }}" />
                <input type="hidden"  name="cliente_id" id="cliente_id" />
                <input type="hidden"  name="comissao_equipe" />
                <input type="hidden"  name="comissao_supervisor" />

              </form>
              <!-- /.card -->
              <!-- general form elements disabled -->
              </div>
            </div>
            <!-- /.row -->
        </section>
    </div>
</div>

@endsection
