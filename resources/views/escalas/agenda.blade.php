@extends('layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  {{-- alerts --}}
  @include('layouts.alerts')
  <section class="content-header">
      <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-12">
                <div class="callout callout-info">
                <h5><i class="fa fa-calendar"></i> DIA: {{ \Carbon\Carbon::parse($data)->format('d/m/Y') }}</h5>
                    <center>
                    <form action="{{ route('escalas.search')}}" method="GET">
                        <div class="input-group input-group-sm" style="width: 200px;">
                          <input type="date" name="dt_escala" class="form-control" placeholder="Search"
                            @isset($data) value="{{\Carbon\Carbon::parse($data)->format('Y-m-d')}}" @endisset
                            required>
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                      </form>
                    </center>
                </div>
              </div>
          </div>
      </div><!-- /.container-fluid -->
  </section>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->

        @foreach ($solicitacoes as $categoria => $todos)
        <div class="col-md-6">
          <!-- TABLE: LATEST ORDERS -->
          <div class="card card-info">
            <div class="card-header border-transparent">
              <h3 class="card-title">{{ $categoria }}  </h3>
              <div class="card-tools">
                <span class="badge badge-danger">TOTAL : {{ count($todos) }}   </span>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="table-responsive ">
                <table class="table m-0 table-sm">
                  <thead>
                    <tr>
                      <th>Cliente</th>
                      <th>Atendente</th>
                      <th>Turno</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($todos as $solicitacao)
                    <tr>
                      <td>{{ $solicitacao->cliente }}</td>
                      <td>{{ $solicitacao->funcionario }}</td>
                      <td>
                        @if ($solicitacao->turno == 1)
                          Manhã
                        @elseif($solicitacao->turno == 2)
                        Tarde
                        @endif
                    </td>
                      <td>
                        <span class="badge
                      @switch($solicitacao->status_solicitacao_id)
                          @case(1)
                          badge-secondary
                              @break
                          @case(2)
                          badge-info
                              @break
                          @case(3)
                          badge-success
                              @break
                          @case(4)
                          badge-success
                          @case(5)
                          badge-success
                          @break
                          @case(6)
                          badge-danger
                          @break
                          @default
                      @endswitch ">
                          {{ $solicitacao->status }}
                      </span>
                      </td>
                      {{-- <span class="badge">
                          SPAN
                      </span> --}}
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
        @endforeach
        <!-- /.col -->
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
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>
@stop
