@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Autorizar Comissões</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Comissão</a></li>
              <li class="breadcrumb-item active">Minhas Comissões</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      @include('comissaos.search_form')
      {{-- @include('comissaos.widget') --}}
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
                                <th>Técnico</th>
                                <th>Consultor</th>
                                <th>Plano</th>
                                <th>Status</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($ordens as $os)
                                    <tr>
                                      <td title=" {{$os->codos}} ">{{ \Carbon\Carbon::parse($os->data_fechamento)->format('d/m') }}</td>
                                      <td>{{ $os->cliente }}</td>
                                      <td>{{ $os->tipo }}</td>
                                      <td>{{ $os->usr_nome }}</td>
                                      <td>{{ $os->vendedor }}</td>
                                      <td>{{ $os->plano }}</td>
                                    <td title="{{ $os->codclassifenc}}">{{ $os->classificacao }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                        </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                          <ul class="pagination pagination-sm m-0 float-right">
                                {{-- {{ $ordens->render() }} --}}
                          </ul>
                        </div>
                      </div>
                      <!-- /.card -->
                    </div>
                  </div>
                </div>
        </section>
    </div>
</div>

@endsection
