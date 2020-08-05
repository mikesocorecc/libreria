<?php  
    include_once "funciones/sesiones.php"; //le agrego la funcion que comprueba si esta iniciado sesion
    include_once 'templates/header.php';//incluyo el header
    include_once 'templates/barra.php';//incluyo la barra
    include_once 'templates/sidebar.php'; //incluyo el sidebar
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tablero</h1>
          </div><!-- /.col -->
          <div class="col-sm-6"> <!--  breadcrumb --> 
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
              <li class="breadcrumb-item active">Tablero</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

          
      </div><!-- /.container-fluid -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->



</div>
<!-- ./wrapper -->

<?php include_once 'templates/footer.php'; ?>