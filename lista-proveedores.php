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
            <h1 class="m-0 text-dark">Administrar los proveedores</h1>
          </div><!-- /.col -->
          <div class="col-sm-6"> <!--  breadcrumb --> 
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
              <li class="breadcrumb-item active">Proveedores</li>
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
                 Agregar una nuevo proveedor
            </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="registrar" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Direccion</th>
                  <th>Telefono</th>
                  <th>Email</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    try {
                      //consulta la tabla Proveedores
                      $sql = "SELECT * FROM proveedores ORDER BY idproveedor DESC";
                      $resultado = $conn->query($sql);
                    } catch (Exception $e) {
                      $error = $e->getMessage();
                      echo $error;
                    }
                    //recorro los arreglos con while
                while($proveedores = $resultado->fetch_assoc()){ ?>
                <tr>
                  <td><?php echo $proveedores['idproveedor']; ?> </td>
                  <td><?php echo $proveedores['nombreProv'];  ?> </td>
                  <td><?php echo $proveedores['direccion']; ?> </td>
                  <td><?php echo $proveedores['telefono']; ?> </td>
                  <td><?php echo $proveedores['emailProv']; ?> </td>
                  <td>
                      <a href="#modal-editar-proveedor" class="btn btn-primary btn-sm  mt-2 mt-lg-0 " data-toggle="modal"  data-id="<?php echo $proveedores['idproveedor']; ?>" data-nombreProv="<?php echo $proveedores['nombreProv'];  ?>" data-direccionProv="<?php echo $proveedores['direccion']; ?>" data-telefonoProv="<?php echo $proveedores['telefono'] ?>" data-emailProv="<?php echo $proveedores['emailProv'] ?>">
                         <i class="fas fa-edit "></i> Editar
                      </a>
                      <a href="#" class="btn btn-danger btn-sm mt-2 mt-lg-0 borrar" data-tipo="proveedor" data-id="<?php echo $proveedores['idproveedor'];?>"> 
                      <i class="fas fa-trash"></i> Borrar
                      </a>
                  </td>
                </tr>
                <?php } ?>
                </tbody>
                <tfoot>
              </table>
            </div><!-- /.card-body -->
          </div>
      </div><!-- /.container-fluid -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

<!--  ***********************************************MODALES******************************** --> 
<!--  MODAL AGREGAR proveedor --> 
  <div class="modal fade" id="agregar">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Agregar Proveedor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <form  id="crear-registro" action="modelo-proveedor.php" method="POST">
                        <div class="form-group">
                            <label>Nombre Proveedor:</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-list"></i></span>
                              </div>
                              <input type="text" class="form-control" placeholder="Nombre proveedor" name="nombre"  required>
                            </div>
                       </div> <!-- /.input group -->
                        <div class="form-group">
                            <label>Direccion:</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                              </div>
                              <input type="text" class="form-control" placeholder="Descripcion proveedor" name="direccion"  required>
                            </div>
                        </div> <!-- /.input group -->
                        <div class="form-group">
                            <label>Telefono:</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                              </div>
                              <input type="tel" class="form-control" placeholder="Telefono proveedor" name="telefono"  required>
                            </div>
                        </div> <!-- /.input group -->     
                        <div class="form-group">
                            <label>Email:</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                              </div>
                              <input type="email" class="form-control" placeholder="Email proveedor" name="email"  required>
                            </div>
                        </div> <!-- /.input group -->                      
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                          <input type="hidden" name="registro" value="nuevo" >
                          <button type="submit" data-tipo="proveedor" class="btn btn-primary">Agregar</button>
                        </div>
                  </form>
              </div>
         </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div> <!-- /.modal -->
     

  <!--  MODAL EDITAR proveedor --> 
  <div class="modal fade" id="modal-editar-proveedor">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Editar Proveedor</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="editar-registro" action="modelo-proveedor.php" method="POST">
                      <div class="form-group">
                          <label>Nombre proveedor:</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-list"></i></span>
                            </div>
                            <input type="text" id="nombre" class="form-control" placeholder="Nombre proveedor" name="nombre" required>
                          </div>
                      </div> <!-- /.input group -->
                      <div class="form-group">
                          <label>Direccion:</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                            </div>
                            <input type="text" id="direccion" class="form-control" placeholder="Descripcion proveedor" name="direccion" required >
                          </div>
                      </div> <!-- /.input group -->
                      <div class="form-group">
                          <label>Telefono:</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                            </div>
                            <input type="tel" id="telefono" class="form-control" placeholder="Telefono del proveedor" name="telefono"  required>
                          </div>                          
                      </div> <!-- /.input group -->
                      <div class="form-group">
                            <label>Email:</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                              </div>
                              <input id="email" type="email" class="form-control" placeholder="Email proveedor" name="email"  required>
                            </div>
                        </div> <!-- /.input group -->                        
                      <input type="hidden" id="id_registro" name="id_registro">
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