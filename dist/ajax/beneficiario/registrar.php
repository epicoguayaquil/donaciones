<?
    ini_set('display_errors',1);
    
    session_start();
    require "../../../funciones.php";
    
    $return['success'] = 1;
    $return['mensaje'] = "";
    $return['data'] = array();
    
    if( isLogin() )
    {
        $conexion = new Conexion();
        
        $return['data'] = $_POST;
        
        $idtipopersona = 0;
        $idbeneficiario = 0;
        
        if(
            (isset($_POST['idtipopersona']) && !empty($_POST['idtipopersona']))
        )
        {
            $idtipopersona = intval($_POST['idtipopersona']);
        }
        
        if(
            (isset($_POST['idbeneficiario']))
        )
        {
            $idbeneficiario = intval($_POST['idbeneficiario']);
        }
        
        if(
            ( isset( $_POST['txt_provincia'] ) && !empty( $_POST['txt_provincia'] ) )&&
            ( isset( $_POST['txt_ciudad'] ) && !empty( $_POST['txt_ciudad'] ) )&&
            ( isset( $_POST['txt_parroquia'] ) && !empty( $_POST['txt_parroquia'] ) )
        )
        {
            $provincia = intval($_POST['txt_provincia']);
            $ciudad = intval($_POST['txt_ciudad']);
            $parroquia = intval($_POST['txt_parroquia']);
        }
        
        if( $idtipopersona == 1 )
        {
            $retun['aux'] = "NAtural";
            
            $razonsocial = "";
            $mail = "";
            $direccion = "";
            $numero_contacto = "";
            $num_doc = "";
            
            $fechaNac = "";
            
            $flag = false;
            
            if(
                ( isset($_POST['txt_numDoc']) && !empty($_POST['txt_numDoc']) ) && 
                ( isset($_POST['txt_razonSocial']) && !empty($_POST['txt_razonSocial']) ) &&
                ( isset($_POST['txt_telefonoContactoN']) && !empty($_POST['txt_telefonoContactoN']) ) &&
                ( isset($_POST['txt_address']) && !empty($_POST['txt_address']) ) &&
                ( isset($_POST['txt_fechaNacimientoN']) && !empty($_POST['txt_fechaNacimientoN']) ) 
            )
            {
                $num_doc = $_POST['txt_numDoc'];
                $razonsocial = htmlentities($_POST['txt_razonSocial']);
                $numero_contacto = $_POST['txt_telefonoContactoN'];
                $direccion = htmlentities($_POST['txt_address']);
                $fechaNac = date('Y-m-d', strtotime($_POST['txt_fechaNacimientoN']));
            }
            
            if(
                ( isset( $_POST['text_sector'] ) && !empty( $_POST['text_sector'] ) )&&
                ( isset( $_POST['txt_genero'] ) && !empty( $_POST['txt_genero'] ) )&&
                ( isset( $_POST['txt_educativo'] ) && !empty( $_POST['txt_educativo'] ) )
            )
            {
                $sector = intval($_POST['text_sector']);
                $genero = intval($_POST['txt_genero']);
                $niveleducativo = intval($_POST['txt_educativo']);
            }
            
            if( intval( strlen($num_doc) ) == 10)
            {
                $total = 0;
                $arrayElement = str_split($num_doc);
                $endElement = array_pop($arrayElement);
                
                foreach($arrayElement as $key => $value)
                {
                    if( ( $key%2 ) == 0 )
                    {
                        $aux = intval($value * 2);
                        if($aux > 9) $aux -= 9;
                        $total += $aux;
                    }else{
                        $total += intval($value);
                    }
                    
                }
                
                $total = $total % 10 ? 10 - $total % 10 : 0;
                
                if( $endElement == $total  )
                {
                    $flag = true;
                }else{
                    $return['mensaje'] = "Cédula Incorrecta";
                    $return['success'] = 2;
                }
            }else{
                $return['success'] = 2;
                $return['mensaje'] = "Longitud de la cédula debe ser de 10 digitos";
            }
            
            if(
                ( isset($_POST['txt_correo']) && !empty($_POST['txt_correo']) ) && filter_var($_POST['txt_correo'],FILTER_VALIDATE_EMAIL)
            )
            {
                $correo = htmlentities($_POST['txt_correo']);
            }
            
            if( $flag )
            {
                $existe = $conexion->buscarRegistro("SELECT COUNT(*) AS total FROM tb_beneficiario WHERE num_doc = '$num_doc' AND tipo_persona = '$idtipopersona' AND idbeneficiario = '$idbeneficiario' ");
                if( $idbeneficiario > 0 && intval($existe[0]['total']) > 0 )
                {
                    $actualizarbeneficario = $conexion->ejecutar("
                        UPDATE tb_beneficiario SET 
                        tipo_persona = ?,
                        nombres = ?,
                        correo = ?,
                        genero = ?,
                        nivel_academico = ?,
                        direccion = ?,
                        fecha_nac = ?,
                        numero_contacto = ?,
                        provincia = ?,
                        ciudad = ?,
                        parroquia = ?,
                        sector = ?
                        WHERE idbeneficiario = ?
                        AND  num_doc = ?
                    ", array($idtipopersona, $razonsocial, $correo, $genero, $niveleducativo,  $direccion, $fechaNac,  $numero_contacto, $provincia, $ciudad, $parroquia, $sector, $idbeneficiario, $num_doc));
                    
                    if( $actualizarbeneficario )
                    {
                        $return['success'] = 1;
                        $return['mensaje'] = "Éxito al actualizar";
                    }else{
                        $return['success'] = 2;
                        $return['mensaje'] = "Error al actualizar";
                    }
                }else{
                    $exiteCedula = $conexion->buscarRegistro(" SELECT COUNT(*) AS total FROM tb_beneficiario WHERE num_doc = '$num_doc' AND tipo_persona = $idtipopersona ");
                    if( intval( $exiteCedula[0]['total'] ) > 0 )
                    {
                        $return['success'] = 2;
                        $return['mensaje'] = "La cédula debe ser unica";
                    }else{
                        $registrarbeneficiario = $conexion->ejecutar("INSERT INTO tb_beneficiario(num_doc, tipo_persona, nombres, correo, genero, nivel_academico, direccion, fecha_nac, numero_contacto, provincia, ciudad, parroquia, sector) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)",
                                                                                            array($num_doc, $idtipopersona, $razonsocial, $correo, $genero, $niveleducativo,  $direccion, $fechaNac, $numero_contacto, $provincia, $ciudad, $parroquia, $sector  ));
                        if( $registrarbeneficiario )
                        {
                            $return['success'] = 1;
                            $return['mensaje'] = "Éxito al registrar";
                        }else{
                            $return['success'] = 2;
                            $return['mensaje'] = "Error al registrar";
                        }
                    }
                }
            }
            
        }else if( $idtipopersona == 2 )
        {
            $num_doc = "";
            $razonsocial = "";
            $persona_contacto = "";
            $numero_contacto = "";
            $correo = "";
            $direccion = "";
            
            $flag = false;
            
            if(
                ( isset($_POST['txt_numDoc']) && !empty($_POST['txt_numDoc']) ) &&
                ( isset($_POST['txt_razonSocial']) && !empty($_POST['txt_razonSocial']) ) &&
                ( isset($_POST['txt_personaContacto']) && !empty($_POST['txt_personaContacto']) ) &&
                ( isset($_POST['txt_telefonoContacto']) && !empty($_POST['txt_telefonoContacto']) ) &&
                ( isset($_POST['txt_correo']) && !empty($_POST['txt_correo']) ) &&
                ( isset($_POST['txt_address']) && !empty($_POST['txt_address']) ) 
            )
            {
                $num_doc = $_POST['txt_numDoc'];
                $razonsocial = htmlentities($_POST['txt_razonSocial']);
                $persona_contacto = htmlentities($_POST['txt_personaContacto']);
                $numero_contacto = $_POST['txt_telefonoContacto'];
                $correo = $_POST['txt_correo'];
                $direccion =  htmlentities($_POST['txt_address']);
            }
            
            // VALIDA EL RUC PREVIAMENTE INGRESADO
            if( intval( strlen($num_doc) ) == 13 )
            {
                $arrayElement = str_split($num_doc);
                $provincias = ( (intval( $arrayElement[0] ) * 10) + intval( $arrayElement[1] ) );
                
                if( $provincias >= 0 && ( $provincias <= 24 || $provincias == 30 ) )
                {
                    $sucursal = ( intval($arrayElement[10]) + intval($arrayElement[11]) + intval($arrayElement[12]) );
                
                    if($sucursal > 0)
                    {
                        $total = 0;
                        if( intval($arrayElement[2]) == 6)
                        {
                            $cuandoes6 = array(3,2,7,6,5,4,3,2);
                            
                            for( $i = 0; count($cuandoes6); $i++ )
                            {
                                $total += ( intval($arrayElement[$i]) * intval($cuandoes6[$i]) );
                            }
                        }
                        
                        if( intval($arrayElement[2]) == 9 )
                        {
                            $cuandoes9 = array(4,3,2,7,6,5,4,3,2);
                            for( $i = 0; $i<count($cuandoes9); $i++ )
                            {
                                $total += ( intval($arrayElement[$i]) * intval($cuandoes9[$i]) );
                            }
                        }
                        
                        if( $total > 0 )
                        {
                            if( ($total % 11) == 0 )
                            {
                                $sucursal = 0;
                            } else if( ($total % 11) == 1 ) {
                                $flag = false;
                                return false;
                            } else {
                                $sucursal = (11 - ( $total % 11 ));  
                            }
                            
                            if( ($sucursal == $arrayElement[8]) || ($sucursal == $arrayElement[9]) )
                            {
                                $flag = true;
                            }else{
                                $return['estado'] = 2;
                                $return['msj'] = "R.U.C Incorrecto";
                            }
                        }
                    }else{
                        $return['msj'] = "El R.U.C. debe terminar en '001' ";
                        $return['estado'] = 2;
                    }
                    
                }else{
                    $return['msj'] = "El R.U.C. ingresador no corresponde a ninguna provincia del país ";
                    $return['estado'] = 2;
                }
            }else{
                $return['msj'] = "La longitud del R.U.C debe de ser de 13 digitos";
                $return['estado'] = 2;
            }
            
            if( $flag )
            {
                $existe = $conexion->buscarRegistro("SELECT COUNT(*) AS total FROM tb_beneficiario WHERE num_doc = '$num_doc' AND tipo_persona = '$idtipopersona' AND idbeneficiario = '$idbeneficiario' ");
                if( $idbeneficiario > 0 && intval($existe[0]['total']) > 0 )
                {
                    $actualizarbeneficario = $conexion->ejecutar("
                        UPDATE tb_beneficiario SET 
                        tipo_persona = ?,
                        nombres = ?,
                        correo = ?,
                        direccion = ?,
                        persona_contacto = ?,
                        numero_contacto = ?,
                        provincia = ?,
                        ciudad = ?,
                        parroquia = ?
                        WHERE idbeneficiario = ?
                    ", array($idtipopersona, $razonsocial, $correo, $direccion, $persona_contacto, $numero_contacto, $provincia, $ciudad, $parroquia, $idbeneficiario));
                    if( $actualizarbeneficario )
                    {
                        $return['success'] = 1;
                        $return['mensaje'] = "Éxito al actualizar";
                    }else{
                        $return['success'] = 2;
                        $return['mensaje'] = "Error al actualizar";
                    }
                }else{
                    $exiteCedula = $conexion->buscarRegistro(" SELECT COUNT(*) AS total FROM tb_beneficiario WHERE num_doc = '$num_doc' AND tipo_persona = $idtipopersona ");
                    if(  intval( $exiteCedula[0]['total'] ) > 0  )
                    {
                        $return['success'] = 2;
                        $return['mensaje'] = "El R.U.C. debe ser unico";
                    }else{
                        $registrarbeneficiario = $conexion->ejecutar("INSERT INTO tb_beneficiario(num_doc, tipo_persona, nombres, correo, direccion, persona_contacto, numero_contacto, provincia, ciudad, parroquia) VALUES (?,?,?,?,?,?,?,?,?,?)", array($num_doc, $idtipopersona, $razonsocial, $correo, $direccion, $persona_contacto, $numero_contacto, $provincia, $ciudad, $parroquia, ));
                        if( $registrarbeneficiario )
                        {
                            $return['success'] = 1;
                            $return['mensaje'] = "Éxito al registrar";
                        }else{
                            $return['success'] = 2;
                            $return['mensaje'] = "Error al registrar";
                        }
                    }
                }
            }
        }
        
    }else{
        $return['estado'] = 1;
        $return['msj'] = "Debe iniciar session";
    }
    
    print_r( json_encode( $return ) );