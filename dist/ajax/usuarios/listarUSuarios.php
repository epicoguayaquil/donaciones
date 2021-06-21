<?
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require "../../../funciones.php";

    session_start();
    
    if( isLogin() )
    {
        $conexion = new Conexion();
        
        $return['success'] = 1;
        $return['mensaje'] = "";
        $return['data'] = array();
        
        if( $_POST['metodo'] == "GLOGISTICO" )
        {
            $GLOGISTICO = $conexion->buscarVariosRegistro(" SELECT usu_id, nombre FROM tb_usuario WHERE rol_id = 3 AND estado = 'A' ");
            if( count($GLOGISTICO) > 0 )
            {
                $return['data'] = $GLOGISTICO;
            }
        }else if( $_POST['metodo'] == "GDONACION" )
        {
            $GLOGISTICO = $conexion->buscarVariosRegistro("SELECT usu.usu_id, usu.nombre, rol.rol FROM tb_usuario AS usu INNER JOIN tb_rol AS rol ON rol.rol_id = usu.rol_id WHERE usu.rol_id = 2 AND usu.estado = 'A' ");
            
            $return['data'] = $GLOGISTICO;
        }else if( $_POST['metodo'] == "GESTORLOGISTICOCENTROACOPIO" )
        {
            $centrosAcopio = $conexion->buscarVariosRegistro("SELECT * FROM tb_sucursal WHERE id_gestor_logistico = ? AND estado = ? ",array( intval($_POST['idlogistico']) , 'A' ));
            $return['centros'] = $centrosAcopio;
        }else if( $_POST['metodo'] == "GESTORVERIFICADOR" )
        {
            $GVERIFICADOR = $conexion->buscarVariosRegistro("SELECT usu.usu_id, usu.nombre, rol.rol FROM tb_usuario AS usu INNER JOIN tb_rol AS rol ON rol.rol_id = usu.rol_id WHERE usu.rol_id = 4 AND usu.estado = 'A' ");
            
            $return['data'] = $GVERIFICADOR;
        }else if( $_POST['metodo'] == "CAMBIARCONTRASENA" )
        {
            $return['data'] = $_POST;
            $email = $_SESSION['usuario'];
            $contrasenaActual = $_POST['contrasenaActual'];
            
            $nuevaContrasena = $_POST['contrasenaNueva'];
            $repetirContrasena = $_POST['repetirContrasena'];
            
            if( $nuevaContrasena == $repetirContrasena )
            {
                $usuarioExistente = $conexion->buscarRegistro( "SELECT * FROM tb_usuario WHERE usuario = '$email' AND clave = '$contrasenaActual' " );
                
                if( $usuarioExistente )
                {
                    $actualizarContrasena = $conexion->ejecutar( "UPDATE tb_usuario SET clave = ? WHERE usu_id = ?", array( $nuevaContrasena, $_SESSION['usu_id'] ));
                    
                    if( $actualizarContrasena )
                    {   
                        $_SESSION = array();
                        $return['mensaje'] = html_entity_decode("Contrase&ntilde;a actualizada");
                    }else{
                        $return['success'] = 2;
                        $return['mensaje'] = html_entity_decode("Error al actualizar la contrase&ntilde;a");
                    }
                }else{
                    $return['success'] = 2;
                    $return['mensaje'] = html_entity_decode("La contrase&ntilde;a ingresada no coincide con la registrada previamente");
                }
            }else{
                $return['success'] = 3;
                $return['mensaje'] = " Las contraseñas deben coincidir ";
            }
        }
        
    }else{
        $return['success'] = 3;
        $return['mensaje'] = "Debe iniciar session";
    }
    
    print_r( json_encode($return) );