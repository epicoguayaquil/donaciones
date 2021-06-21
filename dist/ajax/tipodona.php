<?
    ini_set('display_errors','1');
    
    session_start();

    require "../../config.php";
    require "../../conexion.php";
    
    $conexion = new Conexion();
    
    $respuesta = new stdClass();
    $respuesta->estado = 1;
    $respuesta->msg = "";
    $respuesta->data = array();
    
    if($_SESSION['usuario']){
        
        $idtipodonacionweb = 0;
        $nombre = "";
        $nombre_hover = "";
        $detalle_donacion = "";
        $imagen_fondo = "";
        
        if( isset($_POST['idtipodonacionweb']) ){
            $idtipodonacionweb = intval($_POST['idtipodonacionweb']);
        }
        
        if( isset($_FILES['imagen_fondo']) ){
            $imagen_fondo = $_FILES['imagen_fondo'];
        }
        
        if(
            ( isset($_POST['detalle_donacion']) && !empty($_POST['detalle_donacion']) ) &&   
            ( isset($_POST['nombre']) && !empty($_POST['nombre']) ) &&   
            ( isset($_POST['nombre_hover']) && !empty($_POST['nombre_hover']) )  
        ){
            $nombre = htmlentities($_POST['nombre']);
            $nombre_hover = htmlentities($_POST['nombre_hover']);
            $detalle_donacion = htmlentities($_POST['detalle_donacion']);
        }
        
        if(
            empty($nombre) ||
            empty($nombre_hover) ||
            empty($detalle_donacion)
        ){
            $respuesta->estado = 2;
            $respuesta->msg = "Parámetros vacíos";
        }
        
        $sql = "UPDATE tb_tipo_donacion_web SET nombre='$nombre', nombre_hover='$nombre_hover', detalle_donacion='$detalle_donacion' ";
        
        if(!empty($imagen_fondo)){
            $ext = explode('/',$imagen_fondo['type']);
            $nameFile = date("YmdHis").'.'.$ext[1];
        
                if(in_array($ext[1], array('png','jpg','jpeg'))){
                    
                    $nameFile = date("YmdHis").'.'.$ext[1];
                    
                    if(move_uploaded_file($imagen_fondo['tmp_name'], '../../../../images/about/'.$nameFile)){
                        $sql .= ", imagen_fondo = '$nameFile' ";
                    }
                }else{
                    $respuesta->estado = 2;
                    $respuesta->msg = "Formato no soportado";
                    $respuesta->data = $imagen_fondo;
                }
        }
        
        $sql .= "WHERE idtipodonacionweb = '$idtipodonacionweb' ";
        
        $res = $conexion->UpdateRegistro($sql);
        
        if($res){
            $respuesta->msg = "Exito";
        }else{
            $respuesta->msg = "Fallo";
            $respuesta->estado = 2;
        }
    }else{
        $respuesta->estado = 2;
        $respuesta->msg = "Debe iniciar session";
    }
    
    
    print_r( json_encode( $respuesta ) );