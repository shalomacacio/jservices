<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{!! route('dashboard') !!}" class="brand-link">
    <img src="/img/logo.png" alt="Laravel Starter" class="brand-image img-circle elevation-3"
   style="opacity: .8">
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
                <li class="nav-item has-treeview ">
                  <a href="{!! route('dashboard') !!}" class="nav-link ">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/widgets.html" class="nav-link">
                    <i class="nav-icon fa fa-th"></i>
                    <p>Solicitações</p>
                  </a>
                </li>

                <li class="nav-header">CADASTROS</li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-plus-square"></i>
                    <p>Extras <i class="fa fa-angle-left right"></i></p>
                  </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <a href="{{route('servico.index')}}" class="nav-link">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p>Serviços</p>
                          </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">RELATORIOS</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-plus-square"></i>
                      <p>Extras2 <i class="fa fa-angle-left right"></i></p>
                    </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="pages/examples/404.html" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Error 404</p>
                            </a>
                          </li>
                      </ul>
                  </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
