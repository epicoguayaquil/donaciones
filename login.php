<?php
    require "funciones.php";
    session_start();
    
    if( isLogin() ){
        header("Location: index.php");
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
	 <?php
        titulo_header();
    ?>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name=description content="SISTEMA EPICO">
<!--===============================================================================================-->	
<!--===============================================================================================-->
	<!--<link href="../vendors/bootstrap/dist/css/bootstrap2.min.css" rel="stylesheet">-->
<!--===============================================================================================-->
	<!--<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">-->
<!--===============================================================================================-->
	<!--<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">-->
	<!--<link href="../vendors/font-awesome/css/icon-font.min.css" rel="stylesheet">-->
<!--===============================================================================================-->
	<!--<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">-->
	<!--<link href="../vendors/font-awesome/css/material-design-iconic-font.min.css" rel="stylesheet">-->
<!--===============================================================================================-->
	<!--<link href="../vendors/animate.css/animate.min.css" rel="stylesheet">-->
<!--===============================================================================================-->	
	<!--<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">-->
	<!--<link href="../vendors/css-hamburgers/hamburgers.min.css" rel="stylesheet">-->
<!--===============================================================================================-->
	<!--<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">-->
	<!--<link rel="stylesheet" type="text/css" href="../vendors/animsition/css/animsition.min.css">-->
<!--===============================================================================================-->
	<!--<link rel="stylesheet" type="text/css" href="../vendors/select2/select2.min.css">-->
<!--===============================================================================================-->	
	<!--<link rel="stylesheet" type="text/css" href="../vendors/daterangepicker/daterangepicker.css">-->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body style="background-color: #999999;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="login100-more" style="background-image: url('images/logo/login-min.jpeg');"></div>

			<div class="wrap-login100 p-l-50 p-r-50 p-t-0 p-b-50">
				<form class="login100-form validate-form" id="frm_login">
					<span class="login100-form-title p-b-59" style="text-align: center;padding-bottom: 0px;">
						<img src="images/logo/logo_2-min.webp" class="lazyload" style="width: 75%" width="75%" alt="Logo_Epico" >
					</span>
					<div class="wrap-input100 validate-input" data-validate="Username is required">
						<span class="label-input100" style="color: black;">Usuario</span>
						<input class="input100" type="text" name="email" id="txtusuario" placeholder="usuario..." style='height: 30px'>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<span class="label-input100" style="color: black;">Contrase&ntilde;a</span>
						<input class="input100" type="password" name="password" id="txtpassword" placeholder="*************" style='height: 30px'>
						<span class="focus-input100"></span>
					</div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn">
								Ingresar
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>


	
<!--===============================================================================================-->
	<!--<script src="../vendors/jquery/jquery-3.2.1.min.js"></script>-->
	<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!--===============================================================================================-->
	<!--<script src="../vendors/animsition/js/animsition.min.js"></script>-->
<!--===============================================================================================-->
	<!--<script src="../vendors/bootstrap/js/popper.js"></script>-->
	<!--<script src="../vendors/bootstrap/js/bootstrap.min.js"></script>-->
<!--===============================================================================================-->
	<!--<script src="../vendors/select2/select2.min.js"></script>-->
<!--===============================================================================================-->
	<!--<script src="../vendors/daterangepicker/moment.min.js"></script>-->
	<!--<script src="../vendors/daterangepicker/daterangepicker.js"></script>-->
<!--===============================================================================================-->
	<!--<script src="../vendors/countdowntime/countdowntime.js"></script>-->
<!--===============================================================================================-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
<!--===============================================================================================-->
	<!--<script src="js/main.js"></script>-->

<script>
$(document).ready(function(){
    $("#frm_login").submit(function( event ){
        event.preventDefault()
        
        var usuario = $("#txtusuario").val(), 
        contrasena = $("#txtpassword").val();
        $.ajax({
            type: "POST",
            url: "dist/ajax/login.php",
            dataType: "json",
            data:{
                usuario,
                contrasena
            },
            error: function( err )
            {
                console.log(err);
            },
            success: function( response )
            {
                console.log( response )
                switch( response.estado )
                {
                case 1:
                    document.location = "";
                    break;
                    case 2:
                        Swal.fire({
                            icon: 'warning',
                            text: 'No se pudo iniciar sesión: correo o contraseña no válidos',
                            confirmButtonText: 'Aceptar'
                        })
                        
                        $("#frm_login").trigger('reset')
                    break;
                }
            }
        });
    
        return false;
    });
}); 

</script>
</body>
</html>