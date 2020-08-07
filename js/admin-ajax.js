//Funcion ajax para ingresar un registro
$(document).ready(function () {

    //crear un registro
    $('#crear-registro').on('submit', function(e){
        e.preventDefault();
        var datos = $(this).serializeArray();
      
        //Llamado ajax
        $.ajax({
            type: $(this).attr('method'),
            data : datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data){
                console.log('click');
                console.log(data);
                var resultado = data;
                if(resultado.respuesta == 'correcto'){
                    $(".modal#agregar").modal('hide');//cierro el modal    
                    Swal.fire(
                        'Correcto!',
                        'Creado correctamente!',
                        'success'
                        ).then(function() {
                        location.reload(); //recarga la pagina
                    });
                                
                } else if(resultado.respuesta == 'vacio'){
                    Swal.fire(
                        'Error!',
                        'Rellene todos los campos',
                        'error'
                        )
                } else{
                    Swal.fire(
                        'Error!',
                        'No se pudo agregar ',
                        'error'
                        )
                }   
            }
        })
        
    });

 //crear un registro con archivo
    $('#crear-registro-archivo').on('submit', function(e){
        e.preventDefault();
        var datos = new FormData(this);

        //Llamado ajax
        $.ajax({
            type: $(this).attr('method'),
            data : datos,
            url: $(this).attr('action'),
            dataType: 'json',
            contentType: false,
            processData: false,
            async: true,
            cache: false,
            success: function(data){
                console.log(data);
                var resultado = data;
                if(resultado.respuesta == 'correcto'){
                    $(".modal#agregar").modal('hide');//cierro el modal    
                    Swal.fire(
                        'Correcto!',
                        'Creado correctamente!',
                        'success'
                        ).then(function() {
                            location.reload(); //recarga la pagina
                    });
                                
                } else if(resultado.respuesta == 'vacio'){
                    Swal.fire(
                        'Error!',
                        'Rellene todos los campos',
                        'error'
                        )
                } else{
                    Swal.fire(
                        'Error!',
                        'No se pudo agregar ',
                        'error'
                        )
                }   
            }
        })
        
    });

    //Editar un registro
    $('#editar-registro').on('submit', function(e){
        e.preventDefault();
        var datos = $(this).serializeArray();
        //Llamado ajax
        $.ajax({
            type: $(this).attr('method'),
            data : datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data){
                console.log(data);
                var resultado = data;
                if(resultado.respuesta == 'correcto'){
                    $(".modal#modal-editar").modal('hide');//cierro el modal    
                    Swal.fire(
                        'Correcto!',
                        'Editado correctamente!',
                        'success'
                        ).then(function() {
                        location.reload();//recarga la pagina
                    });         
                } else if(resultado.respuesta == 'vacio'){
                    Swal.fire(
                        'Error!',
                        'Rellene todos los campos',
                        'error'
                        )
                } else{
                    Swal.fire(
                        'Error!',
                        'No se pudo editar',
                        'error'
                        )
                }
                
            }
        })
    });

     //crear un registro con archivo
     $('#editar-registro-archivo').on('submit', function(e){
        e.preventDefault();
        var datos = new FormData(this);

        //Llamado ajax
        $.ajax({
            type: $(this).attr('method'),
            data : datos,
            url: $(this).attr('action'),
            dataType: 'json',
            contentType: false,
            processData: false,
            async: true,
            cache: false,
            success: function(data){
                console.log(data);
                var resultado = data;
                if(resultado.respuesta == 'correcto'){
                    $(".modal#agregar").modal('hide');//cierro el modal    
                    Swal.fire(
                        'Correcto!',
                        'Creado correctamente!',
                        'success'
                        ).then(function() {
                            location.reload(); //recarga la pagina
                    });
                                
                } else if(resultado.respuesta == 'vacio'){
                    Swal.fire(
                        'Error!',
                        'Rellene todos los campos',
                        'error'
                        )
                } else{
                    Swal.fire(
                        'Error!',
                        'No se pudo agregar ',
                        'error'
                        )
                }   
            }
        })
        
    });

    //Borrar un registro
    $('.borrar').on('click', function(e){
        e.preventDefault();
        
        var tipo = $(this).attr('data-tipo');
        var id = $(this).data('id');
        Swal.fire({
            title: 'Estas seguro?',
            text: "Un registro eliminado no se puede recuperar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    data: { 'id' : id, 'registro' : 'eliminar' },
                    url: "modelo-"+tipo+".php", //esto me hace referencia al tipo que manda el data            
                    success: function (data) {
                        var resultado = JSON.parse(data);
                        console.log(resultado);
                        if(resultado.respuesta == 'correcto'){
                            Swal.fire(
                                'Eliminado!',
                                'Registro eliminado',
                                'success'
                                )
                            jQuery('[data-id="'+resultado.id_eliminado+'"]').parents('tr').remove(); //lo quito de la lista
                        } else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'No se pudo eliminar'
                                })
                        }
                    }
                    }); //fin ajax
            } else{

            }
        });//fin del result
                
    }); //fin borrar

});