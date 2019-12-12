@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Escala</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Cadastro</a></li>
              <li class="breadcrumb-item active">Nova Escala</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
                <!-- general form elements disabled -->
                <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Nova Escala</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <form role="form" action="{{ route('escalas.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Data:</label>
                            <input type="date" class="form-control" name="dt_escala"  required>
                        </div>
                        </div>

                        <div class="col-sm-4">
                            <!-- select -->
                            <div class="form-group">
                                <label>Colaboradores</label>
                                <select multiple class="form-control" name="users[]" required>
                                    @foreach( $users as $user)
                                        <option value="{{ $user->id}}">{{ $user->name }} {{ $user->sobrenome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info float-right">Adicionar</button>
                </div>
                <!-- /.card-body -->
                </div>
                </form>
            <!-- /.card -->
            <!-- general form elements disabled -->
              </div>
            </div>

            <div class="row">
            <div class="col-md-12">
              <div class="card">

                <div class="card-header">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title">Escalas Cadastradas</h3>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                      <th style="width: 10px">#</th>
                      <th>Data</th>
                      <th>Colaboradores</th>
                      <th>Ações</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($escalas as $escala)
                      <tr>
                        <td>{{ $escala->id }}</td>
                        <td>{{ $escala->dt_escala }}</td>
                        <td>
                          @foreach ($escala->users as $user)
                            {{$user->name}} {{$user->sobrenome}}  /
                          @endforeach
                        </td>
                        <td>
                          <form action="{{route('escalas.destroy', $escala->id)}}" method="POST">
                            <a class="btn btn-info" href="{{route('escalas.edit', $escala->id)}}"  onclick="return confirm('Deseja Editar?')"><i class="fas fa-edit"></i></a>
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger"  type="submit"  onclick="return confirm('Excluir Escala ?')"><i class="fas fa-trash"></i></button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div><!-- /.card-body -->
              </div><!-- /.card -->
            </div><!-- /.col-m12 -->
          </div><!-- /.row -->
        </section>
    </div>
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