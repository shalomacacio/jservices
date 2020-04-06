@extends('layouts.master')

@section('css')
<!-- datepicker3.css -->
{{-- <link rel="stylesheet" href="/dist/plugins/datepicker/datepicker3.css"> --}}
<link rel="stylesheet" href="/dist/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
@stop

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
    <div class="messages"></div>
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
            <form id="form" role="form" action="{{ route('solicitacao.store') }}" method="POST">
              <div class="card-body">
                  @csrf
                  <div class="row">
                    @include('solicitacaos.form')
                  </div>
              </div><!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-info float-right">Adicionar</button>
              </div>
              <input type="hidden" name="comissao_atendimento" />
              <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}" />
              <input type="hidden" name="cliente_id" id="cliente_id" />
              <input type="hidden" name="comissao_equipe" />
              <input type="hidden" name="comissao_supervisor" />
              <input type="hidden" name="dataValidation" value="true" />
            </form>
          </div><!-- /.card -->
        </div><!-- /.row -->
      </div>
    </div>
  </section>
</div>

@endsection

@section('javascript')
<!-- datepicker.js -->
<script src="/dist/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" charset="UTF-8"></script>
<script type="text/javascript">

function fechaAlert(){
  setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove();
    });
  }, 3000);
}

$(document).ready(function(){
      var date_input=$('input[name="dt_agendamento"]'); //our date input has the name "date"
      var dates = ['2020-04-15', '2020-04-16'];
      date_input.datepicker({
        language: "pt-BR",
        format: 'yyyy-mm-dd',
        maxViewMode: 2,
        todayBtn: false, //"linked",
        clearBtn: false,
        forceParse: false,
        autoclose: true,
        // datesDisabled: dates
    });
    fechaAlert();
    })

    $('#dt_agendamento').change(function() {
      // alert($(this).val())
      $.ajax({
      type: "GET",
      data: {
        dt_agendamento: $("#dt_agendamento").val()
      },
      url: "/solicitacao/ajaxQtdServDia",
      dataType: 'JSON',
      success: function(response) {
        var messages = $('.messages');
        console.log(response)
        if(response.dataValidation == false){
          var successHtml = '<div class="alert alert-danger">'+
                '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                '<strong><i class="glyphicon glyphicon-ok-sign push-5-r"></</strong> '+ response.message +
                '</div>';
          $(messages).html(successHtml);
          $('#dt_agendamento').val(" ");
          $('#dataValidation').val(false);
          fechaAlert();
        }

      }
    });

  });

  $('select[name=categoria_servico_id]').change(function() {
    var item = $(this).val()
    // console.log(item);
    habilitaCampos(item);
    ajaxServicos();
  });

  function habilitaCampos(item) {
    switch (item) {
      case '1':
        desabilitaCampos();
        $('.plano').removeAttr('hidden');
        break;
      case '2':
        desabilitaCampos();
        $('.cancelamento').removeAttr('hidden');
        break;
      case '4':
        desabilitaCampos();
        $('.migracao').removeAttr('hidden');
        break;
        case '5':
        desabilitaCampos();
        $('.plano').removeAttr('hidden');
        break;
        case '6':
        desabilitaCampos();
        $('.puxada').removeAttr('hidden');
        $('.serv_pago').removeAttr('hidden');
        break;
      case '8':
        desabilitaCampos();
        $('.transferencia').removeAttr('hidden');
        break;
      case '9':
        desabilitaCampos();
        $('.upgrade').removeAttr('hidden');
        break;
      default:
        desabilitaCampos();
    }
  }

  function desabilitaCampos() {
    $('.plano').attr('hidden', true);
    $('.migracao').attr('hidden', true);
    $('.upgrade').attr('hidden', true);
    $('.transferencia').attr('hidden', true);
    $('.serv_pago').attr('hidden', true);
    $('.cancelamento').attr('hidden', true);
  }

  $('select[name=plano_id]').change(function() {
    ajaxValor();
    ajaxDiferenca();
  });

  $('select[name=tipo_pagamento_id]').change(function() {
    var item = $(this).val()
    // console.log(item);
    if(item != 5){
      $('.serv_pago').removeAttr('hidden');
    } else if( item == 5){
      $('.serv_pago').attr('hidden', true);
    }

  });

  $('select[name=plano_ant_id]').change(function() {
    ajaxDiferenca();
  });

  $('#search').click(function() {
    // ajaxCliente();
    ajaxAtendimento();
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
          if(categoria_servico_id)
          {
            // $('select[name=servico_id]').append('<option value=' + null + '>--Selecione--</option>');
            $('select[name=servico_id]').append('<option value=0>--Selecione--</option>');
          }
          $.each(response.servicos, function (key, value)
          {
            $('select[name=servico_id]').append('<option value=' + value.id + '>' + value.descricao + '</option>');
          })
        }
    });
  }

  function ajaxCliente() {
    $.ajax({
      type: "GET",
      data: {
        codpessoa: $("#codpessoa").val()
      },
      url: "/solicitacao/ajaxCliente",
      dataType: 'JSON',
      success: function(response) {
        // console.log(response);
        if (response.error) {
          alert("Erro:" + response.message);
        } else {
          $('#typeahead').val(response.nome_razaosocial);
        }
      },
      error: function(response) {
        alert("A conexão com MKSOLUTION falhou!")
      }
    });
  }

  function ajaxValor() {
    $.ajax({
      type: "GET",
      data: {
        plano_id: $("#plano_id").val()
      },
      url: "/solicitacao/ajaxValor",
      dataType: 'JSON',
      success: function(response) {
        console.log(response.vlr_plano)
        $('#vlr_plano').val(response.vlr_plano);
      }
    });
  }

  function ajaxAtendimento() {
    $.ajax({
      type: "GET",
      data: {
        codatendimento: $("#codatendimento").val()
      },
      url: "/solicitacao/ajaxAtendimento",
      dataType: 'JSON',
      success: function(response) {
        // console.log(response.cliente)
        $('#obs').val(response.atendimento.info_cliente);
        $('#typeahead').val(response.cliente.nome_razaosocial);
      }
    });
  }

  function ajaxDiferenca() {
    $.ajax({

      type: "GET",
      data: {
        plano_id: $("#plano_id").val(),
        plano_ant_id: $("#plano_ant_id").val()
      },
      url: "/solicitacao/ajaxDiferenca",
      dataType: 'JSON',
      success: function(response) {
        console.log(response)
        $('#vlr_plano_dif').val(response);
      }
    });
  }

  var cli = function(request, response) {
    $.ajax({
      url: "{{ route('autocomplete') }}",
      data: {
        query: request.term
      },
      dataType: "json",
      success: function(data) {
        var resp = $.map(data, function(obj) {
          if (obj.id) {
            $('#cliente_id').val(obj.id);
          } else if (obj.codpessoa) {
            $('#codpessoa').val(obj.codpessoa);

          }
          // console.log(obj);
          return obj.nome_razaosocial;
        });
        response(resp);
      }
    });
  }

  $("#typeahead").autocomplete({
    source: cli,
    minLength: 1
  });
</script>

@stop
