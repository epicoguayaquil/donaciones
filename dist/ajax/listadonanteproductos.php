<?
    session_start();
    
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    
    require "../../funciones.php";
    
    if(isLogin())
    { 
        //require "../../config.php";
        //require "../../conexion.php";
    
        $return['estado'] = 1;
        $return['msj'] = "";
        $return['data'] = array();
        
        $conexion = new Conexion();
        
        $listadonante = "SELECT * FROM tb_donante";
        
        $res = $conexion->buscarVariosRegistro($listadonante);
        
        if( count($res) > 0 )
        {
            foreach($res as $key => $value)
            {
                $resdonaciones = $conexion->buscarVariosRegistro("SELECT * FROM tb_producto_donate WHERE iddonante = '".$value['iddonante']."' ");
                
                if( count($resdonaciones) > 0 )
                {
                    $value['productos'] = $resdonaciones;
                }
                
                $return['data'][] = $value;
            }
        }
        
    }else{
        $return['estado'] = 2;
        $return['msj'] = "Debe inciar session";
    }
    
    print_r( json_encode( $return ) );