<?
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require "../../../funciones.php";

    session_start();
    
    if( isLogin() )
    {
        $conexion = new Conexion();
        
        $return['estado'] = 1;
        // $return['data'] = $_POST;
        
        /**
         * REGISTRA NUEVO CAUSA
         */
         
        $flag = true; 
        $idcausa = 0;
        $iddonante = 0;
        
        // ID DONANTE
        if( isset($_POST['selectdonante']) && intval($_POST['selectdonante']) > 0 )
        {
            $iddonante = intval($_POST['selectdonante']);
        }else{
            $flag = false;
            $return['estado'] = 2;
            $return['msj'] = "Debe seleccionar al menos un donante para la causa";
        }
        
        // ID CAUSA
        if( isset($_POST['idcausamodal']) && !empty($_POST['idcausamodal']) )
        {
            $idcausa = intval( $_POST['idcausamodal'] );
        }else{
            $flag = false;
            $return['estado'] = 2;
            $return['msj'] = "No hay causa seleccionada";
        }
        
        if( $flag )
        {
            $flagRegistrarCausa = true;
            $productos = array();
            $cantidad = array();
            $categoria_producto_causa = array();
            
            if(
                ( isset($_POST['productos_causa']) ) &&
                ( isset($_POST['cantidad_producto']) ) &&
                ( isset($_POST['categoria_producto_causa']) ) 
            )
            {
                $productos = $_POST['productos_causa'];
                $cantidad = $_POST['cantidad_producto'];
                $categoria_producto_causa = $_POST['categoria_producto_causa'];
            }
            
            if( in_array("0", $categoria_producto_causa) )
            {
                $flagRegistrarCausa = false;
                $return['estado'] = 2;
                $return['msj'] = "Debe seleccionar una categoria";
            }
            
            if( in_array("0", $cantidad) )
            {
                $flagRegistrarCausa = false;
                $return['estado'] = 2;
                $return['msj'] = "Debe ingresar una cantidad mayor a 0";
            }
            
            if( in_array("0", $productos) )
            {
                $flagRegistrarCausa = false;
                $return['estado'] = 2;
                $return['msj'] = "Debe seleccionar un producto de la categoria";
            }
            
            if( $flagRegistrarCausa )
            {
                if( count($productos) == count( array_unique($productos) ) )
                {
                    if( $idcausa > 0 )
                    {
                        $total = 0;
                        for( $i = 0; $i < count($productos); $i++ )
                        {
                            // SENTENCIA PARA GUARDAR EN TB_DONACIONES
                            $estado = $conexion->ejecutar("INSERT INTO tb_donaciones(iddonante, causaid, idproducto, cantidad, idunidadmedida) VALUES (?, ?, ?, ?, ?)",array($iddonante, $idcausa, $productos[$i], $cantidad[$i], intval( $_POST['unidadMedidaDonacion'][$i] )));
                            if( $estado )
                            {
                                $total++;
                            }else{
                                $total--;
                            }
                            
                        }
                        
                        if( intval($total) == intval( count($productos) ) )
                        {
                            $return['mensaje'] = "Registrado con éxito ";
                        }else{
                            $return['estado'] = 2;
                            $return['msj'] = "error";
                        }
                    }
                }else{
                    $return['estado'] = 2;
                    $return['msj'] = "No debe existir productos duplicados";
                }
            }
        }
    }else{
        $return['estado'] = 2;
        $return['msj'] = "debe iniciar session";
    }
    
    print_r( json_encode( $return ) );