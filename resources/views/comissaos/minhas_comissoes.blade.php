@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Minhas Comissões</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Comissão</a></li>
              <li class="breadcrumb-item active">Minhas Comissões</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      @include('comissaos.widget')
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
                                <th>Data</th>
                                <th>Cliente</th>
                                <th>Serviço </th>
                                <th>Colaborador</th>
                                <th>Status</th>
                                <th>Plano</th>
                                <th>Taxa</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($solicitacaos as $solicitacao)
                                    <tr>
                                        <td>{{  \Carbon\Carbon::parse($solicitacao->dt_conclusao)->format('d/m') }}</td>
                                        <td>{{ $solicitacao->nome_razaosocial }}</td>
                                        <td>{{ $solicitacao->servico}}</td>
                                        <td>{{ $solicitacao->colaborador }}</td>
                                        <td>
                                            @if($solicitacao->status_comissao == 1)
                                            AUTORIZADO
                                            @elseif($solicitacao->status_comissao == 1)
                                            NÃO AUTORIZADO
                                            @else
                                            AGUARDANDO
                                            @endif
                                        </td>
                                        <td>{{ $solicitacao->vlr_plano }}</td>
                                        <td>{{ $solicitacao->vlr_servico }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                        </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                          <ul class="pagination pagination-sm m-0 float-right">
                                {{-- {{ $solicitacaos->render() }} --}}
                          </ul>
                        </div>
                      </div>
                      <!-- /.card -->
                    </div>
                  </div>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection
