<?
    session_start();
    
    if($_SESSION['usuario']){
        require "../../config.php";
        require "../../conexion.php";
        
        $return['estado'] = 1;
        
        $conexion = new Conexion();
        
        $restipodonacion = $conexion->buscarVariosRegistro("SELECT * FROM tb_tipo_donacion WHERE estado = 'A'");
        
        if( $restipodonacion )
        {
            $return['data'] = $restipodonacion;
        }else{
            $return['estado'] = 2;
            $return['msg'] = html_entity_decode("Sin datos para mostrar");
        }
        
    }else{
        $return['estado'] = 2;
        $return['msg'] = "Debe iniciar session";
    }
    
    print_r( json_encode( $return ) );