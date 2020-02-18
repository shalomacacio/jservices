@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pesquisar </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Pesquisar</a></li>
              <li class="breadcrumb-item active">Solicitacoes</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->

      {{-- alerts --}}
      @include('layouts.alerts')
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="col-md-12">
      <!-- general form elements disabled -->
      <div class="card card-warning">
        <div class="card-header">
          <h3 class="card-title">Relatório de Comissões </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form role="form" action="{{ route('reports.comissoes') }}" method="GET">
            <div class="row">
              <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                  <label>Data Início</label>
                  <input type="date" class="form-control" name="dt_inicio" required>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Data Fim</label>
                  <input type="date" class="form-control" name="dt_fim" required>
                </div>
              </div>
              <div class="col-sm-4">
                <!-- select -->
                <div class="form-group">
                  <label>Colaborador</label>
                  <select class="form-control" name="funcionario_id">
                    <option value="0">-- TODOS --</option>
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-sm-4">
                <!-- checkbox -->
                <div class="form-group">

                  <div class="form-check">
                    <input type="checkbox" name="roles[]" value="2" />
                    <label class="form-check-label">Atendimento</label>
                  </div>

                  <div class="form-check">
                    <input type="checkbox" name="roles[]" value="5" />
                    <label class="form-check-label">Tecnico</label>
                  </div>

                  <div class="form-check">
                    <input type="checkbox" name="roles[]" value="8" />
                    <label class="form-check-label">Consultor</label>
                  </div>

                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-4">
                <!-- checkbox -->
                <div class="form-group">

                  <div class="form-check">
                    <input type="checkbox" name="flags[]" value="1" />
                    <label class="form-check-label"> Autorizados</label>
                  </div>

                  <div class="form-check">
                    <input type="checkbox" name="flags[]" value="0" />
                    <label class="form-check-label">Não Autorizados</label>
                  </div>

                  <div class="form-check">
                    <input type="checkbox" name="flags[]" value="3" />
                    <label class="form-check-label">Aguardando</label>
                  </div>

                </div>
              </div>
            </div>

        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary float-right">Pesquisar</button>
        </div>
        <!-- /.card-body -->
      </form>
      </div>
      <!-- /.card -->
      <!-- general form elements disabled -->
      <!-- /.card -->
    </div>
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
