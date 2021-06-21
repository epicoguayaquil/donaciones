<?php
session_start();
ob_start();
include("../../conexion.php");
require_once "../../class/acopio_guardar.php";

date_default_timezone_set('America/Guayaquil');
	   //  id_acopio	id_requirente	nombre	estado	direccion
if(isset($_GET['metodo']))
{
	$metodo = $_GET['metodo'];
	
	if($metodo == "GUARDAR_ACOPIO")
	{
	    $pasar=1;
	    $mensaje=0;
	   
	    
	    if(isset($_POST['nombre'])){
	        $nombre=$_POST['nombre'];
	        if($nombre == "" || $nombre == null){
	            $pasar=0;
	            $mensaje="Tiene que agregar un nombre";
	           
	        }else
	            if(!preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/',$nombre)){
	                 $pasar=0;
	                 $mensaje="Solo se aceptan letras";
	                   
	               }
	    }else{
	        $nombre="";
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

	    
	    
	    if($pasar){
	        $Guardar_ =new guardar();
    	    $guardar_requirente = $Guardar_->guardar_acopio($nombre,$direccion);
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
