//aqui se cargaran las inicializacion de todas las funciones
$(function () {

    //DataTable
    $("#registrar").DataTable({
      "responsive": true,
      "autoWidth": false,
      "order": [[ 3, "desc" ]],
      'language': {
        paginate: {
          next: 'Siguiente',
          previous: 'Anterior',
          last: 'Ultimo',
          first: 'Primero'
        },
        info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
        emptyTable: 'No hay registros',
        infoEmpty: '0 registros',
        search: 'Buscar',
        show: 'mostrar',
      }
    }); //fin dataTable
    $('#example2').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    //Initialize Select2 Elements
    $('.select2').select2();

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });

//******************************************************************** */
//mis codigos php
//******************************************************************** */
//modal editar
$('#modal-editar-categoria').on('show.bs.modal', function (event) {        
  // Guardamos los valores de los data en una variable
   var button = $(event.relatedTarget) 
   var idCategoria = button.data('id')
   var nombreCategoria = button.data('nombre')
   var descripcion = button.data('descripcion')
   var modal = $(this)
   // Le asiganmaos los valores a los inputs
   modal.find('.modal-body #nombre').val(nombreCategoria);
   modal.find('.modal-body #descripcion').val(descripcion);
   modal.find('.modal-body #id_registro').val(idCategoria);
   }); // Fin editar categoria


   //modal editar  producto archivo
$('#modal-editar-producto').on('show.bs.modal', function (event) {        
  // Guardamos los valores de los data en una variable
   var button = $(event.relatedTarget) 
   var idCat = button.data('id_cat')
   var nombreProd = button.data('nombre')
   var descripcionProd = button.data('descripcion')
   var precio = button.data('precio')
   var idProducto = button.data('id') //hace referencia al id del producto que es enviado por data
   var modal = $(this)
   // Le asiganmaos los valores a los inputs
   modal.find('.modal-body #cat_producto').val(idCat);
   modal.find('.modal-body #nombre').val(nombreProd);
   modal.find('.modal-body #descripcion').val(descripcionProd);
   modal.find('.modal-body #precio').val(precio);
   modal.find('.modal-body #id_registro').val(idProducto);
   }); // Fin editar categoria

   //modelo editar proveedores
   $('#modal-editar-proveedor').on('show.bs.modal', function(event){
      //Guardamos los valores en una variabe
      var button = $(event.relatedTarget)
      var idProv = button.data('id')
      var nombreProv = button.data('nombreprov')
      var direccionProv = button.data('direccionprov')
      var telefonoProv = button.data('telefonoprov')
      var emailProv = button.data('emailprov')
      //le asigno los valores al los campos
      var modal = $(this) //con esto ago referencia al modal que esta abierto
      modal.find('.modal-body #nombre').val(nombreProv)
      modal.find('.modal-body #direccion').val(direccionProv);
      modal.find('.modal-body #telefono').val(telefonoProv);
      modal.find('.modal-body #email').val(emailProv);
      modal.find('.modal-body #id_registro').val(idProv);
   }) //fin modal edit proveedores

      //modelo editar rol
      $('#modal-editar-rol').on('show.bs.modal', function(event){
        //Guardamos los valores en una variabe
        var button = $(event.relatedTarget)
        var id= button.data('id')
        var nombre = button.data('nombre')
        var descripcion = button.data('descripcion')
        //le asigno los valores al los campos
        var modal = $(this) //con esto ago referencia al modal que esta abierto
        modal.find('.modal-body #nombre').val(nombre)
        modal.find('.modal-body #descripcion').val(descripcion);
        modal.find('.modal-body #id_registro').val(id);
     }) //fin modal edit rol

     //modal editar  usuario archivo
$('#modal-editar-usuario').on('show.bs.modal', function (event) {        
  // Guardamos los valores de los data en una variable
   var button = $(event.relatedTarget) 
   var usuario = button.data('usuario')
   var idRol = button.data('rol')
   var cui = button.data('cui')
   var nombre = button.data('nombre')
   var apellido = button.data('apellido')
   var telefono = button.data('telefono')
   var email = button.data('email')
   var direccion = button.data('direccion')
   var idUsuario = button.data('id') //hace referencia al id del producto que es enviado por data
   var modal = $(this)
   // Le asiganmaos los valores a los inputs
   modal.find('.modal-body #usuario').val(usuario);
   modal.find('.modal-body #rol').val(idRol);
   modal.find('.modal-body #cui').val(cui);
   modal.find('.modal-body #nombre').val(nombre);
   modal.find('.modal-body #apellido').val(apellido);
   modal.find('.modal-body #telefono').val(telefono);
   modal.find('.modal-body #email').val(email);
   modal.find('.modal-body #direccion').val(direccion);
   modal.find('.modal-body #id_registro').val(idUsuario);
   }); // Fin editar usuario

        //modal editar  cliente 
