@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Serviços</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Cadastros</a></li>
              <li class="breadcrumb-item active">Novo Serviço</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->

      {{-- alerts --}}
      @if(Session::has('message'))
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i>Sucesso</h5>
        {{Session::get('message')}}
      </div>
      @elseif($errors->any())
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i>Erro</h5>
          <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
      </div>
      @endif
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="col-md-12">
        <!-- general form elements disabled -->
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">Novo Serviço</h3>
          </div>
          <form role="form" action="{{ route('servicos.store') }}" method="POST">
          <!-- /.card-header -->
          <div class="card-body">
            @csrf
           <div class="row">

              <div class="col-12 col-sm-12 col-md-3">
                <div class="form-group">
                  <label>Categoria</label>
                  <select class="form-control" name="categoria_servico_id" required>
                    @foreach( $categorias as $categoria)
                      <option value="{{ $categoria->id}}">{{ $categoria->descricao}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-12 col-sm-12 col-md-6">
                <!-- text input -->
                <div class="form-group">
                  <label>Serviço</label>
                  <input type="text" class="form-control" name="descricao" placeholder="Nome do serviço ..." required>
                </div>
              </div>

              <div class="col-12 col-sm-12 col-md-3">
                <!-- text input -->
                <div class="form-group">
                  <label>Valor</label>
                  <input type="text" class="form-control" name="servico_vlr" placeholder="" >
                </div>
              </div>

              <div class="col-12 col-sm-12 col-md-3">
                <!-- text input -->
                <div class="form-group">
                  <label>Pontos</label>
                  <input type="text" class="form-control" name="pontuacao" placeholder="" >
                </div>
              </div>

              <div class="col-12 col-sm-12 col-md-3">
                <!-- text input -->
                <div class="form-group">
                  <label>Comissão Atendimento</label>
                  <input type="text" class="form-control" name="comissao_atendimento" >
                </div>
              </div>


              <div class="col-12 col-sm-12 col-md-1">
                  <!-- checkbox -->
                  <div class="form-group">
                    <br/>
                    @foreach($tipoComissaos as $tipo)
                    <div class="form-check">
                    <input class="form-check-input" name="tipo_comissao_atendimento" value="{{$tipo->id}}" type="checkbox">
                    <label class="form-check-label">{{ $tipo->descricao }}</label>
                    </div>
                    @endforeach
                  </div>
                </div>

                <div class="col-12 col-sm-12 col-md-3">
                <!-- text input -->
                <div class="form-group">
                  <label>Comissão Equipe</label>
                  <input type="text" class="form-control" name="comissao_equipe" >
                </div>
              </div>

              <div class="col-12 col-sm-12 col-md-1">
                  <!-- checkbox -->
                  <div class="form-group">
                    <br/>
                    @foreach($tipoComissaos as $tipo)
                    <div class="form-check">
                    <input class="form-check-input" name="tipo_comissao_equipe" value="{{$tipo->id}}" type="checkbox">
                    <label class="form-check-label">{{ $tipo->descricao }}</label>
                    </div>
                    @endforeach
                  </div>
                </div>
            </div><!-- /.row -->
          </div><!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary float-right">Adicionar</button>
          </div>
          </form>
        </div><!-- /.card warning-->
      </div><!-- /.col-m12 -->

      <div class="row">
        <div class="col-md-12">
          <div class="card">

            <div class="card-header">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Serviços Cadastrados</h3>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                  <th style="width: 10px">#</th>
                  <th>Serviço</th>
                  <th>Valor</th>
                  <th>Pontuação</th>
                  <th>Comiss Atend</th>
                  <th>Comiss Eq</th>
                  <th style="width: 150px">Ações</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($servicos as $servico)
                  <tr>
                    <td>{{ $servico->id }}</td>
                    <td>{{ $servico->descricao }}</td>
                    <td>{{ $servico->servico_vlr }}</td>
                    <td>{{ $servico->pontuacao }}</td>
                    <td>@if($servico->tipo_comissao_atendimento == 1) R$  @endif {{ $servico->comissao_atendimento }}@if($servico->tipo_comissao_atendimento == 2) %  @endif </td>
                    <td>@if($servico->tipo_comissao_equipe == 1) R$  @endif {{ $servico->comissao_equipe }}@if($servico->tipo_comissao_equipe == 2) %  @endif </td>
                    <td>
                      <form action="{{route('servicos.destroy', $servico->id)}}" method="POST">
                        <a class="btn btn-info" href="{{route('servicos.edit', $servico->id)}}"  ><i class="fas fa-edit"></i></a>
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger"  type="submit"  onclick="return confirm('Excluir Usuário ?')"><i class="fas fa-trash"></i></button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            </div><!-- /.card-body -->
          </div><!-- /.card -->
        </div><!-- /.col-m12 -->
      </div><!-- /.row -->
    </section>
</div>

@endsection

@section('javascript')
<!-- jQuery -->
<script src="/dist/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)

</script>
<!-- Bootstrap 4 -->
<script src="/dist/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="/dist/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="/dist/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="/dist/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/dist/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="/dist/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="/dist/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="/dist/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/dist/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="/dist/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/dist/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>
@stop
