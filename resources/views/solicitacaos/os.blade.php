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

@section('javascript')
<!-- jQuery -->
<script src="/dist/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)

</script>

<script type="text/javascript">
  $('select[name=categoria_servico_id]').change(function () {
    ajaxServicos();
  });

  $('select[name=servico_id]').change(function () {
    ajaxValor();
  });

  // $('#codpessoa').change(function () {
  //   ajaxCliente();
  // });


  $('#search').click( function () {
    ajaxCliente();
  });

  function ajaxServicos(){
    $.ajax({
        type: "GET",
        data: {categoria_servico_id: $("#categoria_servico_id").val()},
        url: "/solicitacao/ajaxServicos",
        dataType: 'JSON',
        success: function(response) {
          $('select[name=servico_id]').empty();
          // alert(categoria_servico_id.value );
          if(categoria_servico_id){
            $('select[name=servico_id]').append('<option value=' + null + '>--Selecione--</option>');
          }
          $.each(response.servicos, function (key, value) {

            $('select[name=servico_id]').append('<option value=' + value.id + '>' + value.descricao + '</option>');
          })
        }
    });
  }

  function ajaxCliente(){
    $.ajax({
        type: "GET",
        data: {codpessoa: $("#codpessoa").val()},
        url: "/solicitacao/ajaxCliente",
        dataType: 'JSON',
        success: function(response) {
          if(response.error){
            alert("Erro:"+ response.message);
          } else {
            $('#cliente').val(response.result[0]['nome_razaosocial']);
          }
        },
        error: function(response){
          alert("A conexão com MKSOLUTION falhou!")
        }
    });
  }
  function ajaxValor(){
    $.ajax({
        type: "GET",
        data: {servico_id: $("#servico_id").val()},
        url: "/solicitacao/ajaxValor",
        dataType: 'JSON',
        success: function(response) {
          // alert(response.valor['servico_vlr']);
          $('#servico_vlr').val(response.valor['servico_vlr']);
        }
    });
  }
</script>
<!-- Bootstrap 4 -->
<script src="/dist/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="/dist/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="/dist/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="/dist/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/dist/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="/dist/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="/dist/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="/dist/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/dist/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="/dist/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/dist/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>
@stop
