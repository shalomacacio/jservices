          <div class="row">
            <div class="col-md-12 col-sm-12 col-12">
              <div class="callout callout-info">
                <center>
                  <form action="{{ route('escalas.agenda2')}}" method="GET">
                    <div class="input-group input-group-sm" style="width: 200px;">
                      <input type="date" name="dt_escala" class="form-control" placeholder="Search" @isset($data) value="{{\Carbon\Carbon::parse($data)->format('Y-m-d')}}" @endisset required>
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                  </form>
                </center>
              </div>
            </div>
          </div>
