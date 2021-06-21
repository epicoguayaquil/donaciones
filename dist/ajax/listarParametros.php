<?
	ini_set('display_errors','1');
    session_start();
	
    include_once('../../config.php');
    include_once('../../conexion.php');
    
    $respuesta = new stdClass();
    $respuesta->estado = 1;
    $respuesta->msg = "";
    $respuesta->data = array();
    
    $conexion = new Conexion();
    
    if($_SESSION['usuario']){
        $sql = "SELECT * FROM tb_parametro";
        $query = $conexion->buscarVariosRegistro($sql);
        
        $total = array();
        
        foreach($query as $fila){
            $fila['estadoaux'] = $fila['estado'] == "A" ? "ACTIVO" : "INACTIVO";
            
            if( preg_match('/#/', $fila['str_val']) ){
                $fila['inputColor'] = "<input type='color' value='". $fila['str_val']."' disabled />";
            }else{
                $fila['inputColor'] = $fila['str_val'];
            } 
            
            if( preg_match('/#/', $fila['str_val2']) ){
                $fila['inputColor2'] = "<input type='color' value='". $fila['str_val2']."' disabled />";
            }else{
                $fila['inputColor2'] = $fila['str_val2'];
            }
            $total[] = $fila;
        }
        
        if( count($total) > 0 ){
            $respuesta->data = $total;
        }else{
            $respuesta->estado = 2;
            $respuesta->msg = "Sin datos para mostrar";
        }
    }else{
        $respuesta->estado = 2;
        $respuesta->msg = "Debe iniciar session";
    }
    
    print_r( json_encode( $respuesta ) );