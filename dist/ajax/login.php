<?
ini_set('display_errors', 1);
			
    include_once('../../config.php');
    include_once('../../conexion.php');
    
    $respuesta = new stdClass();
    $respuesta->estado = 1;
    $respuesta->msg = "";
    $respuesta->data = array();
    
    $conexion = new Conexion();
    
    $usuario = "";
    $contrasena = "";
    
    if( isset($_POST['usuario']) && !empty($_POST['usuario']) ){
        $usuario = ($_POST['usuario']);
    }
    
    if( isset($_POST['contrasena']) && !empty($_POST['contrasena']) ){
        $contrasena = $_POST['contrasena'];
    }
    
    if( !filter_var( $usuario, FILTER_VALIDATE_EMAIL) ){
        $respuesta->estado = 2;
        $respuesta->msg = "El E-mail ingresado no es válido";
    }
    
   //$query = ("SELECT idusuario, ro.idRol as idrol, ro.nombre as rol, us.nombre as nombre, us.correo FROM tb_usuario AS us INNER JOIN tb_rol AS ro ON (us.idrol = ro.idRol) WHERE us.correo = '$usuario' AND contrasena = '$contrasena' LIMIT 1");
    $query = "SELECT rol.rol_id as idrol, rol.rol, rol.tabla, rol.campoId, usu.id, usu.usu_id,usu.nombre as nombre, usu.usuario, usu.estado FROM `tb_usuario` AS usu INNER JOIN tb_rol AS rol ON ( usu.rol_id = rol.rol_id ) 
   WHERE usu.usuario = '$usuario' AND usu.clave = '$contrasena' LIMIT 1";
    
    $res = $conexion->buscarRegistro($query);
    
    
    if($res)
    {
        session_start();
        
        $query2 = "SELECT * FROM ".$res[0]['tabla']." WHERE ".$res[0]['campoId']." = '".$res[0]['id']."' ";
           
        $sql2 = trim($query2);
        
        $res2 = $conexion->buscarRegistro($sql2);
        
        //$respuesta->data = $res2;
        
        $_SESSION['nombre'] = $res[0]['nombre'];
        
        
        $_SESSION['usu_id'] = $res[0]['usu_id'];
        $_SESSION['id'] = $res[0]['id'];
        $_SESSION['usuario'] = $res[0]['usuario'];
        
        $_SESSION['idrol'] = $res[0]['idrol'];
        $_SESSION['rol'] = $res[0]['rol'];
        
        // $_SESSION['campoCausa'] = $res[0]['campoCausa'];
        
    }else{
        $respuesta->estado = 2;
        $respuesta->msg = "Credenciales Incorrectas [usuario - contraseña] ";
        
    }
    
    $respuesta->data = $res;
    
     print_r( json_encode( $respuesta ) );
    