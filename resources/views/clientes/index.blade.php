@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cliente</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Cliente</a></li>
              <li class="breadcrumb-item active">Novo Cliente</li>
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
                    <h3 class="card-title">Novo Cliente</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <form role="form" action="{{ route('clientes.store') }}" method="POST">
                    @csrf

                    <div class="row">
                      <div class="col-12 col-sm-12 col-md-3">
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

                        <div class="col-12 col-sm-12 col-md-9">
                        <!-- text input -->
                          <div class="form-group">
                              <label>Nome / Razão Social</label>
                              <input type="text" class="form-control" name="nome_razaosocial" id="typeahead"  required>
                          </div>
                        </div>


                    </div><!-- /.row -->

                    <div class="row">

                      <div class="col-12 col-sm-12 col-md-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Data Nascimento</label>
                          <input type="date" class="form-control" name="dt_nascimento" id="dt_nascimento"  required>
                        </div>
                      </div>

                      <div class="col-12 col-sm-12 col-md-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>CPF</label>
                          <input type="text" class="form-control" name="cpf" id="cpf"  required>
                        </div>
                      </div>

                      <div class="col-12 col-sm-12 col-md-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Telefone</label>
                          <input type="text" class="form-control" name="tel" id="tel"  required>
                        </div>
                      </div>

                      <div class="col-12 col-sm-12 col-md-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Celular</label>
                          <input type="text" class="form-control" name="cel" id="cel"  required>
                        </div>
                      </div>
                    </div>

                    <div class="row">

                      <div class="col-12 col-sm-12 col-md-5">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Endereco</label>
                          <input type="text" class="form-control" name="endereco" id="endereco" required>
                        </div>
                      </div>

                      <div class="col-12 col-sm-12 col-md-1">
                        <!-- text input -->
                        <div class="form-group">
                          <label>N°</label>
                          <input type="text" class="form-control" name="num" id="num" required>
                        </div>
                      </div>

                      <div class="col-12 col-sm-12 col-md-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Bairro</label>
                          <input type="text" class="form-control" name="bairro" id="bairro" required>
                        </div>
                      </div>

                      <div class="col-12 col-sm-12 col-md-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Cidade</label>
                          <input type="text" class="form-control" name="cidade" id="cidade" required>
                        </div>
                      </div>

                    </div>
                </div>
                    <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info float-right">Adicionar</button>
                </div>
                <!-- /.card-body -->
                </div>
                <input type="hidden" value="{{Auth::user()->id}}" name="user_id" />
                </form>
            <!-- /.card -->
            <!-- general form elements disabled -->
              </div>
            </div>

            <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Clientes</h3>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table class="table table-sm table-striped table-hover table-bordered " >
                            <thead>
                              <tr>
                                <th class="d-none d-sm-table-cell"style="width: 100px">Data </th>
                                <th>Cliente</th>
                                <th class="d-none d-sm-table-cell" style="width: 100px">CPF </th>
                                <th style="width: 100px">Ações </th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($clientes as $cliente)
                              <tr>
                                <td class="d-none d-sm-table-cell" >{{ \Carbon\Carbon::parse($cliente->created_at)->format('d/m/Y') }}</td>
                                <td>{{ $cliente->nome_razaosocial }}</td>
                                <td class="d-none d-sm-table-cell" >{{ $cliente->cpf }}</td>
                                <td>
                                  <form action="{{route('clientes.destroy', $cliente->id)}}" method="POST">
                                    <a class="btn btn-info" href="{{route('clientes.edit', $cliente->id)}}"  ><i class="fas fa-edit"></i></a>
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger"  type="submit"  onclick="return confirm('Excluir Cliente ?')"><i class="fas fa-trash"></i></button>
                                  </form>
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                          <ul class="pagination pagination-sm m-0 float-right">
                            {{-- {{ $comissaos->render() }} --}}
                          </ul>
                        </div>
                      </div>
                      <!-- /.card -->
                    </div>
            </div><!-- /.row -->
        </section>
    </div>
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
  $('select[name=categoria_servico_id]').change(function () {
    ajaxServicos();
  });

  $('select[name=servico_id]').change(function () {
    ajaxValor();
  });

  // var path = "{{ route('autocomplete') }}";
  // $("#typeahead").typeahead({
  //   minLength: 2,
  //   // source : ["DANIELE MEDEIROS DA COSTA ACACIO", "PAULO MARIA DA SILVA"]
  //   source : function (query, process){
  //     return $.get(path, {query: query}, function(data){
  //         console.log(data[0]);
  //         return process(data)
  //     });
  //   }
  // });



      //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })


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
          $('#servico_vlr').val(response.valor['servico_vlr']);
        }
    });
  }

  var cli = function (request, response) {
        $.ajax({
          url: "{{ route('autocomplete') }}",
          data: {
            query : request.term
            },
          dataType: "json",
          success: function(data){
            var resp = $.map(data,function(obj){
              if(obj.id){
                $('#cliente_id').val(obj.id);
              }else if(obj.codpessoa){
                $('#codpessoa').val(obj.codpessoa);

              }


              console.log(obj);
              return obj.nome_razaosocial;
            });
            response(resp);
          }
        });
      }

    $( "#typeahead" ).autocomplete({
      source: cli,
      minLength: 1
    });

</script>

@stop
