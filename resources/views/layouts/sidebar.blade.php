<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{!! route('comissao.minhasComissoes') !!}" class="brand-link">
    <img src="/img/logo.png" alt="Laravel Starter" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">JNet Serviços</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="/img/profile.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"> {{auth()->user()->name!=null ? auth()->user()->name : "Administrator"}} </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @is(['admin', 'supervisor'])
        <li class="nav-item has-treeview ">
          <a href="{!! route('dashboard') !!}" class="nav-link ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        @endis
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-th"></i>
            <p>Solicitações <i class="fa fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('escalas.agenda')}}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Agenda</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('solicitacao.create')}}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Nova Solicitação</p>
              </a>
            </li>
            @is(['admin','controlador'])
            <li class="nav-item">
              <a href="{{route('solicitacoes.pesquisar')}}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Pesquisar</p>
              </a>
            </li>


            @endis
          </ul>
        </li>
        @is(['admin', 'supervisor', 'controlador'])
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-plus-square"></i>
            <p>Controlador <i class="fa fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('escalas.agenda')}}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Escala</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{route('escalas.index')}}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p> Nova Escala</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('solicitacoes.fila')}}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Fila de Atendimento</p>
              </a>
            </li>

          </ul>
        </li>
        @endis
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-th"></i>
            <p>Comissão <i class="fa fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('comissao.minhasComissoes')}}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Minhas Comissões</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('comissao.pesquisarMinhasComissoes')}}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Pesquisar Comissoes</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-th"></i>
            <p>Vendas <i class="fa fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('clientes.index')}}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Cliente</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Pré Venda</p>
              </a>
            </li>

          </ul>
        </li>

        <li class="nav-header">CADASTROS</li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-plus-square"></i>
            <p>Clientes <i class="fa fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('clientes.index')}}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Novo Cliente</p>
              </a>
            </li>
          </ul>
        </li>
        @is(['admin', 'financeiro'])
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-plus-square"></i>
            <p>Usuários <i class="fa fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('users.index')}}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Novo Usuário</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('roles.index')}}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Grupos e Permissões</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-plus-square"></i>
            <p>Parâmetros <i class="fa fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="{{route('planos.index')}}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Planos</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{route('categoriaServicos.index')}}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Categoria Servios</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('statusSolicitacao.index')}}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Status Solicitacao</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('tipoMidias.index')}}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Tipo Mídia</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('tipoPagamento.index')}}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Tipo Pagamento</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('tipoAquisicao.index')}}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Tipo Aquisição Equipamento</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-plus-square"></i>
            <p>Relatórios: <i class="fa fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('reports.relServicosForm') }}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Serviços</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-plus-square"></i>
            <p>Financeiro <i class="fa fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            @is(['admin', 'financeiro', 'auditor'])
            <li class="nav-item">
              <a href="{{route('comissao.autorizarComissoes') }}" class="nav-link">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Autorizar Comissões</p>
              </a>
            </li>
            @endis

          </ul>
        </li>
        @endis
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
