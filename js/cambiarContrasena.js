$(document).ready(function(){
    
    $("#formContrasena").submit(  function(e){
        e.preventDefault()
        
        var contrasena = $("#contrasenaNueva").val(),
            repeteContrasena = $("#repetirContrasena").val()
        
        
        if( contrasena === repeteContrasena  )
        {
            var formData = new FormData( $(this)[0] )
            formData.append('metodo', 'CAMBIARCONTRASENA')
            
            $.ajax({
                type: 'POST',
                url: 'dist/ajax/usuarios/listarUSuarios.php',
                data: formData,
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                error: function( err )
                {
                    console.log( err )
                },
                beforeSend: function()
                {
                    $(".cambiarCorreo").prop({disabled: true}).html('<i class="fa fa-spinner fa-spin"></i> Actualizando Correo');
                },
                success:   function( response )
                {
                    switch( response.success )
                    {
                        case 1:
                            $('#myModal').modal('hide')
                            sweetAlert('success', response.mensaje, 'Reinicie Session para confirmar la contrase\u00F1a', function( estado ){
                                if( estado.isConfirmed )
                                {
                                    location.reload()
                                }
                            });
                            
                            // alert( response.mensaje )
                            // location.reload()
                            break;
                        case 2:
                            // alert( response.mensaje)
                            sweetAlert('warning', 'Contrase\u00F1a Invalida', response.mensaje, (estado)=>{})
                            break;
                        case 3:
                            location.reload();
                            break;
                    }
                },
                complete: function()
                {
                    $(".cambiarCorreo").prop({disabled: false}).html('Cambiar Contrase«Ða');
                }
            })
        }else{
            // alert("La nueva contraseÃ±a desde ser la misma")
            sweetAlert('warning', 'Contrase\u00F1a Invalida', "La nueva contrase\u00F1a desde ser la misma", (estado)=>{})
        }
        
        return  false
    })
})

function sweetAlert( icon = 'success', title = 'Contrase\u00F1a Actualizada', text = '', callback  )
{
    Swal.fire({
        icon,
        text,
        title,
        confirmButtonText: 'Aceptar'
    }).then((result)=>{
        callback( result )
    })
}