@extends('layouts.master')

@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Contratos:</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">relatorios</a></li>
            <li class="breadcrumb-item active">contratos</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
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
            <center><h3>RELATÓRIO DE CONTRATOS  </h3></center>
            <br/>
            <!-- Table row -->


          <div class="col-12">
          <p class="lead"><b>Serviços: </b></p>
          </div>

            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped table-sm ">
                  <thead>
                  <tr>
                    <th>Codigo</th>
                    <th>Cliente</th>
                    <th>Contato 1</th>
                    <th>Contato 2</th>
                    <th>Endereco </th>
                    <th>Bairro </th>
                    <th>Dt Adesao</th>
                    <th>Dt Cancel</th>
                    <th>Tipo Motivo</th>
                    <th>Desc Motivo </th>
                    <th>Inativo </th>
                    <th>Valor</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($contratos as $contrato)
                  <tr>
                    <td>{{ $contrato->codcontrato }}</td>
                    <td>{{ $contrato->nome_razaosocial }}</td>
                    <td>{{ $contrato->fone01 }}</td>
                    <td>{{ $contrato->fone02 }}</td>
                    <td>{{ $contrato->logradouro}}</td>
                    <td>{{ $contrato->bairro}}</td>
                    <td> {{\Carbon\Carbon::parse($contrato->adesao)->format('d/m/Y') }} </td>
                    <td> {{\Carbon\Carbon::parse($contrato->dt_cancelamento)->format('d/m/Y') }} </td>
                    <td>{{ $contrato->descricao_mot_cancel }}</td>
                    <td>{{ $contrato->motivo_cancelamento }}</td>
                    <td>{{ $contrato->inativo }}</td>
                    <td>{{ $contrato->vlr_renovacao }}</td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          <br/>
          <!-- /.row -->
            <!-- this row will not appear when printing -->
            <div class="row no-print">
              <div class="col-12">
                <a href="javascript:void(0)" onClick="window.print()" class="btn btn-default float-right"><i class="fas fa-print"></i> Imprimir</a>
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
