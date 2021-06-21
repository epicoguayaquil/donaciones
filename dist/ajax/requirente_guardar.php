<?php
session_start();
ob_start();
include("../../conexion.php");
require_once "../../class/requirente_guardar.php";

date_default_timezone_set('America/Guayaquil');

if(isset($_GET['metodo']))
{
	$metodo = $_GET['metodo'];
	
	if($metodo == "GUARDAR_REQUIRENTE")
	{
	    $pasar=1;
	    $mensaje=0;
	    $nombre=$_POST['nombre'];
	    if(isset($_POST['nombre'])){
	        $nombre=$_POST['nombre'];
	        if($nombre == "" || $nombre == null){
	            $pasar=0;
	            $mensaje="Tiene que agregar un nombre";
	        }
	    }else{
	        $nombre="";
	    }
	    if(isset($_POST['apellido'])){
	        $apellido = $_POST['apellido'];
	        if($apellido == "" || $apellido == null){
	            $pasar=0;
	            $mensaje="Tiene que agregar un apellido";
	        }
	    }else{
	        $apellido = "";
	    }
	    
	        
	    if(isset($_POST['email'])){
	        $email=$_POST['email'];
	        if($email=="" || $email==null){
	            $pasar=0;
	            $mensaje="Tiene que agregar el email";
	        }
	    }else{
	        $email="";
	    }
	  

	    if(isset($_POST['direccion'])){
	        $direccion=$_POST['direccion'];
	        if($direccion == "" || $direccion == null){
	            $pasar=0;
	            $mensaje="Tiene que agregar la dirección";
	        }
	    }else{
	        $direccion="";
	    }
	    
	    
	    if(isset($_POST['password'])){
	        $password=$_POST['password'];
	        if($password == "" || $password == null){
	            $pasar=0;
	            $mensaje="Tiene que agregar la contraseña";
	        }
	    }else{
	        $password="";
	    }
	    
	    
	    
	    
	    if($pasar){
	        $Guardar_ =new guardar();
    	    $guardar_requirente = $Guardar_->guardar_requirente($nombre,$apellido,$email,$direccion,$password);
            if($guardar_requirente){
                $return['success'] = 1;
    		    $return['mensaje'] = "Guardado de manera correcta, Esta ventana se cerrara.";
            }else{
                $return['success'] = 0;
    		    $return['mensaje'] = "No se pudo guardar sus datos";
            }    
	    }else{
	        $return['success'] = 0;
    	    $return['mensaje'] = $mensaje;
	    }
	    
		
	}
	else
	{
		$return['success'] = 0;
		$return['mensaje'] = "Metodo no existente";
	}

}
/*
else
{
	$return['success'] = 0;
	$return['mensaje'] = "Faltan datos";
}
*/


header('Content-Type: application/json');
echo json_encode($return);


?>
