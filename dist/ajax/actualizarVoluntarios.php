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
        
        $idvoluntario = 0;
        $nombresApellidos = "";
        $googleplus = "";
        $linkedin = "";
        $facebook = "";
        $twitter = "";
        
        if( 
            ( isset($_POST['idvoluntario']) && !empty($_POST['idvoluntario']) ) &&
            ( isset($_POST['nombresApellidos']) && !empty($_POST['nombresApellidos']) )
        ){
            $idvoluntario = intval($_POST['idvoluntario']);
            $nombresApellidos = htmlentities($_POST['nombresApellidos']);
        }
        
        if( isset($_POST['facebook']) && empty($_POST['facebook']) ){
            $facebook = htmlentities($_POST['facebook']);
        }
        
        if( isset($_POST['twitter']) && empty($_POST['twitter']) ){
            $twitter = htmlentities($_POST['twitter']);
        }
        
        if( isset($_POST['linkedin']) && empty($_POST['linkedin']) ){
            $linkedin = htmlentities($_POST['linkedin']);
        }
        
        if( isset($_POST['googleplus']) && empty($_POST['googleplus']) ){
            $googleplus = htmlentities($_POST['googleplus']);
        }
        
        $respuesta->msg = $nombresApellidos;
        
    }else{
        $respuesta->estado = 2;
        $respuesta->msg = "Debe Iniciar Session";
    }
    
    print_r( json_encode( $respuesta ) );