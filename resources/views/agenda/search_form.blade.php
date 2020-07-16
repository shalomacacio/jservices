          <div class="row">
            <div class="col-md-12 col-sm-12 col-12">
              <div class="callout callout-info">
                <center>
                  <form action="{{ route('agenda')}}" method="GET">

                    <div class="form-group"  style="width: 200px;">
                      <label>Turno</label>
                      <select class="form-control" name="grupo[]" >
                        <option value="">--Selecione--</option>
                        @foreach ($agendaGrupo as $grupo)
                      <option value="{{ $grupo->codagenda_grupo }}">{{ $grupo->nome }}</option>
                        @endforeach
                      </select>
                    </div>

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
