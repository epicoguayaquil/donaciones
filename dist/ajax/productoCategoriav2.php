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
        
        if( $_POST["metodo"] == "PRODUCTO" )
        {
            if( $_POST["submetodo"] == "LISTARPRODUCTOS" )
            {
                $listarProductos = $conexion->buscarVariosRegistro( "SELECT pd.id_producto, pd.id_categoria, pd.nombre, pd.descripcion, pd.estado, ct.nombre AS nombreCategoria FROM tb_producto AS pd INNER JOIN tb_categorias AS ct ON ( pd.id_categoria = ct.id_categoria )" );
                
                $data = array();
                
                foreach( $listarProductos as $key => $value )
                {
                    $value['nombreCategoria'] = html_entity_decode($value['nombreCategoria']);
                    $value['descripcion'] = html_entity_decode($value['descripcion']);
                    $value['nombre'] = html_entity_decode($value['nombre']);
                    
                    $data[] = $value;
                }
                
                if( count($data) > 0 )
                {
                    $return['data'] = $data;
                }else{
                    $return['mensaje'] = "NO HAY DATOS";
                }
                
            }else if( $_POST["submetodo"] == "ACTUALIZARPRODUCTOS" )
            {
                if( intval( $_POST['idproducto'] ) == 0)
                {
                    // AQUI REGISTRO UN NUEVO PRODUCTO QUE NO EXISTA
                    $idcategoria = intval( $_POST['categoriaProducto'] );
                    
                    if( $idcategoria > 0)
                    {
                        $nombrePorducto = htmlentities( $_POST['nombreProducto'] );
                        $descripcionProdcuto = htmlentities( $_POST['descripcionProducto'] );
                        
                        $buscarProducto = $conexion->buscarRegistro( "SELECT * FROM tb_producto WHERE nombre = '$nombrePorducto'" );
                        if( intval( count( $buscarProducto ) ) == 0 )
                        {
                            $registrarProducto = $conexion->ejecutar( "INSERT INTO tb_producto(id_categoria, nombre, descripcion) VALUES ( ?, ?, ? ) ", array($idcategoria, $nombrePorducto, $descripcionProdcuto) );
                            if( $registrarProducto )
                            {
                                $return['mensaje'] = html_entity_decode("&Eacute;XITO AL REGISTRAR");
                            }else{
                                $return['success'] = 2;
                                $return['mensaje'] = html_entity_decode("ERROR AL REGISTRAR");
                            }
                        }else{
                            $return['success'] = 2;
                            $return['mensaje'] = "El producto ya existe";
                        }
                    }else{
                        $return['success'] = 2;
                        $return['mensaje'] = "Debe selecionar la categoria del producto";
                    }
                    
                }else{
                    // AQUI ACTUALIZO EL PRODUCTO TALES COMO NOMBRE Y DESCRIPCION
                    $idproducto = intval( $_POST['idproducto'] );
                    $nombrePorducto = htmlentities( $_POST['nombreProducto'] );
                    $descripcionProducto = htmlentities( $_POST['descripcionProducto'] );
                    
                    $actualizarProducto = $conexion->ejecutar( "UPDATE tb_producto SET nombre = ?, descripcion = ? WHERE id_producto = ?", array( $nombrePorducto, $descripcionProducto, $idproducto ) );
                    
                    if( $actualizarProducto )
                    {
                        $return['mensaje'] = html_entity_decode("&Eacute;XITO AL ACTUALIZAR");
                    }else{
                        $return['success'] = 2;
                        $return['mensaje'] = html_entity_decode("ERROR AL ACTUALIZAR");
                    }
                }
            }else if( $_POST["submetodo"] == "ACTUALIZARESTADO" )
            {
                $actualizarEstado = $conexion->ejecutar("UPDATE tb_producto SET estado = ? WHERE id_producto = ?", array( $_POST['estado'], intval( $_POST['idproducto'] ) ));
                if( $actualizarEstado )
                {
                    $return['mensaje'] = html_entity_decode("ACTUALIZADO CON &Eacute;XITO");
                }else{
                    $return['success'] = 2;
                    $return['mensaje'] = html_entity_decode("ERROR AL ACTUALIZAR");
                }
            }
        }else if( $_POST["metodo"] == "CATEGORIAS" )
        {
            if( $_POST["submetodo"] == "LISTARCATEGORIAS" )
            {
                $listarCategorias = $conexion->buscarVariosRegistro( "SELECT * FROM tb_categorias" );
                
                $data = array();
                
                foreach( $listarCategorias as $key => $value )
                {
                    $value['nombre'] = html_entity_decode( $value['nombre'] );
                    
                    $data[] = $value;
                }
                
                if( count($data) > 0 )
                {
                    $return['data'] = $data;
                }else{
                    $return['mensaje'] = "NO HAY CATEGORIAS PARA MOSTRAR";
                }
            }else if( $_POST["submetodo"] == "REGISTRARACTUALIZARCAUSA" )
            {
                $idCategoria = intval( $_POST['idcategoria'] );
                
                if( $idCategoria == 0 )
                {
                    $nombreCategoria = htmlentities($_POST['nombreCategoria']);
                    
                    $existeCategoria = $conexion->buscarRegistro("SELECT * FROM tb_categorias WHERE nombre = '$nombreCategoria' ");
                    
                    if( $existeCategoria )
                    {
                        $return['success'] = 2;
                        $return['mensaje'] = "La categoria ya existe";
                    }else{
                        $registrarCategoria = $conexion->ejecutar("INSERT INTO tb_categorias (nombre) VALUES (?)", array( $_POST['nombreCategoria'] ));
                        
                        if( $registrarCategoria )
                        {
                            $return['mensaje'] = html_entity_decode("&Eacute;XITO AL REGISTRAR");
                        }else{
                            $return['success'] = 2;
                            $return['mensaje'] = "ERROR AL REGISTRAR";
                        }
                    }
                }else{
                    $actualizarCategoria = $conexion->ejecutar("UPDATE tb_categorias SET nombre = ? WHERE id_categoria = ? ", array( htmlentities( $_POST['nombreCategoria'] ), intval( $_POST['idcategoria'] ) ) );
                    
                    if( $actualizarCategoria )
                    {
                        $return['mensaje'] = html_entity_decode("&Eacute;XITO AL ACTUALIZAR");
                    }else{
                        $return['success'] = 2;
                        $return['mensaje'] = "ERROR AL ACTUALIZAR";
                    }
                }
            }else if( $_POST["submetodo"] == "ACTUALIZARESTADOCAUSA" )
            {
                $actualizarEstadoCausa = $conexion->ejecutar("UPDATE tb_categorias SET estado = ? WHERE id_categoria = ?", array( $_POST['estado'], intval( $_POST['idcategoria'] ) ));
                if( $actualizarEstadoCausa )
                {
                    $return['mensaje'] = html_entity_decode("ACTUALIZADO CON &Eacute;XITO");
                }else{
                    $return['success'] = 2;
                    $return['mensaje'] = html_entity_decode("ERROR AL ACTUALIZAR");
                }
            }
        }
        
    }else{
        $return['success'] = 3;
        $return['mensaje'] = "Debe iniciar session";
    }
    
    header('Content-Type: application/json;charset=utf-8');
    print_r( json_encode($return) );