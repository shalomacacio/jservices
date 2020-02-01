@extends('layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Comissões</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Relatórios</a></li>
            <li class="breadcrumb-item active">Producao Diária</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          {{-- <div class="callout callout-info">
            <h5><i class="fas fa-info"></i> Note:</h5>
            This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
          </div> --}}


          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  <i class="fas fa-globe"></i> JNET - Telecom
                <small class="float-right">Date: {{ \Carbon\Carbon::now()}}</small>
                </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                Data Inicial
                <address>
                  <strong>{{ \Carbon\Carbon::parse($request->dt_inicio)->format('d/m/Y')}}</strong><br>
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                Data Final
                <address>
                  <strong>{{ \Carbon\Carbon::parse($request->dt_fim)->format('d/m/Y')}}</strong><br>
                </address>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
            <center><h3>RELATÓRIO DE PRODUÇÃO DIÁRIA </h3></center>
            <br/>
            <!-- Table row -->
          @foreach ($solicitacaos as $categoria => $solics)

            <div class="row">
              <div class="col-12 table-responsive">
                {{-- <p>
                  <i class="nav-icon fas fa-plus-square" data-toggle="collapse" data-target="#demo" ></i>
                  {{ $categoria }} -{{ $solics->count() }}
                </p> --}}

                <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                      <i class="nav-icon fa fa-th"></i>
                        <p>{{ $categoria }} -{{ $solics->count() }} <i class="fa fa-angle-left right"></i></p>
                      </a>
                        <ul class="nav nav-treeview">
                          @foreach ($solics as $solicitacao)

                              <table class="table table-sm ">
                                <thead>
                                  <tr>
                                    <td>Data</td>
                                    <td>Colaborador</td>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>{{\Carbon\Carbon::parse($solicitacao->data)->format('d-m-Y') }}</td>
                                    <td>{{ $solicitacao->colaborador }}</td>
                                  </tr>
                                </tbody>
                              </table>

                            @endforeach
                        </ul>
                    </li>

                  </ul>
                </nav>

                <table id="demo" class="table table-striped table-sm collapse ">
                  <thead>
                    <tr >
                      <th>Data</th>
                      <th>Colaborador</th>
                      <th>Cliente</th>
                      <th style="width: 110px">Plano</th>
                    </tr>
                  </thead>
                  <tbody >
                    @foreach ($solics as $solicitacao)
                      <tr>
                        <td>{{\Carbon\Carbon::parse($solicitacao->data)->format('d-m-Y') }}</td>
                        <td>{{ $solicitacao->colaborador }}</td>
                        <td>{{ $solicitacao->cliente }}</td>
                        <td>{{ $solicitacao->plano }}</td>
                        <td></td>
                      </tr>
                    @endforeach
                  </tbody>
                    {{-- <tr>
                      <th>Subtotal:</th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th style="text-align: center"> {{ $solics->count()}}</th>
                    </tr> --}}
                </table>
              </div>
              <!-- /.col -->
            </div>
          <br/>

          @endforeach

          <div class="row">
            <!-- accepted payments column -->
            <div class="col-5">
              <p class="lead">Impressão:</p>
              <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                Utilizar tamnho de papel A4 deixar as configurações de margens e escala
                no modo Padrão e marcar somente a opção Cabeçalho e Rodapé para o caso
                de utilizar enumeração de páginas.
              </p>
            </div>
            <div class="col-1"></div>
            <!-- /.col -->
            <div class="col-6">
              <p class="lead">Período {{ \Carbon\Carbon::parse($request->dt_inicio)->format('d/m/Y')}} até  {{ \Carbon\Carbon::parse($request->dt_fim)->format('d/m/Y')}}</p>

              <div class="table-responsive">
                <table class="table">
                  @foreach ($solicitacaos as $categoria => $solics)
                    <tr>
                      <th style="width:50%">{{ $categoria }}:</th>
                      <td style="width:50%"> {{ $solics->count()}}</td>
                    </tr>
                  @endforeach
                  <tr>
                    <th>TOTAL:</th>
                    <th>{{ $total }}</th>
                  </tr>
                </table>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
              <div class="col-12">
                <a href="javascript:void(0)" onClick="window.print()" class="btn btn-default float-right"><i class="fas fa-print"></i> Imprimir</a>
                {{-- <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card" disabled></i> Submit
                  Payment
                </button>
                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                  <i class="fas fa-download"></i> Generate PDF
                </button> --}}
              </div>
            </div>
          </div>
          <!-- /.invoice -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
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

<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>
@stop
