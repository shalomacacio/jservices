          <div class="row">
            <div class="col-md-12 col-sm-12 col-12">
              <div class="callout callout-info">
                <center>
                  <form action="{{ route('solicitacoes.searchAtendimento') }}" method="GET">
                    @csrf
                    <div class="input-group input-group-sm" style="width: 200px;">
                      <input type="text" class="form-control" name="codatendimento" id="codatendimento"
                      @isset($solicitacao->codatendimento)
                        value="{{$solicitacao->codatendimento}}"
                      @endisset>                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default" id="search"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                  </form>
                </center>
              </div>
            </div>
          </div>
