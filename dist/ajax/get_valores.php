<?php
session_start();
ob_start();
include("../../conexion.php");

date_default_timezone_set('America/Guayaquil');
if(isset($_GET['metodo']))
{
	$metodo = $_GET['metodo'];
	
	if($metodo == "TRAER_DATOS")
	{
	    $return['success'] = 1;
	    $TIPO=$_POST['tipo'];
	    if($TIPO==1){
	        
	        $fechaN = strtotime ('-19 year' , strtotime(date("Y-m-d")));
	        $fechaActual = date("Y-m-d", strtotime ('-19 year' , strtotime(date("Y-m-d"))) );
	        
	        $body.='
	            <div class="row">
	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
    	                <div style="text-align: left;">
                            <label> Nombres</label>
                            <input type="text" id="txt_nombres" style="margin: 0 0 5px;" name="txt_nombres" placeholder="Ingrese sus Nombres" required class="form-control"/>
                        </div>
	                </div>
                </div>
                
                <div class="row">
	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                        <div style="text-align: left;">
                            <label> Apellidos</label>
                            <input type="text" class="form-control" id="txt_apellidos" style="margin: 0 0 5px;" name="txt_apellidos" placeholder="Ingrese sus Apellidos" required="" />
                        </div>
	                </div>
                </div>
                
                <div class="row">
	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                        <div style="text-align: left;">
                            <label> N&uacute;mero Doc.</label>
                            <input type="text" class="form-control" id="txt_numDoc" style="margin: 0 0 5px;" name="txt_numDoc" onkeypress="return valideKey(event);" placeholder="Ingrese su N&uacute;mero de documento" required="" />
                        </div>
	                </div>
                </div>
                
                <div class="row">
	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                        <div style="text-align: left;">
                            <label> Número de teléfono</label>
                            <input type="text" class="form-control" id="txt_telefono" style="margin: 0 0 5px;"  onkeypress="return valideKey(event);" maxlength="15" name="txt_telefono" placeholder="Número de telefono" onlyNumber required="" />
                        </div>
	                </div>
                </div>
                
                <div class="row">
	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                        <div style="text-align: left;">
                            <label> Correo</label>
                            <input type="text" class="form-control" id="txt_correo" style="margin: 0 0 5px;" name="txt_correo" placeholder="Ingrese su Correo" onlyNumber required="" />
                        </div>
	                </div>
                </div>
                
                <div class="row">
	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                        <div style="text-align: left;">
                            <label> Direcci&oacute;n</label>
                            <input type="text" class="form-control" id="txt_address" style="margin: 0 0 5px;" name="txt_address" placeholder="Ingrese su direcci&oacute;n" onlyNumber required="" />
                        </div>
	                </div>
                </div>
                
                <div class="row">
	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                        <div style="text-align: left;">
                            <label> Parroquia </label>
                            <input type="text" class="form-control" id="txt_parroquia" style="margin: 0 0 5px;" name="txt_parroquia" placeholder="Ingrese la parroquia" onlyNumber required="" />
                        </div>
	                </div>
                </div>
                
                <div class="row">
	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                        <div style="text-align: left;">
                            <label> G&eacute;nero</label>
                            <select id="txt_genero" name="txt_genero" class="form-control col-md-7 col-xs-12"   style="margin-bottom: 2%;">
                                <option value="0">Selecciones Genero</option>
                                <option value="1">Masculino</option>
                                <option value="2">Femenino</option>
                            </select>
                        </div>
	                </div>
                </div>
                
                <div class="row">
	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                        <div style="text-align: left;">
                            <label>Nivel Educativo</label>
                            <select id="txt_educativo" name="txt_educativo" class="form-control col-md-7 col-xs-12"   style="margin-bottom: 2%;" >';
                    
    $consulta=Conexion::buscarVariosRegistro("SELECT * FROM tb_nivel_educativo where estado = 'A' ");
                        $body .="<option value='0'>Seleccione nivel educativo</option>";
                                 foreach($consulta as $fila){
$body.='<option value="'.$fila['id_nivel_educativo'].'">'.$fila['nombre'].'</option>';
                        }  
                        $body.='
                            </select>
                        </div>
	                </div>
                </div>
                
                <div class="row">
	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                        <div style="text-align: left;">
                            <label> Fecha Nacimiento</label>
                            <input type="date"  id="txt_fechaNacimiento" class="form-control col-md-7 col-xs-12" style="margin: 0 0 5px;" name="txt_fechaNacimiento" value="'.date("Y-m-d", strtotime ('-19 year' , strtotime(date("Y-m-d"))) ).'" placeholder="Ingrese su Fecha Nacimiento"  required="" />
                            
                        </div>
	                </div>
                </div>
                    ';
	    }else if($TIPO==2){
	        $body='
	            
                <div class="row">
	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
    	                <div style="text-align: left;">
                            <label> Raz&oacute;n Social</label>
                            <input type="text" class="form-control" id="txt_razonSocial" style="margin: 0 0 5px;" name="txt_razonSocial" placeholder="Ingrese raz&oacute;n social" required="" />
                        </div>
	                </div>
                </div>
                
                <div class="row">
	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                        <div style="text-align: left;">
                            <label> N&uacute;mero Doc.</label>
                            <input type="text" class="form-control" id="txt_numDoc" style="margin: 0 0 5px;" name="txt_numDoc" onkeypress="return valideKey(event);" placeholder="Ingrese su N&uacute;mero de documento" required="" />
                        </div>
	                </div>
                </div>
                
                <div class="row">
	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                        <div style="text-align: left;">
                            <label> Persona Contacto</label>
                            <input type="text" class="form-control" id="txt_personaContacto" style="margin: 0 0 5px;" name="txt_personaContacto" placeholder="Ingrese sus persona contacto" required="" />
                        </div>
	                </div>
                </div>
                
                <div class="row">
	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                        <div style="text-align: left;">
                            <label> Tel&eacute;fono Contacto</label>
                            <input type="text" class="form-control" id="txt_telefonoContacto" onkeypress="return valideKey(event);" style="margin: 0 0 5px;" name="txt_telefonoContacto" placeholder="Ingrese su t&eacute;lefono contacto" required="" />
                        </div>
	                </div>
                </div>
                
                <div class="row">
	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                        <div style="text-align: left;">
                            <label> Correo</label>
                            <input type="text" class="form-control" id="txt_correo" style="margin: 0 0 5px;" name="txt_correo" placeholder="Ingrese su Correo" onlyNumber required="" />
                        </div>
	                </div>
                </div>
                
                <div class="row">
	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                        <div style="text-align: left;">
                            <label> Direcci&oacute;n</label>
                            <input type="text" class="form-control" id="txt_address" style="margin: 0 0 5px;" name="txt_address" placeholder="Ingrese su direcci&oacute;n" onlyNumber required="" />
                        </div>
                    </div>
                </div>
                    
                    ';
	    }
	    
		$return['body'] =$body;
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
