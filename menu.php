    <?php require_once('session.php'); ?>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand border-bottom-0 navbar-dark navbar-purple">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>



      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Cerrar Sesion -->
        <li class="nav-item dropdown">
          <a class="nav-link" href="<?php echo $base_url; ?>salida.php">
            <i class="fas fa-sign-out-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar elevation-1 sidebar-light-yellow sidebar-no-expand" style="background-color:#D2B4DE">
      <!-- Brand Logo -->
      <a href="#" class="brand-link navbar-purple">
        <img src="<?php echo $base_url ?>images/lapiz.png" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>SYSTEM C.A </b></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="<?= $base_url ?>pages/inicio.php" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Inicio
                </p>
              </a>
            </li>
           <!--
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Reportes
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= $base_url ?>pages/reportes/dashboardUno.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dashboard General</p>
                  </a>
                </li>
              </ul>
            </li>
            -->
            <li class="nav-item">
              <a href="<?= $base_url ?>pages/proyectos/index.php" class="nav-link">
                <i class="nav-icon fas fa-hammer"></i>
                <p>
                  Proyectos
                </p>
              </a>
            </li>
           <!--
            <li class="nav-item">
              <a href="<?= $base_url ?>pages/productos/indexProductos.php" class="nav-link">
                <i class="nav-icon fas fa-box-open"></i>
                <p>
                  Productos
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= $base_url ?>pages/categoriaProducto/indexCategoriaProducto.php" class="nav-link">
                <i class="nav-icon fas fa-clone"></i>
                <p>
                 Categoria Productos
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= $base_url ?>pages/subObras/indexSubObras.php" class="nav-link">
                <i class="nav-icon fas fa-toolbox"></i>
                <p>
                  Sub-obras
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= $base_url ?>pages/unidadmedida/indexUnidadMedida.php" class="nav-link">
                <i class="nav-icon fas fa-pencil-ruler"></i>
                <p>
                  Unidades de Medidas
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= $base_url ?>pages/areatrabajo/indexAreaTrabajo.php" class="nav-link">
                <i class="nav-icon fas fa-road"></i>
                <p>
                  Areas de trabajos
                </p>
              </a>
            </li>
            -->
            <li class="nav-item">
              <a href="<?= $base_url ?>pages/tipoestudiante/indexTipoEstudiante.php" class="nav-link">
                <i class="nav-icon fas fa-user-friends"></i>
                <p>
                  Grado estudiantes
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= $base_url ?>pages/estudiantes/indexEstudiantes.php" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Estudiantes
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= $base_url ?>pages/contratistas/indexContratistas.php" class="nav-link">
              <i class="nav-icon fas fa-solid fa-clipboard"></i>
                <p>
                  Tiempos 
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= $base_url ?>pages/clientes/indexClientes.php" class="nav-link">
              <i class="nav-icon fas fa-solid fa-user-plus"></i>
                <p>
                  Clientes
                </p>
              </a>
            </li>
            <!--
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                  Configuración
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fas fa-cog nav-icon"></i>
                    <p>Administración</p>
                    <i class="fas fa-angle-left right"></i>
                  </a>

                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="fas fa-users nav-icon"></i>
                        <p>Usuarios</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="fas fa-key nav-icon"></i>
                        <p>Perfiles</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="fas fa-lock nav-icon"></i>
                        <p>Permisos</p>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>
            -->
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
