<?
    date_default_timezone_set('America/Guayaquil');
    session_start();
    
    ini_set('display_errors', 1);
    
    require "../../config.php";
    require "../../conexion.php";
    
    $conexion = new Conexion();
    /*
    $idacopio = "";
    $idtipodonacion = "";
    
    $dona_dinero = "";
    
    $necesidad_detalle_causa = "";
    $numero_persona_contacto = "";
    $objetivo = "";
    $proposito = "";
    $persona_contacto = "";
    
    $imagen = "";
    
    if(
        isset($_FILES['imagen']) && !empty($_FILES['imagen'])
    ){
        $imagen = $_FILES['imagen'];
    }
    
    if(
        (isset($_POST['id_acopio']) ) &&
        (isset($_POST['id_tipo_donacion']))
    ){
        $idacopio = $_POST['id_acopio'];
        $idtipodonacion = $_POST['id_tipo_donacion'];
    }
    
    if(
        isset($_POST['dona_dinero']) && !empty($_POST['dona_dinero'])
    ){
        $dona_dinero = $_POST['dona_dinero'];
    }
    
    if(
        (isset($_POST['necesidad_detalle_causa']) && !empty($_POST['necesidad_detalle_causa'])) &&
        (isset($_POST['numero_persona_contacto']) && !empty($_POST['numero_persona_contacto'])) &&
        (isset($_POST['objetivo']) && !empty($_POST['objetivo'])) &&
        (isset($_POST['proposito']) && !empty($_POST['proposito'])) &&
        (isset($_POST['persona_contacto']) && !empty($_POST['persona_contacto']))
    ){
        $necesidad_detalle_causa = $_POST['necesidad_detalle_causa'];
        $numero_persona_contacto = $_POST['numero_persona_contacto'];
        $objetivo = $_POST['objetivo'];
        $proposito = $_POST['proposito'];
        $persona_contacto = $_POST['persona_contacto'];
    }
    
    if(
        empty($idacopio) ||
        empty($idtipodonacion) ||
        empty($necesidad_detalle_causa) ||
        empty($numero_persona_contacto) ||
        empty($objetivo) ||
        empty($proposito) ||
        empty($persona_contacto) ||
        empty($imagen) 
    ){
        $respuesta->estado = 2;
        $respuesta->msg = "Alguno campos llegaron vacíos";
    }
    
    $typeImg = explode("/",$imagen['type']);
    $formatos= array('png','jpg','jpeg');
    
    $renombre = date("YmdHis").'.'.$typeImg[1];
    $destino = "../../donaciones/".$renombre;
    
    if(!in_array($typeImg[1], $formatos)){
        $respuesta->estado = 2;
        $respuesta->msg = "Los formatos requerido son [png - jpeg - jpg]";
    }
    
    if(!move_uploaded_file($imagen['tmp_name'], $destino)){
        $respuesta->estado = 2;
        $respuesta->msg = "Error al guardar la imagen";
    }
    
    $sql = "
        INSERT INTO `tb_solicitud_donacion`( `proposito`, `objetivo`, `persona_contacto`, `numero_persona_contacto`, `id_tipo_donacion`, `necesidad_detalle_causa`, `id_acopio`, `id_usuario_requirente`, `imagen`) 
        VALUES (?,?,?,?,?,?,?,?,?)
    ";
    
    $query = trim($sql);
    
    $data = array($proposito,$objetivo,$persona_contacto,$numero_persona_contacto,$idtipodonacion,$necesidad_detalle_causa,$idacopio,$_SESSION['id'],$renombre);
    
    $res = $conexion->ejecutar($query,$data);
    
    if($res){
        $respuesta->msg = "Éxito al guardar";
    }else{
        $respuesta->estado = 2;
        $respuesta->msg = "Error al guardar";
    }
    */
    
    //$return['data'] = $_POST;
    
    $idtipodonacion = 0;
    $centroacopio = 0;
    
    $proposito = "";
    $personcontacto = "";
    $numcontacto = "";
    
    $fechaInicio = "";
    $FechaFin = "";
    
    $beneficiarios = array();
    
    if(
        ( isset($_POST['proposito']) && !empty($_POST['proposito']) ) &&
        ( isset($_POST['persona_contacto']) && !empty($_POST['persona_contacto']) ) &&
        ( isset($_POST['numero_persona_contacto']) && !empty($_POST['numero_persona_contacto']) ) 
    ){
        $proposito = htmlentities($_POST['proposito']);
        $personcontacto = htmlentities($_POST['persona_contacto']);
        $numcontacto = htmlentities($_POST['numero_persona_contacto']);
    }
    
    if(
        ( isset($_POST['id_tipo_donacion'])  && !empty($_POST['id_tipo_donacion']) ) &&
        ( isset($_POST['centroacopio']) && !empty($_POST['centroacopio']) )
    ){
        $idtipodonacion = intval($_POST['id_tipo_donacion']);
        $centroacopio = intval($_POST['centroacopio']);
    }
    
    if( isset($_POST['beneficiarios']) && !empty($_POST['beneficiarios']) )
    {
        $beneficiarios = $_POST['beneficiarios'];
    }
    
    if(
        ( isset($_POST['fechaInicio'])  && !empty($_POST['fechaInicio'])) &&
        ( isset($_POST['fechaFin'])  && !empty($_POST['fechaFin']))
    ){
        $fechaInicio = $_POST['fechaInicio'];
        $FechaFin = $_POST['fechaFin'];
    }
    
    $sqlGuardar = "
        INSERT INTO tb_causa
        (proposito,
        tipo,
        fecha_inicio,
        fecha_fin)
        VALUES
        (?,?,?,?);
    ";
    
    $res = $conexion->ejecutar($sqlGuardar ,array($proposito, $idtipodonacion, $fechaInicio, $FechaFin) );
    
    if( $res ){
        
        $idcausa = $conexion->lastId();
        $cont = 0;
        
        for( $i = 0; $i < count($beneficiarios); $i++){
            $sqllogis = "
                INSERT INTO tb_logistica
                    (`idcausa`,
                    `idbeneficiario`,
                    `idacopio`)
                    VALUES
                    (?,?,?)
            ";
            $conexion->ejecutar($sqllogis ,array($idcausa, $beneficiarios[$i], $centroacopio) );
            $cont++;
        }
        
        if( count($beneficiarios) == $cont )
        {
            $return['msj'] = 'correcto';
        }else{
            $return['msj'] = "nada";   
        }
        
    }
    
    print_r( json_encode( $return ) );