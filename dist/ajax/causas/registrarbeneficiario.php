<?
    ini_set("display_errors","1");

    require "../../../funciones.php";
    
    session_start();
    
    if( isLogin() )
    {
        $conexion = new Conexion();
        
        $return['estado'] = 1;
        $return['data'] = $_POST;
        
        $idcausa = 0;
        $beneficiarios = array();
        
        
        if( isset($_POST['idcausabeneficiario']) )
        {
            $idcausa = intval( $_POST['idcausabeneficiario'] );
        }
        
        if( count($_POST['selectbeneficiario']) > 0 )
        {
            $beneficiarios = $_POST['selectbeneficiario'];
        }else{
            $return['estado'] = 2;
            $return['msj'] = "Debe seleccionar al menos un beneficiario";
        }
        
        $total = 0;
        for( $i = 0; $i < count($beneficiarios); $i++ )
        {

		$buscarBeneficiario = $conexion->buscarRegistro("SELECT bn.num_doc, bn.nombres FROM tb_beneficiario AS bn INNER JOIN tb_beneficiarioCausa AS bc ON ( bn.idbeneficiario = bc.idbeneficiario ) WHERE bc.idbeneficiario = ".intval( $beneficiarios[$i] ) );

		if( $buscarBeneficiario )
		{
			$return['estado'] = 2;
			$return['msj'] = "El beneficiario '".$buscarBeneficiario[0]['nombres']."', ya esta inscrito en la necesidad";
			break;
		}else{
			$exito = $conexion->ejecutar("INSERT INTO tb_beneficiarioCausa (idcausa, idbeneficiario) VALUES (?,?) ", array($idcausa, $beneficiarios[$i]));
			if( $exito )
			{
            			$total++;
			}
		}
        }
        
        if( count($beneficiarios) == $total )
        {
            $return['msj'] = "Éxito";
        }else{
            $return['estado'] = 2;
            $return['msj'] = "Error";
        }
    }else{
        $return['estado'] = 2;
        $return['msj'] = "Debe iniciar session";
    }
    
    print_r( json_encode( $return ) );