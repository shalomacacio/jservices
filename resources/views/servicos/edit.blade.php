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
            <h3 class="card-title">Editar Serviço</h3>
          </div>
          <form role="form" action="{{ route('servicos.update', $servico->id) }}" method="POST">
          <!-- /.card-header -->
          <div class="card-body">
            @csrf
            @method('PUT')
           <div class="row">

              <div class="col-sm-3">
                <div class="form-group">
                  <label>Categoria</label>
                  <select class="form-control" name="categoria_servico_id" required>
                    <option value="{{ $servico->categoria_servico_id}}">{{ $servico->categoriaServico->descricao}}</option>
                    @foreach( $categorias as $categoria)
                      <option value="{{ $categoria->id}}">{{ $categoria->descricao}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                  <label>Serviço</label>
                <input type="text" class="form-control" name="descricao" value="{{$servico->descricao}}" required>
                </div>
              </div>

              <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                  <label>Valor</label>
                  <input type="text" class="form-control" name="servico_vlr"  value="{{$servico->servico_vlr}}" >
                </div>
              </div>

              <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                  <label>Pontos</label>
                  <input type="text" class="form-control" name="pontuacao"  value="{{$servico->pontuacao}}"  >
                </div>
              </div>

              <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                  <label>Comissão Atendimento</label>
                  <input type="text" class="form-control" name="comissao_atendimento"  value="{{$servico->comissao_atendimento}}"  >
                </div>
              </div>


              <div class="col-sm-1">
                  <!-- checkbox -->
                  <div class="form-group">
                    <br/>
                    @foreach($tipoComissaos as $tipo)
                    <div class="form-check">
                    <input class="form-check-input" name="tipo_comissao_atendimento"
                    value="{{$tipo->id}}" type="checkbox" @if($tipo->id == $servico->tipo_comissao_atendimento) checked @endif>
                    <label class="form-check-label">{{ $tipo->descricao }}</label>
                    </div>
                    @endforeach
                  </div>
                </div>

              <div class="col-sm-3">
                <!-- text input -->
                <div class="form-group">
                  <label>Comissão Equipe</label>
                  <input type="text" class="form-control" name="comissao_equipe"  value="{{$servico->comissao_equipe}}" >
                </div>
              </div>

              <div class="col-sm-1">
                  <!-- checkbox -->
                  <div class="form-group">
                    <br/>
                    @foreach($tipoComissaos as $tipo)
                    <div class="form-check">
                    <input class="form-check-input" name="tipo_comissao_equipe"
                    value="{{$tipo->id}}" type="checkbox" @if($tipo->id == $servico->tipo_comissao_equipe) checked @endif >
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
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>
@stop