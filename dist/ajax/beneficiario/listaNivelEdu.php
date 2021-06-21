<?
    session_start();
    
    ini_set('display_errors', '1');
    
    if($_SESSION['usuario']){
    
        require "../../../config.php";
        require "../../../conexion.php";
        
        $conexion = new Conexion();
        
        $return['estado'] = 1;
        
        $NIVEL_EDU = $conexion->buscarVariosRegistro("SELECT * FROM tb_nivel_educativo WHERE estado = 'A'");
        
        if( count($NIVEL_EDU) > 0 )
        {
            $return['data'] = $NIVEL_EDU;
        }else{
            $return['estado'] = 2;
            $return['data'] = array();
        }
        
        
        
    }else{
        $return['estado'] = 3;
        $return['msg'] = "Debe iniciar session";
    }
    
    print_r( json_encode( $return ) );