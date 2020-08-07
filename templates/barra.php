<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-lightblue">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <li class="dropdown user user-menu">
					
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<img src="img/usuarios/<?php echo $_SESSION['imagenusuario']?>" class="user-image">						
						<span class="hidden-xs text-light"><?php echo $_SESSION['usuario'] ?></span>
          </a>
          
					<!-- Dropdown-toggle -->
					<ul class="dropdown-menu">
						<li class="user-header ">
                <img  src="img/usuarios/<?php echo $_SESSION['imagenusuario']?>" alt="<?php echo $_SESSION['imagenusuario']?>">
                <p>Administrador	<small>Perfil: Administrador</small></p>
            </li>	
						<li class="user-body ">
							<div class="pull-right text-center ">
								<a href="login.php?cerrar_sesion=true" class="btn btn-default btn-flat ">Cerrar session</a>
							</div>
						</li>
					</ul>
				</li>
    </ul>
  </nav><!-- /.navbar -->
