@extends('layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Adesões:</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">relatorios</a></li>
            <li class="breadcrumb-item active">comissoes</li>
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
            <center><h3>RELATÓRIO DE ADESÕES  POR PERÍODO </h3></center>
            <br/>
            <!-- Table row -->


          <div class="col-12">
          <p class="lead"><b>Adesão: </b></p>
          </div>

            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped table-sm ">
                  <thead>
                  <tr>
                    <th>Data</th>
                    <th>Cliente</th>
                    <th>Consultor</th>
                    <th>Técnico</th>
                    <th>Plano</th>
                    <th>Taxa</th>

                  </tr>
                  </thead>
                  <tbody>
                  @foreach($solicitacaos as $solicitacao)
                  <tr>
                    <td>{{\Carbon\Carbon::parse($solicitacao->dt_conclusao)->format('d/m/Y') }}</td>
                    <td>{{ $solicitacao->nome_razaosocial}}</td>
                    <td>{{ $solicitacao->consultor}} </td>
                    <td>{{ $solicitacao->tecnico}} </td>
                    <td>R$ {{ $solicitacao->vlr_plano}} </td>
                    <td>
                      R$ @isset($solicitacao->vlr_servico) {{ $solicitacao->vlr_servico}} @endisset
                         @empty($solicitacao->vlr_servico)  0.00 @endempty
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                    <tr>
                      <th colspan="5">Subtotal:</th>
                    <th >R$ </th>
                    </tr>
                </table>
              </div>
              <!-- /.col -->
            </div>
          <br/>



          <div class="row">
            <!-- accepted payments column -->
            <div class="col-6">
              <p class="lead"></p>
              <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">

              </p>
            </div>
            <!-- /.col -->
            <div class="col-6">


              <div class="table-responsive">
                @if($request->funcionario_id == 0)
                <table class="table">
                  <tr>

                    <th colspan="3">Total:</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th><h4>R$ </h4></th>
                  </tr>
                </table>
                @endif
              </div>
            </div>
            <!-- /.col -->
          </div>
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
