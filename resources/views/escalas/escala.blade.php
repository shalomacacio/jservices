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
            <div class="col-md-6 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fa fa-star"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Pontos Disponívies</span>
                <span class="info-box-number"><h4>
                  @isset($pontosDisponiveis)
                  @if( $pontosDisponiveis > 0)
                  {{ $pontosDisponiveis }}
                  @else
                  {{ $pontosDisponiveis }} AGENDA PREENCHIDA
                  @endif

                  @endisset</h4></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-md-6 col-sm-6 col-12">
                <div class="callout callout-info">
                <h5><i class="fa fa-calendar"></i> DIA:@isset($request->dt_escala) {{ \Carbon\Carbon::parse($request->dt_escala)->format('d/m/Y')}} @endisset</h5>
                    <center>
                    <form action="{{ route('escalas.search')}}" method="GET">
                        <div class="input-group input-group-sm" style="width: 200px;">
                          <input type="date" name="dt_escala" class="form-control" placeholder="Search"
                            @isset($escala->dt_escala) value="{{\Carbon\Carbon::parse($escala->dt_escala)->format('Y-m-d')}}" @endisset
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
  @isset($escala)
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        @foreach ($escala->users as $user)
        <div class="col-md-6">
          <!-- TABLE: LATEST ORDERS -->
          <div class="card card-info">
            <div class="card-header border-transparent">
              <h3 class="card-title">{{ $user->name }}  {{ $user->sobrenome }} </h3>
              <div class="card-tools">
                <span class="badge badge-danger">MAX PONTOS: {{ $user->max_ponto }}   </span>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="table-responsive ">
                <table class="table m-0 table-sm">
                  <thead>
                    <tr>
                      <th>Cliente</th>
                      <th>Servico</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($user->solicitacaos as $solicitacao)
                    @if (\Carbon\Carbon::parse($solicitacao->dt_agendamento)->format('Y-m-d') == \Carbon\Carbon::parse( $escala->dt_escala )->format('Y-m-d') )
                    <tr>
                      <td>{{ $solicitacao->nome_razaosocial }}</td>
                      <td>{{ $solicitacao->categoriaServico->descricao }}</td>
                      <td>
                      <span class="badge
                      @switch($solicitacao->statusSolicitacao->id)
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
                          @default
                      @endswitch ">
                          {{ $solicitacao->statusSolicitacao->descricao }}
                      </span>
                      </td>
                    </tr>
                    @endif
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
  @endisset
</div>
<!-- /.content-wrapper -->
@endsection
