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
        
        if( $_POST['metodo'] == "guardarusuario" )
        {
            $guardarUsuario = $conexion->ejecutar("
                INSERT INTO tb_usuario( rol_id, nombre, usuario, telefono, area, clave, descripcion)
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ", array(
                intval( $_POST["rol"] ),
                htmlentities( $_POST["apellidosnombres"] ),
                htmlentities( $_POST["correoElectronico"] ),
                htmlentities( $_POST["telefonousuario"] ),
                htmlentities( $_POST["areausuario"] ),
                htmlentities( $_POST["contrasenausuario"] ),
                htmlentities( $_POST["descripcion"] )
                )
                );
                
            if( $guardarUsuario )
            {
                $return['mensaje'] = "Usuario Creado";
            }else{
                $return['success'] = 2;
                $return['mensaje'] = "Error al crear usuario";
            }
        } else if( $_POST['metodo'] == "actualizarusuario" )
        {
            $actualizarUsuario = Conexion::ejecutar(
                " UPDATE `tb_usuario` SET
                `rol_id`= ? ,
                `nombre`= ? ,
                `usuario`= ? ,
                `telefono`= ? ,
                `area`= ? ,
                `descripcion`= ? 
                WHERE usu_id = ? ",
                array(
                    intval( $_POST['rol'] ) ,
                    html_entity_decode( $_POST['apellidosnombres'] ),
                    html_entity_decode( $_POST['correoElectronico'] ),
                    $_POST['telefonousuario'],
                    html_entity_decode( $_POST['areausuario'] ),
                    html_entity_decode( $_POST['descripcion'] ),
                    intval( $_POST['idusuario'] ) 
                )
            );
            
            if( $actualizarUsuario )
            {
                $return['mensaje'] = "Usuario Actualizado";
            }else{
                $return['success'] = 2;
                $return['mensaje'] = "Error al crear usuario";
            }
            
        } else if( $_POST['metodo'] == "listarUsuario" )
        {
            $todosUsuarios = Conexion::buscarVariosRegistro("SELECT rl.rol, usu.* FROM tb_usuario AS usu INNER JOIN tb_rol AS rl ON (usu.rol_id = rl.rol_id)");
            
            if( count( $todosUsuarios ) > 0 )
            {
                foreach( $todosUsuarios as $item )
                {
                    $item['nombre'] = html_entity_decode( $item['nombre'] );
                    $item['usuario'] = html_entity_decode( $item['usuario'] );
                    $item['area'] = html_entity_decode( $item['area'] );
                    $item['descripcion'] = html_entity_decode( $item['descripcion'] );
                    
                    $return['data'][] = $item;
                }
            }else{
                $return['success'] = 2;
                $return['mensaje'] = "No hay registros";
            }
        }
        
    }else{
        $return['success'] = 3;
        $return['mensaje'] = "Debe iniciar session";
    }
    
    print_r( json_encode($return) );