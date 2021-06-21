<?
    ini_set("display_errors","1");
    session_start();
    require "../../../funciones.php";
    if( isLogin() )
    {
        $conexion = new Conexion();
        
        $return['estado'] = 1;
        $return['msj'] = "";
        $return['data'] = array();
        
        if( $_POST['metodo'] == "CATEGORIA" )
        {
            // $LISTAPRODUCTOS = $conexion->buscarVariosRegistro("SELECT * FROM tb_detalle_causa cd , tb_producto p where cd.id_producto=p.id_producto and id_causa=1");
            
            //DAVID 
            $LISTAPRODUCTOS = $conexion->buscarVariosRegistro("SELECT * FROM tb_detalle_causa cd , tb_producto p where cd.id_producto=p.id_producto and cd.id_causa= ".intval($_POST['idcausa'])." AND cd.id_categoria = ".intval($_POST['idcategoria'])." "); 
            //$return['data']= $LISTADONANTES;
            
            
            foreach( $LISTAPRODUCTOS as $key => $value )
            {
                $values['nombre'] = html_entity_decode($values['nombre']);
                
                $values['descripcion'] = html_entity_decode($values['descripcion']);
            
                $return['data'][] = $value;
            }
            
        }else if( $_POST['metodo'] == "PRODUCTOSCAUSA" )
        {
            $select = "";
            
            if( count( $_POST['iddatos'] ) > 0 )
            {
            
                $SELECTDATA = $conexion->buscarVariosRegistro("SELECT * FROM tb_detalle_causa WHERE id_causa = ".intval($_POST['idcausa']));
                
                // $return['detalle'] = $SELECTDATA;
                
                for( $i = 0; $i < count($SELECTDATA); $i++ )
                {
                    $select .= "<tr>";
                    
                    // CATEGORIA
                    $SELECTCATEGORIA = $conexion->buscarVariosRegistro("SELECT * FROM tb_categorias WHERE estado = 'A' ");
                    $select .= "<td align='center' style='width: 18%;'> <select id='categorias' name='categorias[]'  class='form-control categorias' data-placeholder='Selecione categoria' onchange='mostrat_sub_categoria(this,value)'> <option value='0'> SELECCIONE UNA CATEGORIA </option>";
                    
                    for( $c = 0; $c < count($SELECTCATEGORIA); $c++ )
                    {
                        
                        $select .= "<option  value='".$SELECTCATEGORIA[$c]['id_categoria']."' ".( $SELECTCATEGORIA[$c]['id_categoria'] == $_POST['iddatos'][$i]['id_categoria'] ? 'selected' : '' )." > ".$SELECTCATEGORIA[$c]['nombre']." </option>";
                        
                    }
                    $select .= "</select> </td>";
                    
                    // PRODUCTOS
                    $SELECTPRODUCTOS = $conexion->buscarVariosRegistro("SELECT * FROM tb_producto WHERE estado = 'A' AND id_categoria = '".$SELECTDATA[$i]['id_categoria']."'");
                    $select .= "<td align='center' style='width: 18%;'> <select id='productos' name='productos[]'  class='form-control productos' onchange='asignar_unidadMedida(this, value)'> <option value='0'> SELECCIONE UN PRODUCTO DE LA CATEGORIA </option>";
                    
                    for( $cp = 0; $cp < count($SELECTPRODUCTOS); $cp++ )
                    {
                        
                        $select .= "<option  value='".$SELECTPRODUCTOS[$cp]['id_producto']."' ".( $SELECTPRODUCTOS[$cp]['id_producto'] == $_POST['iddatos'][$i]['id_producto'] ? 'selected' : '' )." > ".$SELECTPRODUCTOS[$cp]['nombre']." </option>";
                        
                    }
                    $select .= "</select> </td>";
                    
                    // UNIDADES DE MEDIDA
                    $SELECTUNIDADESMEDIDAS = $conexion->buscarVariosRegistro("SELECT umd.idunidadmedida, umd.definicion FROM tb_detalle_causa AS dtc INNER JOIN tb_productos_unidadesMedidas AS pum ON ( dtc.id_producto = pum.idproducto ) INNER JOIN tb_unidades_medidas AS umd ON ( pum.idmedida = umd.idunidadmedida ) WHERE dtc.id_producto = ? AND dtc.id_causa = ?", array ( intval( $SELECTDATA[$i]['id_producto'] ), intval( $SELECTDATA[$i]['id_causa'] ) ));
                    
                    $return['med'] = $SELECTUNIDADESMEDIDAS;
                    $return['data'] = array( intval( $SELECTDATA[$i]['id_producto'] ), intval( $SELECTDATA[$i]['id_causa'] ) );
                    
                    $select .= "<td align='center' style='width: 18%;'> <select id='unidadMedida' name='unidadMedida[]' class='form-control unidadMedidad' onchange='habilitarCantidad(this, value)'>  <option value='0'> SELECCIONE UNA UNIDAD DE MEDIDA </option>";
                    for( $um = 0; $um < count( $SELECTUNIDADESMEDIDAS ); $um++ )
                    {
                        $select .= "<option value='".$SELECTUNIDADESMEDIDAS[$um]['idunidadmedida']."' ".( $SELECTUNIDADESMEDIDAS[$um]['idunidadmedida'] == $_POST['iddatos'][$i]['idUnidadMedida'] ? 'selected' : '' )."> ".$SELECTUNIDADESMEDIDAS[$um]['definicion']." </option>";
                    }
                    $select .= "</select> </td>";
                    
                    // CANTIDAD
                    $select .= "<td align='center' style='width: 18%;'>";
                    
                    $select .= "<input type='number' onkeypress='soloNumeros(event)' value='".$_POST['iddatos'][$i]['cantidad']."' maxlength='6' oninput='javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);' required pattern='[0-9]{1,5}' class='form-control' name='cantidad_lista_producto[]' id='cantidad_lista_producto' style='margin-bottom: 0px' /> <small>M&aacute;ximo 6 digitos</small>";
                    
                    $select .= "</td>";
                    
                    $select .= "<td align='center' style='width: 18%;'>";
                    
                    $select .= "<button class='eliminar_fila btn btn-primary btn-lg' style='margin-top: 5px;margin-bottom: 5px; background-color: #054b88; border-color: #26312b; font-size: 11px;padding: 7px 15px;' onclick='eliminar_(this, event);'><i class='fa fa-trash'></i></button>";
                    
                    $select .= "</td>";
                    
                    $select .= "</tr>";
                }
            }else{
                
                $query=Conexion::buscarVariosRegistro("SELECT * FROM tb_categorias where estado='A'");
                                    if($query){
                                        foreach($query as $cat){
                                            // echo "<option value="'.$cat["id_categoria"].'">'.$cat['nombre'].'</option>";
                                            $select2 .= '<option value="'.$cat["id_categoria"].'">'.$cat['nombre'].'</option>';
                                        }
                                    }
                $select .= '
                    <tr>
				        <td align="center" style="text-align:center !important;">
						    <!--<input type="text"  name="agregar_lista_producto_hijos[]" id="agregar_lista_producto_hijos" maxlength="100" title="agrega Sub-Categorias que deseas" style="width: 97%;margin-left: 2%;color:black;" >-->
					        <select id="categorias" name="categorias[]"  class="form-control categorias" data-placeholder="Selecione categoria" onchange="mostrat_sub_categoria(this,value)">
                                <option value="0">Seleccione una categoria</option>
                                '.$select2.'
                            </select>
					    </td>	
					    <td align="center" style="text-align:center !important;">
						    <!--<input type="text"  name="agregar_lista_producto_hijos[]" id="agregar_lista_producto_hijos" maxlength="100" title="agrega Sub-Categorias que deseas" style="width: 97%;margin-left: 2%;color:black;" >-->
					        <select id="productos" name="productos[]"  class="form-control productos" disabled data-placeholder="Selecione un producto">
                                <option value="0" >Seleccione una categoria</option>
                            </select>
					    </td>										
					    <td align="center" style="text-align:center !important;">
						    <input type="number" pattern="[0-9]{1,5}" min="1" required title="Tiene que ser un valor mayor que 0"  name="cantidad_lista_producto[]" id="cantidad_lista_producto"  maxlength="100" title="agrega Sub-Categorias que deseas" style="width: 97%;margin-left: 2%;color:black;" >
					    </td>
					    <!--
					    <td align="center" style="width: 18%;">
						    <button class="agregar_fila btn btn-primary btn-lg" style="margin-top: 5px;margin-bottom: 5px; background-color: #054b88; border-color: #26312b; font-size: 11px;padding: 7px 15px;" onclick="duplicateLine(this, event);">
						    <i class="fa fa-clock-o"></i>Duplicar</button>
					    </td>	
					    -->
					    <td align="center" style="width: 18%;">
						    <button class="eliminar_fila btn btn-primary btn-lg" style="margin-top: 5px;margin-bottom: 5px; background-color: #054b88; border-color: #26312b; font-size: 11px;padding: 7px 15px;" onclick="eliminar_(this, event);">
						    <i class="fa fa-trash"></i>  Eliminar</button>
					    </td>
                    </tr>
                
                ';
            }
            
            $return['select'] = $select;
            // $return['data'] = $_POST;
        }else if( $_POST['metodo'] == "BUSCARPRODUCTOPORCAUSA" )
        {
            $productoExiste = $conexion->buscarVariosRegistro("SELECT * FROM tb_donaciones WHERE causaid = ? AND idproducto = ? AND flag_logistico = ?", array(intval($_POST['idcausa']), intval($_POST['elemento']), 1 ));
            $return['productos'] = $productoExiste;
        }else if( $_POST['metodo'] == "CANTIDADPRODUCTOSDISPONIBLE" )
        {
            $idcausa = 0;
            $idproducto = 0;
            
            if(
                ( isset($_POST['idcausa']) ) &&
                ( isset($_POST['idproducto']) )
            )
            {
                $idcausa = intval($_POST['idcausa']);
                $idproducto = intval($_POST['idproducto']);
            }
            
            $cantidadProducto = $conexion->buscarVariosRegistro("SELECT SUM(cantidad) AS total FROM tb_donaciones WHERE causaid = ? AND idproducto = ?", array($idcausa, $idproducto));
            $return['cantidad'] = ( $cantidadProducto[0]['total'] == NULL ? 0 : $cantidadProducto[0]['total'] );
            $return['data'] = $_POST;
        }else if( $_POST['metodo'] == "PRODUCTOUNIDADMEDIDA" )
        {
            $return['POST'] = $_POST;
            $seleccionarUnidadMedidaProducto = $conexion->buscarRegistro("SELECT undM.abreviatura, undM.definicion, undM.idunidadmedida FROM tb_detalle_causa AS dtc INNER JOIN tb_unidades_medidas AS undM ON( dtc.idUnidadMedida = undM.idunidadmedida ) WHERE dtc.id_causa = ".intval( $_POST['idcausa'] )." AND dtc.id_producto = ".intval( $_POST['idproducto'] ));
            if( $seleccionarUnidadMedidaProducto )
            {
                $return['data'] = $seleccionarUnidadMedidaProducto;
            }else{
                $return['estado'] = 2;
                $return['msj'] = "No hay unidad de medida seleccionada para este producto";
            }
        }
        
    }else{
        $return['estado'] = 2;
        $return['msj'] = "Debe iniciar session";
    }
    
    print_r( json_encode( $return ) );