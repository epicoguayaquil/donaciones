<?
    ini_set('display_errors','1');
    
    session_start();

    require "../../../../config.php";
    require "../../conexion.php";
    
    $conexion = new Conexion();
    
    $respuesta = new stdClass();
    $respuesta->estado = 1;
    $respuesta->msg = "";
    $respuesta->data = array();
    
    if($_SESSION['usuario']){
        $res = $conexion->buscarVariosRegistro("SELECT * FROM `tb_voluntarios`");
        
        foreach( $res as $fila ){
            $fila['imagen'] = "../../images/team/".$fila['imagen'];
            
            $respuesta->data[] = $fila;
        }
        
    }else{
        $respuesta->estado = 2;
        $respuesta->msg = "Debe Iniciar Session";
    }
    
    print_r( json_encode( $respuesta ) );