@extends('layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Comissões</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Relatórios</a></li>
            <li class="breadcrumb-item active">Producao Por Periodo</li>
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
            <center><h3>RELATÓRIO DE PRODUÇÃO POR PERÍODO </h3></center>
            <br/>
            <!-- Table row -->
          @foreach ($solicitacaos as $categoria => $solics)



          <div class="col-12">
            <p class="lead"><b>Categoria: {{ $categoria }}</b></p>
          </div>

            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped table-sm ">
                  <thead>
                  <tr>
                    {{-- <th>ServiçoList</th> --}}
                    <th>Data</th>
                    <th>Colaborador</th>
                    <th>Cliente</th>
                    <th style="width: 110px">Plano</th>

                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($solics as $solicitacao)
                      <tr>
                        <td>{{\Carbon\Carbon::parse($solicitacao->data)->format('d-m-Y') }}</td>
                        <td>{{ $solicitacao->colaborador }}</td>
                        <td>{{ $solicitacao->cliente }}</td>
                        <td>{{ $solicitacao->plano }}</td>
                        <td></td>
                      </tr>
                    @endforeach
                  </tbody>
                    <tr>
                      <th>Subtotal:</th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th style="text-align: center"> {{ $solics->count()}}</th>
                    </tr>
                </table>
              </div>
              <!-- /.col -->
            </div>
          <br/>

          @endforeach

          <div class="row">
            <!-- accepted payments column -->
            <div class="col-3">
              <p class="lead">Por Categoria</p>
              <div class="table-responsive">
                <table class="table table-sm">
                  @foreach ($solicitacaos as $categoria => $solics)
                    <tr>
                      <th style="width:50%">{{ $categoria }}:</th>
                      <td style="width:50%"> {{ $solics->count()}}</td>
                    </tr>
                  @endforeach
                </table>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-3">
              <p class="lead">Por Colaborador</p>

              <div class="table-responsive">
                <table class="table table-sm">
                  @foreach ($colaboradores as $nome => $todos)
                    <tr>
                      <th style="width:50%">{{ $nome }}:</th>
                      <td style="width:50%"> {{ $todos->count()}}</td>
                    </tr>
                  @endforeach
                </table>
              </div>
            </div>
            <!-- /.col -->
            <!-- /.col -->
            <div class="col-3">
              <p class="lead">Por Consultor</p>
              <div class="table-responsive">
                <table class="table table-sm">
                  @foreach ($consultores as $consultor => $todos)
                    <tr>
                      <th style="width:50%">{{ $consultor }}:</th>
                      <td style="width:50%"> {{ $todos->count()}}</td>
                    </tr>
                  @endforeach
                </table>
              </div>
            </div>
            <!-- /.col -->
            <!-- /.col -->
            <div class="col-3">
              <p class="lead">Por Tecnico</p>
                <div class="table-responsive">
                  <table class="table table-sm">
                    @foreach ($tecnicos as $tecnico => $todos)
                      <tr>
                        <th style="width:50%">{{ $tecnico }}:</th>
                        <td style="width:50%"> {{ $todos->sum('pontuacao')}}</td>
                      </tr>
                    @endforeach
                  </table>
                </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row float-right">
            <!-- accepted payments column -->
            <div class="col-12">
              <table>
                <tr>
                  <th>TOTAL:</th>
                  <th>{{ $total }} SERVIÇOS REALIZADOS</th>
                </tr>
              </table>
            </div>
          </div>

          <br/>
            <!-- this row will not appear when printing -->
            <div class="row no-print  ">
              <div class="col-12 ">
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
