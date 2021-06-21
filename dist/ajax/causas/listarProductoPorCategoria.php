<?
    ini_set("display_errors","1");
    session_start();
    require "../../../funciones.php";
    if( isLogin() )
    {
        $conexion = new Conexion();
        $return['success'] = 1;
        $return['data'] = array();
        
        if( $_POST['metodo'] == 'LISTARCATEGORIAS' ){   
            
            
            $LISTARCATEGORIAS = $conexion->buscarVariosRegistro("SELECT DISTINCT dc.id_categoria, c.id_categoria, c.nombre FROM tb_detalle_causa AS dc INNER JOIN tb_categorias AS c ON ( dc.id_categoria = c.id_categoria) WHERE dc.id_causa = ".intval( $_POST['idcausa'] ));
            $return['data'] = $LISTARCATEGORIAS;
            
            
        }else if( $_POST['metodo'] == 'LISTARALLCATEGORIAS')
        {
            $LISTACATEGORIAS = $conexion->buscarVariosRegistro("SELECT * FROM tb_categorias WHERE estado = 'A' ");
            
            if( count( $LISTACATEGORIAS ) > 0 )
            {
                foreach( $LISTACATEGORIAS as $key => $value )
                {
                    $values['nombre'] = html_entity_decode($values['nombre']);
                    
                    $return['data'][] = $value;
                }
            }else{
                $return['success'] = 2;
                $return['mensaje'] = "No hay categorias disponibles";
            }
        }else{
            $idCategoria = intval($_POST['idcategoria']);
            
            $LISTAPRODUCTOS = $conexion->buscarVariosRegistro("SELECT id_producto, nombre FROM tb_producto where id_categoria = $idCategoria AND estado = 'A' ");
            
                foreach( $LISTAPRODUCTOS as $key => $value )
                {
                    $values['nombre'] = html_entity_decode($values['nombre']);
                    
                    
                    $return['data'][] = $value;
                }
        }
    }else{
        $return['success'] = 2;
        $return['mensaje'] = "Debe iniciar session";
    }
    
    print_r( json_encode( $return ) );