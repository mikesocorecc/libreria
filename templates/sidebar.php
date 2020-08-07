  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="inicio.php" class="brand-link">
      <span class="brand-text font-weight-bold"></span>
      <img src="img/logo.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Libreria del futuro</span>
    </a>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="img/usuarios/<?php echo $_SESSION['imagenusuario'] ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Mike Socorec</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
            <a href="lista-categorias.php" class="nav-link">
            <i class="fas fa-th-list"></i>
              <p>Categoria</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="lista-productos.php" class="nav-link">
       <!--      <i class="fas fa-box-open"> </i> -->
            <i class="fab fa-product-hunt"></i>
              <p> Productos</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="lista-proveedores.php" class="nav-link">
            <i class="fas fa-truck"></i>
              <p>Proveedores</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="lista-roles.php" class="nav-link">
            <i class="fas fa-user-lock"></i>
              <p>Roles</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="lista-usuarios.php" class="nav-link">
            <i class="fas fa-user"> </i>
              <p>Usuarios</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="lista-clientes.php" class="nav-link">
            <i class="fas fa-users"></i>
              <p>Clientes</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="lista-compras.php" class="nav-link">
            <i class="fas fa-shopping-cart"></i>
              <p>Compras</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="lista-categorias.php" class="nav-link">
            <i class="fas fa-sticky-note"></i>
              <p>Facturas</p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>Productos<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/tables/simple.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Simple Tables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/data.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DataTables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/jsgrid.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>jsGrid</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item">
            <a href="pages/gallery.html" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Gallery
              </p>
            </a>
          </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>