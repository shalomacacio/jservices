@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">

      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>AGENDA</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Solicitacoes</a></li>
            <li class="breadcrumb-item active"> Agenda </li>
          </ol>
        </div>
      </div>
      @include('escalas.search_form2')
      @include('escalas.widget')
    </div><!-- /.container-fluid -->

    {{-- alerts --}}
    @include('layouts.alerts')
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-info">
            <div class="card-header">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Serviços</h3>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <table id="grid-basic" class="table table-condensed table-hover table-striped">
                <thead>
                  <tr>
                    <th data-column-id="cliente">Cliente</th>
                    <th data-column-id="descricao">Serviço</th>
                    <th data-column-id="atendente">Atend/Vendedor</th>
                    <th data-column-id="turno">Turno</th>
                    <th data-column-id="tecnico">Técnico</th>
                    <th data-column-id="status">Status</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($solicitacoes as $solicitacao)
                  <tr>
                    <td>{{ $solicitacao->cliente }}</td>
                    <td>{{ $solicitacao->descricao }}</td>
                    <td>{{ $solicitacao->funcionario }}</td>
                    <td>@if( $solicitacao->turno == 1 ) MANHÃ @else TARDE @endif</td>
                    <td>{{ $solicitacao->tecnico }}</td>
                    <td> {{ $solicitacao->status }} </td>
                  </tr>
                @endforeach
                </tbody>
              </table>

            </div>
            <!-- /.card-body -->
            <!-- /.card-footer -->
            <div class="card-footer clearfix">
              <div class="row">
                <!-- /.col -->
                <div class="col-3">
                  <p class="lead">Serviços Por  Atendente</p>
                  <div class="table-responsive">
                    <table class="table">
                      @foreach ($porAtend as $funcionario => $item )
                      <tr>
                        <th style="width:50%">{{ $funcionario }}:</th>
                      <td>{{ $item->count() }}</td>
                      </tr>
                      @endforeach
                    </table>
                  </div>
                </div>
                <!-- /.col -->
                <!-- /.col -->
                <div class="col-3">
                  <p class="lead">Total Por Serviço</p>
                  <div class="table-responsive">
                    <table class="table">
                      @foreach ($porServ as $servico => $item )
                      <tr>
                        <th style="width:50%">{{ $servico }}:</th>
                      <td>{{ $item->count() }}</td>
                      </tr>
                      @endforeach
                    </table>
                  </div>
                </div>
                <!-- /.col -->
                <!-- /.col -->
                <div class="col-3">
                  <p class="lead">Total Por Tecnico</p>
                  <div class="table-responsive">
                    <table class="table">
                      @foreach ($porTec as $tecnico => $item )
                      <tr>
                        <th style="width:50%">{{ $tecnico }}:</th>
                        <td>{{ $item->count() }}</td>
                      </tr>
                      @endforeach
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-footer -->
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
<!-- Bootgrid -->
<script src="/dist/plugins/bootgrid/jquery.bootgrid.js"></script>

<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<script type="text/javascript">
$("#grid-basic").bootgrid({
    labels: {
        all: "Tudo",
        loading: "Aguardando...",
        noResults: "Nenhum resultado encontrado!",
        refresh: "Refresh",
        search: "Filtro"
    }
});
</script>

@stop
