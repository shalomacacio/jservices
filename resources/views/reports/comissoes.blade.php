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
            <center><h3>RELATÓRIO DE COMISSÕES POR PERÍODO </h3></center>
            <br/>
            <!-- Table row -->
          @foreach ($comissaos as $user => $lista)

          <div class="col-12">
          <p class="lead"><b>Colaborador: {{ \App\Entities\User::find($user)->name }} {{ \App\Entities\User::find($user)->sobrenome }}</b></p>
          </div>

            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped table-sm ">
                  <thead>
                  <tr>
                    <th>Data</th>
                    <th>Cliente</th>
                    <th>Serviço</th>
                    <th>Pgto.</th>
                    <th>Status </th>
                    <th>Comissao</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($lista as $comissao)
                  <tr>
                    <td>{{\Carbon\Carbon::parse($comissao->dt_referencia)->format('d/m/Y') }}</td>
                    <td>{{$comissao->solicitacao->nome_razaosocial}}</td>
                    <td>{{$comissao->solicitacao->categoriaServico->descricao}} </td>
                    <td>
                      @isset($comissao->solicitacao->tipoPagamento) {{$comissao->solicitacao->tipoPagamento->descricao}} @endisset
                      @empty($comissao->solicitacao->tipoPagamento) -  @endempty
                    </td>
                    <td>@if($comissao->flg_autorizado == 1) AUTORIZADO
                          @elseif(($comissao->flg_autorizado == 0)) NÃO AUTORIZADO
                          @elseif(($comissao->flg_autorizado == 3)) AGUARDANDO
                        @endif</td>
                    @if($comissao->flg_autorizado) <td>R$ {{$comissao->comissao_vlr}}</td> @else <td style="color:red">R$ -{{$comissao->comissao_vlr}}</td> @endif
                  </tr>
                  @endforeach
                  </tbody>
                    <tr>
                      <th colspan="5">Subtotal:</th>
                    <th >R$ {{ number_format($lista->where('flg_autorizado', '=',  1)->sum('comissao_vlr'), 2) }}</th>
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
                    <th><h4>R$ {{ number_format($total,2) }}</h4></th>
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
