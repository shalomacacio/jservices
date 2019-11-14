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
                <form role="form" action="{{ route('solicitacao.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-2">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Cliente</label>
                            <input type="text" class="form-control" name="cliente" placeholder="Nome do cliente ..." required>
                        </div>
                        </div>

                        <div class="col-sm-2">
                        <!-- select -->
                        <div class="form-group">
                            <label>Serviço</label>
                            <select class="form-control" name="servico_id" required>
                                @foreach( $servicos as $servico)
                                    <option value="{{ $servico->id}}">{{ $servico->descricao}}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                        <div class="col-sm-2">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Valor Serviço</label>
                                <input type="text" class="form-control" name="servico_vlr" placeholder="R$ 0.00" required>
                            </div>
                        </div>

                        <div class="col-sm-2">
                                <!-- select -->
                                <div class="form-group">
                                    <label>Tecnologia</label>
                                    <select class="form-control" name="tecnologia_id">
                                        @foreach ($tecnologias as $tecnologia)
                                            <option value={{$tecnologia->id}}>{{$tecnologia->descricao}}</option>
                                        @endforeach

                                    </select>
                                </div>
                        </div>

                        <div class="col-sm-2">
                        <!-- select -->
                        <div class="form-group">
                            <label>Forma de Pagamento</label>
                            <select class="form-control" name="forma_pagamento">
                                <option value=null>Nenhum</option>
                                <option value="avista">À Vista</option>
                                <option value="boleto">Boleto</option>
                                <option value="credito">Crédito</option>
                            </select>
                        </div>
                        </div>

                        <div class="col-sm-2">
                        <!-- select -->
                        <div class="form-group">
                            <label>Equipamentos</label>
                            <select class="form-control" name="tipo_aquisicao">
                                <option value=null>Nenhum</option>
                                <option value="comodato">Comodato</option>
                                <option value="venda">Venda</option>
                            </select>
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <!-- textarea -->
                            <div class="form-group">
                            <label>Observação</label>
                            <textarea class="form-control" name="obs" rows="1" placeholder="Enter ..."></textarea>
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
                <input type="hidden"  name="comissao_atendimento" />
                <input type="hidden"  name="comissao_equipe" />
                <input type="hidden"  name="comissao_supervisor" />
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
                                <h3 class="card-title">{{ \Carbon\Carbon::now()->format('F') }}</h3>
                                <h3 class="card-title">Comissão: {{  $solicitacaos->sum('comissao_atendimento')  }}</h3>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th style="width: 10px">#</th>
                                <th>Cliente</th>
                                <th>Serviço </th>
                                <th style="width: 40px">Status</th>
                                <th style="width: 40px">Comissão </th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($solicitacaos as $solicitacao)
                                    <tr>
                                        <td>{{ $solicitacao->id }}</td>
                                        <td>{{ $solicitacao->cliente }}</td>
                                        <td>{{ $solicitacao->servico->descricao }}</td>
                                        <td>{{ $solicitacao->statusSolicitacao->descricao }}</td>
                                        <td>R$ {{ $solicitacao->comissao_atendimento }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                          <ul class="pagination pagination-sm m-0 float-right">
                                {{ $solicitacaos->render() }}
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
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)

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
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>
@stop
