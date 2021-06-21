<?
    ini_set("display_errors","1");
    session_start();
    require "../../../funciones.php";
    if( isLogin() )
    {
        $id_causa= intval( $_POST['id_causa'] );//JEFF
        
        $conexion = new Conexion();
        $return['estado'] = 1;
        
        $sql = "SELECT * FROM tb_donaciones dc INNER JOIN tb_donante d ON dc.iddonante = d.iddonante inner join tb_producto pd on dc.idproducto = pd.id_producto where dc.causaid = $id_causa ";
        $LISTADONANTES = $conexion->buscarVariosRegistro($sql); // DAVID: AGREGE EL 'inner join tb_producto pd on dc.id_producto = pd.id_producto where dc.causaid = $id_causa' PARA OBTENER LOS DONANTES POR CAUSA
        
        // if( count($LISTADONANTES) > 0 )
        if( $LISTADONANTES )
        {
            foreach( $LISTADONANTES as $key => $value )
            {
                $value['nombres'] = html_entity_decode($value['nombres']);
                
                // DAVID: OBTENGO LA FECHA DE LA TABLA HISTORIAL_CAUSA
                $fecha = $conexion->buscarVariosRegistro("SELECT fecha FROM tb_historial_causa WHERE idcausa = '$id_causa' ");
                $value['fechaCreacion'] = $fecha[0]['fecha'];
                
                $return['data'][] = $value;
            }
        }else{
            $return['estado'] = 2;
            $return['msj'] = "Sin datos para mostrar";
        }
        
    }else{
        $return['estado'] = 2;
        $return['msj'] = "Debe iniciar session";
    }
    
    print_r( json_encode( $return ) );