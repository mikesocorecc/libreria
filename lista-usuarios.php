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
            <h1 class="m-0 text-dark">Administrar los usuarios</h1>
          </div><!-- /.col -->
          <div class="col-sm-6"> <!--  breadcrumb --> 
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
              <li class="breadcrumb-item active">usuarios</li>
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
                 Agregar un nuevo usuario
            </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="registrar" class="table table-bordered table-striped " style="font-size: 14px;" >
                <thead>
                <tr>
                  <th >Cui</th>
                  <th>Foto</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Direccion</th>
                  <th>Telefono</th>
                  <th>Email</th>
                  <th>Usuario</th>
                  <th>Rol</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    try {
                      //consulta la tabla categorias
                      $sql =  "SELECT usuarios.*, rol.idrol, rol.nombrerol ";
                      $sql .= " FROM usuarios ";
                      $sql .= " INNER JOIN rol ";
                      $sql .= " ON usuarios.idRol = rol.idrol  ORDER BY idusuario DESC ";
                      $resultado = $conn->query($sql);        
                    } catch (Exception $e) {
                      $error = $e->getMessage();
                      echo $error;
                    }
                    //recorro los arreglos con while
                while($usuarios = $resultado->fetch_assoc()){ ?>
                <tr>
                  <td > <?php echo $usuarios['cui'] ?> </td>        
                  <td >
                    <img src="img/usuarios/<?php echo $usuarios['imagenusuario'] ?> " alt="<?php echo $usuarios['imagenusuario'] ?>" width="60px" class="img-fluid">
                  </td>
                  <td> <?php echo $usuarios['nombre'] ?> </td>
                  <td> <?php echo $usuarios['apellido'] ?>  </td>
                  <td> <?php echo $usuarios['direccion'] ?> </td>
                  <td> <?php echo $usuarios['telefono'] ?> </td>
                  <td> <?php echo $usuarios['email'] ?> </td>
                  <td> <?php echo $usuarios['usuario'] ?> </td>
                  <td> <?php echo $usuarios['nombrerol'] ?> </td>
                  <td>
                      <a href="#modal-editar-usuario" class="btn btn-primary btn-sm  mt-2 mt-lg-0 " data-toggle="modal"  
                            data-id="<?php echo $usuarios['idusuario']; ?>" 
                            data-cui="<?php echo $usuarios['cui'] ?>" 
                            data-foto="<?php echo $usuarios['imagenusuario']; ?>" 
                            data-nombre="<?php echo $usuarios['nombre'];  ?>" 
                            data-apellido="<?php echo $usuarios['apellido']; ?>"
                            data-direccion="<?php echo $usuarios['direccion'] ?>" 
                            data-telefono="<?php echo $usuarios['telefono'] ?>" 
                            data-email="<?php echo $usuarios['email'] ?>" 
                            data-usuario="<?php echo $usuarios['usuario'] ?>" 
                            data-rol="<?php echo $usuarios['idrol'] ?>" > <!--  fin del <a> --> 
                            <i class="fas fa-edit "></i> Editar
                      </a>
                      <a href="#" class="btn btn-danger btn-sm mt-2 mt-lg-0 borrar " data-tipo="usuario" data-id="<?php echo $usuarios['idusuario'];?>" > 
                      <i class="fas fa-trash "></i> Borrar
                      </a>
                  </td>
                </tr>
                <?php } ?>
                </tbody>
                <tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>

      </div><!-- /.container-fluid -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

