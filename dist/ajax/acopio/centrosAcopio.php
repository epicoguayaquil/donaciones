<?
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require "../../../funciones.php";

    session_start();
    
    if( isLogin() )
    {
        $return['success'] = 1;
        $return['mensaje'] = "";
        
        $conexion = new Conexion();
        
        if( $_POST['accion'] == "REGISTRAR")
        {
            $idacopio = 0;
            $estado = "A";
            $nombreAcopio = "";
            $direccionAcopio = "";
            
            if(                
                ( isset($_POST['nombre']) && !empty($_POST['nombre']) ) &&
                ( isset($_POST['direccion']) && !empty($_POST['direccion']) ) 
            )
            {
                $nombreAcopio = htmlentities($_POST['nombre']);
                $direccionAcopio = htmlentities($_POST['direccion']);
            }
            
            if( isset($_POST['idsucursal']) )
            {
                $idacopio = intval($_POST['idsucursal']);
            }  
            
            if( isset($_POST['estado']) )
            {
                $estado = ($_POST['estado']);
            }
            
            if(
                empty($nombreAcopio) ||
                empty($direccionAcopio)
            )
            {
                $return['success'] = 2;
                $return['mensaje'] = html_entity_decode("Parámetros Vacios");
            }
            /*
            $existeCAcopio = $conexion->buscarRegistro("SELECT * FROM tb_sucursal WHERE nombre = '$nombreAcopio'");
            
            if( $existeCAcopio )
            {
                $return['success'] = 2;
                $return['mensaje'] = "El centro del acopio ya existe";
            }else{
                */
                if( $idacopio > 0 )
                {
                    $actualizarCAcopio = $conexion->ejecutar("UPDATE tb_sucursal SET nombre = ?, direccion = ?, estado = ?, latitud = ?, longitud = ? WHERE idsucursal = ?",array($nombreAcopio,$direccionAcopio,$estado, $_POST['latitud'], $_POST['longitud'] ,$idacopio));
                    if( $actualizarCAcopio )
                    {
                        $return['success'] = 1;
                        $return['mensaje'] = "Éxito al actualizar";
                    }else{
                        $return['success'] = 2;
                        $return['mensaje'] = "Error al actualizar";
                    }
                }else{
                    $registrarCAcopio = $conexion->ejecutar("INSERT INTO tb_sucursal (id_gestor_logistico, nombre, direccion, latitud, longitud) VALUES (?,?,?,?,?)", array($_SESSION['usu_id'], $nombreAcopio, $direccionAcopio, $_POST['latitud'], $_POST['longitud']));
                    if( $registrarCAcopio )
                    {
                        $return['success'] = 1;
                        $return['mensaje'] = "Éxito al registrar";
                    }else{
                        $return['success'] = 2;
                        $return['mensaje'] = "Error al registrar";
                    }
                }
            // }
        }else if( $_POST['accion'] == "LISTAR")
        {
            $idgeslogis = intval( $_SESSION['usu_id'] );
            
            $sql = "SELECT * FROM tb_sucursal WHERE id_gestor_logistico = ? ";
            
            if( isset($_POST['idgestor']) )
            {
                $idgeslogis = intval($_POST['idgestor']);
                $sql .= "AND estado = 'A'";
            }
            
            $seleccionarIdAcopio = $conexion->buscarVariosRegistro($sql,array($idgeslogis));
            
            $return['data'] = $seleccionarIdAcopio;
        }
        
    }else{
        $return['success'] = 3;
        $return['mensaje'] = "Debe iniciar session";
    }

    print_r( json_encode( $return ) );