$(document).ready(function () {
    $('#login-usuario').on('submit', function(e){
        e.preventDefault();
        var datos = $(this).serializeArray();        
        $.ajax({
            type: "post",
            url: "modelo-login.php",
            data: datos,
            dataType: "json",
            success: function (data) {
                var resultado  = data;
                if(resultado.respuesta == "correcto"){
                    Swal.fire(
                        'Correcto!',
                        'Bienvenid(o) <span class="text-success font-weight-bold">'+resultado.usuario+'</span> !!!',
                        'success'
                        ).then(function() {
                           location.href = 'inicio.php';
                    });
                }else{
                    Swal.fire(
                        'Error!',
                        '<span class="text-danger ">'+'El usuario o el password son incorrecto !!!'+'</span> ',
                        'error'
                        )                     
                }                
                
            }
        });
    });
});