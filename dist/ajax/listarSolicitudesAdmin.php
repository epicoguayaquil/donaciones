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
        $query = "SELECT don.*, CONCAT( req.apellido,' ',req.nombre ) AS requirente, tipodona.nombre FROM `tb_solicitud_donacion` AS don
INNER join tb_requirente AS req
ON (don.id_usuario_requirente = req.id_requirente)
INNER JOIN tb_tipo_donacion as tipodona
ON (don.id_tipo_donacion = tipodona.id_tipo_donacion)
WHERE don.estado = 'P'";

        $sql  = trim($query);

        $res = $conexion->buscarVariosRegistro($sql);
        
        foreach($res as $key => $value){
            
            $value['combobox'] = "
                <select class='form-control estado'> 
                    <option value='A' ".($value['estado']=="A" ? 'selected':'')." >ACTIVAR</option> 
                    <option value='I' ".($value['estado']=="I" ? 'selected':'')." >INACTIVAR</option> 
                    <option value='P' ".($value['estado']=="P" ? 'selected':'')." >PENDIENTE</option> 
                    <option value='E' ".($value['estado']=="E" ? 'selected':'')." >ELIMINAR</option> 
                </select>";
            
            $respuesta->data[] = $value;
        }
    }else{
        $respuesta->estado = 2;
        $respuesta->msg = "Debe Inicar session";
    }
    
    print_r( json_encode( $respuesta ) );