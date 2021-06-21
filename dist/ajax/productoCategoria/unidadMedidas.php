<?
    session_start();
    ini_set('display_errors', '1');
    
    require "../../../funciones.php";
    
    if( isLogin() )
    {
        $return['success'] = 1;
        $return['mensaje'] = "";
        $return['data'] = array();
        
        $conexion = new Conexion();
        
        if( $_POST['metodo'] == "crearunidadmedida" )
        {
            $crearUnidad = $conexion->ejecutar("INSERT INTO tb_unidades_medidas ( definicion, abreviatura ) VALUES (?,?)", array( htmlentities( $_POST['definicion'] ), htmlentities( $_POST['abreviatura'] ) ) );
            
            if( $crearUnidad )
            {
                $return['success'] = 1;
                $return['mensaje'] = "Unidad de medida creado con éxito";
            }else{
                $return['success'] = 2;
                $return['mensaje'] = "Error al crear la unidad de medida";
            }
        }else if( $_POST['metodo'] == "actualizarestadounidadmedida" )
        {
            $actualizarUnidad = $conexion->ejecutar("UPDATE tb_unidades_medidas SET estado = ? WHERE idunidadmedida = ?", array( $_POST['estado'], intval( $_POST['idunidadmedida'] ) ) );
            
            if( $actualizarUnidad )
            {
                $return['success'] = 1;
                $return['mensaje'] = "Unidad de medida actualizada con éxito";
            }else{
                $return['success'] = 2;
                $return['mensaje'] = "Error al actualizar la unidad de medida";
            }
        }else if( $_POST['metodo'] == "actualizarunidadmedida" )
        {
            $actualizarUnidad = $conexion->ejecutar("UPDATE tb_unidades_medidas SET definicion = ?, abreviatura = ? WHERE idunidadmedida = ?", array( htmlentities( $_POST['definicion'] ), htmlentities( $_POST['abreviatura'] ) , $_POST['idunidadmedida'] ));
            
            if( $actualizarUnidad )
            {
                $return['success'] = 1;
                $return['mensaje'] = "Unidad de medida actualizada con éxito";
            }else{
                $return['success'] = 2;
                $return['mensaje'] = "Error al actualizar la unidad de medida";
            }
        }else if( $_POST['metodo'] == "listarunidadmedida" )
        {
            $unidades = $conexion->buscarVariosRegistro("SELECT * FROM tb_unidades_medidas");
            
            if( count( $unidades ) > 0 )
            {
                foreach( $unidades  as $key => $value )
                {
                    $value['definicion'] = html_entity_decode( $value['definicion'] );
                    $value['abreviatura'] = html_entity_decode( $value['abreviatura'] );
                    
                    $return['data'][] = $value;
                }
            }else{
                $return['success'] = 2;
                $return['mensaje'] = "No hay registros";
            }
        }else if( $_POST['metodo'] == "listarunidadmedidaactivas" )
        {
            $unidadesActivas = $conexion->buscarVariosRegistro("SELECT * FROM tb_unidades_medidas WHERE estado = 'A' ");
            
            if( count( $unidadesActivas ) > 0 )
            {
                foreach( $unidadesActivas  as $key => $value )
                {
                    $value['definicion'] = html_entity_decode( $value['definicion'] );
                    $value['abreviatura'] = html_entity_decode( $value['abreviatura'] );
                    
                    $return['data'][] = $value;
                }
            }else{
                $return['success'] = 2;
                $return['mensaje'] = "No hay registros";
            }
        }else if( $_POST['metodo'] == "listarunidadmedidaporidproducto" )
        {
            $buscarUnidadMedida = $conexion->buscarVariosRegistro("SELECT unm.definicion, unm.idunidadmedida FROM tb_productos_unidadesMedidas AS pum INNER JOIN tb_unidades_medidas as unm ON( pum.idmedida = unm.idunidadmedida ) WHERE pum.idproducto = ? ",array( intval( $_POST['idproducto'] ) ));
            if( count($buscarUnidadMedida) > 0 )
            {
                foreach( $buscarUnidadMedida as $key => $value )
                {
                    $value['definicion'] = html_entity_decode( $value['definicion'] );
                    
                    $return['data'][] = $value;
                }
            }else{
                $return['mensaje'] = "No hay unidades de medida asignada a este producto";
            }
        }
        
    }else{
        $return['success'] = 3;
        $return['mensaje'] = "Debe iniciar session";
    }
    
    header('Content-Type: application/json;charset=utf-8');
    print_r( json_encode($return) );