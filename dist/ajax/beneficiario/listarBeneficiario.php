<?
    session_start();
    require '../../../funciones.php';
    
    if( isLogin() )
    {
        $return['success'] = 1;
        $return['mensaje'] = "";
        $return['data'] = array();
        
        $conexion = new Conexion();
        
        if( $_POST['metodo'] == "LISTARBENEFICIARIOS" )
        {
            $listadobeneficiario = $conexion->buscarVariosRegistro("SELECT * FROM tb_beneficiario");
            
            if( count($listadobeneficiario) > 0)
            {
                foreach( $listadobeneficiario as $key => $value)
                {
                    // NIVEL ACADEMICO DE PERSONA NATURAL
                    $nivelAcademicoAux = $conexion->buscarRegistro("SELECT nombre FROM tb_nivel_educativo WHERE id_nivel_educativo = ".intval($value['nivel_academico']) );
                    $value['nivelAcademicoAux'] = ( count($nivelAcademicoAux) > 0 ? $nivelAcademicoAux[0]['nombre'] : '' );
                    
                    // TIPO DE PERSONA O BENEFICIARIO
                    if( $value['tipo_persona'] == 1 )
                    {
                        $value['tipoPersonaAux'] = "NATURAL";
                    }else{
                        $value['tipoPersonaAux'] = html_entity_decode("JUR&Iacute;DICO");
                        $value['fecha_nac'] = " ";
                    }
                    
                    // GÉNERO PERSONA NATURAL
                    if( $value['genero'] == 1 )
                    {
                        $value['generoAux'] = "MASCULINO";
                    }else if( $value['genero'] == 1 )
                    {
                        $value['generoAux'] = "FEMENINO";
                    }else{
                        $value['generoAux'] = "";
                    }
                    
                    if( $value['latitud'] == NULL && $value['longitud'] == NULL )
                    {
                        $value['ubicaciongeo'] = NULL;
                    }else{
                        $value['ubicaciongeo'] = "https://maps.google.com/?q=".$value['latitud'].",".$value['longitud'];
                    }
                    
                    $value['nombres'] = html_entity_decode($value['nombres']);
                    
                    $return['data'][] = $value;
                }
            }
        }else if( $_POST['metodo'] == "LISTARBENEFICIARIODONACION" )
        {
            $listadoBeneficiario = $conexion->buscarVariosRegistro("SELECT bf.idbeneficiario, bf.num_doc, bf.nombres FROM tb_beneficiarioCausa AS bc INNER JOIN tb_beneficiario AS bf ON bf.idbeneficiario = bc.idbeneficiario WHERE bc.idcausa = ? ", array( intval( $_POST['idcausa'] ) ));
            $return['data'] = $listadoBeneficiario;
        }
    }else{
        $return['success'] = 3;
        $return['mensaje'] = "Debe iniciar session";
    }
    
    print_r( json_encode( $return ) );