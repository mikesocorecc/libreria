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
                <h1 class="m-0 text-dark">Agregar compra</h1>
                
            </div><!-- /.col -->
            <div class="col-sm-6"> <!--  breadcrumb --> 
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
                <li class="breadcrumb-item active">compras</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div><!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-default">

                  <div class="card-header">
                    <h3 class="card-title">Complete el formulario</h3>
                    <div class="card-tools">
                    </div>
                  </div>

                  <form class=""  id=""   method="POST" >
                        <div class="card-body row">
                                <div class="col-md-12">
                                      <div class="form-group">
                                      <label>Proveedor</label>
                                      <select class="form-control select2bs4" style="width: 100%;" id="id_proveedor">
                                          <option selected="selected">---Selecciones un proveedor---</option>
                                          <?php  
                                              try {
                                                $sql = "SELECT * FROM proveedores ORDER BY idproveedor DESC";
                                                $resultado = $conn->query($sql);
                                                while($proveedores = $resultado->fetch_assoc()){ ?>
                                                <option value="<?php echo $proveedores['idproveedor'];?>" ><?php echo $proveedores['nombreProv'];?></option>
                                                <?php }
                                              } catch (Exception $e) {
                                                echo "Error".$e->getMessage();
                                              }
                                          ?>
                                      </select>
                                      </div>
                                    <div class="form-group">
                                    <label>Usuario</label>
                                    <select class="form-control select2bs4" style="width: 100%;" disabled id="id_usuario">
                                        <option selected="selected"  value="<?php $_SESSION['id'] ?>"><?php echo $_SESSION['usuario'] ?></option>
                                    </select>
                                    </div>
                                    <div class="card-header form-group">
                                        <h3 class="card-title">Complete el formulario</h3>
                                        <div class="card-tools">
                                        </div>
                                    </div>
                                    <div class="form-group mt-4">
                                    <label>Seleccione el producto</label>
                                    <select class="form-control select2bs4" style="width: 100%;" id="id_producto" required>
                                        <option selected disabled >---Seleccione un producto---</option>
                                        <?php  
                                            try {
                                              $sql = "SELECT * FROM productos ORDER BY idproducto DESC";
                                              $resultado = $conn->query($sql);
                                              while($productos = $resultado->fetch_assoc()){ ?>
                                              <option value="<?php echo $productos['idproducto'];?>" ><?php echo $productos['nombreProducto'];?></option>
                                              <?php }
                                            } catch (Exception $e) {
                                              echo "Error".$e->getMessage();
                                            }
                                        ?>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group ">
                                        <label>Cantidad</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-list"></i></span>
                                            </div>
                                            <input type="number" class="form-control" placeholder="Cantidad a comprar" id="cantidad"  required>
                                        </div>
                                    </div> <!-- /.input group -->
                                </div>
                                <div class="col-12 col-md-4">    
                                    <div class="form-group ">
                                        <label>Precio:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-list"></i></span>
                                            </div>
                                            <input type="number" class="form-control" placeholder="Precio compreaa" id="precio"  required>
                                        </div>
                                    </div> <!-- /.input group -->   
                                  </div>   
                                <div class="col-12 col-md-4">    
                                    <div class="form-group ">
                                            <br>
                                          <button type="submit" id="calcular"  class="btn btn-success w-75 mt-0 mt-md-2 ">Agregar detalle</button>
                                    </div> <!-- /.input group -->                           
                                </div> 

                                <div class="col-12">
                                  <div class="card">
                                    <div class="card-header">
                                      <h3 class="card-title">Detalle de la compra</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                      <table id="detalles" class="table table-hover text-nowrap">
                                        <thead>
                                          <tr>
                                            <th>Accion</th>
                                            <th>Producto</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Subtotal</th>
                                          </tr>
                                        </thead>
                                        <tfoot>
                                          <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Total</td>
                                            <td class="text-primary" id="total"></td>
                                          </tr>
                                          <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Total Impuesto</td>
                                            <td class="text-primary"  id="total_impuesto"></td>
                                          </tr>
                                          <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Total a pagar</td>
                                            <td class="text-danger"  style="font-size: 20px;" id="monto_pagar"> <input type="hidden" id="total_pagar" name="total_pagar"></td>
                                          </tr>
                                        </tfoot>
                                        <tbody>
                                        <td id="aqui">aqui</td>
                                        </tbody>
                                      </table>
                                    </div>
                                    <!-- /.card-body -->
                                  </div>
                                  <!-- /.card -->
                                </div>
                                <div class="text-center w-100">
                                    <a id="guardar" class="btn btn-app   bg-success ">
                                      <i class="fas fa-save"></i> Guardar
                                    </a>
                                </div>
                        </div>  
                  </form>
              </div>
  
          </div><!-- /.container-fluid -->
     </section>

</div><!-- /.content-wrapper -->
     



<?php include_once 'templates/footer.php'; ?>