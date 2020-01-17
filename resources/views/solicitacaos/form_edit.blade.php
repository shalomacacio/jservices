@isset($solicitacao->codpessoa)
<div class="col-12 col-sm-12 col-md-2">
  <label>Codigo</label>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <button type="button" id="search" class="btn btn-info">
        <i class="fas fa-search"></i>
      </button>
    </div>
    <!-- /btn-group -->
    <input type="text" class="form-control" name="codpessoa" id="codpessoa" value="{{$solicitacao->codpessoa}}">
  </div>
</div>
@endisset

@isset($solicitacao->nome_razaosocial)
<div class="col-12 col-sm-12 col-md-4">
  <div class="form-group">
    <label>Cliente</label>
    <input type="text" class="form-control" name="nome_razaosocial" id="typeahead"
    value="{{$solicitacao->nome_razaosocial}}" data-provide="typeahead" data-items="4" >
  </div>
</div>
@endisset

@isset($solicitacao->user_atendimento_id)
<div class="col-12 col-sm-12 col-md-2">
  <!-- select -->
  <div class="form-group">
    <label>Vend/Atend</label>
    <select class="form-control" name="user_atendimento_id" id="user_atendimento_id" required>
      <option value="{{$solicitacao->user->id}}">{{$solicitacao->user->name}}</option>
      @foreach( $users as $user)
      <option value="{{ $user->id}}">{{ $user->name}}</option>
      @endforeach
    </select>
  </div>
</div>
@endisset

@if($solicitacao->origem_venda_id != 0)
<div class="col-12 col-sm-12 col-md-2">
  <!-- select -->
  <div class="form-group">
    <label>Origem Venda</label>
    <select class="form-control" name="origem_venda_id" id="origem_venda_id" required>
      <option value="{{ $solicitacao->origem->id}}">{{ $solicitacao->origem->descricao}}</option>
      @foreach( $origens as $origem)
      <option value="{{ $origem->id}}">{{ $origem->descricao}}</option>
      @endforeach
    </select>
  </div>
</div>
@endif

@isset($solicitacao->categoria_servico_id)
<div class="col-12 col-sm-12 col-md-2">
  <!-- select -->
  <div class="form-group">
    <label>Categoria</label>
    <select class="form-control" name="categoria_servico_id" id="categoria_servico_id" required>
      <option value="{{ $solicitacao->categoriaServico->id }}">{{ $solicitacao->categoriaServico->descricao }}</option>
      @foreach( $categorias as $categoria)
      <option value="{{ $categoria->id}}">{{ $categoria->descricao}}</option>
      @endforeach
    </select>
  </div>
</div>
@endisset

@if($solicitacao->servico_id != 0)
<div class="col-12 col-sm-12 col-md-4 transferencia" >
  <!-- select -->
  <div class="form-group">
      <label>Serviço</label>
      <select class="form-control" name="servico_id" id="servico_id"  required>
        <option value={{$solicitacao->servico->id}}>{{$solicitacao->servico->descricao}}</option>
      </select>
  </div>
</div>
@endif

@if($solicitacao->plano_id != 0)
<div class="col-12 col-sm-12 col-md-2 plano migracao upgrade" >
  <!-- select -->
  <div class="form-group">
    <label>Plano</label>
    <select class="form-control" name="plano_id" id="plano_id">
      <option value={{$solicitacao->plano->id}}>{{$solicitacao->plano->descricao}}</option>
      @foreach ($planos as $plano)
      <option value={{$plano->id}}>{{$plano->descricao}}</option>
      @endforeach
    </select>
  </div>
</div>
@endif

@if($solicitacao->plano_ant_id != 0)
<div class="col-12 col-sm-12 col-md-2 upgrade" >
  <!-- select -->
  <div class="form-group">
    <label>Plano Anterior</label>
    <select class="form-control" name="plano_ant_id" id="plano_ant_id">
      <option value={{ $solicitacao->planoAnt->id }}>{{ $solicitacao->planoAnt->descricao }}</option>
      @foreach ($planos as $plano)
      <option value={{ $plano->id }}>{{ $plano->descricao }}</option>
      @endforeach
    </select>
  </div>
