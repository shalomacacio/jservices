@extends('layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Serviços:</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">relatorios</a></li>
            <li class="breadcrumb-item active">servicos</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          {{-- <div class="callout callout-info">
            <h5><i class="fas fa-info"></i> Note:</h5>
            This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
          </div> --}}


          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  <i class="fas fa-globe"></i> JNET - Telecom
                <small class="float-right">Date: {{ \Carbon\Carbon::now()}}</small>
                </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                Data Inicial
                <address>
                  <strong>{{ \Carbon\Carbon::parse($request->dt_inicio)->format('d/m/Y')}}</strong><br>
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                Data Final
                <address>
                  <strong>{{ \Carbon\Carbon::parse($request->dt_fim)->format('d/m/Y')}}</strong><br>
                </address>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
            <center><h3>RELATÓRIO DE SERVIÇOS  POR PERÍODO </h3></center>
            <br/>
            <!-- Table row -->


          <div class="col-12">
          <p class="lead"><b>Serviços: {{$totalServicos}}</b></p>
          </div>

            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped table-sm" >
                  <thead>
                  <tr>
                    <th>Dt Abert</th>
                    <th>Dt Encer Mob</th>
                    <th>Dt Encer O.S</th>
                    <th>Cliente</th>
                    <th>Serviço</th>
                    <th>Operador</th>
                    <th>Consultor</th>
                    <th>Técnico</th>
                    <th>Plano</th>
                    <th>Taxa </th>
                    <th>Inativo </th>
                    <th>Classificacao</th>
                    <th>Serv Prestado</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($ordens as $os)
                  <tr>
                    <td title="Cod: {{ $os->operador }}" >{{\Carbon\Carbon::parse($os->data_abertura)->format('d/m/Y') }}</td>
                    <td>@isset($os->dt_hr_fechamento_tec){{\Carbon\Carbon::parse($os->dt_hr_fechamento_tec)->format('d/m/Y') }}@endisset</td>
                    <td>@isset($os->data_fechamento) {{\Carbon\Carbon::parse($os->data_fechamento)->format('d/m/Y') }}@endisset</td>
                  <td title="O.S: {{ $os->codos }}" >{{ $os->cliente}}</td>
                    <td>
                      @isset($os->tipo ) {{ $os->tipo }} @endisset
                    </td>
                    <td>
                      @isset($os->operador ) {{ strtoupper($os->operador) }} @endisset
                    </td>
                    <td>@isset($os->consult2) {{ $os->consult2 }} @endisset</td>
                    <td>@isset($os->usr_nome ) {{ $os->usr_nome }} @endisset </td>
                    <td>@isset($os->vlr_renovacao ) {{ $os->vlr_renovacao }} @endisset </td>
                    <td>@isset($os->indicacoes ) {{ $os->indicacoes }} @endisset </td>
                    <td>{{ $os->inativo }}</td>
                    <td>
                    @if($os->classificacao_encerramento == 25)
                      Concluido
                      @elseif($os->classificacao_encerramento == 27)
                      Cancelado
                      @elseif($os->classificacao_encerramento == 29)
                      N Autorizado
                      @else
                      SEM CLASSIFICACAO
                      </td>
                    @endif
                    <td> {{ $os->servico_prestado }} </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
          <br/>

          {{-- <div class="row">
            <!-- accepted payments column -->
            <div class="col-6"></div>
            <div class="col-3">
              <p class="lead">Por Consultor</p>
              <div class="table-responsive">
                <table class="table">
                  <th colspan="3">Por Consultor:</th>
                    @foreach ($porConsultor as $consultor => $list)
                      <tr>
                        <td>{{ $consultor }}</td>
                        <td>{{ $list->count() }}</td>
                      </tr>
                    @endforeach
                    <th>Total</th>
                    <th>{{ $solicitacaos->count() }}</th>
                </table>
              </div>
            </div>
            <!-- /.col -->

            <div class="col-3">
              <p class="lead">Por Técnico</p>
              <div class="table-responsive">
                <table class="table">
                    @foreach ($porTecnico as $tecnico => $list)
                      <tr>
                        <td>{{ $tecnico }}</td>
                        <td>{{ $list->count() }}</td>
                      </tr>
                    @endforeach
                    <th>Total</th>
                    <th>{{ $solicitacaos->count() }}</th>
                </table>
              </div>
            </div>

          </div> --}}
          <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
              <div class="col-12">
                <a href="javascript:void(0)" onClick="window.print()" class="btn btn-default float-right"><i class="fas fa-print"></i> Imprimir</a>
                {{-- <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card" disabled></i> Submit
                  Payment
                </button>
                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                  <i class="fas fa-download"></i> Generate PDF
                </button> --}}
              </div>
            </div>
          </div>
          <!-- /.invoice -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
</div>
@endsection
