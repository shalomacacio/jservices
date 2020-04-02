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
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
                <!-- general form elements disabled -->
                <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Novo Cliente</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <form role="form" action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-sm-3">
                            <label>Codigo</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <button type="button" id="search" class="btn btn-info"><i class="fas fa-search">
                                    </i></button>
                                </div>
                                <!-- /btn-group -->
                                <input type="text" class="form-control"  name="codpessoa" id="codpessoa" value="{{$cliente->cod}}">
                              </div>
                        </div>

                        <div class="col-sm-9">
                        <!-- text input -->
                          <div class="form-group">
                              <label>Nome / Razão Social</label>
                          <input type="text" class="form-control" name="nome_razaosocial" id="nome_razaosocial" value="{{$cliente->nome_razaosocial}}" required>
                          </div>
                        </div>


                    </div><!-- /.row -->

                    <div class="row">

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Data Nascimento</label>
                          <input type="date" class="form-control" name="dt_nascimento" id="dt_nascimento"  value="{{$cliente->dt_nascimento}}" required>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>CPF</label>
                          <input type="text" class="form-control" name="cpf" id="cpf"  value="{{$cliente->cpf}}" required>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Telefone</label>
                          <input type="text" class="form-control" name="tel" id="tel" value="{{$cliente->tel}}"  required>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Celular</label>
                          <input type="text" class="form-control" name="cel" id="cel" value="{{$cliente->cel}}" required>
                        </div>
                      </div>
                    </div>

                    <div class="row">

                      <div class="col-sm-5">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Endereco</label>
                          <input type="text" class="form-control" name="endereco" id="endereco" value="{{$cliente->endereco}}" required>
                        </div>
                      </div>

                      <div class="col-sm-1">
                        <!-- text input -->
                        <div class="form-group">
                          <label>N°</label>
                          <input type="text" class="form-control" name="num" id="num" value="{{$cliente->num}}" required>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Bairro</label>
                          <input type="text" class="form-control" name="bairro" id="bairro" value="{{$cliente->bairro}}" required>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Cidade</label>
                          <input type="text" class="form-control" name="cidade" id="cidade" value="{{$cliente->cidade}}" required>
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
                <input type="hidden" value="{{Auth::user()->id}}" name="user_id" />
                </form>
            <!-- /.card -->
            <!-- general form elements disabled -->
              </div>
            </div>
        </section>
    </div>
</div>

@endsection

@section('javascript')
<!-- TYPEHEAD -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
  var path = "{{ route('autocomplete') }}";

  $('input.typeahead').typeahead({
      source:  function (query, process) {
      return $.get(path, { query: query }, function (data) {
        console.log(data)
              return process(data);

          });
      }
  });

</script>
@stop
