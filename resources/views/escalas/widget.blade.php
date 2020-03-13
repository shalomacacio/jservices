<div class="row">
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-clipboard-list"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">ABERTOS</span>
        <span class="info-box-number">
          <small>{{ $aberto }}</small>
           {{-- {{number_format($aguardando, 2) }} --}}
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-info elevation-1"><i class="fa fa-motorcycle"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">ENCAMINHADOS</span>
        <span class="info-box-number">
        <small> {{ $encaminhado }} </small>
        {{-- {{number_format($nAutorizado, 2) }} --}}
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-retweet"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">RETORNOS</span>
        <span class="info-box-number">
        <small> {{ $retorno }} </small>
        {{-- {{number_format($nAutorizado, 2) }} --}}
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <!-- fix for small devices only -->
  <div class="clearfix hidden-md-up"></div>

  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-success elevation-1"><i class="fa fa-thumbs-up"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">CONCLUÍDOS</span>
        <span class="info-box-number">
        <small>{{ $concluido }}</small>
        {{-- {{number_format($autorizado, 2) }} --}}
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

</div>
<!-- /.row -->
