@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Planos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Cadastros</a></li>
              <li class="breadcrumb-item active">Novo Plano</li>
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
          <form role="form" action="{{ route('planos.update', $plano->id) }}" method="POST">
            @csrf
            @method('PUT')
          <!-- /.card-header -->
          <div class="card-body">

           <div class="row">

              <div class="col-12 col-sm-12 col-md-6">
                <!-- text input -->
                <div class="form-group">
                  <label>Plano</label>
                  <input type="text" class="form-control" name="descricao" @isset($plano->descricao)
                     value="{{ $plano->descricao }}"
                  @endisset  required>
                </div>
              </div>

              <div class="col-12 col-sm-12 col-md-3">
                <!-- text input -->
                <div class="form-group">
                  <label>Valor</label>
                  <input type="text" class="form-control" name="vlr_plano" @isset($plano->vlr_plano)
                  value="{{ $plano->vlr_plano }}"
               @endisset  >
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