</div>
@endif

@if($solicitacao->vlr_plano > 0)
<div class="col-12 col-sm-12 col-md-2 plano migracao">
  <!-- text input -->
  <div class="form-group">
    <label>Valor</label>
    <input type="text" class="form-control" name="vlr_plano" id="vlr_plano" readonly
      value="{{ $solicitacao->plano->vlr_plano }}"
    >
  </div>
</div>
@endif

@if($solicitacao->vlr_plano_dif > 0)
<div class="col-12 col-sm-12 col-md-2 upgrade" >
  <!-- text input -->
  <div class="form-group">
    <label>Valor Dif</label>
    <input type="text" class="form-control" name="vlr_plano_dif" id="vlr_plano_dif" readonly
    value="{{ $solicitacao->vlr_plano_dif }}"
    >
  </div>
</div>
@endif

@if($solicitacao->tecnologia_id != 0)
<div class="col-12 col-sm-12 col-md-2 plano migracao" >
  <!-- select -->
  <div class="form-group">
    <label>Tecnologia</label>
    <select class="form-control" name="tecnologia_id">
      <option value={{$solicitacao->tecnologia->id}}>{{$solicitacao->tecnologia->descricao}}</option>
      @foreach ($tecnologias as $tecnologia)
      <option value={{$tecnologia->id}}>{{$tecnologia->descricao}}</option>
      @endforeach
    </select>
  </div>
</div>
@endif

@if($solicitacao->tipo_pagamento_id != 0)
<div class="col-12 col-sm-12 col-md-2 plano migracao" >
  <!-- select -->
  <div class="form-group">
    <label>Forma Pag</label>
    <select class="form-control" name="tipo_pagamento_id">
      <option value={{$solicitacao->tipoPagamento->id}}>{{$solicitacao->tipoPagamento->descricao}}</option>
      @foreach ($tipoPagamentos as $tipo)
      <option value={{$tipo->id}}>{{$tipo->descricao}}</option>
      @endforeach
    </select>
  </div>
</div>
@endif

@if($solicitacao->tipo_aquisicao_id != 0)
<div class="col-12 col-sm-12 col-md-2 plano" >
  <!-- select -->
  <div class="form-group">
    <label>Equipamentos</label>
    <select class="form-control" name="tipo_aquisicao_id">
      <option value={{$solicitacao->tipoAquisicao->id}}>{{$solicitacao->tipoAquisicao->descricao}}</option>
      @foreach ($tipoAquisicaos as $tipo)
      <option value={{$tipo->id}}>{{$tipo->descricao}}</option>
      @endforeach
    </select>
  </div>
</div>
@endif

@if($solicitacao->tipo_midia_id != 0)
<div class="col-12 col-sm-12 col-md-2 plano" >
  <!-- select -->
  <div class="form-group">
    <label>Canal Venda</label>
    <select class="form-control" name="tipo_midia_id">
      <option value={{$solicitacao->tipoMidia->id}}>{{$solicitacao->tipoMidia->descricao}}</option>
      @foreach ($tipoMidia as $tipo)
      <option value={{$tipo->id}}>{{$tipo->descricao}}</option>
      @endforeach
    </select>
  </div>
</div>
@endif

@isset($solicitacao->obs)
<div class="col-12 col-sm-12 col-md-8 ">
  <!-- textarea -->
  <div class="form-group">
    <label>Observação</label>
  <textarea class="form-control" name="obs" rows="1">{{$solicitacao->obs}}</textarea>
  </div>
</div>
@endisset


<div class="col-12 col-sm-12 col-md-4">
  <!-- text input -->
  <div class="form-group">
    <label>Agendar para:
      <param name="" value=""></label>
    <input type="date" class="form-control" name="dt_agendamento"
    value="{{ \Carbon\Carbon::parse($solicitacao->dt_agendamento)->format('Y-d-m')}}"
    >
  </div>
</div>