<!--  ***********************************************MODALES******************************** --> 
<!--  MODAL AGREGAR PRODUCTO --> 
  <div class="modal fade" id="agregar">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Agregar usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <form class="row"  id="crear-registro-archivo"  action="modelo-usuario.php" method="POST" enctype="multipart/form-data">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <div class="panel">SUBIR IMAGEN</div>
                                <input type="file" class="nuevaImagen"  name="imagen_usuario">
                                <p class="help-block">Peso máximo de la imagen 2MB</p>
                                <img src="img/productos/default.png" class="img-thumbnail previsualizar" width="100px">
                            </div>
                            <div class="form-group">
                                <label>Telefono:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                  </div>
                                  <input type="number" class="form-control" placeholder="Telefono del usuario" name="telefono">
                                </div>
                            </div> <!-- /.input group -->
                            <div class="form-group">
                                <label>Email:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                  </div>
                                  <input type="email" class="form-control" placeholder="Email del usuario" name="email">
                                </div>
                            </div> <!-- /.input group -->
                            <div class="form-group">
                                <label>Direccion:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="Direccion del usuario" name="direccion">
                                </div>
                            </div> <!-- /.input group -->
                        </div>
                        <div class="col-12 col-lg-6">
                           <div class="form-group">
                                <label>Usuario:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="Nombre de usuario " name="usuario">
                                </div>
                            </div> <!-- /.input group -->
                            <div class="form-group">
                                <label>Password:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                  </div>
                                  <input type="password" class="form-control" placeholder="Ingrese su contraseña" name="password">
                                </div>
                            </div> <!-- /.input group -->
                            <div class="form-group">
                                <label>Rol</label>
                                <select name="rol" class="form-control select2" style="width: 100%;" required>
                                  <option selected="selected">-----Seleccione un rol----</option>
                                  <?php  
                                    try {
                                      $sql = "SELECT * FROM rol ORDER BY idrol DESC";
                                      $resultado = $conn->query($sql);
                                      while($rol = $resultado->fetch_assoc()){ ?>
                                      <option value="<?php echo $rol['idrol'];?>" ><?php echo $rol['nombrerol'];?></option>
                                      <?php }
                                    } catch (Exception $e) {
                                      echo "Error".$e->getMessage();
                                    }
                                ?>
                                </select>
                            </div>                          
                            <div class="form-group">
                                <label>Cui:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-list"></i></span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="Ingrese su codigo unico de identificacion" name="cui"  required>
                                </div>
                            </div> <!-- /.input group -->
                            <div class="form-group">
                                <label>Nombre:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="Ingrese el nombre" name="nombre"  required>
                                </div>
                            </div> <!-- /.input group -->

                            <div class="form-group">
                                <label>Apellido:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="Ingrese apellido" name="apellido"  required>
                                </div>
                            </div> <!-- /.input group -->
                        </div>
                        
                        <div class="modal-footer justify-content-between col-12">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                          <input type="hidden"  name="registro" value="nuevo" >
                          <button type="submit"  class="btn btn-primary">Agregar</button>
                        </div>
                  </form>
              </div>
         </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div> <!-- /.modal -->
  
  <!--  MODAL EDITAR PRODUCTO --> 
  <div class="modal fade" id="modal-editar-usuario">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Editar Producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form class="row"  id="editar-registro-archivo"  action="modelo-usuario.php" method="POST" enctype="multipart/form-data">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <div class="panel">SUBIR IMAGEN</div>
                                <input type="file" class="nuevaImagen"  name="imagen_usuario">
                                <p class="help-block">Peso máximo de la imagen 2MB</p>
                                <img src="img/productos/default.png" class="img-thumbnail previsualizar" width="100px">
                            </div>
                            <div class="form-group">
                                <label>Telefono:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                  </div>
                                  <input type="number" class="form-control" placeholder="Telefono del usuario" name="telefono" id="telefono">
                                </div>
                            </div> <!-- /.input group -->
                            <div class="form-group">
                                <label>Email:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                  </div>
                                  <input type="email" class="form-control" placeholder="Email del usuario" name="email" id="email">
                                </div>
                            </div> <!-- /.input group -->
                            <div class="form-group">
                                <label>Direccion:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="Direccion del usuario" name="direccion" id="direccion">
                                </div>
                            </div> <!-- /.input group -->
                        </div>
                        <div class="col-12 col-lg-6">
                           <div class="form-group">
                                <label>Usuario:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="Nombre de usuario " name="usuario" id="usuario">
                                </div>
                            </div> <!-- /.input group -->
                            <div class="form-group">
                                <label>Password:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                  </div>
                                  <input type="password" class="form-control" placeholder="Ingrese su contraseña" name="password">
                                </div>
                            </div> <!-- /.input group -->
                            <div class="form-group">
                                <label>Rol</label>
                                <select name="rol" id="rol" class="form-control select2" style="width: 100%;" required>
                                  <option selected="selected">-----Seleccione un rol----</option>
                                  <?php  
                                    try {
                                      $sql = "SELECT * FROM rol ORDER BY idrol DESC";
                                      $resultado = $conn->query($sql);
                                      while($rol = $resultado->fetch_assoc()){ ?>
                                      <option value="<?php echo $rol['idrol'];?>" ><?php echo $rol['nombrerol'];?></option>
                                      <?php }
                                    } catch (Exception $e) {
                                      echo "Error".$e->getMessage();
                                    }
                                ?>
                                </select>
                            </div>                          
                            <div class="form-group">
                                <label>Cui:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-list"></i></span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="Ingrese su codigo unico de identificacion" name="cui" id="cui"  required>
                                </div>
                            </div> <!-- /.input group -->
                            <div class="form-group">
                                <label>Nombre:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="Ingrese el nombre" name="nombre" id="nombre" required>
                                </div>
                            </div> <!-- /.input group -->

                            <div class="form-group">
                                <label>Apellido:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="Ingrese apellido" name="apellido" id="apellido"  required>
                                </div>
                            </div> <!-- /.input group -->
                            <input type="hidden" id="id_registro" name="id_registro"><!--  Mando el id que se actualizara --> 
                        </div>
                        <div class="modal-footer justify-content-between col-12">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                          <input type="hidden"  name="registro" value="actualizar" >
                          <button type="submit"  class="btn btn-primary">Agregar</button>
                        </div>
                  </form>
              </div>
         </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div> <!-- /.modal -->

<?php include_once 'templates/footer.php'; ?>