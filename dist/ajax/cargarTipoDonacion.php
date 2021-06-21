<?
    ini_set('display_errors','1');

    require "../../config.php";
    require "../../conexion.php";
    
    $conexion = new Conexion();
    
    $respuesta = new stdClass();
    $respuesta->estado = 1;
    $respuesta->msg = "";
    $respuesta->data = array();
    
    // Tipo de Donacion
    $sql = $conexion->buscarVariosRegistro("SELECT * FROM tb_tipo_donacion_web WHERE estado = ?",array("true"));
    
    $respuesta->data['donacion'] = $sql;
    
    // Voluntarios
    $voluntario = $conexion->buscarVariosRegistro("SELECT * FROM `tb_voluntarios`");
    
    $respuesta->data['voluntarios'] = $voluntario;
    
    print_r( json_encode( $respuesta ) );
