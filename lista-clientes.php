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
            <h1 class="m-0 text-dark">Administrar los clientes</h1>
          </div><!-- /.col -->
          <div class="col-sm-6"> <!--  breadcrumb --> 
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
              <li class="breadcrumb-item active">clientes</li>
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
                 Agregar un nuevo cliente
            </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="registrar" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th><small>(numero de identificacion tributaria)</small><br> NIT </th>
                  <th>Direccion</th>
                  <th>Telefono</th>
                  <th>Email</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    try {
                      //consulta la tabla categorias
                      $sql = "SELECT * FROM clientes ORDER BY idcliente DESC";
                      $resultado = $conn->query($sql);
                    } catch (Exception $e) {
                      $error = $e->getMessage();
                      echo $error;
                    }
                    //recorro los arreglos con while
                while($clientes = $resultado->fetch_assoc()){ ?>
                <tr>
                  <td><?php echo $clientes['idcliente']; ?> </td>
                  <td><?php echo $clientes['nombre'];  ?> </td>
                  <td><?php echo $clientes['apellido'];  ?> </td>
                  <td><?php echo $clientes['nit']; ?> </td>
                  <td><?php echo $clientes['direccion']; ?> </td>
                  <td><?php echo $clientes['telefono']; ?> </td>
                  <td><?php echo $clientes['email']; ?> </td>
                  <td>
                      
                      <a href="#modal-editar-cliente" class="btn btn-primary btn-sm  mt-2 mt-lg-0 " data-toggle="modal"  data-id="<?php echo $clientes['idcliente']; ?>" data-nombre="<?php echo $clientes['nombre'];  ?>" data-apellido="<?php echo $clientes['apellido'] ?>" data-nit="<?php echo $clientes['nit']; ?>" data-direccion="<?php echo $clientes['direccion']?>" data-telefono="<?php echo $clientes['telefono'] ?>" data-email="<?php echo $clientes['email'] ?>">
                         <i class="fas fa-edit "></i> Editar
                      </a>
                      <a href="#" class="btn btn-danger btn-sm mt-2 mt-lg-0 borrar" data-tipo="cliente" data-id="<?php echo $clientes['idcliente'];?>"> 
                      <i class="fas fa-trash"></i> Borrar
                      </a>
                  </td>
                </tr>
                <?php } ?>
                </tbody>
                <tfoot>
              </table>
            </div> <!-- /.card-body -->
          </div>
      </div><!-- /.container-fluid -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

<!--  ***********************************************MODALES******************************** --> 
<!--  MODAL AGREGAR CLIENTE --> 
  <div class="modal fade" id="agregar">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Agregar cliente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <form  class="row" id="crear-registro" action="modelo-cliente.php" method="POST">
                        <div class="col-12 col-lg-6">
                              <div class="form-group">
                                  <label>Nombre del cliente:</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-list"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nombre cliente" name="nombre"  required>
                                  </div>
                            </div> <!-- /.input group -->
                            <div class="form-group">
                                  <label>Apellido del cliente:</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-list"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Apellido cliente" name="apellido"  required>
                                  </div>
                            </div> <!-- /.input group -->
                              <div class="form-group">
                                  <label>NIT:</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Numero de identificacion tributaria " name="nit"  required>
                                  </div>
                              </div> <!-- /.input group -->
                        </div>
                        <div class="col-12 col-lg-6">
                              <div class="form-group">
                                  <label>Direccion:</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Direccion del cliente" name="direccion"  required>
                                  </div>
                              </div> <!-- /.input group -->
                              <div class="form-group">
                                  <label>Telefono:</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="Numero de telefono de cliente " name="telefono"  required>
                                  </div>
                              </div> <!-- /.input group -->
                              <div class="form-group">
                                  <label>Email:</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                    </div>
                                    <input type="email" class="form-control" placeholder="Email del cliente " name="email"  required>
                                  </div>
                              </div> <!-- /.input group -->
                          </div>
                          <div class="modal-footer justify-content-between col-12">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            <input type="hidden" name="registro" value="nuevo" >
                            <button type="submit" data-tipo="clientes" class="btn btn-primary">Agregar</button>
                          </div>
                  </form>
              </div>
         </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div> <!-- /.modal -->
     

  <!--  MODAL EDITAR CLIENTE --> 
  <div class="modal fade" id="modal-editar-cliente">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Editar cliente</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <form  class="row" id="editar-registro" action="modelo-cliente.php" method="POST">
                  <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label>Nombre del cliente:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-list"></i></span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="Nombre cliente" id="nombre" name="nombre"  required>
                                </div>
                          </div> <!-- /.input group -->
                          <div class="form-group">
                                <label>Apellido del cliente:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-list"></i></span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="Apellido cliente" id="apellido" name="apellido"  required>
                                </div>
                          </div> <!-- /.input group -->
                            <div class="form-group">
                                <label>NIT:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="Numero de identificacion tributaria " id="nit" name="nit"  required>
                                </div>
                            </div> <!-- /.input group -->
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <label>Direccion:</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                              </div>
                              <input type="text" class="form-control" placeholder="Direccion del cliente" id="direccion" name="direccion"  required>
                            </div>
                        </div> <!-- /.input group -->
                        <div class="form-group">
                            <label>Telefono:</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                              </div>
                              <input type="number" class="form-control" placeholder="Numero de telefono de cliente " id="telefono" name="telefono"  required>
                            </div>
                        </div> <!-- /.input group -->
                        <div class="form-group">
                            <label>Email:</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                              </div>
                              <input type="email" class="form-control" placeholder="Email del cliente " id="email" name="email"  required>
                            </div>
                        </div> <!-- /.input group --> 
                        <input type="hidden" id="id_registro" name="id_registro">             
                   </div>
                    <div class="modal-footer justify-content-between col-12">
                        <button type="button" class="btn btn-danger " data-dismiss="modal">Cerrar</button>
                        <input type="hidden" name="registro" value="actualizar" >
                        <button type="submit" data-tipo="clientes" class="btn btn-primary ">Agregar</button>
                    </div>
                   
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div> <!-- /.modal -->

     



<?php include_once 'templates/footer.php'; ?>
