@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Solicitações</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Solicitação</a></li>
              <li class="breadcrumb-item active">Solicitações</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    {{-- alerts  --}}
     @include('layouts.alerts')
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
                                <th class="d-none d-sm-table-cell">Data</th>
                                <th>Cliente</th>
                                <th class="d-none d-sm-table-cell">Serviço </th>
                                <th class="d-none d-sm-table-cell">Atendente</th>
                                <th class="d-none d-sm-table-cell">Situação</th>
                                <th style="width: 130px">Ações </th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($solicitacaos as $solicitacao)
                                    <tr>
                                      <td class="d-none d-sm-table-cell">{{ \Carbon\Carbon::parse($solicitacao->dt_agendamento)->format('d/m/Y') }}</td>
                                      <td>{{ $solicitacao->nome_razaosocial }}</td>
                                      <td class="d-none d-sm-table-cell">{{ $solicitacao->categoria }}</td>
                                      <td class="d-none d-sm-table-cell">{{ $solicitacao->user }}</td>
                                      <td class="d-none d-sm-table-cell">{{ $solicitacao->status}}</td>
                                      <td>
                                        <form action="{{route('solicitacao.destroy', $solicitacao->id)}}" method="POST">
                                          <a class="btn btn-info btn-sm" href="{{route('solicitacao.edit', $solicitacao->id)}}" ><i class="fas fa-edit"></i></a>
                                          @csrf
                                          @method('DELETE')
                                          <button class="btn btn-danger btn-sm"  type="submit"  onclick="return confirm('Cancelar a Solicitação ?')"><i class="fas fa-trash"></i></button>
                                        </form>
                                      </td>
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
        </section>
    </div>
</div>

@endsection
