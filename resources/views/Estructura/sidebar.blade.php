<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
    <img src="{{ asset('/imgAgenda/logo.png') }}"  class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Agenda Electrónica</span>
    </a>
    <div class="sidebar ">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
              <img src="{{ asset('/img/profile.png') }}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
              <a href="#" class="d-block"> {{ auth()->user()->name!=null ? auth()->user()->name : "Administrator" }} </a>
          </div>
      </div>
      <nav class="mt-2 ">
          <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                  <a href="calendario" class="nav-link">
                    <i class="nav-icon fa fa-th"></i>
                    <p>
                      Calendario
                    </p>
                  </a>
              </li>
              <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-list-alt" aria-hidden="true"></i>
                    <p>
                      Eventos
                      <i class="right fa fa-angle-left"></i>
                    </p>
                  </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="Eventos" class="nav-link">
                          <i class="fa fa-circle-o nav-icon"></i>
                          <p>Agendar</p>
                        </a>
                    </li>
                </ul>
              </li>
          </ul>
      </nav>
    </div>
</aside>