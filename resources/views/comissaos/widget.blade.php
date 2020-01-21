<div class="row">
  <div class="col-12 col-sm-6 col-md-4">
    <div class="info-box">
      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-exclamation-triangle"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">AGUARDANDO</span>
        <span class="info-box-number">
          <small>R$:</small>
           {{number_format($aguardando, 2) }}
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-12 col-sm-6 col-md-4">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-danger elevation-1"><i class="fab fa-creative-commons-nc"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">NÃO AUTORIZADO</span>
        <span class="info-box-number">
        <small>R$:</small>
        {{number_format($nAutorizado, 2) }}
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <!-- fix for small devices only -->
  <div class="clearfix hidden-md-up"></div>

  <div class="col-12 col-sm-6 col-md-4">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-success elevation-1"><i class="fas fa-dollar"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">AUTORIZADO</span>
        <span class="info-box-number">
        <small>R$:</small>
        {{number_format($autorizado, 2) }}
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

</div>
<!-- /.row -->
