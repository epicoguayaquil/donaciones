<?
    ini_set("display_errors","1");
    session_start();
    require "../../../funciones.php";
    
    if( isLogin() )
    {
        $return['success'] = 1;
        $return['mensaje'] = "";
        
        $conexion = new Conexion();
        
        if( $_POST['metodo'] == 'LISTARDONACIONES' )
        {
            $listardonaciones = $conexion->buscarVariosRegistro("SELECT dc.flag_logistico, dc.idtabledonaciones, cs.idcausa, cs.nombre_causa, cs.proposito, dd.nombres, dd.direccion, dd.numero_contacto, dd.persona_contacto, pd.nombre, dc.cantidad FROM tb_donaciones AS dc INNER JOIN tb_donante AS dd ON dc.iddonante = dd.iddonante INNER JOIN tb_causa AS cs ON cs.idcausa = dc.causaid INNER JOIN tb_producto AS pd ON pd.id_producto = dc.idproducto");
            
            foreach( $listardonaciones as $key => $value )
            {
                $diferrencia = $conexion->buscarVariosRegistro("SELECT SUM(cantidad) AS total FROM tb_donaciones_logistica WHERE id_donaciones = ?" , array( intval( $value['idtabledonaciones'] ) ) );
                $value['cantidadAux'] = ( $diferrencia[0]['total'] == NULL ? 0 :  $diferrencia[0]['total'] );
                /*
                if( $diferrencia[0]['total'] != NULL )
                {
                    $value['cantidadAux'] = ( $value['cantidad'] - intval( $diferrencia[0]['total'] ) );
                }
                */
                
                $value['nombres'] = html_entity_decode($value['nombres']);
                
                $return['data'][] = $value;
            }
        }else if( $_POST['metodo'] == 'GESTIONARDONACIONESV2' )
        {
            // $return['data'] = $_POST;
            
            
            $idcentroacopio = 0;
            $idgesVerificador = 0;
            
            $donacion = array(3,4,5);
            $idtabla = array();
            $beneficiarioCant = array();
            $donacionBeneficiario = array();
            
            if( isset($_POST['idcentroacopio']) )
            {
                $idcentroacopio = intval($_POST['idcentroacopio']);
            }
            
            if( isset($_POST['idgesVerificador']) )
            {
                $idgesVerificador = intval($_POST['idgesVerificador']);
            }
            
            if( isset($_POST['iddonacion']) )
            {
                $donacion = json_decode( $_POST['iddonacion'] ) ;
            }
            
            if(
                ( isset($_POST['idtabla']) && !empty($_POST['idtabla'])) &&
                ( isset($_POST['beneficiarioCant']) && !empty($_POST['beneficiarioCant']) ) && 
                ( isset($_POST['donacionBeneficiario']) && !empty($_POST['donacionBeneficiario']) )
            )
            {
                $beneficiarioCant = json_decode( $_POST['beneficiarioCant'] );
                $donacionBeneficiario = json_decode( $_POST['donacionBeneficiario'] );
                $idtabla = json_decode( $_POST['idtabla'] );
            }
            
            date_default_timezone_set('America/Guayaquil');
            
            $totalEstado = 0;
            
            for( $i = 0; $i < count($beneficiarioCant); $i++ )
            {
                $estadoDonacion = $conexion->ejecutar("UPDATE tb_donaciones SET flag_logistico = ?, estado_donacion = ? WHERE idtabledonaciones = ?",array(1, 'A', $donacion[$i]));
                
                if( $estadoDonacion ) { $totalEstado++; }
            }
            
            if( $totalEstado == count($beneficiarioCant) )
            {
                $estado = 0;
                if( $idgesVerificador == 0 )
                {
                    $estado = 1;
                }
                $totalInt = 0;
                for( $x = 0; $x < count($beneficiarioCant); $x++ )
                {
                    
                    $sql = "INSERT INTO tb_despacho(id_donacion_logisitica, iddonacion, fecha_ingreso, id_gestor_logistica, id_gestor_verificador, id_beneficiario, id_acopio, cantidad ) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
                    $dataInsert = array($idtabla[$x], $donacion[$x], date("Y-m-d"), $_SESSION['usu_id'], $idgesVerificador, $donacionBeneficiario[$x], $idcentroacopio, $beneficiarioCant[$x]);
                    
                    
                    $estado = 0;
                    if( $idgesVerificador == 0 )
                    {
                        $estado = 1;
                        // TABLA SECUENCIAL
                        $secuencial = $conexion->buscarRegistro( "SELECT * FROM tb_secuencial");
                        $numDespacho = 1;
                        
                        if( intval( $secuencial[0]['numero'] ) > 1 )
                        {
                            $numDespacho = ( intval( $secuencial[0]['numero'] ) + 1 );
                        }
                        
                        $actualizar = $conexion->ejecutar( "UPDATE tb_secuencial SET numero = ? WHERE id_secuencial = ?", array($numDespacho, intval( $secuencial[0]['id_secuencial'] ) ) );
                        
                        if( $actualizar )
                        {
                            $causaID = $conexion->buscarRegistro("SELECT causaid FROM tb_donaciones WHERE idtabledonaciones = ".$donacion[$x]);
                            
                            $codQR = $donacion[$x].'-'.$_SESSION['usu_id'].'-'.date("YmdHis")."-".intval( $causaID[0]['causaid'] ).'-'.$numDespacho;
                            
                            $sql = "INSERT INTO tb_despacho(id_donacion_logisitica, iddonacion, fecha_ingreso, id_gestor_logistica, id_gestor_verificador, id_beneficiario, id_acopio, cantidad, estado, num_despacho, QR ) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                            $dataInsert = array($idtabla[$x], $donacion[$x], date("Y-m-d"), $_SESSION['usu_id'], $idgesVerificador, $donacionBeneficiario[$x], $idcentroacopio, $beneficiarioCant[$x], $estado, $numDespacho, $codQR);
                        }
                    }
                    
                    // TB_DONACIONES_LOGISTICA
                    $guardarDespacho = $conexion->ejecutar($sql, $dataInsert);
                    
                    if( $guardarDespacho )
                    {
                        $totalInt++;
                    }
                }
                
                if( $totalInt > 0 ) 
                {
                    $idcausa = 0;
                    
                    $idmensaje="no esta establecida el idcausa";
                    if( isset($_POST['idcausa']) )
                    {
                        $idcausa = intval( $_POST['idcausa'] );
                        $idmensaje="esta establecida el idcausa $idcausa";
                    }
                    
                    
                    $totalDonacion = 0;
                    $totalDonacionDespachadas = 0;
                    
                    $estadoDonacion = "D"; 
                    if( $idgesVerificador == 0 )
                    {
                        $estadoDonacion = "V";
                    }
                    
                    $tomar="no entre $idcausa";
                    
                    $sumarDonaciones = $conexion->buscarVariosRegistro("SELECT idproducto, causaid, SUM(cantidad) AS total FROM tb_donaciones WHERE causaid = $idcausa GROUP BY causaid");
                    foreach( $sumarDonaciones as $key => $value )
                    {
                        $prepararCambioEstadoCausa = $conexion->buscarRegistro("SELECT dc.causaid, SUM(dp.cantidad) AS totalDespachado FROM tb_despacho AS dp INNER JOIN tb_donaciones AS dc ON ( dp.iddonacion = dc.idtabledonaciones ) WHERE dc.causaid = ".intval( $value['causaid'] ) );
                        
                        if( intval( $value['total'] ) == intval( $prepararCambioEstadoCausa[0]['totalDespachado'] ) )
                        {
                            $tomar="si entre";
                            $conexion->ejecutar("UPDATE tb_causa SET estado = ? WHERE idcausa = ?",array("D", $value['causaid']));
                        }
                        $totalDonacion++;
                    }
                    
                    $return['mensajeAux'] = $idmensaje;
                    $return['mensaje'] = "exito";
                }else{
                    $return["success"] = 2;
                    $return['mensaje'] = "error";
                }
            }
            
        }else if( $_POST['metodo'] == 'GESTIONARDONACIONESV1' )
        {
            // $return['data'] = $_POST;
            
            $idcentroacopio = 0;
            $idgesVerificador = 0;
            
            $donacion = array();
            $idtabla = array();
            $beneficiarioCant = array();
            $donacionBeneficiario = array();
            
            if( isset($_POST['idcentroacopio']) )
            {
                $idcentroacopio = intval($_POST['idcentroacopio']);
            }
            
            if( isset($_POST['idgesVerificador']) )
            {
                $idgesVerificador = intval($_POST['idgesVerificador']);
            }
            
            if( isset($_POST['iddonacion']) )
            {
                $donacion = json_decode( $_POST['iddonacion'] ) ;
            }
            
            if(
                ( isset($_POST['idtabla']) && !empty($_POST['idtabla'])) &&
                ( isset($_POST['beneficiarioCant']) && !empty($_POST['beneficiarioCant']) ) && 
                ( isset($_POST['donacionBeneficiario']) && !empty($_POST['donacionBeneficiario']) )
            )
            {
                $beneficiarioCant = json_decode( $_POST['beneficiarioCant'] );
                $donacionBeneficiario = json_decode( $_POST['donacionBeneficiario'] );
                $idtabla = json_decode( $_POST['idtabla'] );
            }
            
            date_default_timezone_set('America/Guayaquil');
            
            $totalEstado = 0;
            
            for( $i = 0; $i < count($beneficiarioCant); $i++ )
            {
                $estadoDonacion = $conexion->ejecutar("UPDATE tb_donaciones SET flag_logistico = ?, estado_donacion = ? WHERE idtabledonaciones = ?",array(1, 'A', $donacion[$i]));
                
                if( $estadoDonacion ) { $totalEstado++; }
            }
            
            if( $totalEstado == count($beneficiarioCant) )
            {
                $totalInt = 0;
                for( $x = 0; $x < count($beneficiarioCant); $x++ )
                {
                    // TB_DONACIONES_LOGISTICA
                    $guardarDespacho = $conexion->ejecutar("INSERT INTO tb_despacho(id_donacion_logisitica, iddonacion, fecha_ingreso, id_gestor_logistica, id_gestor_verificador, id_beneficiario, id_acopio, cantidad ) VALUES(?, ?, ?, ?, ?, ?, ?, ?)",
                                                                            array($idtabla[$x], $donacion[$x], date("Y-m-d"), $_SESSION['usu_id'], $idgesVerificador, $donacionBeneficiario[$x], $idcentroacopio, $beneficiarioCant[$x]));
                    
                    if( $guardarDespacho )
                    {
                        $totalInt++;
                    }
                }
                
                if( $totalInt == count($beneficiarioCant) ) 
                {
                    $totalDonaciones = $conexion->buscarVariosRegistro("SELECT idproducto, causaid, SUM(cantidad) AS total FROM tb_donaciones GROUP BY causaid");
                    $return['mensaje'] = "exito";
                }else{
                    $return["success"] = 2;
                    $return['mensaje'] = "error";
                }
            }
        
        }else if( $_POST['metodo'] == 'GESTIONARDONACIONES' )
        {
            $return['data'] = $_POST;
            
            $iddonacion = 0;
            
            $idbeneficiarios = array();
            $idgesVerificador = array();
            $idcentroacopio = array();
            $cantidad = array();
            
            if( isset($_POST['iddonacion']) && !empty($_POST['iddonacion']) )
            {
                $iddonacion = intval($_POST['iddonacion']);
            }
            
            if(
                ( isset($_POST['idbeneficiarios']) && !empty($_POST['idbeneficiarios']) ) && 
                ( isset($_POST['idgesVerificador']) && !empty($_POST['idgesVerificador']) ) && 
                ( isset($_POST['idcentroacopio']) && !empty($_POST['idcentroacopio']) )  &&
                ( isset($_POST['cantidad']) && !empty($_POST['cantidad']) )
            )
            {
                $idbeneficiarios = $_POST['idbeneficiarios'];
                $idgesVerificador = $_POST['idgesVerificador'];
                $idcentroacopio = $_POST['idcentroacopio'];
                $cantidad = $_POST['cantidad'];
            }
            
            $estadoA = $conexion->buscarRegistro("SELECT estado_donacion FROM tb_donaciones WHERE idtabledonaciones = $iddonacion");    
                
            if( $estadoA[0]['estado_donacion'] != 'A' )
            {
                $conexion->ejecutar("UPDATE tb_donaciones SET flag_logistico = ?, estado_donacion = ? WHERE idtabledonaciones = ?",array(1, 'A', $iddonacion));
            }
            
            // if( $asignarGesLogis )
            // {
                $total = 0;
                
                if( count($idbeneficiarios) == count( array_unique( $idbeneficiarios ) ) )
                {
                    date_default_timezone_set('America/Guayaquil');
                    for( $i = 0; $i < count($idcentroacopio); $i++ )
                    {
                        // TB_DONACIONES_LOGISTICA
                        $guardarGestor = $conexion->ejecutar("INSERT INTO tb_despacho(iddonacion, fecha_ingreso, id_gestor_logistica, id_gestor_verificador, id_beneficiario, id_acopio, cantidad ) VALUES(?, ?, ?, ?, ?, ?, ?)",
                                                                                            array($iddonacion, date("Y-m-d"), $_SESSION['usu_id'], $idgesVerificador[$i], $idbeneficiarios[$i], $idcentroacopio[$i], $cantidad[$i]));
                        
                        if( $guardarGestor )
                        {
                            $total++;
                        }
                    }
                    
                    if( count($idcentroacopio) == $total )
                    {
                        $return['mensaje'] = html_entity_decode("&Eacute;xito");
                    }else{
                        $return['success'] = 2;
                        $return['mensaje'] = html_entity_decode("Error");
                    }
                }else{
                    $return['success'] = 2;
                    $return['mensaje'] = html_entity_decode("No deben existir beneficiarios duplicados");
                }
            // }
            
        }else if( $_POST['metodo'] == 'GESTIONARDONACIONESID-V2' )
        {
            $buscarCausas = $conexion->buscarVariosRegistro( "SELECT DISTINCT cs.nombre_causa, cs.proposito, cs.idcausa FROM tb_donaciones_logistica AS dl INNER JOIN tb_donaciones AS dc ON dl.id_donaciones = dc.idtabledonaciones INNER JOIN tb_causa AS cs ON dc.causaid = cs.idcausa WHERE dl.id_logistica = ? GROUP BY cs.nombre_causa ", array( intval( $_SESSION['usu_id'] ) ));
            foreach( $buscarCausas as $key => $value)
            {
                
                $obtenerDonacionParaVerificar = $conexion->buscarVariosRegistro("SELECT dl.cantidad, dl.id_producto, dl.idtabla, dc.idtabledonaciones FROM tb_donaciones_logistica AS dl INNER JOIN tb_donaciones AS dc ON ( dl.id_donaciones = dc.idtabledonaciones ) WHERE dl.id_logistica = ? AND causaid = ?", array($_SESSION['usu_id'], $value['idcausa']));
                foreach ( $obtenerDonacionParaVerificar as $key => $valueInt )
                {
                    $sumaProducto = $conexion->buscarRegistro("SELECT SUM(cantidad) AS despachado FROM tb_despacho WHERE id_donacion_logisitica = ".intval( $valueInt['idtabla'] )." AND id_gestor_logistica = ".intval($_SESSION['usu_id']) );
                    if( $sumaProducto[0]['despachado'] == NULL )
                    {
                        $valueInt['cantidad'];
                    }else if( intval($sumaProducto[0]['despachado']) > 0)
                    {
                        $valueInt['cantidad'] = ( intval($valueInt['cantidad']) - intval($sumaProducto[0]['despachado']) );
                    }else{
                        $valueInt['cantidad'] = 0;
                    }
                    
                    $value['idtabledonaciones'];
                    
                    $producto = $conexion->buscarRegistro("SELECT nombre FROM tb_producto WHERE id_producto = ".$valueInt['id_producto']);
                    $valueInt['producto'] = $producto[0]['nombre'];
                    
                    $value['detalleDonacion'][] = $valueInt;
                }
                
                $return['data'][] = $value;
            }
            
        }else if( $_POST['metodo'] == 'GESTIONARDONACIONESID-V1' )
        {
            $buscarCausas = $conexion->buscarVariosRegistro( "SELECT DISTINCT cs.nombre_causa, cs.proposito, cs.idcausa, dc.* FROM tb_donaciones_logistica AS dl INNER JOIN tb_donaciones AS dc ON dl.id_donaciones = dc.idtabledonaciones INNER JOIN tb_causa AS cs ON dc.causaid = cs.idcausa WHERE dl.id_logistica = ? GROUP BY cs.nombre_causa ", array( intval( $_SESSION['usu_id'] ) ));
            foreach( $buscarCausas as $key => $value)
            {
                
                $obtenerDonacionParaVerificar = $conexion->buscarVariosRegistro("SELECT dl.cantidad, dl.id_producto, dl.idtabla, dc.idtabledonaciones FROM tb_donaciones_logistica AS dl INNER JOIN tb_donaciones AS dc ON ( dl.id_donaciones = dc.idtabledonaciones ) WHERE dl.id_logistica = ? AND causaid = ?", array($_SESSION['usu_id'], $value['idcausa']));
                foreach ( $obtenerDonacionParaVerificar as $key => $valueInt )
                {
                    $sumaProducto = $conexion->buscarRegistro("SELECT SUM(cantidad) AS despachado FROM tb_despacho WHERE id_donacion_logisitica = ".intval( $valueInt['idtabla'] )." AND id_gestor_logistica = ".intval($_SESSION['usu_id']) );
                    if( $sumaProducto[0]['despachado'] == NULL )
                    {
                        $valueInt['cantidad'];
                    }else if( intval($sumaProducto[0]['despachado']) > 0)
                    {
                        $valueInt['cantidad'] = ( intval($valueInt['cantidad']) - intval($sumaProducto[0]['despachado']) );
                    }else{
                        $valueInt['cantidad'] = 0;
                    }
                    
                    $value['idtabledonaciones'];
                    
                    $producto = $conexion->buscarRegistro("SELECT nombre FROM tb_producto WHERE id_producto = ".$valueInt['id_producto']);
                    $valueInt['producto'] = $producto[0]['nombre'];
                    
                    $value['detalleDonacion'][] = $valueInt;
                }
                
                $return['data'][] = $value;
            }
            
        }else if( $_POST['metodo'] == 'DESPACHARDONACIONES' )
        {
            $iddonacion = array();
            $idproducto = array();
            $cantidadProd = array();
            
            $idGesLogis = 0;
            $total = 0;
            
            if( isset($_POST['idgeslogistico']) && !empty($_POST['idgeslogistico']) )
            {
                $idGesLogis = intval( $_POST['idgeslogistico'] );
            }
            
            if(
                ( isset($_POST['idtabladonacion']) && !empty($_POST['idtabladonacion']) ) &&
                ( isset($_POST['idproducto']) && !empty($_POST['idproducto']) ) &&
                ( isset($_POST['cantAsignada']) && !empty($_POST['cantAsignada']) ) 
            )
            {
                $iddonacion = json_decode( $_POST['idtabladonacion'] );
                $idproducto = json_decode( $_POST['idproducto'] );
                $cantidadProd = json_decode( $_POST['cantAsignada'] );
            }
            
            for( $i = 0; $i < count($idproducto); $i++ )
            {
                $guardar = $conexion->ejecutar("INSERT INTO tb_donaciones_logistica( id_donaciones, id_logistica,  id_producto, cantidad) VALUES (?, ?, ?, ?)", 
                                                                                    array( $iddonacion[$i], $idGesLogis, $idproducto[$i], $cantidadProd[$i], ) );
                {
                    $total++;
                }
            }
            
            if( intval($total) == intval(count($idproducto)) )
            {
                $totalDonacionDespachado = 0;
                $totalDonacion = 0;
                
                $idcausa = 0;
                
                /*
                // $totalSumarEstadoCausa = $conexion->buscarRegistro("SELECT id_donaciones, SUM(cantidad) AS total FROM tb_donaciones_logistica GROUP BY id_donaciones");
                $totalSumarEstadoCausa = $conexion->buscarRegistro("SELECT idproducto, causaid, SUM(cantidad) AS total FROM tb_donaciones GROUP BY idproducto");
                foreach( $totalSumarEstadoCausa as $key => $value)
                {
                    // $prepararCambiarEstadoCausa = $conexion->buscarRegistro( "SELECT * FROM tb_donaciones WHERE idtabledonaciones = ".intval( $value['id_donaciones'] ));
                    $prepararCambiarEstadoCausa = $conexion->buscarRegistro( "SELECT SUM(cantidad) AS totalDespachada FROM `tb_donaciones_logistica` WHERE id_donaciones = ".intval( $value['idtabledonaciones'] ));
                    
                    
                    if( intval( $value['total'] ) == intval( $prepararCambiarEstadoCausa[0]['cantidad'] ) )
                    {
                        $idcausa = intval( $prepararCambiarEstadoCausa[0]['causaid'] );
                        $total++;
                    }
                    
                    $totalDonacion++;
                }
                
                
                if( $totalDonacion == $total )
                {
                    $cambiarEstadoCausa = $conexion->ejecutar( "UPDATE tb_causa SET estado = ? WHERE idcausa = ?", array( "A", $idcausa ) );
                }
                */
                
                $totalDonaciones = $conexion->buscarVariosRegistro("SELECT idproducto, causaid, SUM(cantidad) AS total FROM tb_donaciones GROUP BY causaid");
                
                foreach( $totalDonaciones as $key => $value )
                    {
                    $totalDespachado = $conexion->buscarRegistro("SELECT SUM(dl.cantidad) AS total, dc.causaid FROM tb_donaciones_logistica AS dl INNER JOIN tb_donaciones AS dc ON ( dl.id_donaciones = dc.idtabledonaciones ) WHERE dc.causaid =".intval( $value['causaid'] )." GROUP BY dc.causaid");
                    
                    if( intval( $value['total'] ) == intval( $totalDespachado[0]['total'] ) )
                    {
                        $conexion->ejecutar( "UPDATE tb_causa SET estado = ? WHERE idcausa = ?", array( "A", intval( $value['causaid'] ) ) );
                        // $idcausa = intval( $value['causaid'] );
                        // $totalDonacionDespachado++;
                    }
                    // $totalDonacion++;
                }
                /*
                if( $totalDonacion == $totalDonacionDespachado )
                {
                    $conexion->ejecutar( "UPDATE tb_causa SET estado = ? WHERE idcausa = ?", array( "A", $idcausa ) );
                }
                */
                $return['mensaje'] = html_entity_decode("&Eacute;xito");
            }else{
                $return['success'] = 2;
                $return['mensaje'] = "Error";
            }
            
            $return['idges'] = $cantidadProd;
            
            /*
            $iddonacion = array();
            
            if( isset($_POST['donacion']) )
            {
                $iddonacion = json_decode( $_POST['donacion'] );
            }
            
            $idgesLogistico = 0;
            
            $cantidad = array();
            $categoria = array();
            $idproducto = array();
            
            if(
                ( isset($_POST['cantAsignada']) && !empty($_POST['cantAsignada']) ) &&
                // ( isset($_POST['categoria']) && !empty($_POST['categoria']) )  &&
                ( isset($_POST['donacion']) && !empty($_POST['donacion']) )  &&
                ( isset($_POST['idgeslogistico']) && !empty($_POST['idgeslogistico']) ) 
            )
            {
                $cantidad = json_decode( $_POST['cantAsignada'] );
                // $categoria = json_decode( $_POST['categoria'] );
                $idproducto = json_decode( $_POST['donacion'] );
                $idgesLogistico = intval( $_POST['idgeslogistico'] );
            }
            
            /*
            $buscarDonaciones = $conexion->buscarVariosRegistro("SELECT COUNT(*) AS totalExistentes FROM tb_donaciones_logistica WHERE id_donaciones = ? ", array($iddonacion));
            
            if( intval( $buscarDonaciones[0]['totalExistentes'] ) >= 1 )
            {
                $return['success'] = 2;
                $return['mensaje'] = html_entity_decode("La dinaci&oacute;n ya asido despachada");
            }else{
            
                $registrarDespacho = true;
                $total = 0;
                
                // if( in_array( 0, $idgesLogistico) )
                
                if( $idgesLogistico == 0)
                {
                    $registrarDespacho = false;
                    $return['success'] = 2;
                    // $return['mensaje'] = "Debe elegir al menos un gestor logistico";
                    $return['mensaje'] = html_entity_decode( "Debe elegir el gestor de log&iacute;stico" );
                }
                
                if( $registrarDespacho )
                {
                    for( $i = 0; $i < count($categoria); $i++  )
                    {
                        $guardar = $conexion->ejecutar("INSERT INTO tb_donaciones_logistica( id_donaciones, id_logistica,  id_producto, cantidad) VALUES (?, ?, ?, ?)", 
                                                                                    array( $iddonacion[$i], $idgesLogistico, $idproducto[$i], $cantidad[$i] ));
                        if( $guardar )
                        {
                            $total++;
                        }
                    }
                    
                    if( intval($total) == intval(count($categoria)) )
                    {
                        $return['mensaje'] = html_entity_decode("&Eacute;xito");
                    }else{
                        $return['success'] = 2;
                        $return['mensaje'] = "Error";
                    }
                }
            // }
            
            */
            
            
        }else if( $_POST['metodo'] == 'LISTARDESPACHO' )
        {
            $consultar_centroacopio = $conexion->buscarVariosRegistro("SELECT * FROM  tb_sucursal WHERE id_gestor_logistico = ?", array($_SESSION['usu_id']) );
            $return['sucursal'] = $consultar_centroacopio;
            
        }else if( $_POST['metodo'] == "LISTARLOGISTICA" )
        {
            $consultar_gestor = $conexion->buscarRegistro("SELECT us.nombre, dl.cantidad FROM tb_donaciones_logistica AS dl INNER JOIN tb_usuario AS us ON (dl.id_logistica = us.usu_id) WHERE dl.id_donaciones = ".intval( $_POST['iddonacion'] )." AND dl.id_sucursal = ".intval( $_POST['idsucursal'] ) );
            $return['data'] = $consultar_gestor;
            
            // BENEFICIARIO
            $consultar_donacion = $conexion->buscarVariosRegistro("SELECT bf.idbeneficiario, bf.num_doc, bf.nombres FROM tb_beneficiario AS bf INNER JOIN tb_beneficiarioCausa AS bc ON ( bf.idbeneficiario = bc.idbeneficiario ) WHERE bc.idcausa = ? ", array( intval( $_POST['idcausa'] ) ));
            $optionBeneficiario = "<option value='0'> Seleccione beneficiario </option>";
            foreach( $consultar_donacion as $key => $value )
            {
                $optionBeneficiario .= "<option value='".$value['idbeneficiario']."'> ".$value['num_doc']." - ".$value['nombres']." </option>";
            }
            
            // GESTOR VERIFICADOR
            $consultar_verificador = $conexion->buscarVariosRegistro("SELECT * FROM tb_usuario WHERE rol_id = 4 AND estado = 'A' ");
            $optionVerificador = "<option value='0'> Seleccione un verificador </option>";
            foreach( $consultar_verificador as $key => $value )
            {
                $optionVerificador .= "<option value='".$value['usu_id']."'> ".$value['nombre']." </option>";
            }
            
            $tablaHTML = "
                <tr>
                    <td>
                        <select id='beneficiario' name='beneficiario[]' class='form-control' required>
                            ".$optionBeneficiario."
                        </select>
                    </td>
                    <td>
                        <select id='gverificador' name='gverificador[]' class='form-control' required>
                            ".$optionVerificador."
                        </select>
                    </td>
                    <td>
                        <input type='number' class='form-control' min='1' placeholder='Ingrese la cantidad' required />
                    </td>
                    <td>
                        <button type='button' title='Eliminar Fila' class='btn btn-primary btn-lg' onclick='eliminar_(this, event)' style='margin-top: 5px;margin-bottom: 5px; background-color: #054b88; border-color: #26312b; font-size: 11px;padding: 7px 15px;'>
                            <i class='fa fa-trash'></i>
                        </button>
                    </td>
                </tr>
            ";
            
            $return['tabla'] = $tablaHTML;
        }else if( $_POST['metodo'] == "VERIFICARDONACIONLOGISTICO")
        {
            // $buscarDonaciones = $conexion->buscarVariosRegistro("SELECT DISTINCT cs.nombre_causa, cs.proposito FROM tb_despacho AS dp INNER JOIN tb_donaciones AS dc ON dp.iddonacion = dc.idtabledonaciones INNER JOIN tb_causa AS cs ON dc.causaid = cs.idcausa WHERE dp.id_gestor_logistica = ?", array( intval( $_SESSION['usu_id'] ) ));
            $buscarDonaciones = $conexion->buscarVariosRegistro( "SELECT DISTINCT cs.nombre_causa, cs.proposito, cs.idcausa FROM tb_donaciones_logistica AS dl INNER JOIN tb_donaciones AS dc ON dl.id_donaciones = dc.idtabledonaciones INNER JOIN tb_causa AS cs ON dc.causaid = cs.idcausa WHERE dl.id_logistica = ? GROUP BY cs.nombre_causa ", array( intval( $_SESSION['usu_id'] ) ));

            $data = array();
            foreach( $buscarDonaciones as $key => $value )
            {
                $obtenerDonacionParaVerificar = $conexion->buscarVariosRegistro("SELECT dl.cantidad, dl.id_producto, dl.idtabla, dc.idtabledonaciones FROM tb_donaciones_logistica AS dl INNER JOIN tb_donaciones AS dc ON ( dl.id_donaciones = dc.idtabledonaciones ) WHERE dl.id_logistica = ? AND causaid = ?", array($_SESSION['usu_id'], $value['idcausa']));
                foreach( $obtenerDonacionParaVerificar as $key => $valueInt )
                {
                    $sumaProducto = $conexion->buscarRegistro("SELECT SUM(cantidad) AS despachado FROM tb_despacho WHERE id_donacion_logisitica = ".intval( $valueInt['idtabla'] )." AND id_gestor_logistica = ".intval($_SESSION['usu_id']) );
                    if( $sumaProducto[0]['despachado'] == NULL )
                    {
                        $valueInt['cantidad'];
                    }else if( intval($sumaProducto[0]['despachado']) > 0)
                    {
                        $valueInt['cantidad'] = ( intval($valueInt['cantidad']) - intval($sumaProducto[0]['despachado']) );
                    }else{
                        $valueInt['cantidad'] = 0;
                    }
                    
                    $producto = $conexion->buscarRegistro("SELECT nombre FROM tb_producto WHERE id_producto = ".$valueInt['id_producto']);
                    $valueInt['producto'] = $producto[0]['nombre'];
                    
                    // CENTROS DE ACOPIO
                    $centroAcopio = $conexion->buscarVariosRegistro( "SELECT idsucursal, nombre FROM tb_sucursal WHERE id_gestor_logistico = ".intval( $_SESSION['usu_id'] ) );
                    $valueInt['sucursales'] = $centroAcopio;
                    
                    // BENEFICIARIO
                    $beneficiario = $conexion->buscarVariosRegistro( "SELECT b.idbeneficiario, b.num_doc, b.nombres FROM tb_beneficiarioCausa AS bc INNER JOIN tb_beneficiario AS b ON bc.idbeneficiario = b.idbeneficiario WHERE bc.idcausa = ?", array( intval( $value['idcausa'] ) ) );
                    $valueInt['beneficiarios'] = $beneficiario;
                    
                    // PRODUCTO
                    $producto =  $conexion->buscarRegistro( "SELECT nombre FROM tb_producto WHERE id_producto = ".intval( $valueInt['id_producto'] ) );
                    $valueInt['id_producto'] = $producto[0]['nombre'];
                    
                    $value['detalle'][] = $valueInt;
                }
                
                $data[] = $value;
            }

            if( count($data) > 0 )
            {
                $return['data'] = $data;
            }
            /*
            foreach( $buscarDonaciones as $key => $value )
            {
                $contButtonDisabled = 0;
                $contDonacionesChecked = 0;
                
                // DONACIONES PARA VERIFICAR
                $listarDonaciones = $conexion->buscarVariosRegistro( "SELECT dp.id_despacho, dp.iddonacion, dp.id_beneficiario, dp.id_acopio, dp.cantidad, pd.id_producto, dp.estado FROM tb_despacho AS dp INNER JOIN tb_donaciones AS dc ON dp.iddonacion = dc.idtabledonaciones INNER JOIN tb_causa AS cs ON dc.causaid = cs.idcausa INNER JOIN tb_producto AS pd ON dc.idproducto = pd.id_producto WHERE dp.id_gestor_logistica = ?", array( intval( $_SESSION['usu_id'] ) ) );
                foreach( $listarDonaciones as $key => $valueInt)
                {
                    if( intval($valueInt['estado']) == 1)
                    {
                        $contDonacionesChecked++;
                    }
                    
                    // BENEFICIARIO
                    $beneficiario = $conexion->buscarRegistro( "SELECT num_doc, nombres FROM tb_beneficiario WHERE idbeneficiario = ".intval( $valueInt['id_beneficiario'] ) );
                    $valueInt['id_beneficiario'] = $beneficiario[0]['num_doc'].' - '.$beneficiario[0]['nombres'];
                    
                    // CENTRO DE ACOPIO
                    // $centroAcopio = $conexion->buscarRegistro( "SELECT nombre FROM tb_sucursal WHERE idsucursal = ".intval( $valueInt['id_acopio'] ) );
                    // $valueInt['id_acopio'] = $centroAcopio[0]['nombre'];
                    
                    
                    $centroAcopio = $conexion->buscarVariosRegistro( "SELECT nombre FROM tb_sucursal WHERE id_gestor_logistico = ".intval( $_SESSION['usu_id'] ) );
                    $valueInt['id_acopio'] = $centroAcopio;
                    
                    // PRODUCTO
                    // $producto =  $conexion->buscarRegistro( "SELECT nombre FROM tb_producto WHERE id_producto = ".intval( $valueInt['id_producto'] ) );
                    // $valueInt['id_producto'] = $producto[0]['nombre'];
                    
                    $contButtonDisabled++;
                    
                    $value['detalle'][] = $valueInt;
                }
                
                $value['buttonDisabled'] = (  $contDonacionesChecked == $contButtonDisabled ? true : false );
                
                $return['data'][] = $value;
            }
            */
        }
        
    }else{
        $return['success'] = 3;
        $return['mensaje'] = "Debe iniciar session";
    }
    
    header('Content-Type: application/json');
    print_r( json_encode( $return ) );
// echo json_encode($return);