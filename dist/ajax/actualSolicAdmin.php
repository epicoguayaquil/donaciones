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
        
        $idSolicitud = 0;
        $estadoSolicitud = "E";
        
        if( isset($_POST['id']) && !empty($_POST['id']) ){
            $idSolicitud = $_POST['id'];
        }
        
        if( isset($_POST['estado']) && !empty($_POST['estado']) ){
            $estadoSolicitud = $_POST['estado'];
        }
        
        if(
            empty($idSolicitud) ||
            empty($estadoSolicitud)
        ){
            $respuesta->estado = 2;
            $respuesta->msg = "Parámetros vacíos";
        }
        
        $sql = "UPDATE tb_solicitud_donacion SET estado = ? WHERE id_solicitud_donacion = ?";
        $data = array($estadoSolicitud, $idSolicitud);
        
       
        $res = $conexion->ejecutar($sql, $data);
        
        if($res){
            $respuesta->msg = "Éxito ".$estadoSolicitud." - ".$idSolicitud;
        }else{
            $respuesta->msg = "Error";
        }
        
    }else{
        $respuesta->estado = 2;
        $respuesta->msg = "Debe Inicar session";
    }
    
    print_r( json_encode( $respuesta ) );