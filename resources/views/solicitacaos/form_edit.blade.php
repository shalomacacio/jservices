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
      data-provide="typeahead" data-items="4" value="{{ $solicitacao->nome_razaosocial }}" required>
  </div>
</div>
@endisset

@isset($solicitacao->user_atendimento_id)
<div class="col-12 col-sm-12 col-md-2">
  <!-- select -->
  <div class="form-group">
    <label>Vend/Atend</label>
    <select class="form-control" name="user_atendimento_id" id="user_atendimento_id" required>
      <option value="{{ $solicitacao->user_atendimento_id}}">{{ $solicitacao->user->name}}</option>
      @foreach( $users as $user)
      <option value="{{ $user->id}}">{{ $user->name}}</option>
      @endforeach
    </select>
  </div>
</div>
@endisset

@isset($solicitacao->origem_venda_id)
<div class="col-12 col-sm-12 col-md-2">
  <!-- select -->
  <div class="form-group">
    <label>Origem</label>
    <select class="form-control" name="origem_venda_id" id="origem_venda_id" required>
      <option value="{{ $solicitacao->origem_venda_id }}">{{ $solicitacao->origem->descricao }}</option>
      @foreach( $origens as $origem)
      <option value="{{ $origem->id}}">{{ $origem->descricao}}</option>
      @endforeach
    </select>
  </div>
</div>
@endisset

@isset($solicitacao->categoria_servico_id)
<div class="col-12 col-sm-12 col-md-2">
  <!-- select -->
  <div class="form-group">
    <label>Categoria</label>
    <select class="form-control" name="categoria_servico_id" id="categoria_servico_id" required>
      <option value="{{ $solicitacao->categoria_servico_id }}">{{ $solicitacao->categoriaServico->descricao}}</option>
      @foreach( $categorias as $categoria)
      <option value="{{ $categoria->id}}">{{ $categoria->descricao}}</option>
      @endforeach
    </select>
  </div>
</div>
@endisset

@if($solicitacao->servico_id )
<div class="col-12 col-sm-12 col-md-4 transferencia puxada" >
  <!-- select -->
  <div class="form-group">
      <label>Serviço</label>
      <select class="form-control" name="servico_id" id="servico_id" >
        <option value="{{ $solicitacao->servico_id}}">{{ $solicitacao->servico->descricao}}</option>
      </select>
  </div>
</div>
@endif

@isset($solicitacao->plano_id )
<div class="col-12 col-sm-12 col-md-3 plano migracao upgrade cancelamento" >
  <!-- select -->
  <div class="form-group">
    <label>Plano</label>
    <select class="form-control" name="plano_id" id="plano_id">
      <option value={{$solicitacao->plano_id}}>{{$solicitacao->plano->descricao}}</option>
      @foreach ($planos as $plano)
      <option value={{$plano->id}}>{{$plano->descricao}}</option>
      @endforeach
    </select>
  </div>
</div>
@endisset

@isset($solicitacao->plano_ant_id)
<div class="col-12 col-sm-12 col-md-3 upgrade" >
  <!-- select -->
  <div class="form-group">
    <label>Plano Anterior</label>
    <select class="form-control" name="plano_ant_id" id="plano_ant_id">
      <option value={{$solicitacao->plano_ant_id}}>{{$solicitacao->planoAnt->descricao}}</option>
      @foreach ($planos as $plano)
      <option value={{ $plano->id }}>{{ $plano->descricao }}</option>
      @endforeach
    </select>
  </div>
</div>
@endisset

@isset($solicitacao->vlr_plano)
<div class="col-12 col-sm-12 col-md-3 plano migracao" >
  <!-- text input -->
  <div class="form-group">
    <label>Valor Plano</label>
    <input type="text" class="form-control" name="vlr_plano" id="vlr_plano"
      value="{{ $solicitacao->vlr_plano }}" readonly>
  </div>
</div>
@endisset

@isset($solicitacao->vlr_plano_dif)
<div class="col-12 col-sm-12 col-md-3 upgrade" >
  <!-- text input -->
  <div class="form-group">
    <label>Valor Dif</label>
    <input type="text" class="form-control" name="vlr_plano_dif" id="vlr_plano_dif"
    value="{{ $solicitacao->vlr_plano_dif }}" readonly>
  </div>
</div>
@endisset

