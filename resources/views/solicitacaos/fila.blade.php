@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Fila de Atendimento</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Solicitação</a></li>
              <li class="breadcrumb-item active">Fila </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->

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
                      <div class="card card-info">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">{{ \Carbon\Carbon::now('America/Fortaleza')->format('d-M-y') }}</h3>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th class="d-none d-sm-table-cell" style="width: 30px">Data</th>
                                <th>Cliente</th>
                                <th class="d-none d-sm-table-cell">Serviço </th>
                                <th class="d-none d-sm-table-cell">Situação</th>
                                <th class="d-none d-sm-table-cell">Atendente</th>
                                <th class="d-none d-sm-table-cell">Bairro</th>
                                <th class="d-none d-sm-table-cell">Equipe</th>
                                <th style="width: 140px">Ações </th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($solicitacaos as $solicitacao)
                                    <tr>
                                        <td class="d-none d-sm-table-cell">{{ \Carbon\Carbon::parse($solicitacao->dt_agendamento)->format('d/m') }}</td>
                                        <td>{{ $solicitacao->nome_razaosocial }}</td>
                                        <td class="d-none d-sm-table-cell">{{ $solicitacao->categoriaServico->descricao }}</td>
                                        <td class="d-none d-sm-table-cell">{{ $solicitacao->statusSolicitacao->descricao}}</td>
                                        <td class="d-none d-sm-table-cell">{{ $solicitacao->user->name}}</td>
                                        <td class="d-none d-sm-table-cell">{{ $solicitacao->mkPessoa->bairro->bairro}}</td>

                                        <td class="d-none d-sm-table-cell">
                                            @foreach ($solicitacao->users as $tecnico)
                                              @isset($tecnico)
                                                {{$tecnico->name}} {{$tecnico->sobrenome}} <br/>
                                              @endisset
                                            @endforeach
                                            @empty($solicitacao->users)
                                              Nenhum técnico atribuido
                                            @endempty
                                        </td>
                                        <td>
                                           @if($solicitacao->status_solicitacao_id == 1  || $solicitacao->status_solicitacao_id == 6  ){{-- 1=aberto  --}}
                                           <a class="btn btn-info btn-sm"  href="{{route('solicitacao.encaminhar', $solicitacao->id)}}"><i class="fa fa-motorcycle"></i></a>
                                          @elseif($solicitacao->status_solicitacao_id == 2)
                                          <a class="btn btn-danger  btn-sm" title="reagendar" href="{{route('solicitacao.reagendar', $solicitacao->id)}}"><i class="fa fa-calendar"></i></a>
                                          <a class="btn btn-success btn-sm" title="concluir"  href="{{route('solicitacao.concluir', $solicitacao->id)}}"  onclick="return confirm('Deseja Concluir?')"><i class="fas fa-check"></i></a>
                                          @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                          </div>
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
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>

<!-- Bootgrid -->
<script src="/dist/plugins/bootgrid/jquery.bootgrid.js"></script>

@stop
