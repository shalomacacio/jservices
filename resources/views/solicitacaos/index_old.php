@extends('layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Solicitação</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Solicitação</a></li>
              <li class="breadcrumb-item active">Nova Solicitação</li>
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
                    <h3 class="card-title">Nova Solicitação</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <form id="form" role="form" action="{{ route('solicitacao.store') }}" method="POST">
                    @csrf

                    <div class="row">
                      <div class="col-12 col-sm-12 col-md-2">
                            <label>Codigo</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <button type="button" id="search" class="btn btn-info"><i class="fas fa-search">
                                    </i></button>
                                </div>
                                <!-- /btn-group -->
                                <input type="text" class="form-control"  name="codpessoa" id="codpessoa">
                              </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-4">
                          <div class="form-group">
                            <label>Cliente</label>
                             <input type="text" class="form-control" name="cliente" id="typeahead" data-provide="typeahead" data-items="4" >
                          </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-3">
                          <!-- select -->
                          <div class="form-group">
                              <label>Vend/Atend</label>
                              <select class="form-control" name="user_id" id="user_id"  required>
                                <option value=null>-- Selecione --</option>
                                @foreach( $users as $user)
                                      <option value="{{ $user->id}}">{{ $user->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                          </div>

                          <div class="col-12 col-sm-12 col-md-3">
                            <!-- select -->
                            <div class="form-group">
                                <label>Categoria</label>
                                <select class="form-control" name="categoria_servico_id" id="categoria_servico_id"  required>
                                  <option value=null>-- Selecione --</option>
                                  @foreach( $categorias as $categoria)
                                        <option value="{{ $categoria->id}}">{{ $categoria->descricao}}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                    </div>
                    <div class="row">
                      <div class="col-12 col-sm-12 col-md-2 plano migracao" hidden>
                        <!-- select -->
                        <div class="form-group">
                            <label>Plano</label>
                            <select class="form-control" name="plano_id" id="plano_id" >
                                <option value=null>--Selecione--</option>
                                @foreach ($planos as $plano)
                                  <option value={{$plano->id}}>{{$plano->descricao}}</option>
                                @endforeach
                            </select>
                        </div>
                      </div>

                      <div class="col-12 col-sm-12 col-md-2 plano migracao" hidden>
                        <!-- text input -->
                        <div class="form-group">
                            <label>Valor</label>
                            <input type="text" class="form-control" name="vlr_plano" id="vlr_plano"  readonly >
                        </div>
                        </div>

                    <div class="col-12 col-sm-12 col-md-2 plano migracao" hidden>
                    <!-- select -->
                      <div class="form-group">
                        <label>Tecnologia</label>
                        <select class="form-control" name="tecnologia_id">
                          <option value=null>--Selecione--</option>
                          @foreach ($tecnologias as $tecnologia)
                            <option value={{$tecnologia->id}}>{{$tecnologia->descricao}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-2 plano migracao" hidden>
                      <!-- select -->
                      <div class="form-group">
                          <label>Forma Pag</label>
                          <select class="form-control" name="tipo_pagamento_id">
                              <option value=null>--Selecione--</option>
                              @foreach ($tipoPagamentos as $tipo)
                              <option value={{$tipo->id}}>{{$tipo->descricao}}</option>
                            @endforeach
                          </select>
                      </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-2 plano " hidden>
                      <!-- select -->
                      <div class="form-group">
                          <label>Equipamentos</label>
                          <select class="form-control" name="tipo_aquisicao_id">
                              <option value=null>--Selecione--</option>
                              @foreach ($tipoAquisicaos as $tipo)
                                <option value={{$tipo->id}}>{{$tipo->descricao}}</option>
                              @endforeach
                          </select>
                      </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-2 plano " hidden>
                        <!-- select -->
                        <div class="form-group">
                            <label>Como coheceu ?</label>
                            <select class="form-control" name="tipo_midia_id">
                                <option value="0">--Selecione--</option>
                                @foreach ($tipoMidia as $tipo)
                                  <option value={{$tipo->id}}>{{$tipo->descricao}}</option>
                                @endforeach
                            </select>
                        </div>
                      </div>
                    </div>

                  <div class="row">
                      <div class="col-12 col-sm-12 col-md-8">
                        <!-- textarea -->
                        <div class="form-group">
                        <label>Observação</label>
                        <textarea class="form-control" name="obs" rows="1" placeholder="Observação ..."></textarea>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-4">
                      <!-- text input -->
                      <div class="form-group">
                          <label>Agendar para:<param name="" value=""></label>
                          <input type="date" class="form-control" name="dt_agendamento"  >
                      </div>
                    </div>
                  </div>
                    <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info float-right">Adicionar</button>
                </div>
                <!-- /.card-body -->
                </div>
                <input type="hidden"  name="comissao_atendimento" />
                <input type="hidden"  name="cliente_id" id="cliente_id" />
                <input type="hidden"  name="comissao_equipe" />
                <input type="hidden"  name="comissao_supervisor" />
                </form>
            <!-- /.card -->
            <!-- general form elements disabled -->
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-dollar"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">MES ANTERIOR</span>
                    <span class="info-box-number">
                      <small>R$:</small>
                       {{number_format($comissaos->where('flg_autorizado', '=',  3 )->sum('comissao_vlr'),2)  }}
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>

              <div class="col-12 col-sm-6 col-md-3">
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
              <div class="col-12 col-sm-6 col-md-3">
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

              <div class="col-12 col-sm-6 col-md-3">
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
            <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">{{ \Carbon\Carbon::now()->format('F') }}</h3>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <div class="table-responsive">
                          <table class="table table-sm table-striped table-hover table-bordered " >
                            <thead>
                              <tr>
                                <th class="d-none d-sm-table-cell" >Data</th>
                                <th>Cliente</th>
                                <th class="d-none d-sm-table-cell">Serviço </th>
                                <th class="d-none d-sm-table-cell">Status </th>
                                <th>Autorizado</th>
                                <th>Comissão </th>
                                <th>Ações </th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($comissaos as $comissao)
                                    <tr>
                                        <td class="d-none d-sm-table-cell">{{ \Carbon\Carbon::parse($comissao->dt_referencia)->format('d/m/Y') }}</td>
                                        <td style="text">{{ $comissao->solicitacao->cliente->nome_razaosocial}}</td>
                                        <td class="d-none d-sm-table-cell">{{ $comissao->servico->descricao }}</td>
                                        <td class="d-none d-sm-table-cell">{{ $comissao->solicitacao->statusSolicitacao->descricao}}</td>
                                        <td> @if($comissao->flg_autorizado == 3 ) aguard @elseif($comissao->flg_autorizado == 0) nao @elseif($comissao->flg_autorizado == 1) sim @endif </td>
                                        <td  style="color: @if($comissao->flg_autorizado != 1 ) red  @endif ">R$ {{ $comissao->comissao_vlr }}</td>
                                        <td>
                                          <form action="{{route('solicitacao.destroy', $comissao->solicitacao->id)}}" method="POST">
                                            @if($comissao->solicitacao->status_solicitacao_id == 1)
                                            <a class="btn btn-info btn-sm" href="{{route('solicitacao.edit', $comissao->solicitacao->id)}}" ><i class="fas fa-edit"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"  type="submit"  onclick="return confirm('Cancelar a Solicitação ?')"><i class="fas fa-trash"></i></button>
                                            @endif
                                          </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                        </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                          <ul class="pagination pagination-sm m-0 float-right">
                            {{-- {{ $comissaos->render() }} --}}
                          </ul>
                        </div>
                      </div>
                      <!-- /.card -->
                    </div>
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
<!-- Select2 -->
<script src="/dist/plugins/select2/select2.full.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<script type="text/javascript">
  $('select[name=categoria_servico_id]' ).change(function () {
      var item = $(this).val()
      console.log(item);
      habilitaCampos(item);
  });

  function habilitaCampos(item){
    switch (item) {
      case '1':
        $('.plano').removeAttr('hidden');
        break;
      case '4':
        desabilitaCampos();
        $('.migracao').removeAttr('hidden');
        break;
      default:
        $('.plano').attr('hidden', true);
    }
  }

  function desabilitaCampos(){
    // $("#form :input").attr("hidden",true);
    $(".plano").attr("hidden",true);

  }


  $('select[name=plano_id]').change(function () {
    ajaxValor();
  });

      //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })


  $('#search').click( function () {
    ajaxCliente();
  });

  function ajaxServicos(){
    $.ajax({
        type: "GET",
        data: {categoria_servico_id: $("#categoria_servico_id").val()},
        url: "/solicitacao/ajaxServicos",
        dataType: 'JSON',
        success: function(response) {
          $('select[name=servico_id]').empty();
          // alert(categoria_servico_id.value );
          if(categoria_servico_id){
            $('select[name=servico_id]').append('<option value=' + null + '>--Selecione--</option>');
          }
          $.each(response.servicos, function (key, value) {

            $('select[name=servico_id]').append('<option value=' + value.id + '>' + value.descricao + '</option>');
          })
        }
    });
  }

  function ajaxCliente(){
    $.ajax({
        type: "GET",
        data: {codpessoa: $("#codpessoa").val()},
        url: "/solicitacao/ajaxCliente",
        dataType: 'JSON',
        success: function(response) {
          if(response.error){
            alert("Erro:"+ response.message);
          } else {
            $('#cliente').val(response.result[0]['nome_razaosocial']);
          }
        },
        error: function(response){
          alert("A conexão com MKSOLUTION falhou!")
        }
    });
  }

  function ajaxValor(){
    $.ajax({
        type: "GET",
        data: {plano_id: $("#plano_id").val()},
        url: "/solicitacao/ajaxValor",
        dataType: 'JSON',
        success: function(response) {
          console.log(response.vlr_plano)
          $('#vlr_plano').val(response.vlr_plano);
        }
    });
  }

  var cli = function (request, response) {
        $.ajax({
          url: "{{ route('autocomplete') }}",
          data: {
            query : request.term
            },
          dataType: "json",
          success: function(data){
            var resp = $.map(data,function(obj){
              if(obj.id){
                $('#cliente_id').val(obj.id);
              }else if(obj.codpessoa){
                $('#codpessoa').val(obj.codpessoa);

              }


              console.log(obj);
              return obj.nome_razaosocial;
            });
            response(resp);
          }
        });
      }

    $( "#typeahead" ).autocomplete({
      source: cli,
      minLength: 1
    });

</script>

@stop

{{--
//json-genarator.com for mock data
$.get("https://next.json-generator.com/api/json/get/V1cGoKmDV", function(data){
    console.log(data);
    // use a data source with 'id' and 'name' keys
    $("#query").typeahead({ source:data });
},'json');


//https://github.com/bassjobsen/Bootstrap-3-Typeahead
!function(root,factory)
{"use strict";"undefined"!=typeof module&&module.exports?module.exports=factory(require("jquery")):"function"==typeof define&&define.amd?define(["jquery"],function($){return factory($)}):factory(root.jQuery)}(this,function($){"use strict";var Typeahead=function(element,options){this.$element=$(element),this.options=$.extend({},Typeahead.defaults,options),this.matcher=this.options.matcher||this.matcher,this.sorter=this.options.sorter||this.sorter,this.select=this.options.select||this.select,this.autoSelect="boolean"!=typeof this.options.autoSelect||this.options.autoSelect,this.highlighter=this.options.highlighter||this.highlighter,this.render=this.options.render||this.render,this.updater=this.options.updater||this.updater,this.displayText=this.options.displayText||this.displayText,this.itemLink=this.options.itemLink||this.itemLink,this.itemTitle=this.options.itemTitle||this.itemTitle,this.followLinkOnSelect=this.options.followLinkOnSelect||this.followLinkOnSelect,this.source=this.options.source,this.delay=this.options.delay,this.theme=this.options.theme&&this.options.themes&&this.options.themes[this.options.theme]||Typeahead.defaults.themes[Typeahead.defaults.theme],this.$menu=$(this.options.menu||this.theme.menu),this.$appendTo=this.options.appendTo?$(this.options.appendTo):null,this.fitToElement="boolean"==typeof this.options.fitToElement&&this.options.fitToElement,this.shown=!1,this.listen(),this.showHintOnFocus=("boolean"==typeof this.options.showHintOnFocus||"all"===this.options.showHintOnFocus)&&this.options.showHintOnFocus,this.afterSelect=this.options.afterSelect,this.afterEmptySelect=this.options.afterEmptySelect,this.addItem=!1,this.value=this.$element.val()||this.$element.text(),this.keyPressed=!1,this.focused=this.$element.is(":focus")};Typeahead.prototype={constructor:Typeahead,setDefault:function(val){if(this.$element.data("active",val),this.autoSelect||val){var newVal=this.updater(val);newVal||(newVal=""),this.$element.val(this.displayText(newVal)||newVal).text(this.displayText(newVal)||newVal).change(),this.afterSelect(newVal)}return this.hide()},select:function(){var val=this.$menu.find(".active").data("value");if(this.$element.data("active",val),this.autoSelect||val){var newVal=this.updater(val);newVal||(newVal=""),this.$element.val(this.displayText(newVal)||newVal).text(this.displayText(newVal)||newVal).change(),this.afterSelect(newVal),this.followLinkOnSelect&&this.itemLink(val)?(document.location=this.itemLink(val),this.afterSelect(newVal)):this.followLinkOnSelect&&!this.itemLink(val)?this.afterEmptySelect(newVal):this.afterSelect(newVal)}else this.afterEmptySelect(newVal);return this.hide()},updater:function(item){return item},setSource:function(source){this.source=source},show:function(){var element,pos=$.extend({},this.$element.position(),{height:this.$element[0].offsetHeight}),scrollHeight="function"==typeof this.options.scrollHeight?this.options.scrollHeight.call():this.options.scrollHeight;if(this.shown?element=this.$menu:this.$appendTo?(element=this.$menu.appendTo(this.$appendTo),this.hasSameParent=this.$appendTo.is(this.$element.parent())):(element=this.$menu.insertAfter(this.$element),this.hasSameParent=!0),!this.hasSameParent){element.css("position","fixed");var offset=this.$element.offset();pos.top=offset.top,pos.left=offset.left}var newTop=$(element).parent().hasClass("dropup")?"auto":pos.top+pos.height+scrollHeight,newLeft=$(element).hasClass("dropdown-menu-right")?"auto":pos.left;return element.css({top:newTop,left:newLeft}).show(),!0===this.options.fitToElement&&element.css("width",this.$element.outerWidth()+"px"),this.shown=!0,this},hide:function(){return this.$menu.hide(),this.shown=!1,this},lookup:function(query){if(this.query=void 0!==query&&null!==query?query:this.$element.val(),this.query.length<this.options.minLength&&!this.options.showHintOnFocus)return this.shown?this.hide():this;var worker=$.proxy(function(){$.isFunction(this.source)&&3===this.source.length?this.source(this.query,$.proxy(this.process,this),$.proxy(this.process,this)):$.isFunction(this.source)?this.source(this.query,$.proxy(this.process,this)):this.source&&this.process(this.source)},this);clearTimeout(this.lookupWorker),this.lookupWorker=setTimeout(worker,this.delay)},process:function(items){var that=this;return items=$.grep(items,function(item){return that.matcher(item)}),(items=this.sorter(items)).length||this.options.addItem?(items.length>0?this.$element.data("active",items[0]):this.$element.data("active",null),"all"!=this.options.items&&(items=items.slice(0,this.options.items)),this.options.addItem&&items.push(this.options.addItem),this.render(items).show()):this.shown?this.hide():this},matcher:function(item){return~this.displayText(item).toLowerCase().indexOf(this.query.toLowerCase())},sorter:function(items){for(var item,beginswith=[],caseSensitive=[],caseInsensitive=[];item=items.shift();){var it=this.displayText(item);it.toLowerCase().indexOf(this.query.toLowerCase())?~it.indexOf(this.query)?caseSensitive.push(item):caseInsensitive.push(item):beginswith.push(item)}return beginswith.concat(caseSensitive,caseInsensitive)},highlighter:function(item){var text=this.query;if(""===text)return item;var i,matches=item.match(/(>)([^<]*)(<)/g),first=[],second=[];if(matches&&matches.length)for(i=0;i<matches.length;++i)matches[i].length>2&&first.push(matches[i]);else(first=[]).push(item);text=text.replace(/[\(\)\/\.\*\+\?\[\]]/g,function(mat){return"\\"+mat});var m,reg=new RegExp(text,"g");for(i=0;i<first.length;++i)(m=first[i].match(reg))&&m.length>0&&second.push(first[i]);for(i=0;i<second.length;++i)item=item.replace(second[i],second[i].replace(reg,"<strong>$&</strong>"));return item},render:function(items){var that=this,self=this,activeFound=!1,data=[],_category=that.options.separator;return $.each(items,function(key,value){key>0&&value[_category]!==items[key-1][_category]&&data.push({__type:"divider"}),!value[_category]||0!==key&&value[_category]===items[key-1][_category]||data.push({__type:"category",name:value[_category]}),data.push(value)}),items=$(data).map(function(i,item){if("category"==(item.__type||!1))return $(that.options.headerHtml||that.theme.headerHtml).text(item.name)[0];if("divider"==(item.__type||!1))return $(that.options.headerDivider||that.theme.headerDivider)[0];var text=self.displayText(item);return(i=$(that.options.item||that.theme.item).data("value",item)).find(that.options.itemContentSelector||that.theme.itemContentSelector).addBack(that.options.itemContentSelector||that.theme.itemContentSelector).html(that.highlighter(text,item)),this.followLinkOnSelect&&i.find("a").attr("href",self.itemLink(item)),i.find("a").attr("title",self.itemTitle(item)),text==self.$element.val()&&(i.addClass("active"),self.$element.data("active",item),activeFound=!0),i[0]}),this.autoSelect&&!activeFound&&(items.filter(":not(.dropdown-header)").first().addClass("active"),this.$element.data("active",items.first().data("value"))),this.$menu.html(items),this},displayText:function(item){return void 0!==item&&void 0!==item.name?item.name:item},itemLink:function(item){return null},itemTitle:function(item){return null},next:function(event){var next=this.$menu.find(".active").removeClass("active").next();next.length||(next=$(this.$menu.find($(this.options.item||this.theme.item).prop("tagName"))[0])),next.addClass("active");var newVal=this.updater(next.data("value"));this.$element.val(this.displayText(newVal)||newVal)},prev:function(event){var prev=this.$menu.find(".active").removeClass("active").prev();prev.length||(prev=this.$menu.find($(this.options.item||this.theme.item).prop("tagName")).last()),prev.addClass("active");var newVal=this.updater(prev.data("value"));this.$element.val(this.displayText(newVal)||newVal)},listen:function(){this.$element.on("focus.bootstrap3Typeahead",$.proxy(this.focus,this)).on("blur.bootstrap3Typeahead",$.proxy(this.blur,this)).on("keypress.bootstrap3Typeahead",$.proxy(this.keypress,this)).on("propertychange.bootstrap3Typeahead input.bootstrap3Typeahead",$.proxy(this.input,this)).on("keyup.bootstrap3Typeahead",$.proxy(this.keyup,this)),this.eventSupported("keydown")&&this.$element.on("keydown.bootstrap3Typeahead",$.proxy(this.keydown,this));var itemTagName=$(this.options.item||this.theme.item).prop("tagName");"ontouchstart"in document.documentElement?this.$menu.on("touchstart",itemTagName,$.proxy(this.touchstart,this)).on("touchend",itemTagName,$.proxy(this.click,this)):this.$menu.on("click",$.proxy(this.click,this)).on("mouseenter",itemTagName,$.proxy(this.mouseenter,this)).on("mouseleave",itemTagName,$.proxy(this.mouseleave,this)).on("mousedown",$.proxy(this.mousedown,this))},destroy:function(){this.$element.data("typeahead",null),this.$element.data("active",null),this.$element.unbind("focus.bootstrap3Typeahead").unbind("blur.bootstrap3Typeahead").unbind("keypress.bootstrap3Typeahead").unbind("propertychange.bootstrap3Typeahead input.bootstrap3Typeahead").unbind("keyup.bootstrap3Typeahead"),this.eventSupported("keydown")&&this.$element.unbind("keydown.bootstrap3-typeahead"),this.$menu.remove(),this.destroyed=!0},eventSupported:function(eventName){var isSupported=eventName in this.$element;return isSupported||(this.$element.setAttribute(eventName,"return;"),isSupported="function"==typeof this.$element[eventName]),isSupported},move:function(e){if(this.shown)switch(e.keyCode){case 9:case 13:case 27:e.preventDefault();break;case 38:if(e.shiftKey)return;e.preventDefault(),this.prev();break;case 40:if(e.shiftKey)return;e.preventDefault(),this.next()}},keydown:function(e){17!==e.keyCode&&(this.keyPressed=!0,this.suppressKeyPressRepeat=~$.inArray(e.keyCode,[40,38,9,13,27]),this.shown||40!=e.keyCode?this.move(e):this.lookup())},keypress:function(e){this.suppressKeyPressRepeat||this.move(e)},input:function(e){var currentValue=this.$element.val()||this.$element.text();this.value!==currentValue&&(this.value=currentValue,this.lookup())},keyup:function(e){if(!this.destroyed)switch(e.keyCode){case 40:case 38:case 16:case 17:case 18:break;case 9:if(!this.shown||this.showHintOnFocus&&!this.keyPressed)return;this.select();break;case 13:if(!this.shown)return;this.select();break;case 27:if(!this.shown)return;this.hide()}},focus:function(e){this.focused||(this.focused=!0,this.keyPressed=!1,this.options.showHintOnFocus&&!0!==this.skipShowHintOnFocus&&("all"===this.options.showHintOnFocus?this.lookup(""):this.lookup())),this.skipShowHintOnFocus&&(this.skipShowHintOnFocus=!1)},blur:function(e){this.mousedover||this.mouseddown||!this.shown?this.mouseddown&&(this.skipShowHintOnFocus=!0,this.$element.focus(),this.mouseddown=!1):(this.select(),this.hide(),this.focused=!1,this.keyPressed=!1)},click:function(e){e.preventDefault(),this.skipShowHintOnFocus=!0,this.select(),this.$element.focus(),this.hide()},mouseenter:function(e){this.mousedover=!0,this.$menu.find(".active").removeClass("active"),$(e.currentTarget).addClass("active")},mouseleave:function(e){this.mousedover=!1,!this.focused&&this.shown&&this.hide()},mousedown:function(e){this.mouseddown=!0,this.$menu.one("mouseup",function(e){this.mouseddown=!1}.bind(this))},touchstart:function(e){e.preventDefault(),this.$menu.find(".active").removeClass("active"),$(e.currentTarget).addClass("active")},touchend:function(e){e.preventDefault(),this.select(),this.$element.focus()}};var old=$.fn.typeahead;$.fn.typeahead=function(option){var arg=arguments;return"string"==typeof option&&"getActive"==option?this.data("active"):this.each(function(){var $this=$(this),data=$this.data("typeahead"),options="object"==typeof option&&option;data||$this.data("typeahead",data=new Typeahead(this,options)),"string"==typeof option&&data[option]&&(arg.length>1?data[option].apply(data,Array.prototype.slice.call(arg,1)):data[option]())})},Typeahead.defaults={source:[],items:8,minLength:1,scrollHeight:0,autoSelect:!0,afterSelect:$.noop,afterEmptySelect:$.noop,addItem:!1,followLinkOnSelect:!1,delay:0,separator:"category",theme:"bootstrap3",themes:{bootstrap3:{menu:'<ul class="typeahead dropdown-menu" role="listbox"></ul>',item:'<li><a class="dropdown-item" href="#" role="option"></a></li>',itemContentSelector:"a",headerHtml:'<li class="dropdown-header"></li>',headerDivider:'<li class="divider" role="separator"></li>'},bootstrap4:{menu:'<div class="typeahead dropdown-menu" role="listbox"></div>',item:'<button class="dropdown-item" role="option"></button>',itemContentSelector:".dropdown-item",headerHtml:'<h6 class="dropdown-header"></h6>',headerDivider:'<div class="dropdown-divider"></div>'}}},$.fn.typeahead.Constructor=Typeahead,$.fn.typeahead.noConflict=function(){return $.fn.typeahead=old,this},$(document).on("focus.typeahead.data-api",'[data-provide="typeahead"]',function(e){var $this=$(this);$this.data("typeahead")||$this.typeahead($this.data())})}); --}}
