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
            <li class="breadcrumb-item active">Comissoes</li>
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
            <center><h3>RELATÓRIO DE SERVIÇOS POR  PERÍODO </h3></center>
            <br/>
            <!-- Table row -->
          @foreach ($solicitacaos as $user => $solics)

          <div class="col-12">
            <p class="lead"><b>Colaborador: {{ \App\Entities\User::find($user)->name }} {{ \App\Entities\User::find($user)->sobrenome }}</b></p>
          </div>

            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped table-sm ">
                  <thead>
                  <tr>
                    <th>Serviço</th>
                    <th style="width: 100px" >Quantidade </th>
                  </tr>
                  </thead>
                  <tbody>

                  @foreach ($solics->groupby('descricao') as $servico => $servicos)
                  <tr>
                    <td>{{ $servico }}</td>
                    <td style="text-align: center">{{ $servicos->count() }}</td>
                  </tr>

                  @endforeach

                  </tbody>
                    <tr>
                      <th>Subtotal:</th>
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
            <div class="col-6">
              <p class="lead">Servicos:</p>
              <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                plugg
                dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
              </p>
            </div>
            <!-- /.col -->
            <div class="col-6">
              <p class="lead">Período Due 2/22/2014</p>

              <div class="table-responsive">
                <table class="table">
                  @foreach ($solicitacaos as $descricao => $servicos )
                    <tr>
                      <th style="width:50%">{{ $descricao }}:</th>
                      <th style="width:50%"> {{ $descricao->count()}}</th>
                    </tr>


                  @endforeach
                  <tr>
                    <th>Total:</th>
                    <td>$265.24</td>
                  </tr>
                </table>
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
