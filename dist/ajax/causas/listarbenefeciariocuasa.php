<?
    ini_set("display_errors","1");
    session_start();
    require "../../../funciones.php";
    if( isLogin() )
    {
        $conexion = new Conexion();
        $return['estado'] = 1;
        
        // $return['data'] = $_POST;
        
        $LISTADONANTES = $conexion->buscarVariosRegistro("select * from tb_beneficiarioCausa  as bc inner join tb_beneficiario as b on bc.idbeneficiario = b.idbeneficiario where idcausa = ".intval($_POST['id_causa'])." ");
        //$return['data']= $LISTADONANTES;
        
        if( count($LISTADONANTES) > 0 )
        {
            foreach( $LISTADONANTES as $key => $value )
            {
                $values['nombres'] = html_entity_decode($values['nombres']);
                
                if( intval($value['tipo_persona']) == 1 )
                {
                    $value['tipo'] = "NATRUAL";
                }else{
                    $value['tipo'] = html_entity_decode("JURÍDICO");
                }
                
                /*
                if( $value['persona_contacto'] == NULL || $value['persona_contacto'] == "" )
                {
                    $value['persona_contacto'] = "NO APLICA";
                }
                */
                
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