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
            <h1 class="m-0 text-dark">Administrar los productos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6"> <!--  breadcrumb --> 
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
              <li class="breadcrumb-item active">Productos</li>
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
                 Agregar un nuevo producto
            </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="registrar" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Imagen</th>
                  <th>Nombre</th>
                  <th>Descripcion</th>
                  <th>Categoria</th>
                  <th>Precio Venta</th>
                  <th>Stock</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    try {
                      //consulta la tabla categorias
                      $sql =  "SELECT productos.*, categorias.idcategoria, categorias.nombre ";
                      $sql .= " FROM productos ";
                      $sql .= " INNER JOIN categorias ";
                      $sql .= " ON productos.idCategoria = categorias.idcategoria ORDER BY idproducto DESC  ";
                      $resultado = $conn->query($sql);
                    } catch (Exception $e) {
                      $error = $e->getMessage();
                      echo $error;
                    }
                    //recorro los arreglos con while
                while($productos = $resultado->fetch_assoc()){ ?>
                <tr>
                  <td> <?php echo $productos['idproducto'] ?> </td>
                  <td>
                    <img src="img/productos/<?php echo $productos['imagenProd'] ?> " alt="<?php echo $productos['imagenProd'] ?>" width="60px" class="img-fluid">
                  </td>
                  <td> <?php echo $productos['nombreProducto'] ?> </td>
                  <td> <?php echo $productos['descripcion'] ?>  </td>
                  <td> <?php echo $productos['nombre'] ?> </td>
                  <td>Q <?php echo $productos['precioActual'] ?> </td>
                  <td> <?php echo $productos['stock'] ?> </td>
                  <td>
                      <a href="#modal-editar-producto" class="btn btn-primary btn-sm  mt-2 mt-lg-0 " data-toggle="modal"  data-id="<?php echo $productos['idproducto']; ?>" data-nombre="<?php echo $productos['nombreProducto'];  ?>" data-descripcion="<?php echo $productos['descripcion']; ?>"
                         data-id_cat="<?php echo $productos['idCategoria'] ?>" data-precio="<?php echo $productos['precioActual'] ?>" >
                         <i class="fas fa-edit "></i> Editar
                      </a>
                      <a href="#" class="btn btn-danger btn-sm mt-2 mt-lg-0 borrar" data-tipo="producto" data-id="<?php echo $productos['idproducto'];?>" > 
                      <i class="fas fa-trash "></i> Borrar
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
<!--  MODAL AGREGAR PRODUCTO --> 
  <div class="modal fade" id="agregar">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Agregar Producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <form class="row"  id="crear-registro-archivo"  action="modelo-producto.php" method="POST" enctype="multipart/form-data">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <div class="panel">SUBIR IMAGEN</div>
                                <input type="file" class="nuevaImagen"  name="imagen_producto">
                                <p class="help-block">Peso máximo de la imagen 2MB</p>
                                <img src="img/productos/default.png" class="img-thumbnail previsualizar" width="200px">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                        <div class="form-group">
                                <label>Categoria</label>
                                <select name="cat_producto" class="form-control select2" style="width: 100%;" required>
                                  <option selected="selected">-----Seleccione una categoria---</option>
                                  <?php  
                                    try {
                                      $sql = "SELECT * FROM categorias ORDER BY idcategoria DESC";
                                      $resultado = $conn->query($sql);
                                      while($cat_prod = $resultado->fetch_assoc()){ ?>
                                      <option value="<?php echo $cat_prod['idcategoria'];?>" ><?php echo $cat_prod['nombre'];?></option>
                                      <?php }
                                    } catch (Exception $e) {
                                      echo "Error".$e->getMessage();
                                    }
                                ?>
                                  
                                </select>
                            </div>                          
                            <div class="form-group">
                                <label>Nombre producto:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-list"></i></span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="Nombre categoria" name="nombre"  required>
                                </div>
                            </div> <!-- /.input group -->
                            <div class="form-group">
                                <label>Descripcion:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="Descripcion Producto" name="descripcion"  required>
                                </div>
                            </div> <!-- /.input group -->

                            <div class="form-group">
                                <label>Precio venta:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                  </div>
                                  <input type="number" class="form-control" placeholder="Precio venta" name="precio"  required>
                                </div>
                            </div> <!-- /.input group -->
                            <div class="form-group">
                                <label>Stock:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                  </div>
                                  <input type="number" class="form-control" placeholder="0" value="0" disabled >
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
  <div class="modal fade" id="modal-editar-producto">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Editar Producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <form class="row"  id="editar-registro-archivo"  action="modelo-producto.php" method="POST" enctype="multipart/form-data">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <div class="panel">SUBIR IMAGEN</div>
                                <input type="file" class="nuevaImagen"  name="imagen_producto">
                                <p class="help-block">Peso máximo de la imagen 2MB</p>
                                <img src="img/productos/default.png" class="img-thumbnail previsualizar" width="200px">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                        <div class="form-group">
                                <label>Categoria</label>
                                <select name="cat_producto" id="cat_producto" class="form-control select2" style="width: 100%;" required>
                                  <option selected="selected">-----Seleccione una categoria---</option>
                                  <?php  
                                    try {
                                      $sql = "SELECT * FROM categorias ORDER BY idcategoria DESC";
                                      $resultado = $conn->query($sql);
                                      while($cat_prod = $resultado->fetch_assoc()){ ?>
                                      <option value="<?php echo $cat_prod['idcategoria'];?>" ><?php echo $cat_prod['nombre'];?></option>
                                      <?php }
                                    } catch (Exception $e) {
                                      echo "Error".$e->getMessage();
                                    }
                                ?>
                                </select>
                            </div>                          
                            <div class="form-group">
                                <label>Nombre producto:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-list"></i></span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="Nombre categoria" id="nombre" name="nombre"  required>
                                </div>
                            </div> <!-- /.input group -->
                            <div class="form-group">
                                <label>Descripcion:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="Descripcion Producto" id="descripcion" name="descripcion"  required>
                                </div>
                            </div> <!-- /.input group -->
                            <div class="form-group">
                                <label>Precio venta:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                  </div>
                                  <input type="number" class="form-control" placeholder="Precio venta" id="precio" name="precio"  required>
                                </div>
                            </div> <!-- /.input group -->
                            <div class="form-group">
                                <label>Stock:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                  </div>
                                  <input type="number" class="form-control" placeholder="0" value="0" disabled >
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