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
           {{-- <div class="row invoice-info">
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
            </div>--}}
            <!-- /.row -->
            <center><h3>RELATÓRIO DE CONTATO POR TIPO DE MÍDIA</h3></center>
            <br/>
            <!-- Table row -->



            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped table-sm ">
                  <thead>
                  <tr>
                    <th>Mídia</th>
                    <th style="width: 100px" >Quantidade </th>
                  </tr>
                  </thead>
                  <tbody>



                        @foreach ($solicitacaos->groupby('tipo_midia_id') as $midia => $midias)
                        @foreach ($midias->groupby('descricao') as $descricao => $midiaList )
                        <tr>
                        <td>{{ $descricao }}</td>
                        <td style="text-align: center">{{ $midiaList->count() }}</td>
                      </tr>
                        @endforeach
                        @endforeach



                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
          <br/>



          <div class="row">
            <!-- accepted payments column -->
            <div class="col-5">
              <p class="lead">Impressão:</p>
              <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                Utilizar tamnho de papel A4 deixar as configurações de margens e escala
                no modo Padrão e marcar somente a opção Cabeçalho e Rodapé para o caso
                de utilizar enumeração de páginas.
              </p>
            </div>
            <div class="col-1"></div>
            <!-- /.col -->
            <div class="col-6">
              <p class="lead">Subtotais </p>

              <div class="table-responsive">
                <table class="table">
                  @foreach ($solicitacaos->groupby('descricao')->sortBy('servico_id') as $descricao => $servicos )
                    <tr>
                      <th style="width:50%">{{ $descricao }}:</th>
                      <td style="width:50%"> {{ $servicos->count()}}</td>
                    </tr>


                  @endforeach
                  <tr>
                    <th>TOTAL:</th>
                    <th>{{ $solicitacaos->count() }}</th>
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
