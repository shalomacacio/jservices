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
            <h1>Autorizar Comissões</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Comissão</a></li>
              <li class="breadcrumb-item active">Comissões</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
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
                          <table class="table table-bordered" id="example1">
                            <thead>
                              <tr>
                                <th>Data</th>
                                <th>Cliente</th>
                                <th>Serviço </th>
                                <th>Colaborador</th>
                                <th>Status</th>
                                <th>Valor</th>
                                <th>Ações </th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($comissaos as $comissao)
                                    <tr>
                                        <td>{{  \Carbon\Carbon::parse($comissao->dt_referencia)->format('d/m') }}</td>
                                        <td>{{ $comissao->solicitacao->nome_razaosocial }}</td>
                                        <td>{{ $comissao->solicitacao->categoriaServico->descricao }}</td>
                                        <td>{{ $comissao->user->name}} {{ $comissao->user->sobrenome}}</td>
                                        <td>{{ $comissao->solicitacao->statusSolicitacao->descricao}}</td>
                                        <td>{{ $comissao->comissao_vlr}}</td>
                                        <td>
                                          @if( $comissao->solicitacao->status_solicitacao_id == 3)
                                            <form action="{{ route('comissao.autorizar', $comissao->id)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button class="btn btn-warning"    type="submit"  onclick="return confirm('Autorizar Solicitação ?')"   name = "flg_autorizado" value="1"><i class="fas fa-dollar"></i></button>
                                            <button class="btn btn-danger"     type="button" data-id="{{ $comissao->id }}" ><i class="fab fa-creative-commons-nc"></i></button>
                                              </form>
                                              @endif
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
                                {{-- {{ $comissaos->render() }} --}}
                          </ul>
                        </div>
                      </div>
                      <!-- /.card -->
                    </div>
                  </div>
                </div>
            </div>
        </section>
    </div>
</div>
@include('comissaos.modal')
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
    $('#formNautorizar').attr('action', 'http://localhost:8000/comissaos/'+ id +'/nAutorizar');
    $('#myModal').modal('show');
  });

</script>

@stop
