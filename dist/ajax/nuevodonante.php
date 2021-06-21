<?
    require "../../config.php";
    require "../../conexion.php";
    require "../../funciones.php";
    
    session_start();
    
    ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
    
    if(isLogin())
    {
        $conexion = new Conexion();
        
        $return['estado'] = 1;
        $return['msg'] = "";
        
        
        if( isset($_POST['dni']) && !empty($_POST['dni']) ){
            $cedula = $_POST['dni'];
        }
        
        $pasar = false;
        
        if( strlen($cedula) == 10 )
        {
            
            $arrayElement = str_split ($cedula);
            $endElement = array_pop($arrayElement);
            
            $total = 0;
            
            for( $i=0; $i<count($arrayElement); $i++ )
            {
                if( ($i%2) == 0 )
                {
                    $aux = intval($arrayElement[$i]*2);
                    
                    if( $aux > 9 ) $aux -= 9;
                    
                    $total += $aux;
                }else{
                    $total += intval($arrayElement[$i]);
                }
            }
            
            $total = $total % 10 ? 10 - $total % 10 : 0;
            
            if($total == $endElement)
            {
                $pasar = true;
            }else{
                $return['estado'] = 2;
                $return['msg'] = "Cédula Incorrecta";
            }
        }else{
            $return['estado'] = 2;
            $return['msg'] = "La longitud de la cédula es incorrecta";
        }
        
        if($pasar)
        {
            
            $sqldata = array();
            
            $dni = 0;
            $nombres = "";
            $apellidos = "";
            $direccion = "";
            $nombrecontacto = "";
            $numerocontacto = "";
            $tipodonacion = 0;
            
            if(
                isset($_POST['tipodonacion']) && !empty($_POST['tipodonacion']) 
            ){
                $tipodonacion = intval($_POST['tipodonacion']);
            }
            
            if(
                ( isset($_POST['nombres']) && !empty($_POST['nombres']) ) &&
                ( isset($_POST['apellidos']) && !empty($_POST['apellidos']) ) &&
                ( isset($_POST['direccion']) && !empty($_POST['direccion']) ) &&
                ( isset($_POST['pcontacto']) && !empty($_POST['pcontacto']) )&&
                ( isset($_POST['ncontacto']) && !empty($_POST['ncontacto']) )
            ){
                $nombres = htmlentities($_POST['nombres']);
                $apellidos = htmlentities($_POST['apellidos']);
                $direccion = htmlentities($_POST['direccion']);
                $nombrecontacto = htmlentities($_POST['pcontacto']);
                $numerocontacto = htmlentities($_POST['ncontacto']);
            }
            
            $sqlProductoDonante = "";
            
            switch( $tipodonacion ){
                case 1:
                    $sqlProductoDonante .= "INSERT INTO tb_producto_donate ( iddonante, tipo_producto, fecha, nombre, cantidad, descripcion ) VALUES ( ?,?,?,?,?,?);";
                    
                    if( empty($_POST['pnombre']) )
                    {
                        $return['estado'] = 2;
                        $return['msg'] = "El nombre del producto no debe estar vacios";
                    }else{
                        array_push( $sqldata, htmlentities($_POST['pnombre']) );
                    }
                    
                    if( empty($_POST['ppreciounit']) )
                    {
                        $return['estado'] = 2;
                        $return['msg'] = "El precio del producto no debe estar vacios";
                    }else{
                        array_push( $sqldata, htmlentities($_POST['ppreciounit']) );
                    }
                    
                    if( empty($_POST['pdescripcion']) )
                    {
                        $return['estado'] = 2;
                        $return['msg'] = "La descripción del producto no debe estar vacios";
                    }else{
                        array_push( $sqldata, htmlentities($_POST['pdescripcion']) );
                    }
                    
                    
                    break;
                case 2:
                    $sqlProductoDonante .= "INSERT INTO tb_producto_donate ( iddonante, tipo_producto, fecha, cantidad ) VALUES ( ?,?,?,?);";
                    
                    if( isset($_POST['cantidaddinero']) && floatval($_POST['cantidaddinero']) > 0 ){
                        array_push( $sqldata, floatval($_POST['cantidaddinero']) );
                    }
                    break;
                case 3:
                    $sqlProductoDonante .= "INSERT INTO tb_producto_donate ( iddonante, tipo_producto, fecha, cantidad ) VALUES ( ?,?,?,?);";
                    
                    if( isset($_POST['tiempo']) && floatval($_POST['tiempo']) > 0 ){
                        array_push( $sqldata, floatval($_POST['tiempo']) );
                    }
                    break;
            }
            
            $existe = false;
            $iddonante = 0;
            
            $existedonante = $conexion->buscarRegistro("SELECT * FROM tb_donante WHERE ruc = '$cedula' LIMIT 1");
            
            if( $existedonante ){
                $existe = true;
            }
            
            if( $existe )
            {
                $iddonante = $existedonante[0]['iddonante'];
            }else{
                $sqlGuardarDonador = "
                    INSERT INTO tb_donante
                    (nombres,
                    ruc,
                    direccion,
                    latitud,
                    longitud,
                    persona_contacto,
                    numero_contacto)
                    VALUES
                    (?,?,?,?,?,?,?);
                ";
                
                $dataDataDonador = array( $apellidos." ".$nombres, $cedula, $direccion, $_POST['latitude'], $_POST['longitude'], $nombrecontacto, $numerocontacto );
                
                $res = $conexion->ejecutar($sqlGuardarDonador, $dataDataDonador);
                
                if($res)
                {
                    $iddonante = $conexion->lastId();
                }
            }
            
            date_default_timezone_set("America/Guayaquil");
            
            array_unshift( $sqldata, $iddonante, $tipodonacion, date("Y-m-d H:i:s"));
            
            $sqlProductoDonante = trim($sqlProductoDonante);
            
            $res2 = $conexion->ejecutar($sqlProductoDonante, $sqldata);
            
            if($res2)
            {
                $return['msg'] = "Data Nueva";
            }
        }
        
    }else{
        $return['data'] = array();
    }

    print_r( json_encode( $return ) );