@isset($solicitacao->tecnologia_id)
<div class="col-12 col-sm-12 col-md-3 plano migracao" >
  <!-- select -->
  <div class="form-group">
    <label>Tecnologia</label>
    <select class="form-control" name="tecnologia_id">
      <option value={{ $solicitacao->tecnologia_id }}>{{$solicitacao->tecnologia->descricao}}</option>
      @foreach ($tecnologias as $tecnologia)
      <option value={{$tecnologia->id}}>{{$tecnologia->descricao}}</option>
      @endforeach
    </select>
  </div>
</div>
@endisset

@isset($solicitacao->tipo_aquisicao_id)
<div class="col-12 col-sm-12 col-md-3 plano " >
  <!-- select -->
  <div class="form-group">
    <label>Equipamentos</label>
    <select class="form-control" name="tipo_aquisicao_id">
      <option value={{$solicitacao->tipo_aquisicao_id}}>{{$solicitacao->tipoAquisicao->descricao}}</option>
      @foreach ($tipoAquisicaos as $tipo)
      <option value={{$tipo->id}}>{{$tipo->descricao}}</option>
      @endforeach
    </select>
  </div>
</div>
@endisset

@isset($solicitacao->tipo_pagamento_id)
<div class="col-12 col-sm-12 col-md-3 plano migracao" >
  <!-- select -->
  <div class="form-group">
    <label>Forma Pag</label>
    <select class="form-control" name="tipo_pagamento_id" id="tipo_pagamento_id">
      <option value={{$solicitacao->tipo_pagamento_id}}>{{$solicitacao->tipoPagamento->descricao}}</option>
      @foreach ($tipoPagamentos as $tipo)
      <option value={{$tipo->id}}>{{$tipo->descricao}}</option>
      @endforeach
    </select>
  </div>
</div>
@endisset

@isset($solicitacao->vlr_servico)
<div class="col-12 col-sm-12 col-md-3 transferencia serv_pago" >
  <!-- text input -->
  <div class="form-group">
    <label>Valor Serviço</label>
    <input type="text" class="form-control" name="vlr_servico" id="vlr_servico"
            value="{{$solicitacao->vlr_servico}}" required>
  </div>
</div>
@endisset

@isset($solicitacao->tipo_midia_id)
<div class="col-12 col-sm-12 col-md-3 plano " >
  <!-- select -->
  <div class="form-group">
    <label>Canal Venda</label>
    <select class="form-control" name="tipo_midia_id">
      <option value={{$solicitacao->tipo_midia_id}}>{{$solicitacao->tipoMidia->descricao}}</option>
      @foreach ($tipoMidia as $tipo)
      <option value={{$tipo->id}}>{{$tipo->descricao}}</option>
      @endforeach
    </select>
  </div>
</div>
@endisset

@if($solicitacao->motivo_cancelamento_id )
<div class="col-12 col-sm-12 col-md-3 cancelamento" >
  <!-- select -->
  <div class="form-group">
    <label>Motivo</label>
    <select class="form-control" name="motivo_cancelamento_id" id="motivo_cancelamento_id">
      <option value={{ $solicitacao->motivo_cancelamento_id }}>{{$solicitacao->motivo->descricao}}</option>
      @foreach ($motivos as $motivo)
      <option value={{$motivo->id}}>{{$motivo->descricao}}</option>
      @endforeach
    </select>
  </div>
</div>
@endif

@isset($solicitacao->obs)
<div class="col-12 col-sm-12 col-md-6">
  <!-- textarea -->
  <div class="form-group">
    <label>Observação</label>
  <textarea class="form-control" name="obs" rows="1" ">{{$solicitacao->obs}}</textarea>
  </div>
</div>
@endisset

<div class="col-12 col-sm-12 col-md-3">
  <!-- text input -->
  <div class="form-group">
    <label>Agendar para:
      <param name="" value=""></label>
    <input type="date" class="form-control" name="dt_agendamento" required>
  </div>
</div>

<div class="col-12 col-sm-12 col-md-3 " >
  <!-- select -->
  <div class="form-group">
    <label>Turno</label>
    <select class="form-control" name="turno_agendamento" >
      <option value="">--Selecione--</option>
      <option value="1">Manhã</option>
      <option value="2">Tarde</option>
    </select>
  </div>
</div>
