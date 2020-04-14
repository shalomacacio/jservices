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
                                <th>Valor</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($comissaos as $comissao)
                                    <tr>
                                        <td>{{  \Carbon\Carbon::parse($comissao->dt_referencia)->format('d/m') }}</td>
                                        <td>{{ $comissao->solicitacao->nome_razaosocial }}</td>
                                        <td>{{ $comissao->solicitacao->categoriaServico->descricao }}</td>
                                        <td>{{ $comissao->user->name}} {{ $comissao->user->sobrenome}}</td>
                                        <td id="motivo" >
                                          @if($comissao->flg_autorizado == 3)
                                            Aguardando
                                          @elseif($comissao->flg_autorizado == 0)
                                            Não Autorizado<br>
                                            Motivo: {{$comissao->motivo}}
                                          @elseif($comissao->flg_autorizado == 1)
                                            Autorizado
                                          @endif
                                        </td>
                                        <td>{{ $comissao->comissao_vlr}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                        </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                          <ul class="pagination pagination-sm m-0 float-right">
                                {{ $comissaos->render() }}
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
