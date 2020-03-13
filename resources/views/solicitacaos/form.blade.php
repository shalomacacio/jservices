<div class="col-12 col-sm-12 col-md-2">
  <label>Cod Atendimento</label>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <button type="button" id="search" class="btn btn-info">
        <i class="fas fa-search"></i>
      </button>
    </div>
    <!-- /btn-group -->
    <input type="text" class="form-control" name="codatendimento" id="codatendimento"
    @isset($solicitacao->codatendimento)
      value="{{$solicitacao->codatendimento}}"
    @endisset>
  </div>
</div>

<div class="col-12 col-sm-12 col-md-4">
  <div class="form-group">
    <label>Cliente</label>
    <input type="text" class="form-control" name="nome_razaosocial" id="typeahead" data-provide="typeahead" data-items="4" required readonly>
  </div>
</div>

<div class="col-12 col-sm-12 col-md-3">
  <!-- select -->
  <div class="form-group">
    <label>Vend/Atend</label>
    <select class="form-control" name="user_atendimento_id" id="user_atendimento_id" required>
      <option value="">-- Selecione --</option>
      @foreach( $users as $user)
      <option value="{{ $user->id}}">{{ $user->name}}</option>
      @endforeach
    </select>
  </div>
</div>

{{-- <div class="col-12 col-sm-12 col-md-2">
  <!-- select -->
  <div class="form-group">
    <label>Origem</label>
    <select class="form-control" name="origem_venda_id" id="origem_venda_id" required>
      <option value="">-- Selecione --</option>
      @foreach( $origens as $origem)
      <option value="{{ $origem->id}}">{{ $origem->descricao}}</option>
      @endforeach
    </select>
  </div>
</div> --}}

<div class="col-12 col-sm-12 col-md-3">
  <!-- select -->
  <div class="form-group">
    <label>Serviço</label>
    <select class="form-control" name="categoria_servico_id" id="categoria_servico_id" required>
      <option value="">-- Selecione --</option>
      @foreach( $categorias as $categoria)
      <option value="{{ $categoria->id}}">{{ $categoria->descricao}}</option>
      @endforeach
    </select>
  </div>
</div>

{{-- <div class="col-12 col-sm-12 col-md-4 transferencia puxada" hidden>
  <!-- select -->
  <div class="form-group">
      <label>Serviço</label>
      <select class="form-control" name="servico_id" id="servico_id" >
        <option value=null>-- Selecione --</option>
      </select>
  </div>
</div> --}}

<div class="col-12 col-sm-12 col-md-3 plano migracao upgrade cancelamento" hidden>
  <!-- select -->
  <div class="form-group">
    <label>Plano</label>
    <select class="form-control" name="plano_id" id="plano_id">
      <option value="">--Selecione--</option>
      @foreach ($planos as $plano)
      <option value={{$plano->id}}>{{$plano->descricao}}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="col-12 col-sm-12 col-md-3 upgrade" hidden>
  <!-- select -->
  <div class="form-group">
    <label>Plano Anterior</label>
    <select class="form-control" name="plano_ant_id" id="plano_ant_id">
      <option value="">--Selecione--</option>
      @foreach ($planos as $plano)
      <option value={{ $plano->id }}>{{ $plano->descricao }}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="col-12 col-sm-12 col-md-3 plano migracao" hidden>
  <!-- text input -->
  <div class="form-group">
    <label>Valor</label>
    <input type="text" class="form-control" name="vlr_plano" id="vlr_plano" readonly>
  </div>
</div>

<div class="col-12 col-sm-12 col-md-3 upgrade" hidden>
  <!-- text input -->
  <div class="form-group">
    <label>Valor Dif</label>
    <input type="text" class="form-control" name="vlr_plano_dif" id="vlr_plano_dif" readonly>
  </div>
</div>

<div class="col-12 col-sm-12 col-md-3 plano migracao" hidden>
  <!-- select -->
  <div class="form-group">
    <label>Tecnologia</label>
    <select class="form-control" name="tecnologia_id">
      <option value="">--Selecione--</option>
      @foreach ($tecnologias as $tecnologia)
      <option value={{$tecnologia->id}}>{{$tecnologia->descricao}}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="col-12 col-sm-12 col-md-3 plano " hidden>
  <!-- select -->
  <div class="form-group">
    <label>Equipamentos</label>
    <select class="form-control" name="tipo_aquisicao_id">
      <option value="">--Selecione--</option>
      @foreach ($tipoAquisicaos as $tipo)
      <option value={{$tipo->id}}>{{$tipo->descricao}}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="col-12 col-sm-12 col-md-3 plano migracao" hidden>
  <!-- select -->
  <div class="form-group">
    <label>Forma Pag</label>
    <select class="form-control" name="tipo_pagamento_id" id="tipo_pagamento_id">
      <option value="">--Selecione--</option>
      @foreach ($tipoPagamentos as $tipo)
      <option value={{$tipo->id}}>{{$tipo->descricao}}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="col-12 col-sm-12 col-md-3 transferencia serv_pago" hidden>
  <!-- text input -->
  <div class="form-group">
    <label>Valor Serviço</label>
    <input type="text" class="form-control" name="vlr_servico" id="vlr_servico">
  </div>
</div>

<div class="col-12 col-sm-12 col-md-3 plano " hidden>
  <!-- select -->
  <div class="form-group">
    <label>Canal Venda</label>
    <select class="form-control" name="tipo_midia_id">
      <option value="">--Selecione--</option>
      @foreach ($tipoMidia as $tipo)
      <option value={{$tipo->id}}>{{$tipo->descricao}}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="col-12 col-sm-12 col-md-3 cancelamento" hidden>
  <!-- select -->
  <div class="form-group">
    <label>Motivo</label>
    <select class="form-control" name="motivo_cancelamento_id" id="motivo_cancelamento_id">
      <option value="">--Selecione--</option>
      @foreach ($motivos as $motivo)
      <option value={{$motivo->id}}>{{$motivo->descricao}}</option>
      @endforeach
    </select>
  </div>
</div>

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

<div class="col-12 col-sm-12 col-md-12">
  <!-- textarea -->
  <div class="form-group">
    <label>Observação</label>
    <textarea class="form-control" name="obs" id="obs" rows="6" placeholder="Observação ..."></textarea>
  </div>
</div>
