<?
    ini_set("display_errors","1");
    session_start();
    require "../../../funciones.php";
    if( isLogin() )
    {
        
        $conexion = new Conexion();
        $return['estado'] = 1;
        $LISTADONANTES = $conexion->buscarVariosRegistro("SELECT * FROM tb_donante where estado='A'"); //esta mal, no puedes llamar a todos los donantes en teoria la lista deberia salir vacia al inicio
        //recordar que las tildes aqui tiene que ser reemplazado por codigo, por favor guiarse a codigo de otros proyecto lo mismo con la respuesta json
        
        //$LISTADONANTES = $conexion->buscarVariosRegistro("SELECT * FROM tb_donaciones dc INNER JOIN tb_donante d ON dc.iddnante = d.iddonante");
        if( count($LISTADONANTES) > 0 )
        {
            foreach( $LISTADONANTES as $key => $value )
            {
                $values['nombres'] = html_entity_decode($values['nombres']);
                
                if( intval($value['tipodonante']) == 1 )
                {
                    $value['tipo'] = "NATRUAL";
                }else{
                    $value['tipo'] = "JURIDICO";  //Jeff -> hay que tratar de guiarse de los fuente que ya tenemos   JURÍDICO
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