@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Serviços</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Cadastros</a></li>
              <li class="breadcrumb-item active">Novo Serviço</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Novo Serviço</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form role="form" action="{{ route('servico.store') }}" method="POST">
                @csrf
                  <div class="row">

                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Serviço</label>
                        <input type="text" class="form-control" name="descricao" placeholder="Nome do serviço ..." required>
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Comissao Atendimento</label>
                        <input type="text" class="form-control" name="comissao_atendimento" placeholder="" required>
                        Percentual % <input type="checkbox" name="tip_comiss_atend" value="percentual" >
                        Fixo  R$ <input type="checkbox"  name="tip_comiss_atend" value="fixo" >
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Comissão Técnico</label>
                        <input type="text" class="form-control" name="comissao_equipe" placeholder="" required>
                        Percentual % <input type="checkbox" name="tip_comiss_eq" value="percentual" >
                        Fixo  R$     <input type="checkbox" name="tip_comiss_eq" value="fixo">
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label> Comissão Supervisor</label>
                        <input type="text" class="form-control" name="comissao_supervisor" placeholder="" required>
                        Percentual % <input type="checkbox" name="tip_comiss_sup" value="percentual" >
                        Fixo  R$ <input type="checkbox"  name="tip_comiss_sup" value="fixo" >
                      </div>
                    </div>
                  </div>
              </div>
              <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">Adicionar</button>
                    </div>
                </form>

            </div>
            <!-- /.card -->
            <!-- general form elements disabled -->
              </div>
            </div> <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">{{ \Carbon\Carbon::now()->format('F') }}</h3>
                                <h3 class="card-title">Comissão:</h3>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th style="width: 10px">#</th>
                                <th>Serviço</th>
                                <th style="width: 60px">Atendimento</th>
                                <th style="width: 40px">Equipe</th>
                                <th style="width: 40px">Supervisor</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($servicos as $servico)
                                    <tr>
                                        <td>{{ $servico->id }}</td>
                                        <td>{{ $servico->descricao }}</td>
                                        <td>@if($servico->tip_comiss_atend == 'fixo') R$ @else %  @endif {{ $servico->comissao_atendimento }}</td>
                                        <td>@if($servico->tip_comiss_eq == 'fixo') R$ @else %  @endif {{ $servico->comissao_equipe }}</td>
                                        <td>@if($servico->tip_comiss_sup == 'fixo') R$ @else %  @endif {{ $servico->comissao_supervisor }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                          <ul class="pagination pagination-sm m-0 float-right">
                            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                          </ul>
                        </div>
                      </div>
                      <!-- /.card -->
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
