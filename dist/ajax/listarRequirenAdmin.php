<?
    session_start();
    
    ini_set('display_errors', 1);
    
    require "../../config.php";
    require "../../conexion.php";
    require "../../funciones.php";
    
    $respuesta = new stdClass();
    $respuesta->estado = 1;
    $respuesta->msg = "";
    $respuesta->data = array();

    $conexion = new Conexion();
    
    if(isLogin()){
        $res = $conexion->buscarVariosRegistro("SELECT * , CONCAT(apellido,' ',nombre) AS usuario FROM tb_requirente");
        
        foreach($res as $key => $value){
            $value['estado2'] = "INACTIVO";
            if($value['estado']=="A"){
                $value['estado2'] = "ACTIVO";
            }
            $respuesta->data[] = $value;
        }
    }else{
        $respuesta->estado = 2;
        $respuesta->msg = "Debe Inicar session";
    }
    
    print_r( json_encode( $respuesta ) );