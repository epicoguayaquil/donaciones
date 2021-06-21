<?
    session_start();
    
    ini_set('display_errors', '1');
    
    if($_SESSION['usuario']){
    
        require "../../../config.php";
        require "../../../conexion.php";
        
        $conexion = new Conexion();
        
        $query = $conexion->buscarVariosRegistro("SELECT * FROM tb_beneficiario");
        
        $return['estado'] = 1;
        $return['data'] = array();
        
        if( count($query) > 0 ){
            
            foreach( $query as $key => $value ){
                
                $value['tipopersona'] = intval($value['tipo_persona']);
                $value['genero2'] = intval($value['genero']);
                
                if( $value['tipo_persona'] == 1 )
                {
                    $value['tipo_persona'] = "NATURAL";
                    // $value['persona_contacto'] = "NO APLICA";
                    
                    // SEXO DE LA PERSONA
                    if( $value['genero'] == 1 )
                    {
                        $value['genero'] = "MASCULINO";
                    }else{
                        $value['genero'] = "FEMENINO";
                    }
                    
                    // NIVEL ACADEMICO DE LA PERSONA
                    $NIVEL_EDU = $conexion->buscarRegistro("SELECT nombre FROM tb_nivel_educativo WHERE id_nivel_educativo = ".$value["nivel_academico"]." ");
                    
                    $value['nivelacademico'] = $NIVEL_EDU[0]['nombre'];
                    
                    
                }else if( $value['tipo_persona'] == 2 ){
                    $value['tipo_persona'] = "JURÍDICA";
                    
                    $value['genero'] = "NO APLICA";
                    $value['nivel_academico'] = "NO APLICA";
                    $value['parroquias'] = "NO APLICA";
                    $value['fecha_nac'] = "NO APLICA";
                    $value['nivelacademico'] = "NO APLICA";
                }
                
                $value['nombres'] = html_entity_decode( $value['nombres'] );
                
                $return['data'][] = $value;
            }
            
        }else{
            $return['estado'] = 2;
            $return['msj'] = "sin datos para mostrar";
        }
    }else{
        $return['estado'] = 3;
        $return['msg'] = "Debe iniciar session";
    }
    
    print_r( json_encode( $return ) );