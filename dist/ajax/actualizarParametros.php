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
        
        $idparametro = 0;
        
        $nombre = "";
        $nombre2 = "";
        
        $str_val = "";
        $str_val2 = "";
        
        if(
            isset($_POST['idparametro'])    
        ){
            $idparametro = $_POST['idparametro'];
        }
        
        
        if(
            isset($_POST['nombre']) && !empty($_POST['nombre'])   
        ){
            $nombre = $_POST['nombre'];
        }
        
        if( isset($_POST['nombre2']) ){
            $nombre2 = $_POST['nombre2'];
            
        }
        
        
        if(
            isset($_POST['str_val']) && !empty($_POST['str_val'])   
        ){
            $str_val = $_POST['str_val'];
        }
        
        if(
            isset($_POST['str_val2'])  
        ){
            $str_val2 = $_POST['str_val2'];
        }
        
        
        if(
            isset($_FILES['str_val']) && !empty($_FILES['str_val'])   
        ){
            $str_val = $_FILES['str_val'];
        }
        
        if(
            isset($_FILES['str_val2'])  
        ){
            $str_val2 = $_FILES['str_val2'];
        }
        
        $sql = "UPDATE tb_parametro SET nombre=?, str_val=?, nombre2=?, str_val2=? WHERE id_parametro = ?";
        $sqlData = array($nombre, $str_val, $nombre2, $str_val2, $idparametro);
        
        $res = $conexion->ejecutar($sql,$sqlData);
        
        if(!$res){
            $respuesta->msg = "Error";
            $respuesta->estado =2;
        }
        
    }else{
        $respuesta->estado = 2;
        $respuesta->msg = "Debe iniciar session";
    }
    
    print_r( json_encode( $respuesta ) );