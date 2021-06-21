<?
    ini_set("display_errors","1");
    session_start();
    require "../../../funciones.php";
    if( isLogin() )
    {
        $conexion = new Conexion();
        $return['estado'] = 1;
        
        // $LISTADONANTES = $conexion->buscarVariosRegistro("SELECT DISTINCT b.idbeneficiario, b.* FROM tb_beneficiario AS b INNER JOIN tb_beneficiarioCausa AS bc ON b.idbeneficiario != bc.idbeneficiario WHERE bc.idcausa !=".intval($_POST['id_causa']) );
        $LISTADONANTES = $conexion->buscarVariosRegistro("SELECT * FROM tb_beneficiario AS b WHERE b.idbeneficiario NOT IN ( SELECT idbeneficiario FROM tb_beneficiarioCausa AS bc WHERE bc.idcausa = ".intval($_POST['id_causa']).") " );

        
        if( count($LISTADONANTES) > 0 )
        {
            foreach( $LISTADONANTES as $key => $value )
            {
                $values['nombres'] = html_entity_decode($values['nombres']);
                
                /*
                if( intval($value['tipodonante']) == 1 )
                {
                    $value['tipo'] = "NATRUAL";
                }else{
                    $value['tipo'] = html_entity_decode("JURÍDICO");
                }
                
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