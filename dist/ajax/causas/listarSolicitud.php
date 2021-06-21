<?php
    session_start();
    
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    
    require "../../../config.php";
    require "../../../conexion.php";
    require "../../../funciones.php";
    
    $return['estado'] = 1;
    $return['mensaje'] = "";
    $return['data'] = array();
    
    if($_SESSION['usuario'])
    {
        $conexion = new Conexion();
        $return['success'] = 1;
        
        if( $_POST['metodo'] == 'LISTARDONACIONESV2' )
        {
            
            // NUEVA VERSION PARA LAS CAUSA Y SUS DONACIONES
            
            if( intval($_SESSION['usu_id']) == 1)
            {
                $listarCausas = "SELECT * FROM tb_causa WHERE estado != 'P' ";
            }else{
                $listarCausas = "SELECT * FROM tb_gestorDonacion_causa AS gdc INNER JOIN tb_causa c ON gdc.idcausa = c.idcausa WHERE estado != 'P' AND gdc.id_gestor_donacion = ".$_SESSION['usu_id'];
            }
            
            $respuestaQuery = $conexion->buscarVariosRegistro($listarCausas);
            
            foreach( $respuestaQuery as $key => $value )
            {   
                $existeBeneficiarioCausa = $conexion->buscarVariosRegistro( "SELECT * FROM tb_beneficiarioCausa WHERE idcausa = ? ", array( intval( $value['idcausa'] ) ) );
                $value['beneficiarios'] = $existeBeneficiarioCausa;
                
                $cont = 0;
                $detalleCausa = $conexion->buscarVariosRegistro("SELECT dc.idtabledonaciones, dc.idproducto, dc.cantidad, dn.nombres, pd.nombre FROM tb_donaciones AS dc INNER JOIN tb_causa AS cs ON ( dc.causaid = cs.idcausa ) INNER JOIN tb_donante AS dn ON ( dc.iddonante = dn.iddonante ) INNER JOIN tb_producto AS pd ON ( dc.idproducto = pd.id_producto ) WHERE dc.causaid = ?", array($value['idcausa']));
                foreach( $detalleCausa as $key => $valueInt )
                {
                    $valueInt['cantidadAux'] = intval($valueInt['cantidad']);
                    
                    $saldoProducto = $conexion->buscarRegistro(" SELECT SUM(cantidad) AS saldo FROM tb_donaciones_logistica WHERE id_donaciones = ".$valueInt['idtabledonaciones']);
                    
                    if( intval($valueInt['cantidad']) == intval($saldoProducto[0]['saldo']) )
                    {
                        $valueInt['cantidad'] = 0;
                    }else if( $saldoProducto[0]['saldo'] == NULL )
                    {
                        $valueInt['cantidad'];
                    }else{
                        $saldoMayor = ( intval($valueInt['cantidad']) - intval($saldoProducto[0]['saldo']) );
                        
                        $valueInt['cantidad'] = ( $saldoMayor <= 0 ? 0 : $saldoMayor );
                    }
                    
                    $value['detalleCausa'][$cont] = $valueInt;
                    $cont++;
                }
            
                $return['data'][] = $value;
            }
            
        }else if( $_POST['metodo'] == 'LISTARDONACIONESV1' )
        {
            // NUEVA VERSION PARA LAS CAUSA Y SUS DONACIONES
            
            if( intval($_SESSION['usu_id']) == 1)
            {
                $listarCausas = "SELECT * FROM tb_causa ";
            }else{
                $listarCausas = "SELECT * FROM tb_gestorDonacion_causa AS gdc INNER JOIN tb_causa c ON gdc.idcausa = c.idcausa WHERE gdc.id_gestor_donacion = ".$_SESSION['usu_id'];
            }
            
            $respuestaQuery = $conexion->buscarVariosRegistro($listarCausas);
            
            foreach( $respuestaQuery as $key => $value )
            {   
                // $existeBeneficiarioCausa = $conexion->buscarVariosRegistro( "", array( intval( $value['idcausa'] ) ) );
                
                
                $cont = 0;
                $detalleCausa = $conexion->buscarVariosRegistro("SELECT dc.idtabledonaciones, dc.idproducto, dc.cantidad, dn.nombres, pd.nombre FROM tb_donaciones AS dc INNER JOIN tb_causa AS cs ON ( dc.causaid = cs.idcausa ) INNER JOIN tb_donante AS dn ON ( dc.iddonante = dn.iddonante ) INNER JOIN tb_producto AS pd ON ( dc.idproducto = pd.id_producto ) WHERE dc.causaid = ?", array($value['idcausa']));
                foreach( $detalleCausa as $key => $valueInt )
                {
                    $saldoProducto = $conexion->buscarRegistro(" SELECT SUM(cantidad) AS saldo FROM tb_donaciones_logistica WHERE id_donaciones = ".$valueInt['idtabledonaciones']);
                    
                    if( intval($valueInt['cantidad']) == intval($saldoProducto[0]['saldo']) )
                    {
                        $valueInt['cantidad'] = 0;
                    }else if( $saldoProducto[0]['saldo'] == NULL )
                    {
                        $valueInt['cantidad'];
                    }else{
                        $valueInt['cantidad'] = ( intval($valueInt['cantidad']) - intval($saldoProducto[0]['saldo']) );
                    }
                    
                    $valueInt['demas'] = $saldoProducto;
                    
                    $value['detalleCausa'][$cont] = $valueInt;
                    $cont++;
                }
            
                $return['data'][] = $value;
            }
            
        }else{
            if( $_SESSION['usu_id'] == 1 )
            {
                $query = "SELECT * FROM tb_causa ";
            }else{
                $query = "SELECT * FROM tb_gestorDonacion_causa AS gdc INNER JOIN tb_causa c ON gdc.idcausa = c.idcausa WHERE gdc.id_gestor_donacion = ".$_SESSION['usu_id'];
            }
            
            $res = $conexion->buscarVariosRegistro($query);
            
            foreach( $res as $key => $value ){
                
                // PARA SABER CUALES SON LOS GESTORES DE UNA CAUSA EN CASO DE SER ADMINISTRADOR
                if( intval( $_SESSION['usu_id'] ) == 1 )
                {
                    $value['gestores'] = $conexion->buscarVariosRegistro("SELECT id_gestor_donacion FROM tb_gestorDonacion_causa WHERE idcausa = ".intval( $value['idcausa'] ) );
                }
                
                // PARA SABER LOS PRODUCTOS DE LA CAUSA
                $value['producto'] = $conexion->buscarVariosRegistro("SELECT * FROM tb_detalle_causa WHERE id_causa = ".intval($value['idcausa']) );
                
                $value['nombre_causa'] = html_entity_decode($value['nombre_causa']);
                
                $value['proposito'] = html_entity_decode($value['proposito']);
                
                // UNIDADES DE MEDIDAS
                $value['idUnidadMedida'] = $conexion->buscarVariosRegistro("SELECT idUnidadMedida FROM tb_detalle_causa WHERE id_causa = ".intval($value['idcausa']) );
                
                
                switch($value['estado']){
                    case "I":
                        $value['estadoA'] = "INICIADO";
                        break;
                    case "A":
                        $value['estadoA'] = "ASIGNADO";
                        break;
                    case "D":
                        $value['estadoA'] = "DESPACHADO";
                        break;
                    case "V":
                        $value['estadoA'] = "VERIFICADO";
                        break;
                    default:
                        $value['estadoA'] = "PENDIENTE";
                }
                
                $value['imagenCausa'] = "images/causas/camara-default.png";
                
                if( $value['imagen_causa'] != NULL )
                {
                    $value['imagenCausa'] = "images/causas/".$value["imagen_causa"];
                }
                
                // OBTENCION PARA LA PORCENTAJE NECESARIO PARA LA CAUSA
                $totalProductosNecesarios = $conexion->buscarRegistro(" SELECT SUM(cantidad) AS totalProductos FROM tb_detalle_causa WHERE id_causa = ".intval( $value['idcausa'] ) );
                
                $totalProductosDonado = $conexion->buscarRegistro("SELECT SUM(cantidad) AS totaldonado FROM tb_donaciones WHERE causaid = ".intval( $value['idcausa'] ) );
                
                $totalProductosNecesarios = ( $totalProductosNecesarios[0]['totalProductos'] == NULL ? 0 : intval( $totalProductosNecesarios[0]['totalProductos'] ) ) ;
                
                $totalProductosDonado = ( $totalProductosDonado[0]['totaldonado'] == NULL ? 0 : intval( $totalProductosDonado[0]['totaldonado'] ) ) ;
                
                // $valuePorcentaje = intval( ceil( ( $totalProductosDonado ) * 100  / $totalProductosNecesarios ) );
                
                if( $totalProductosDonado == 0 && $totalProductosNecesarios == 0 )
                {
                    $value['porcentaje'] = 0;
                }else if( intval( ceil( ( $totalProductosDonado ) * 100  / $totalProductosNecesarios ) ) <= 100 )
                {
                    $value['porcentaje'] = intval( ceil( ( $totalProductosDonado ) * 100  / $totalProductosNecesarios ) );
                }else{
                    $value['porcentaje'] = 100;
                }
                
                
                // CALCULOS DE DIAS RESULTANTE A LA FECHA DE FINALIZACIÓN
                
                $dateActual = new DateTime(date('d-m-Y'));
                $fechaFinAux = new DateTime($value['fecha_fin']);
                $intervalAux = $dateActual->diff($fechaFinAux);
                
                $diasFaltantes = $intervalAux->format('%r%a');
                
                $value['diasRes'] = $diasFaltantes;
                
                if( intval( $diasFaltantes ) <= 0 )
                {
                    $value['diasRestantesAux'] = "0 días";
                }else{
                    $value['diasRestantesAux'] = "$diasFaltantes días";
                }
                            
                $return['data'][] = $value;
            }
        }
    }else{
        $return['estado'] = 2;
        $return['mensaje'] = "Debe Inicar session";
    }
    
    print_r( json_encode( $return ) );