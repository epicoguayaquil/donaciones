<?
    session_start();
    
    ini_set('display_errors', '1');
    
    if($_SESSION['usuario']){
    
        require "../../../config.php";
        require "../../../conexion.php";
        
        $conexion = new Conexion();
        
        $return['estado'] = 1;
        
        $NIVEL_EDU = $conexion->buscarVariosRegistro("SELECT * FROM tb_donante");
        
        if( count($NIVEL_EDU) > 0 )
        {
            foreach( $NIVEL_EDU as $key => $value )
            {
                if( intval($value['tipodonante']) == 1 )
                {
                    $value['tipo'] = "NATURAL";
                }else{
                    $value['tipo'] = html_entity_decode("JURÍDICO");
                }
                
                $value['nombres'] = html_entity_decode($value['nombres']);
                
                if( $value['persona_contacto'] == NULL )
                {
                    $value['persona_contacto'] = "NO APLICA";
                }
                
                $return['data'][] = $value;
            }
        }else{
            $return['estado'] = 2;
            $return['msj'] = "Sﾃｭn datos para mostrar";
        }
        
    }else{
        $return['estado'] = 3;
        $return['msg'] = "Debe iniciar session";
    }
    
    print_r( json_encode( $return ) );