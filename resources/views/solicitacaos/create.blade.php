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
            </form>
          </div><!-- /.card -->
        </div><!-- /.row -->
      </div>
    </div>
  </section>
</div>

@endsection

@section('javascript')
<!-- jQuery -->
<script src="/dist/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
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
<!-- Select2 -->
<script src="/dist/plugins/select2/select2.full.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<script type="text/javascript">
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

  // $('select[name=plano_ant]').change(function () {
  //   var vlr_atual = $('vlr_plano').val();
  //   var vlr_ant = $('vlr_plano').val();

  // });

  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  })

  $('#search').click(function() {
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
