<?
    ini_set("display_errors","1");
    
    session_start();
    
    require "../../../funciones.php";
    
    if( isLogin() )
    {
        date_default_timezone_set ( "America/Guayaquil" );
        
        $conexion = new Conexion();
        
        $return['estado'] = 1;
        $return['msj'] = "";
        $return['data'] = array();
        
        
        if( $_POST['metodo'] == "ACEPTARCAUSA" )
        {
            $idcausa = 0;
            $estadoPara = "";
            
            if(
                ( isset($_POST['idcausa']) && !empty($_POST['idcausa']) ) &&
                ( isset($_POST['estado']) && !empty($_POST['estado']) )
            )
            {
                $idcausa = intval($_POST['idcausa']);
                $estadoPara = $_POST['estado'];
            }
            
            $buscarCausa = $conexion->buscarRegistro("SELECT * FROM tb_historial_causa WHERE idcausa = $idcausa");
            $return['causa'] = $buscarCausa;
            /* 
            if( $buscarCausa )
            { */
                $conexion->ejecutar("UPDATE tb_historial_causa SET estadoAnterior = ?, estadoPosterior = ? WHERE idcausa = ? ",array($buscarCausa[0]['estadoPosterior'],$estadoPara,$idcausa ));
            // }
            
            $actualizarCausa = $conexion->ejecutar("UPDATE tb_causa SET estado = ? WHERE idcausa = ?",array($estadoPara,$idcausa));
            
            if( $actualizarCausa )
            {
                $return['estado'] = 1;
                $return['msj'] = "DARLE";
            }else{
                $return['estado'] = 2;
                $return['msj'] = "Error a actualizar";
            }
        }else{
            
            $nombreCausa = "";
            $detalleCausa = "";
            $fechaInicio = "";
            $fechaFinal = "";
            
            $idcausa = 0;
            $idgestor = $_SESSION['usu_id'];
            
            if(
                ( isset($_POST['nombreproposito']) && !empty($_POST['nombreproposito']) ) &&
                ( isset($_POST['proposito']) && !empty($_POST['proposito']) ) && 
                ( isset($_POST['fechaInicio']) && !empty($_POST['fechaInicio']) ) &&
                ( isset($_POST['fechaFin']) && !empty($_POST['fechaFin']) )  
            ){
                $nombreCausa = htmlentities($_POST['nombreproposito']);
                $detalleCausa = htmlentities($_POST['proposito'], ENT_QUOTES);
                $fechaInicio = date("Y/m/d", strtotime($_POST['fechaInicio']));
                $fechaFinal = date("Y/m/d", strtotime($_POST['fechaFin']));
            }
            
            if( isset($_POST['idcausa']) )
            {
                $idcausa = intval($_POST['idcausa']);
            }
            
            if( isset($_POST['gesDonacion']) )
            {
                $idgestor = intval($_POST['gesDonacion']);
            }
            
            $gestorDonacion[] = $_SESSION['usu_id'];
            
            if(
                ( isset( $_POST['productos'] ) && !empty( $_POST['productos'] ) ) &&
                ( isset( $_POST['cantidad_lista_producto'] ) && !empty( $_POST['cantidad_lista_producto'] ) ) &&
                ( isset( $_POST['categorias'] ) && !empty( $_POST['categorias'] ) ) 
            ){
                $productos=$_POST['productos'];//JEFF -> validar esto
                $cantidad_lista_producto=$_POST['cantidad_lista_producto'];
                $categorias=$_POST['categorias'];
            }
            
            if( isset( $_POST['gesDonacion'] ) )
            {
                $gestorDonacion = $_POST['gesDonacion'];
            }
            
            if(
                empty($productos) ||
                empty($cantidad_lista_producto) ||
                empty($categorias)
            )
            {
                $return['estado'] = 2;
                $return['msj'] = "Debe llenar todos los campos necesarios";
            }
            
            
            if( $idcausa == 0 )
            {
                $REGISTRARCAUSA = true;
                
                if( in_array("0", $categorias) )
                {
                    $REGISTRARCAUSA = false;
                    $return['estado'] = 2;
                    $return['msj'] = "Debe seleccionar una categoria";
                    
                }else if( in_array("0", $productos) )
                {
                    $REGISTRARCAUSA = false;
                    $return['estado'] = 2;
                    $return['msj'] = "Debe seleccionar un productos de la categoria";
                    
                }else if( in_array("0", $cantidad_lista_producto) )
                {
                    $REGISTRARCAUSA = false;
                    $return['estado'] = 2;
                    $return['msj'] = "La cantidad de productos no debe ser menor que 0";
                    
                }
                
                
                if( $REGISTRARCAUSA )
                {
                    
                    if(
                        count($productos) ==  count( array_unique($productos) ) 
                    )
                    {
                    
                        //$existeCausa = $conexion->buscarRegistro("SELECT * FROM tb_causa WHERE nombre_causa LIKE %$nombreCausa%");
                        $existeCausa = $conexion->buscarRegistro("SELECT * FROM tb_causa WHERE nombre_causa = '$nombreCausa'"); //jeff
                        if(!$existeCausa)
                        {
                            
                            $auxFecha = "";
                            if( $fechaInicio > $fechaFinal )
                            {
                                $auxFecha = $fechaFinal;
                                $fechaFinal = $fechaInicio;
                                $fechaInicio = $auxFecha;
                            }
                            
                            $registrarCausas = $conexion->ejecutar("INSERT INTO tb_causa ( nombre_causa, proposito, fecha_inicio, fecha_fin)VALUES(?, ?, ?, ?)",array( $nombreCausa, $detalleCausa, $fechaInicio, $fechaFinal));
                            
                            if( $registrarCausas )
                            {
                                
                                $idcausa = $conexion->lastId();
                            
                                $imagen = imagenGuardado( $conexion, $_FILES['imagenCausa'], $idcausa );
                                
                                if( $imagen[0] )
                                {
                                    $conexion->ejecutar("UPDATE tb_causa SET  imagen_causa = ? WHERE idcausa = ?", array( $imagen[1], $idcausa ));
                                    
                                    for( $dc = 0; $dc < count( $gestorDonacion ); $dc++ )
                                    {
                                        $conexion->ejecutar("INSERT INTO tb_gestorDonacion_causa(idcausa, id_gestor_donacion) VALUES (?,?)",array($idcausa, $gestorDonacion[$dc]));
                                    }
                                    
                                    for($x=0;$x<count($productos);$x++)
                                    {   //validar esta informacion: 1.- de que no este vacio
                                        
                                        $historialCausa = $conexion->ejecutar("INSERT INTO tb_detalle_causa (id_causa,id_producto,cantidad,id_categoria, idUnidadMedida) VALUES(?,?,?,?,?)", array($idcausa,$productos[$x],$cantidad_lista_producto[$x],$categorias[$x], intval( $_POST['unidadMedida'][$x] ) ));
                                                
                                    }
                                    
                                    
                                    $estado = $conexion->buscarRegistro("SELECT * FROM tb_causa WHERE idcausa = '$idcausa' ");
                                    
                                    $historialCausa = $conexion->ejecutar("INSERT INTO tb_historial_causa (idcausa,estadoPosterior,rolId,usuario,fecha) VALUES(?,?,?,?,?)", array($estado[0]['idcausa'], $estado[0]['estado'], $_SESSION['usu_id'], $_SESSION['usuario'], date("Y-m-d H:i:s")));
                                    
                                    if($historialCausa)
                                    {
                                        $return['estado'] = 1;
                                        $return['msj'] = "éxito";
                                    }else{
                                        $return['estado'] = 2;
                                        $return['msj'] = "Error";
                                    }
                                }else{
                                    
                                }
                            }else{
                                $return['estado'] = 2;
                                $return['msj'] = "error al guardar";
                            }
                        }else{
                            $return['estado'] = 2;
                            $return['msj'] = "La causa ya existe";
                        }
                       
                    }else{
                        $return['estado'] = 2;
                        $return['msj'] = "No debe existir productos duplicados";
                    }
                    
                   
                
                }
                
            }else{
                
                $ACTUALIZARCAUSA = true;
                
                if( in_array("0", $categorias) )
                {
                    $ACTUALIZARCAUSA = false;
                    $return['estado'] = 2;
                    $return['msj'] = "Debe seleccionar una categoria";
                    
                }else if( in_array("0", $productos) )
                {
                    $ACTUALIZARCAUSA = false;
                    $return['estado'] = 2;
                    $return['msj'] = "Debe seleccionar un productos de la categoria";
                    
                }else if( in_array("0", $cantidad_lista_producto) )
                {
                    $ACTUALIZARCAUSA = false;
                    $return['estado'] = 2;
                    $return['msj'] = "La cantidad de productos no debe ser menor que 0";
                    
                }
                
                if( $ACTUALIZARCAUSA )
                {
                    if( count($productos) == count( array_unique($productos) ) )
                    {
                        $auxFecha = "";
                        if( $fechaInicio > $fechaFinal )
                        {
                            $auxFecha = $fechaFinal;
                            $fechaFinal = $fechaInicio;
                            $fechaInicio = $auxFecha;
                        }
                        
                        $sql = "UPDATE tb_causa SET nombre_causa = ?,  proposito = ?, fecha_inicio = ?, fecha_fin = ?";
                        $dataUpdate = array( $nombreCausa, $detalleCausa, $fechaInicio, $fechaFinal );
                        
                        if( $_FILES['imagenCausa']["name"] != "" )
                        {
                            $sql .= ", imagen_causa = ?";
                            $actualizarImagen = imagenGuardado( $conexion, $_FILES['imagenCausa'], $idcausa );
                            array_push( $dataUpdate, $actualizarImagen[1] );
                        }
                        
                        $sql .= " WHERE idcausa = ? ";
                        array_push( $dataUpdate,  $idcausa);
                        
                        $actualizarCausa = $conexion->ejecutar( $sql, $dataUpdate);
                        
                        if($actualizarCausa)
                        {
                            $flagEditProdcutos = true;
                            
                            for( $i = 0; $i < count($cantidad_lista_producto); $i++ )
                            {
                                // $totalProductos = $conexion->buscarRegistro("SELECT SUM(cantidad) AS totalasignado FROM tb_donaciones WHERE causaid = ? AND idproducto = ?", array($idcausa, intval( $productos[$i] ) ));
                                
                                $totalProductos = $conexion->buscarRegistro("SELECT SUM(cantidad) AS totalasignado FROM tb_donaciones WHERE causaid = $idcausa AND idproducto = ".intval( $productos[$i] ) );
                                
                                if( intval( $totalProductos[0]['totalasignado'] ) > intval( $cantidad_lista_producto[$i] ) )
                                {
                                    $productoItem = $conexion->buscarRegistro("SELECT nombre FROM tb_producto WHERE id_producto = ".intval( $productos[$i] )); 
                                    $flagEditProdcutos = false;
                                    $return['estado'] = 2;
                                    $return['msj'] = html_entity_decode("La cantidad del producto ".$productoItem[0]['nombre']." tiene que se mayor de ".$totalProductos[0]['totalasignado']);
    
                                    break;
                                }
                                
                            }
                            
                            if($flagEditProdcutos)
                            {
                                $eliminarProductosCausa = $conexion->ejecutar("DELETE FROM tb_detalle_causa WHERE id_causa = ? ", array($idcausa) );
                                
                                if( $eliminarProductosCausa )
                                {
                                    $cont = 0;
                                    for( $u = 0; $u < count($productos); $u++ )
                                    {
                                        $conexion->ejecutar("INSERT INTO tb_detalle_causa (id_causa, id_producto, cantidad, id_categoria, idUnidadMedida) VALUES (?,?,?,?,?)",array($idcausa, $productos[$u], $cantidad_lista_producto[$u], $categorias[$u], intval( $_POST['unidadMedida'][$u] )));
                                        $cont++;
                                    }
                                    
                                    if( $cont == count($productos) )
                                    {
                                        $return['estado'] = 1;
                                        $return['msj'] = "ÉXITO AL ACTUALIZAR";
                                    }
                                }
                            }
                        
                        }else{
                            $return['estado'] = 2;
                            $return['msj'] = "Error al actualizar la causa";
                        }
                        
                    }else{
                        $return['estado'] = 2;
                        $return['msj'] = "No debe existir productos duplicados";
                    }
                }
            }
            
        }
    }else{
        $return['estado'] = 1;
        $return['msj'] = "Debe iniciar session";
    }
    
    print_r( json_encode( $return ) );
    
    function imagenGuardado($conexion, $imagen, $idCausa = 1)
    {
        $ext = strtolower( explode( "/", $imagen['type'] )[1] );
        
        if( in_array( $ext, array( "png", "jpg", "jpeg" ) ) )
        {
            
            $liminarImagen = $conexion->buscarRegistro("SELECT imagen_causa FROM tb_causa WHERE idcausa = ".intval($idCausa));
                
            $nombreFile = "C_".$idCausa."_".date("Y-m-d_H:i:s").".".$ext;
            
            if( $liminarImagen[0]["imagen_causa"] )
            {
                if( file_exists("../../../images/causas/".$liminarImagen[0]["imagen_causa"]) )
                {
                    unlink("../../../images/causas/".$liminarImagen[0]["imagen_causa"]);
                }
            }

            if( move_uploaded_file( $imagen['tmp_name'], "../../../images/causas/$nombreFile" ) ) 
            {
                return [true, $nombreFile];
            }else{
                return [false];
            }
        }
    }