$('#modal-editar-cliente').on('show.bs.modal', function (event) {        
  // Guardamos los valores de los data en una variable
   var button = $(event.relatedTarget) 
   var nombre = button.data('nombre')
   var apellido = button.data('apellido')
   var nit = button.data('nit')
   var direccion = button.data('direccion')
   var telefono = button.data('telefono')
   var email = button.data('email')
   var idCliente = button.data('id')//hace referencia al id del producto que es enviado por data
   var modal = $(this)
   // Le asiganmaos los valores a los inputs
   modal.find('.modal-body #nombre').val(nombre);
   modal.find('.modal-body #apellido').val(apellido);
   modal.find('.modal-body #nit').val(nit);
   modal.find('.modal-body #direccion').val(direccion);
   modal.find('.modal-body #telefono').val(telefono);
   modal.find('.modal-body #email').val(email);
   modal.find('.modal-body #id_registro').val(idCliente);
   }); // Fin editar cliente

   //cotizacion compra
   $("#calcular").click(function(e){
    e.preventDefault();
    agregar();
    });

$('#aqui').click(function(){
  console.log('click');
});
    //variables globales
    var cont = 0;
    var total = 0;
    var subtotal = [];
    $('#guardar').hide();


    //fuuncion agregar
  function agregar(){
     idproducto = $('#id_producto').val();
     producto = $('#id_producto option:selected').text();
     cantidad = $('#cantidad').val();
     precio = $('#precio').val();
         impuesto = 20;

    if(idproducto != "" && cantidad != "" && cantidad > 0 && precio != ""){
      subtotal[cont] = cantidad* precio;
      total = total + subtotal[cont];
      var fila= '<tr class="selected" id="fila'+cont+'"><td><span  id="borrar" class="btn btn-danger btn-sm" ><i class="fa fa-times fa-2x"></i></span></td> <td><input type="hidden" name="id_producto[]" value="'+idproducto+'">'+producto+'</td> <td><input class="form-control w-75" placeholder="Precio de compra" type="number" id="preciocompra[]" name="preciocompra[]"  value="'+precio+'"> </td>  <td><input class="form-control w-75" placeholder="Precio de compra" type="number" name="cantidad[]" value="'+cantidad+'"> </td> <td>Q '+subtotal[cont]+' </td></tr>';
      cont++;
      totales();
      limpiar();
      evaluar();
      $('#detalles').prepend(fila);
    } else{

    }
  }

  //funcion que evalua si hay compras, activa el btn guardar
  function evaluar(){
    if(total>0){
      $("#guardar").show();
    } else{
      $("#guardar").hide();
    }
}

  //funcion totales
  function totales(){
    $('#total').html("QGT " + total.toFixed(2));

    var totalImpuesto = (total * impuesto) / 100;
    var totalPagar = total + totalImpuesto;

    $('#total_impuesto').html("QGT " + totalImpuesto);
    $('#monto_pagar').html("QGT "+ totalPagar.toFixed(2));
    $('#total_pagar').val(totalPagar.toFixed(2));
  }

//funcion limpiar campo
function limpiar(){        
  $("#cantidad").val("");
  $("#precio").val("");
}

//funcion para eliminar de la lista
function eliminar(index){
   total = total - subtotal[index];
   totalImpuesto = total * 20 / 100;
   monto_pagar  = total + totalImpuesto;
  $('#total').html("QGT " + total.toFixed(2));
  $('#total_impuesto').html("QGT " + totalImpuesto);
  $('#monto_pagar').html("QGT "+ monto_pagar.toFixed(2));
  $('#total_pagar').val(monto_pagar.toFixed(2));
  $('#fila'+index).remove();
  evaluar();
}

  });

