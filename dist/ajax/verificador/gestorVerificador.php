<?
    ini_set("display_errors","1");
    session_start();
    require "../../../funciones.php";
    
    if( isLogin() )
    {
        $return['success'] = 1;
        $return['mensaje'] = "";
        $return['data'] = array();
        
        $conexion = new Conexion();
        
        if( $_POST['metodo'] == 'LISTARDONACIONVERIFICADORV1' )
        {
            // $ListarCausasAsignadas = $conexion->buscarVariosRegistro( "SELECT distinct iddonacion FROM tb_despacho WHERE id_gestor_verificador = ?", array( intval( $_SESSION['usu_id'] ) ) );
            $ListarCausasAsignadas = $conexion->buscarVariosRegistro( "SELECT DISTINCT cs.nombre_causa, cs.proposito FROM tb_despacho AS dp INNER JOIN tb_donaciones AS dc ON dp.iddonacion = dc.idtabledonaciones INNER JOIN tb_causa AS cs ON dc.causaid = cs.idcausa WHERE dp.id_gestor_verificador = ?", array( intval( $_SESSION['usu_id'] ) ) );
            foreach( $ListarCausasAsignadas as $key => $value)
            {
                
                $contButtonDisabled = 0;
                $contDonacionesChecked = 0;
                
                // DONACIONES PARA VERIFICAR
                $listarDonaciones = $conexion->buscarVariosRegistro( "SELECT dp.id_despacho, dp.iddonacion, dp.id_beneficiario, dp.id_acopio, dp.cantidad, pd.id_producto, dp.estado FROM tb_despacho AS dp INNER JOIN tb_donaciones AS dc ON dp.iddonacion = dc.idtabledonaciones INNER JOIN tb_causa AS cs ON dc.causaid = cs.idcausa INNER JOIN tb_producto AS pd ON dc.idproducto = pd.id_producto WHERE dp.id_gestor_verificador = ?", array( intval( $_SESSION['usu_id'] ) ) );
                foreach( $listarDonaciones as $key => $valueInt  )
                {
                    if( intval($valueInt['estado']) == 1)
                    {
                        $contDonacionesChecked++;
                    }
                    
                    // BENEFICIARIO
                    $beneficiario = $conexion->buscarRegistro( "SELECT num_doc, nombres FROM tb_beneficiario WHERE idbeneficiario = ".intval( $valueInt['id_beneficiario'] ) );
                    $valueInt['id_beneficiario'] = $beneficiario[0]['num_doc'].' - '.$beneficiario[0]['nombres'];
                    
                    // CENTRO DE ACOPIO
                    $centroAcopio = $conexion->buscarRegistro( "SELECT nombre FROM tb_sucursal WHERE idsucursal = ".intval( $valueInt['id_acopio'] ) );
                    $valueInt['id_acopio'] = $centroAcopio[0]['nombre'];
                    
                    // PRODUCTO
                    $producto =  $conexion->buscarRegistro( "SELECT nombre FROM tb_producto WHERE id_producto = ".intval( $valueInt['id_producto'] ) );
                    $valueInt['id_producto'] = $producto[0]['nombre'];
                    
                    $contButtonDisabled++;
                    
                    $value['detalleProducto'][] = $valueInt;
                }
                
                $value['buttonDisabled'] = (  $contDonacionesChecked == $contButtonDisabled ? true : false );
                
                $return['data'][] = $value;
            }
            
            // $return['data'] = $ListarCausasAsignadas;
            
        }else if( $_POST['metodo'] == "LISTARDONACIONVERIFICADOR" )
        {
            $listar = $conexion->buscarVariosRegistro("SELECT * FROM tb_despacho WHERE id_gestor_verificador = ? ", array($_SESSION['usu_id']));
            
            foreach( $listar as $key => $value)
            {
                $value['beneficiario'] = $conexion->buscarRegistro("SELECT 	idbeneficiario, num_doc, nombres FROM tb_beneficiario WHERE idbeneficiario = ".intval( $value['id_beneficiario'] ));
                
                $value['centracopio'] = $conexion->buscarRegistro("SELECT * FROM tb_sucursal WHERE idsucursal = ".intval( $value['id_acopio'] ));
                
                $value['producto'] = $conexion->buscarRegistro("SELECT pd.nombre, dc.estado_donacion FROM tb_donaciones AS dc INNER JOIN tb_producto AS pd ON ( dc.idproducto = pd.id_producto ) WHERE dc.idtabledonaciones =".intval( $value['iddonacion'] ));
                
                $return['data'][] = $value;
            }
        }else if( $_POST['metodo'] == 'ACTUALIZARDONACION' )
        {
            $actualizarDonacion = $conexion->ejecutar("UPDATE tb_despacho SET estado = ? WHERE id_despacho = ? ", array(1, intval($_POST['id_despacho'])));
            
            if( !$actualizarDonacion )
            {
                $totalDespachado = $conexion->buscarVariosRegistro(" SELECT SUM(cantidad) AS total FROM tb_despacho WHERE iddonacion = ?", array( intval($_POST['iddonacion'] ) ) );
                $cambiarEstadoDonacion = $conexion->buscarRegistro("SELECT * FROM tb_donaciones WHERE idtabledonaciones = ".intval($_POST['iddonacion']) );
                
                if( intval( $totalDespachado[0]['total'] ) == intval( $cambiarEstadoDonacion[0]['cantidad'] ) )
                {
                    $actualizarEstadoDonacion = $conexion->ejecutar("UPDATE tb_donaciones SET estado_donacion = ? WHERE idtabledonaciones = ?", array("D", intval($_POST['iddonacion'])) );
                }
            
                $return['success'] = 2;
                $return['mensaje'] = "ERROR AL ACTUALIZAR";
            }else{
                $return['mensaje'] = "OK";
            }
        }else if( $_POST['metodo'] == 'ACTUALIZARDONACIONV2' )
        {
            $return['data'] = $_POST;
            
            $iddonacion = ( $_POST['donacion'] );
            $iddespacho = ( $_POST['donacionesCheck'] );
            
            $total = 0;
            
            for( $i = 0; $i < count($iddespacho); $i++ )
            {
                $secuencial = $conexion->buscarRegistro("SELECT * FROM tb_secuencial");
                
                $numeroSecuencial = 1;
                if( intval( $secuencial[0]['numero'] ) >= 1 )
                {
                    $numeroSecuencial = ( intval( $secuencial[0]['numero'] ) + 1 );
                }
                
                $actualizar = $conexion->ejecutar( "UPDATE tb_secuencial SET numero = ? WHERE id_secuencial = ?", array($numeroSecuencial, intval( $secuencial[0]['id_secuencial'] ) ) );
                        
                if( $actualizar )
                {
                    $causaID = $conexion->buscarRegistro("SELECT causaid FROM tb_donaciones WHERE idtabledonaciones = ".$iddonacion[$i]);
                    
                    $codQR = $iddonacion[$i].'-'.$_SESSION['usu_id'].'-'.date("YmdHis")."-".intval( $causaID[0]['causaid'] ).'-'.$numeroSecuencial;
                
                    $actualizarDonacion = $conexion->ejecutar("UPDATE tb_despacho SET estado = ?, num_despacho = ?, QR = ? WHERE id_despacho = ? AND iddonacion = ?", array(1, $numeroSecuencial, $codQR, intval( $iddespacho[$i] ), intval( $iddonacion[$i] ) ) );
                    
                    if( $actualizarDonacion )
                    {
                        $total++;
                    }
                }
            }
            
            if( $total > 0)
            {
                $cambiarEstado = false;
                $idcausa = 0;
                
                /*
                $buscarDonacionesVerificadas = $conexion->buscarVariosRegistro( "SELECT iddonacion, SUM(cantidad) AS total FROM tb_despacho WHERE estado = 1 GROUP BY iddonacion" );
                foreach( $buscarDonacionesVerificadas as $key => $value)
                {
                    $preparaCambioEstado = $conexion->buscarRegistro(" SELECT * FROM tb_donaciones WHERE idtabledonaciones = ".intval( $value['iddonacion'] ));
                    
                    if( $value['total'] == intval( $preparaCambioEstado[0]['cantidad'] ) )
                    {
                        $cambiarEstado = true;
                        $idcausa = intval( $preparaCambioEstado[0]['causaid'] );
                    }else{
                        $cambiarEstado = false;
                        $idcausa = 0;
                    }
                }
                */
                
                $totalProductosPorCausa = $conexion->buscarVariosRegistro("SELECT idproducto, causaid, SUM(cantidad) AS total FROM tb_donaciones GROUP BY causaid");
                
                foreach( $totalProductosPorCausa as $key => $value)
                {
                    $listadoProductosVerificado = $conexion->buscarRegistro( "SELECT dn.causaid, SUM(dp.cantidad) AS totalDonacionesVerificadas FROM tb_despacho AS dp INNER JOIN tb_donaciones AS dn ON ( dp.iddonacion = dn.idtabledonaciones ) WHERE dp.estado = 1 AND dn.causaid = ".intval( $value['causaid'] )." GROUP BY dn.causaid" );
                    if( intval($value['total']) == intval( $listadoProductosVerificado[0]['totalDonacionesVerificadas'] ) )
                    {
                        $conexion->ejecutar("UPDATE tb_causa SET estado = ? WHERE idcausa = ? ", array('V', intval( $value['causaid'] )));
                    }
                }
                
                // if( $cambiarEstado && $idcausa > 0 )
                // {   
                //     $conexion->ejecutar("UPDATE tb_causa SET estado = ? WHERE idcausa = ? ", array('V', $idcausa));
                // }
                
                $return['mensaje'] = "OK";
            }else{
                $return['success'] = 2;
                $return['mensaje'] = "ERROR AL ACTUALIZAR";
            }
            
            
            
            
        }else if( $_POST['metodo'] == 'ACTUALIZARDONACIONV1' )
        {
            // $return['data'] = $_POST;
            
            $iddonacion = ( $_POST['donacion'] );
            $iddespacho = ( $_POST['donacionesCheck'] );
            
            $total = 0;
            
            for( $i = 0; $i < count($iddespacho); $i++ )
            {
                $actualizarDonacion = $conexion->ejecutar("UPDATE tb_despacho SET estado = ? WHERE id_despacho = ? AND iddonacion = ?", array(1, intval( $iddespacho[$i] ), intval( $iddonacion[$i] ) ) );
                
                if( $actualizarDonacion )
                {
                    $total++;
                }
            }
            
            if( $total > 0)
            {
                $return['mensaje'] = "OK";
            }else{
                $return['success'] = 2;
                $return['mensaje'] = "ERROR AL ACTUALIZAR";
            }
            
            // // if( $total == count($_POST['donacionesCheck']) )
            // // {
                
            //     $cambiarEstadoDonacion = $conexion->buscarVariosRegistro( "SELECT iddonacion, SUM(cantidad) AS total FROM tb_despacho WHERE estado = ? GROUP BY iddonacion", array(1));
            //     foreach( $cambiarEstadoDonacion as $key => $value )
            //     {
            //         $buscarDonacion = $conexion->buscarRegistro( " SELECT * FROM tb_donaciones WHERE idtabledonaciones = ".intval( $value['iddonacion'] ) );
                    
            //         if( intval($value['total']) == intval( $buscarDonacion[0]['cantidad']) )
            //         {
            //             $conexion->ejecutar("UPDATE tb_donaciones SET estado_donacion = ? WHERE idtabledonaciones = ?", array("D", intval($value['iddonacion'])) );
            //         }
            //     }
                
            //     $return['mensaje'] = "OK";
            // // }else{
            // //     $return['success'] = 2;
            // //     $return['mensaje'] = "ERROR AL ACTUALIZAR";
            // // }
        }else if( $_POST['metodo'] == 'REGISTRARDESPACHOVERIFICADO' )
        {
            $return['data'] = $_POST;
        }
    }else{
        $return['success'] = 3;
        $return['mensaje'] = "Debe iniciar session";
    }
    
    print_r( json_encode( $return ) );