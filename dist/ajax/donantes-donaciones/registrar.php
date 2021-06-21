<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);
    
    session_start();
    require "../../../funciones.php";
    
    $return['estado'] = 1;
    $return['msj'] = "";
    $return['data'] = array();
    
    if( isLogin() )
    {
        $conexion = new Conexion();
        
        $tipopersona = "";
        $valida_num_doc = false;
        
        if(
            (isset($_POST['tipopersona']) && !empty($_POST['tipopersona']))
        )
        {
            $tipopersona = intval($_POST['tipopersona']);
        }
        
        if( $tipopersona == 1 )
        {
            $razonsocial = "";
            $mail = "";
            $direccion = "";
            $telefono = "";
            $num_doc = "";
            
            $pasar = false;
            
            if(
                ( isset($_POST['txt_razonSocialN']) && !empty($_POST['txt_razonSocialN']) ) &&
                ( isset($_POST['txt_numDocN']) && !empty($_POST['txt_numDocN']) )  &&
                ( isset($_POST['txt_telefonoContactoN']) && !empty($_POST['txt_telefonoContactoN']) ) &&
                ( isset($_POST['txt_addressN']) && !empty($_POST['txt_addressN']) )  
                
            )
            {
                $razonsocial = htmlentities($_POST['txt_razonSocialN']);
                $direccion = htmlentities($_POST['txt_addressN']);
                $telefono = $_POST['txt_telefonoContactoN'];
                $num_doc = $_POST['txt_numDocN'];
            }
            
            if(
                ( isset($_POST['txt_correoN']) && !empty($_POST['txt_correoN']) ) && filter_var($_POST['txt_correoN'],FILTER_VALIDATE_EMAIL)
            )
            {
                $mail = htmlentities($_POST['txt_correoN']);
            }
            
            if( intval( strlen($num_doc) ) == 10)
            {
                //$return['mes'] = "erroe";
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
                    $pasar = true;
                }else{
                    $return['msj'] = "Cédula Incorrecta";
                    $return['estado'] = 2;
                }
            }else{
                $return['estado'] = 2;
                $return['msj'] = "Longitud de la cédula debe ser de 10 digitos";
            }
            
            if( $pasar )
            {
                $existe = $conexion->buscarRegistro("SELECT * FROM tb_donante WHERE num_doc = '$num_doc' AND tipodonante = '$tipopersona' ");
                
                if($existe)
                {
                    $data_actuazlo = array($tipopersona, $num_doc, $razonsocial, $direccion, $telefono, $_POST['latitude'], $_POST['longitude'], $num_doc, $tipopersona);
                    $actualzar = $conexion->ejecutar("UPDATE tb_donante SET tipodonante = ?, num_doc = ?, nombres = ?, direccion = ?, numero_contacto = ?, latitud = ?, longitud = ? WHERE num_doc = ? AND tipodonante = ? ", 
                                                                            $data_actuazlo);
                                                                            
                    if( $actualzar )
                    {
                        $return['estado'] = 1;
                        $return['msj'] = "Exito al actualizar";
                        $return['data'] = $data_actuazlo;
                    }else{
                        $return['estado'] = 2;
                        $return['msj'] = "Error al actualizar";
                    }
                }else{
                    $data_insertar = array($tipopersona, $num_doc, $razonsocial, $direccion, $telefono, $_POST['latitude'], $_POST['longitude']);
                    $insertar = $conexion->ejecutar("INSERT INTO tb_donante (tipodonante, num_doc, nombres, direccion, numero_contacto, latitud, longitud) VALUES(?,?,?,?,?,?,?)",$data_insertar);
                                                                    
                    if( $insertar )
                    {
                        $return['estado'] = 1;
                        $return['msj'] = "Exito al registrar";
                    }else{
                        $return['estado'] = 2;
                        $return['msj'] = "Error al registrar";
                    }
                }
            }
            
        }else if( $tipopersona == 2 )
        // PERSONA JURIDICA
        {
            // $return['data'] = $_POST;
         
        
            $DATA_PER_JURI = array();
            
            $razonsocial = "";
            $numero_contacto = "";
            $persona_contacto = "";
            $correo = "";
            $direccion = "";
            $num_doc = "";
            
            if(
                ( isset($_POST['txt_razonSocialJ']) && !empty($_POST['txt_razonSocialJ']) ) &&
                ( isset($_POST['txt_numDocJ']) && !empty($_POST['txt_numDocJ']) ) &&
                ( isset($_POST['txt_personaContactoJ']) && !empty($_POST['txt_personaContactoJ']) ) &&
                ( isset($_POST['txt_telefonoContactoJ']) && !empty($_POST['txt_telefonoContactoJ']) ) &&
                ( isset($_POST['txt_correoJ']) && !empty($_POST['txt_correoJ']) ) &&
                ( isset($_POST['txt_addressJ']) && !empty($_POST['txt_addressJ']) ) 
            )
            {
                $razonsocial = htmlentities($_POST['txt_razonSocialJ']);
                $num_doc = $_POST['txt_numDocJ'];
                $persona_contacto = htmlentities($_POST['txt_personaContactoJ']);
                $numero_contacto = $_POST['txt_telefonoContactoJ'];
                $correo = $_POST['txt_correoJ'];
                $direccion =  htmlentities($_POST['txt_addressJ']);
            }
            
            $pasar = false;    //jeff -> ya existe una validación en javascript
            
            if( intval( strlen($num_doc) ) == 13 )
            {
                $arrayElement = str_split($num_doc);
                $provincia = ( (intval( $arrayElement[0] ) * 10) + intval( $arrayElement[1] ) );
                
                if( $provincia >= 0 && ( $provincia <= 24 || $provincia == 30 ) )
                {
                    
                    $sucursal = ( intval($arrayElement[10]) + intval($arrayElement[11]) + intval($arrayElement[12]) );
                
                    if($sucursal > 0)
                    {
                        $total = 0;
                        if( intval($arrayElement[2]) == 6)
                        {
                            $cuandoes6 = array(3,2,7,6,5,4,3,2);
                            
                            for( $i = 0; $i < count($cuandoes6); $i++ )
                            {
                                $total += intval( intval($arrayElement[$i]) * intval($cuandoes6[$i]) );
                            }
                        }
                        
                        if( intval($arrayElement[2]) == 9 )
                        {
                            $cuandoes9 = array(4,3,2,7,6,5,4,3,2);
                            for( $x = 0; $x < count($cuandoes9); $x++ )
                            {
                                $total += ( intval($arrayElement[$x]) * intval($cuandoes9[$x]) );
                            }
                        }
                        
                        if( $total > 0 )
                        {
                            if( ($total % 11) == 0 )
                            {
                                // $pasar = false;
                                $sucursal = 0;
                            } else if( ($total % 11) == 1 ) {
                                // $pasar = false;
                                return false;
                            } else {
                                $sucursal = (11 - ( $total % 11 )); 
                                // $pasar = false; 
                            }
                    
                            if( ($sucursal == $arrayElement[8]) || ($sucursal == $arrayElement[9]) )
                            {
                                $pasar = true;
                            }else{
                                $return['estado'] = 2;
                                $return['msj'] = "El R.U.C no corresponde a ningun sector";
                                // $pasar = false;
                            }
                        }else{
                            $return['estado'] = 2;
                            $return['msj'] = "R.U.C Incorrecto";
                            // $pasar = false;
                        }
                    }else{
                        // $pasar = false;
                        $return['msj'] = "El R.U.C. debe terminar en '001' ";
                        $return['estado'] = 2;
                    }
                    
                }else{
                    // $pasar = false;
                    $return['msj'] = "El R.U.C. ingresador no corresponde a ninguna provincia del país ";
                    $return['estado'] = 2;
                }
            }else{
                // $pasar = false;
                $return['msj'] = "La longitud del R.U.C debe de ser de 13 digitos";
                $return['estado'] = 2;
            }
            
            if($pasar)
            {
                $existe = $conexion->buscarRegistro("SELECT * FROM tb_donante WHERE num_doc = '$num_doc' AND tipodonante = '$tipopersona' ");
                
                if($existe)
                {
                    $data_actuazlo = array($tipopersona, $num_doc, $razonsocial, $direccion, $persona_contacto, $numero_contacto, $_POST['latitude'], $_POST['longitude'], $num_doc, $tipopersona);
                    $actualzar = $conexion->ejecutar("UPDATE tb_donante SET tipodonante = ?, num_doc = ?, nombres = ?, direccion = ?, persona_contacto = ?, numero_contacto = ?, latitud = ?, longitud = ? WHERE num_doc = ? AND tipodonante = ?  ",$data_actuazlo);
                                                                            
                    if( $actualzar )
                    {
                        $return['estado'] = 1;
                        $return['msj'] = "Exito al actualizar";
                        $return['data'] = $data_actuazlo;
                    }else{
                        $return['estado'] = 2;
                        $return['msj'] = "Error al actualizar";
                    }
                }else{
                    $data_insertar = array($tipopersona, $num_doc, $razonsocial, $direccion, $persona_contacto, $numero_contacto, $_POST['latitude'], $_POST['longitude']);
                    $insertar = $conexion->ejecutar("INSERT INTO tb_donante (tipodonante, num_doc, nombres, direccion, persona_contacto, numero_contacto, latitud, longitud) VALUES(?,?,?,?,?,?,?,?)",$data_insertar);
                                                                    
                    if( $insertar )
                    {
                        $return['estado'] = 1;
                        $return['msj'] = "Exito al registrar";
                        //$return['data'] = $data_insertar;
                    }else{
                        $return['estado'] = 2;
                        $return['msj'] = "Error al registrar";
                    }
                }
            }
            
        }
        
        
    }else{
        $return['estado'] = 1;
        $return['msj'] = "Debe iniciar session";
    }
    
    $return['data'] = $_POST;
    
    print_r( json_encode( $return ) );