<?php  
    include_once "funciones/sesiones.php"; //le agrego la funcion que comprueba si esta iniciado sesion
    include_once 'funciones/conexion-bd.php'; //conexion bd
    include_once 'templates/header.php';
    include_once 'templates/barra.php';
    include_once 'templates/sidebar.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Administrar los roles</h1>
          </div><!-- /.col -->
          <div class="col-sm-6"> <!--  breadcrumb --> 
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
              <li class="breadcrumb-item active">Roles</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <!-- /.card -->
      <div class="card">
            <div class="card-header">
            <button type="button" class="btn bg-gradient-success " data-toggle="modal" data-target="#agregar">
            <i class="fas fa-plus"></i>
                 Agregar una nuevo rol
            </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="registrar" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Descripcion</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    try {
                      //consulta la tabla categorias
                      $sql = "SELECT * FROM rol ORDER BY idrol DESC";
                      $resultado = $conn->query($sql);
                    } catch (Exception $e) {
                      $error = $e->getMessage();
                      echo $error;
                    }
                    //recorro los arreglos con while
                while($roles = $resultado->fetch_assoc()){ ?>
                <tr>
                  <td><?php echo $roles['idrol']; ?> </td>
                  <td><?php echo $roles['nombrerol'];  ?> </td>
                  <td><?php echo $roles['descripcion']; ?> </td>
                  <td>
                      
                      <a href="#modal-editar-rol" class="btn btn-primary btn-sm  mt-2 mt-lg-0 " data-toggle="modal"  data-id="<?php echo $roles['idrol']; ?>" data-nombre="<?php echo $roles['nombrerol'];  ?>" data-descripcion="<?php echo $roles['descripcion']; ?>">
                         <i class="fas fa-edit "></i> Editar
                      </a>
                      <a href="#" class="btn btn-danger btn-sm mt-2 mt-lg-0 borrar" data-tipo="rol" data-id="<?php echo $roles['idrol'];?>"> 
                      <i class="fas fa-trash"></i> Borrar
                      </a>
                  </td>
                </tr>
                <?php } ?>
                </tbody>
                <tfoot>
             <!--     <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                </tr>
                </tfoot> -->
              </table>
            </div>
            <!-- /.card-body -->
          </div>

      </div><!-- /.container-fluid -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

<!--  ***********************************************MODALES******************************** --> 
<!--  MODAL AGREGAR ROL --> 
  <div class="modal fade" id="agregar">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Agregar rol</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <form  id="crear-registro" action="modelo-rol.php" method="POST">
                        <div class="form-group">
                            <label>Nombre del rol:</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-list"></i></span>
                              </div>
                              <input type="text" class="form-control" placeholder="Nombre del rol" name="nombre"  required>
                            </div>
                       </div> <!-- /.input group -->
                        <div class="form-group">
                            <label>Descripcion:</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                              </div>
                              <input type="text" class="form-control" placeholder="Descripcion del rol" name="descripcion"  required>
                            </div>
                        </div> <!-- /.input group -->
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                          <input type="hidden" name="registro" value="nuevo" >
                          <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                  </form>
              </div>
         </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div> <!-- /.modal -->
     

  <!--  MODAL EDITAR ROL --> 
  <div class="modal fade" id="modal-editar-rol">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Editar el rol</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="editar-registro" action="modelo-rol.php" method="POST">
                      <div class="form-group">
                          <label>Nombre del rol:</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-list"></i></span>
                            </div>
                            <input type="text" id="nombre" class="form-control" placeholder="Nombre del rol" name="nombre" required>
                          </div>
                      </div> <!-- /.input group -->
                      <div class="form-group">
                          <label>Descripcion:</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                            </div>
                            <input type="text" id="descripcion" class="form-control" placeholder="Descripcion del rol" name="descripcion" required>
                          </div>
                          <input type="hidden" id="id_registro" name="id_registro">
                      </div> <!-- /.input group -->
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <input type="hidden" name="registro" value="actualizar" >
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                      </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div> <!-- /.modal -->

     



<?php include_once 'templates/footer.php'; ?>