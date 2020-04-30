@extends('layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  {{-- alerts --}}
  @include('layouts.alerts')
  <section class="content-header">
      <div class="container-fluid">
          @include('escalas.search_form')
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
                    @foreach ($todos->sortBy('turno') as $solicitacao)
                    <tr>
                      <td>{{ $solicitacao->cliente }}</td>
                      <td>{{ $solicitacao->funcionario }}</td>
                      <td>
                        @if ($solicitacao->turno == 1)
                          MANHÃ
                        @elseif($solicitacao->turno == 2)
                        TARDE
                        @endif
                    </td>
                      <td>
                        <span class="badge
                      @switch($solicitacao->status_solicitacao_id)
                          @case(1)
                          badge-secondary {{--  cinza --}}
                              @break
                          @case(2)
                          badge-info {{--  azul --}}
                              @break
                          @case(3)
                          badge-success {{--  verde --}}
                              @break
                          @case(4)
                          badge-success {{--  verde --}}
                          @case(5)
                          badge-success {{--  verde --}}
                          @break
                          @case(6)
                          badge-danger {{--  vermelho --}}
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
