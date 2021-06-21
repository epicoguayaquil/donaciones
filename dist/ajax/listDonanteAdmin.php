<?
    session_start();
    
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    
    require "../../config.php";
    require "../../conexion.php";
    require "../../funciones.php";
    
    if(isLogin()){ 
        
        $return['estado'] = 1;
        $return['msj'] = "";
        $return['data'] = array();
        
        $conexion = new Conexion();
        
        $resdonantes = $conexion->buscarVariosRegistro("SELECT * FROM tb_donante");
        
        foreach( $resdonantes as $key => $value ){
            
            $resproductos = $conexion->buscarVariosRegistro(" SELECT COUNT(*) AS TOTAL FROM tb_producto_donate WHERE iddonante = '".$value['iddonante']."' ");
            
            $value['total'] = $resproductos[0]['TOTAL'];
            
            $value['email'] = "crear campo mail";
            
           $return['data'][] = $value; 
        }
        
        /*
        $res = $conexion->buscarVariosRegistro("SELECT donante.*, nivel.nombre, concat(donante.apellido,' ',donante.nombre) AS usuario FROM `tb_donante` AS donante INNER JOIN tb_nivel_educativo AS nivel ON ( donante.id_nivel_educativo = nivel.id_nivel_educativo )");
        
        foreach($res as $key => $value){
            
            $value['tipopersona'] = "Natural";
            
            if($value['tipo_persona'] == "2"){
                $value['tipopersona'] = "jurídica";
            }
            
            if($value['genero'] == NULL){
                $value['genero'] = "SIN ESPECIFICAR";
            }
            
            if($value['profesion'] == NULL){
                $value['profesion'] = "SIN ESPECIFICAR";
            }
            
            $return['data'][] = $value;
        }
        */
    }else{
        $return['estado'] = 2;
        $return['msg'] = "Debe Inicar session";
    }
    
    print_r( json_encode( $return ) );