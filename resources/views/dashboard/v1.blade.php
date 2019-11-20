@extends('layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
            <h3>{{ count($solicitacaos) }}</h3>

              <p>Serviços Diário</p>
            </div>
            <div class="icon">
              <i class="fas fa-clipboard-list"></i>
            </div>
            <a href="#" class="small-box-footer">Detalhes <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ count($andamento) }}</h3>
              <p>Em Andamento</p>
            </div>
            <div class="icon">
              <i class="fas fa-route"></i>
            </div>
            <a href="#" class="small-box-footer">Detalhes <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{count($concluidos)}}</h3>

              <p>Concluídos</p>
            </div>
            <div class="icon">
              <i class="fas fa-calendar-check"></i>
            </div>
            <a href="#" class="small-box-footer">Detalhes <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
            <h3>{{count($pendentes)}}</h3>

              <p>Pendentes</p>
            </div>
            <div class="icon">
              <i class="fas fa-clock"></i>
            </div>
            <a href="#" class="small-box-footer">Detalhes <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->


      <!-- Main row -->
        <div class="row">
            @foreach ($tecnicos as $tecnico)
            @if(count($tecnico->solicitacoes) >=1)
                <!-- Left col -->
                <div class="col-md-6">
                  <!-- TABLE: LATEST ORDERS -->
                  <div class="card card-info">
                    <div class="card-header border-transparent">
                    <h3 class="card-title">{{$tecnico->nome}} {{$tecnico->sobrenome}}</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse">
                          <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-widget="remove">
                          <i class="fa fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                      <div class="table-responsive">
                        <table class="table m-0">
                          <thead>
                          <tr>
                            <th>Data</th>
                            <th>Cliente</th>
                            <th>Servico</th>
                            <th>Status</th>
                          </tr>
                          </thead>
                          <tbody>
                              @foreach ($tecnico->solicitacoes as $solicitacao)
                              <tr>
                                <td><a href="pages/examples/invoice.html">{{$solicitacao->created_at->format('d/m/Y')}}</a></td>
                                <td>{{$solicitacao->cliente}}</td>
                                <td>{{$solicitacao->servico->descricao}}</td>
                                <td>
                                    <span class="badge
                                        @if($solicitacao->status_solicitacao_id == '4' || $solicitacao->status_solicitacao_id == '5' ) badge-danger
                                          @elseif($solicitacao->status_solicitacao_id == '2' ) badge-warning
                                          @else badge-success
                                        @endif ">{{$solicitacao->statusSolicitacao->descricao}}
                                    </span>
                                </td>
                              </tr>
                              @endforeach
                          </tbody>
                        </table>
                      </div>
                      <!-- /.table-responsive -->
                    </div>
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col -->
                @endif
                @endforeach

              </div>
              <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
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
