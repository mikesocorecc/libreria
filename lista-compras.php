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
          <h1 class="m-0 text-dark">Administrar las compras</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <!--  breadcrumb -->
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
      <!-- /.card -->
      <div class="card">
        <div class="card-header">
          <button type="button" class="btn bg-gradient-success " data-toggle="modal">
            <i class="fas fa-plus"></i>
            <a href="crear-compra.php" class="text-light"> Agregar una nueva compra</a>
          </button>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Todas las compras realizadas</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap" style="font-size: 14px;">
                  <thead>
                    <tr>
                      <th>Fecha compra</th>
                      <th>N° compra</th>
                      <th>Proveedor</th>
                      <th>Tipo identificacion</th>
                      <th>Comprador</th>
                      <th>Total </th>
                      <th>Impuesto</th>
                      <th>Acciones</th>
                      <th>Descargar reporte</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    try {
                      //consulta la tabla categorias
                      $sql =  "SELECT compras.*, proveedores.idproveedor, proveedores.nombreProv, usuarios.idusuario, usuarios.usuario ";
                      $sql .= " FROM compras ";
                      $sql .= " INNER JOIN proveedores ";
                      $sql .= " ON compras.idProveedor = proveedores.idproveedor ";
                      $sql .= " INNER JOIN usuarios ";
                      $sql .= " ON compras.idUsuario = usuarios.idusuario  ORDER BY idcompra DESC ";
                      $resultado = $conn->query($sql);
                    } catch (Exception $e) {
                      $error = $e->getMessage();
                      echo $error;
                    }
                    //recorro los arreglos con while
                    while ($compras = $resultado->fetch_assoc()) { ?>
                      <tr>
                        <td><?php echo $compras['fecha'] ?></td>
                        <td><?php echo $compras['idcompra'] ?></td>
                        <td><?php echo $compras['nombreProv'] ?></td>
                        <td><?php echo $compras['identificacion'] ?></td>
                        <td><?php echo $compras['usuario'] ?></td>
                        <td><?php echo $compras['total'] ?></td>
                        <td><?php echo $compras['impuesto'] ?></td>

                        <td class="text-right py-0 align-middle">
                          <div class="btn-group btn-group-sm w-100">
                            <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                          </div>
                        </td>
                        <td>
                          <button type="button" class="btn btn-primary">
                            <i class="fas fa-download"></i> Generar PDF
                          </button>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!--  ***********************************************MODALES******************************** -->
<!--  MODAL AGREGAR CATEGORIA -->
<div class="modal fade" id="agregar">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Agregar categoria</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="crear-registro" action="modelo-categoria.php" method="POST">
          <div class="form-group">
            <label>Nombre categoria:</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-list"></i></span>
              </div>
              <input type="text" class="form-control" placeholder="Nombre categoria" name="nombre" required>
            </div>
          </div> <!-- /.input group -->
          <div class="form-group">
            <label>Descripcion:</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-file-alt"></i></span>
              </div>
              <input type="text" class="form-control" placeholder="Descripcion categoria" name="descripcion" required>
            </div>
          </div> <!-- /.input group -->
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            <input type="hidden" name="registro" value="nuevo">
            <button type="submit" data-tipo="categorias" class="btn btn-primary">Agregar</button>
          </div>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div> <!-- /.modal -->


<!--  MODAL EDITAR CATEGORIA -->
<div class="modal fade" id="modal-editar-categoria">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Editar categoria</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editar-registro" action="modelo-categoria.php" method="POST">
          <div class="form-group">
            <label>Nombre categoria:</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-list"></i></span>
              </div>
              <input type="text" id="nombre" class="form-control" placeholder="Nombre categoria" name="nombre" required>
            </div>
          </div> <!-- /.input group -->
          <div class="form-group">
            <label>Descripcion:</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-file-alt"></i></span>
              </div>
              <input type="text" id="descripcion" class="form-control" placeholder="Descripcion categoria" name="descripcion" required>
            </div>
            <input type="hidden" id="id_registro" name="id_registro">
          </div> <!-- /.input group -->
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            <input type="hidden" name="registro" value="actualizar">
            <button type="submit" class="btn btn-primary">Actualizar</button>
          </div>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div> <!-- /.modal -->





<?php include_once 'templates/footer.php'; ?>