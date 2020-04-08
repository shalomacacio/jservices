@extends('layouts.master')

@section('css')
<!-- Bootgrid -->
<link rel="stylesheet" href="/dist/plugins/bootgrid/jquery.bootgrid.css">
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Fila de Atendimento</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Solicitação</a></li>
              <li class="breadcrumb-item active">Fila </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      @include('layouts.alerts')
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Solicitações</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Data</th>
                <th>Cliente</th>
                <th>Serviço</th>
                <th>Atendente</th>
                <th>Bairro</th>
                <th>Equipe</th>
                <th>Turno</th>
                <th>Status</th>
                <th>Ações</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($solicitacaos as $solicitacao)
                <tr>
                  <td class="d-none d-sm-table-cell">{{ \Carbon\Carbon::parse($solicitacao->dt_agendamento)->format('d/m') }}</td>
                  <td>{{ $solicitacao->nome_razaosocial }}</td>
                  <td>{{ $solicitacao->categoriaServico->descricao }}</td>
                  <td>{{ $solicitacao->user->name}}</td>
                  <td>@isset($solicitacao->mkPessoa->bairro){{ $solicitacao->mkPessoa->bairro->bairro }} @endisset</td>
                  <td class="d-none d-sm-table-cell">
                    @foreach ($solicitacao->users as $tecnico)
                      @isset($tecnico)
                        {{$tecnico->name}} <br/>
                      @endisset
                    @endforeach
                    @empty($solicitacao->users)
                      Nenhum técnico atribuido
                    @endempty
                  </td>
                  <td>@if( $solicitacao->turno == 1 ) MANHÃ @else TARDE @endif</td>
                  <td class="d-none d-sm-table-cell">{{ $solicitacao->statusSolicitacao->descricao}}</td>
                  <td>
                    <form action="{{route('solicitacao.concluir', $solicitacao->id)}}" method="POST">
                      @csrf
                      @method('PUT')
                      @if( $solicitacao->categoria_servico_id != 9)
                        @if($solicitacao->status_solicitacao_id == 1 || $solicitacao->status_solicitacao_id == 6 )
                          <a class="btn btn-info btn-sm" title="encaminhar" id="btn_encaminhar"  href="{{route('solicitacao.encaminhar', $solicitacao->id)}}" ><i class="fa fa-motorcycle"></i></a>
                        @endif
                        @if($solicitacao->status_solicitacao_id == 2)
                          <a class="btn btn-secondary  btn-sm" title="reagendar" href="{{route('solicitacao.reagendar', $solicitacao->id)}}"><i class="fa fa-calendar"></i></a>
                        @endif
                      @endif

                      <button class="btn btn-success btn-sm" type="submit" title="concluir"  onclick="return confirm('Deseja Concluir?')"><i class="fa fa-check"></i></button>
                      <button class="btn btn-danger btn-sm"  type="button" title="cancelar"   data-toggle="modal" data-target="btnModal"  data-id="{{ $solicitacao->id }}" ><i class="fa fa-times"></i></button>

                    </form>
                  </td>
                </tr>

                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>Data</th>
                <th>Cliente</th>
                <th>Serviço</th>
                <th>Atendente</th>
                <th>Bairro</th>
                <th>Equipe</th>
                <th>Turno</th>
                <th>Status</th>
                <th>Ações</th>
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
    </div>
</div>
@include('solicitacaos.modal')
@endsection

@section('javascript')
<!-- DataTables -->
<script src="/dist/plugins/datatables/jquery.dataTables.js"></script>
<script src="/dist/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
{{-- <script src="/dist/plugins/slimScroll/jquery.slimscroll.min.js"></script> --}}

<script>
  $(function () {
    $("#example1").DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "language": {
        search: "Pesquisar" ,
        show: "Mostrar",
        info: "Mostrando pag _PAGE_ de _PAGES_",
        lengthMenu:    "Mostrar _MENU_ ",
        paginate: {
            first:      "Primeiro",
            previous:   "Anterior",
            next:       "Próximo",
            last:       "Último",
        },
      }
    });
  });

  $('button[type="button"]').click(function(){
    var id = $(this).attr("data-id");
    $('#formCancelar').attr('action', 'http://localhost:8000/solicitacao/'+ id +'/cancelar');
    $('#myModal').modal('show');
  });

</script>

@stop
