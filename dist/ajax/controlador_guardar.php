<?php
session_start();
ob_start();
include("../../conexion.php");
require_once "../../class/contra_guardar.php";

date_default_timezone_set('America/Guayaquil');
if(isset($_GET['metodo']))
{
	$metodo = $_GET['metodo'];
	
	if($metodo == "GUARDAR_DONANTE")
	{
	    $pasar=1;
	    $mensaje=0;
	    $tipo_persona=$_POST['txt_tipo_persona'];
	    if(isset($_POST['txt_nombres'])){
	        $nombres=$_POST['txt_nombres'];
	        if($nombres=="" || $nombres==null){
	            $pasar=0;
	            $mensaje="Tiene que agregar un nombre";
	        }
	    }else{
	        $nombres="";
	    }
	    if(isset($_POST['txt_apellidos'])){
	        $apellidos=$_POST['txt_apellidos'];
	        if($apellidos=="" || $apellidos==null){
	            $pasar=0;
	            $mensaje="Tiene que agregar un apellido";
	        }
	    }else{
	        $apellidos="";
	    }
	    if(isset($_POST['txt_genero'])){
	        $genero=$_POST['txt_genero'];
	    }else{
	        $genero="INDEFENIDO";
	    }
	    if(isset($_POST['txt_educativo'])){
	        $n_educativo=$_POST['txt_educativo'];
	    }else{
	        $n_educativo=0;
	    }
	    if(isset($_POST['txt_profesion'])){
	        $profesion=$_POST['txt_profesion'];
	        if($profesion=="" || $profesion==null){
	            $pasar=0;
	            $mensaje=html_entity_decode("Tiene que agregar una profesi&oacute;n");
	        }
	    }else{
	        $profesion="";
	    }
	    
	    if(isset($_POST['txt_fechaNacimiento'])){
	        $fecha_nac=$_POST['txt_fechaNacimiento'];
	        if($fecha_nac=="" || $fecha_nac==null){
	            $pasar=0;
	            $mensaje=html_entity_decode("Fecha nacimiento no valida");
	        }
	    }else{
	        $fecha_nac="";
	    }
	    if(isset($_POST['txt_razonSocial'])){
	        $razon_social=$_POST['txt_razonSocial'];
	        if($razon_social=="" || $razon_social==null){
	            $pasar=0;
	            $mensaje=html_entity_decode("Tiene que agregar una raz&oacute;n social");
	        }
	    }else{
	        $razon_social="";
	    }
	    
	    if(isset($_POST['txt_personaContacto'])){
	        $person_contac=$_POST['txt_personaContacto'];
	        if($person_contac=="" || $person_contac==null){
	            $pasar=0;
	            $mensaje=html_entity_decode("Tiene que agregar una persona de contacto");
	        }
	    }else{
	        $person_contac="";
	    }
	    
	    if(isset($_POST['txt_telefonoContacto'])){
	        $tel_contac=$_POST['txt_telefonoContacto'];
	        if($tel_contac=="" || $tel_contac==null){
	            $pasar=0;
	            $mensaje=html_entity_decode("Tiene que agregar un telefono de contacto");
	        }
	    }else{
	        $tel_contac="";
	    }
	    
	    if(isset($_POST['txt_address'])){
	        $direccion=$_POST['txt_address'];
	        if($direccion=="" || $direccion==null){
	            $pasar=0;
	            $mensaje=html_entity_decode("Tiene que agregar una direccion");
	        }
	    }else{
	        $direccion="";
	    }
	    
	    $password=$_POST['txt_pass'];
        if($password=="" || $password==null){
            $pasar=0;
            $mensaje=html_entity_decode("Tiene que agregar una direccion");
        }
	    $num_doc=$_POST['txt_numDoc'];
	    $correo=$_POST['txt_correo'];
	    
	    if($pasar){
	        $Guardar_ =new guardar();
    	    $guardar_donante = $Guardar_->guardar_donante($tipo_persona,$nombres,$apellidos,$genero,$n_educativo,$profesion,$fecha_nac,$razon_social,$person_contac,$tel_contac,$direccion,$num_doc,$correo,$password);
            if($guardar_donante){
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
else
{
	$return['success'] = 0;
	$return['mensaje'] = "Faltan datos";
}

header('Content-Type: application/json');
echo json_encode($return);

?>
