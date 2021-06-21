<?
    session_start();
    
    ini_set('display_errors', '1');
    
    require "../../config.php";
    require "../../conexion.php";
    
    $respuesta = new stdClass();
    $respuesta->estado = 1;
    $respuesta->msg = "";
    $respuesta->data = array();
    
    $conexion = new Conexion();
    
    if($_SESSION['usuario']){
        $query = $conexion->buscarVariosRegistro("SELECT * FROM `tb_acopio` WHERE estado = 'A'");
        
        if( count($query) > 0 ){
            $respuesta->data = $query;
        }else{
            $respuesta->estado = 2;
            $respuesta->msg = "Sin data para mostrar";
        }
    }else{
        $respuesta->estado = 3;
        $respuesta->msg = "Debe iniciar session";
    }
            
    print_r( json_encode ( $respuesta ) );