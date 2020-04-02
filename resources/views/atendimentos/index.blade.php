@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Cliente</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Cliente</a></li>
            <li class="breadcrumb-item active">Novo Cliente</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->

    {{-- alerts --}}
    @include('layouts.alerts')
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Clientes</h3>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-sm table-striped table-hover table-bordered ">
                <thead>
                  <tr>
                    <th>Data </th>
                    <th>Cliente</th>
                    {{-- <th>Processo </th> --}}
                    <th style="200 px">Descricao</th>
                    <th>Status </th>
                    <th>Tempo </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($mkAtendimentos as $atendimento)
                  <tr>
                    <td class="d-none d-sm-table-cell">{{ \Carbon\Carbon::parse($atendimento->dt_hr_limite_fim_processo )->format('d/m') }} </td>
                    <td>{{ $atendimento->mkPessoa->nome_razaosocial }}</td>
                    {{-- <td>{{ $atendimento->mkProcesso->nome_processo }}</td> --}}
                    <td>{{ $atendimento->info_cliente }}</td>
                    <td class="d-none d-sm-table-cell">{{ \Carbon\Carbon::parse($atendimento->dt_hr_limite_fim_processo)->diffForHumans(\Carbon\Carbon::now()->format('Y-m-d H:i:s')) }} </td>
                    {{-- <td>
                    <form action="{{route('clientes.destroy', $cliente->id)}}" method="POST">
                    <a class="btn btn-info" href="{{route('clientes.edit', $cliente->id)}}"><i class="fas fa-edit"></i></a>
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit" onclick="return confirm('Excluir Cliente ?')"><i class="fas fa-trash"></i></button>
                    </form>
                    </td> --}}
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                {{ $mkAtendimentos->render() }}
              </ul>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div><!-- /.row -->
  </section>
</div>
</div>

@endsection
