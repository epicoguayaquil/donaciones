<?php
require_once("conexion.php");

function titulo_header(){
    
        
        $query=Conexion::buscarRegistro("SELECT * FROM tb_parametro where nombre='title' ");
        echo '<title>'.$query[0]['valor'].'</title>';
        
        $query1=Conexion::buscarRegistro("SELECT * FROM tb_parametro where nombre='logo' ");
        echo '<link rel="icon" type="image/png" href="images/logo/'.$query1[0]['valor'].'">';
}

function anual(){
   echo " <label>A&ntilde;o</label><select name='id_ano' id='id_ano' onchange='cargaranio()'>"; 
      $anio_act=date("Y");
      echo '<option value="0" selected>Seleccione un a&ntilde;o</option>';
        for($i=$anio_act; $i>=2020; $i--){
            if ($i == $anio_act)
                echo '<option value="'.$i.'" >'.$i.'</option>';
            else
                echo '<option value="'.$i.'">'.$i.'</option>';
        }
                                  
    echo" </select>";
}
function fechaInicio()
{
    $month_start = strtotime('first day of this month', time());
    $fecha=date('Y-m-d', $month_start);
    $anio=date("Y-m-d");
    echo '<label>Fecha Inicio:</label>';
    echo '<input type="date" id="fechainicio" name="fechainicio" value="'.$fecha.'"   max="'.$anio.'">';
  
}

function fechaFin(){
    $anio=date("Y-m-d");
    $month_start = strtotime('first day of this month', time());
    $fecha=date('Y-m-d', $month_start);
    echo '<label>Fecha Inicio:</label>';
    echo '<input type="date" id="fechafin"  name="fechafin" value="'.$anio.'"  min="'.$fecha.'" max="'.$anio.'">';
}
function especialidades(){
    $especialidades=Conexion::buscarVariosRegistro("SELECT cod_especialidad,especialidad FROM `tb_especialidades` WHERE estado ='A'");
         if($especialidades){
             echo '<select name="especialidades" id="especialidades">';
             foreach($especialidades as $e){
             echo '<option value="'.$e['cod_especialidad'].'">'.$e['especialidad'].'</opction>';
             }
             echo '<select>';
         }
}
function nombreImg()
{
	date_default_timezone_set('America/Guayaquil');
	$time = time();
	$fecha = date("Y_m_d_H_i_s", $time);	
	return $fecha;
}


function isLogin()
 {
 	if(isset($_SESSION['usuario']))
 	{
	 	if($_SESSION['usuario']!= NULL)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}	
 }
 
function borrar_imagenes($ruta,$extension)
{
	
	switch ($extension) {
		case '.jpg':
			if(file_exists($ruta.".png"))
				unlink($ruta.".png");
			if(file_exists($ruta.".gif"))
				unlink($ruta.".gif");
			break;
		case '.gif':
			if(file_exists($ruta.".png"))
				unlink($ruta.".png");
			if(file_exists($ruta.".jpg"))
				unlink($ruta.".jpg");
			break;
		case '.png':
			if(file_exists($ruta.".jpg"))
				unlink($ruta.".jpg");
			if(file_exists($ruta.".gif"))
				unlink($ruta.".gif");
			break;		
		
		
	}
}
	
	
	//funcion para subir imagenes en php
	function subir_imagenes($tipo,$imagen,$descripcion,$ruta,$size)
	{
			//return "La imagen".$tipo." No se subio";
			if(strstr($tipo,"image"))
			{

				if(strstr($tipo,"jpeg"))
					$extension=".jpg";
				else if(strstr($tipo,"gif"))
					$extension=".gif";
				else if(strstr($tipo,"png"))
					$extension=".png";
				//para saber si la imagen tiene el ancho correcto es de 420px
				$tam_img=getimagesize($imagen);
				$ancho_img=$tam_img[0];
				$alto_img =$tam_img[1];
				$ancho_img_deseado=$size;

				//sii la imagen es maor en su ancho a 420px reajusto su tamaño
					if($ancho_img > $ancho_img_deseado)
					{
						//reajustamos
						//por una regla de tres obtengo el alto de la imagen de manera 
						//proporciaonal  el ancho  nuevo  que sera 420
						$nuevo_ancho_img = $ancho_img_deseado;
						$nuevo_alto_img=($alto_img*$nuevo_ancho_img)/$ancho_img;
						//CREO UNA IMAGEN EN COLOR REAL CON LA NUEVAS DIMENSIONES
					
						$img_reajustada=imagecreatetruecolor($nuevo_ancho_img, $nuevo_alto_img);
						//CREO UNA IMAGEN BASADA EN LA ORIGINAL DEPENDIENDO DE SU EXTENSION ES EL TIPO QUE CREARE
						switch ($extension) {
							case '.jpg':
								$img_original=imagecreatefromjpeg($imagen);
								//REAJUSTO LA IMAGEN NUEVA CON RESPETO ALA ORIGINAL 
								imagecopyresampled($img_reajustada, $img_original, 0, 0, 0, 0, $nuevo_ancho_img, $nuevo_alto_img, 
									$ancho_img, $alto_img);
								//Guardo la imagen  reescalada en el servidor 
								$nombre_img_ext=$ruta.$descripcion.$extension;
								$nombre_img=$ruta.$descripcion;
								imagejpeg($img_reajustada,$nombre_img_ext,100);
								//ejecuto la funcion para borrar posibles imagenes dobles del perfil
								borrar_imagenes($nombre_img,".jpg");
								break;

							case '.gif':
								$img_original=imagecreatefromgif($imagen);
								//REAJUSTO LA IMAGEN NUEVA CON RESPETO ALA ORIGINAL 
								imagecopyresampled($img_reajustada, $img_original, 0, 0, 0, 0, $nuevo_ancho_img, $nuevo_alto_img, 
									$ancho_img, $alto_img);
								//Guardo la imagen  reescalada en el servidor 
								$nombre_img_ext=$ruta.$descripcion.$extension;
								$nombre_img=$ruta.$descripcion;
								imagegif($img_reajustada,$nombre_img_ext,100);
								//ejecuto la funcion para borrar posibles imagenes dobles del perfil
								borrar_imagenes($nombre_img,".gif");
								break;

							case '.png':								
								$img_original=imagecreatefrompng($imagen);
								//REAJUSTO LA IMAGEN NUEVA CON RESPETO ALA ORIGINAL 
							
								imagesavealpha($img_reajustada, true);
								imagealphablending($img_reajustada, false);	
								imagecopyresampled($img_reajustada, $img_original, 0, 0, 0, 0, $nuevo_ancho_img, $nuevo_alto_img, 
								$ancho_img, $alto_img);
								imagecolortransparent($img_reajustada);
								//Guardo la imagen  reescalada en el servidor 
								$nombre_img_ext=$ruta.$descripcion.$extension;
								$nombre_img=$ruta.$descripcion;
								imagepng($img_reajustada,$nombre_img_ext,0);
								//ejecuto la funcion para borrar posibles imagenes dobles del perfil
								borrar_imagenes($nombre_img,".png");
								break;
						}
					
					}
					else
					{
						//no se reajusta y se sube
						$destino=$ruta.$descripcion.$extension;

						//Se sube la foto
						move_uploaded_file($imagen,$destino) /*or die("No se pudo subir la imagen")*/;

						//ejecuto la funcion para borrar posibles imagenes dobles para el perfil
						$nombre_img=$ruta.$descripcion;
						borrar_imagenes($nombre_img,$extension);
					}
					//Asigno el nombre que el que se guardara en la base de datos
					$imagen=$descripcion.$extension;
					return $imagen;
			}
			else
			{
				return "La imagen".$imagen." No se subio";
			}

	}


	function duracion(){
    echo '
    <select name="duracion" id="duracion" class="duracion">';
                    echo '<option value="0">Seleccione una opcion</option>';
                    $acumulador=0;
                    $duracion=Conexion::buscarRegistro("SELECT intervalo,tiempo FROM `tb_configuracion` where cod_configuracion=1");
                    $vueltas=($duracion['tiempo']/$duracion['intervalo']);
                    for ($i=0;$i<$vueltas;$i++){
                        $acumulador=$duracion['intervalo']+$acumulador;
                        echo "<option value='".$acumulador."'>".$acumulador."</option>";
                        
                    }
                    
   echo '</select> ';
}

function mapa()
{
    echo'
        <div class="modal fade" id="modalGPS" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false" style="display: block;
            transition: all 0.6s ease 0s;position: fixed;left: 0px;right: 0px;top: 0px;bottom: 0px;background-color:rgb(255 255 255 / 55%);padding-right: 17px;">
                <div class="modal-dialog modal-lg" role="document">
    
                    <!--Content0-->
                    <div class="modal-content">
                        <!--Body-->
                        <div class="modal-body mb-0 p-0">
    
                            <!--Google map-->
                            <div id="map-container-google-18" class="z-depth-1-half map-container-11"  style="height: 400px;">
                                <fieldset class="gllpLatlonPicker" style="text-align: center;">
                                    <h2 style="color: #9d1d96;"><b style="font-weight: 700; font-size: 28px;">Se&ntilde;ala tu direcci&oacute;n en el mapa</b></h2>
                                    <iframe src="busqueda_lugar.php" id="busqueda_lugar"></iframe>
                                </fieldset>
                            </div>
                        </div>
                        <!--Footer-->
                        <div class="modal-footer justify-content-center">
                            <button type="submit" id="btnSave" name="btnSave" onclick="view_my_report();" class="btn btn-secondary btn-md" style="cursor: pointer;color: #6b6b6b;
                            background-color: #ffffff !important;display: block;width: 100%;overflow: hidden;text-overflow: ellipsis;
                            padding: 16px 28px;font-weight: 700;text-decoration: none;font-size: 18px;border-radius: 100px;max-width: 340px;margin: 0 auto;
                            box-sizing: border-box;border: solid 2px #6f146e;">Guardar Localizacion <i class="fas fa-map-marker-alt ml-1"></i></button>
                        </div>
                    </div>
                    <!--/.Content-->
                </div>
            </div>
    ';
}

    function donantes($ext = 'php'){
        $links = array('registrar','listar');
        $lista = ' <li><a><i class="fa fa-home"></i> Donantes <span class="fa fa-chevron-down"></span></a> <ul class="nav child_menu">';
        for($i = 0; $i < count($links); $i++){
            $nuevoLink = str_replace("","-",$links[$i]);
            $lista .= "<li> <a href=' ".$nuevoLink.".".$ext." ' > ".ucwords($links[$i])." </a> </li>";
        }
        $lista .= " </ul> </li>";
        
        print_r($lista);
    }
    
    function causas(){
        $links = array('listar causas', 'registrar nueva causa');
        $lista = ' <li><a><i class="fa fa-home"></i> Causas <span class="fa fa-chevron-down"></span></a> <ul class="nav child_menu">';
        for($i = 0; $i < count($links); $i++){
            $nuevoLink = str_replace(" ","",$links[$i]);
            $lista .= "<li> <a href='".$nuevoLink.".php' > ".ucwords($links[$i])." </a> </li>";
        }
        $lista .= " </ul> </li>";
        
        print_r($lista);
    }
function menu_lateral()
{
    echo '
    <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"> <span>#GuayaquilSolidario</span></a>
            </div>

            <div class="clearfix"></div>

            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span> Bienvenid@ </span>
                <h2> '.$_SESSION['nombre'].'</h2>
              </div>
            </div>

            <br />

            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">';
                
                    if( strtolower ($_SESSION['rol']) == "donante" ){
                        donantes();
                    }
                    if( strtolower ($_SESSION['rol']) == "requirente" ){
                        requirente();
                    }
                    if(strtolower ($_SESSION['rol']) == 'administrador'){
                    echo'
                        <ul class="nav side-menu">
                            <li class="active"><a ><i class="fa fa-edit"></i> Causas <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: block;">
                                    <li><a href="registrarsolicitud.php">Registrar Causa </a></li>
                                    <li><a href="#">Listado Causas </a></li>
                                    <!--<li><a href="listadoSolicitud.php">Listado Causas </a></li>-->
                                </ul>
                            </li>
                            <li><a><i class="fa fa-edit"></i> Donante <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                  <li><a href="listadoDonante.php">Listado de Donantes</a></li>
                                  <li><a href="registro.php">Registrar Donante</a></li>
                                </ul>
                            </li>
                            <li><a><i class="fa fa-desktop"></i> Requirente <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="listadoRequirente.php">Listado de Requirentes</a></li>
                                </ul>
                            </li>
                            
                            <li><a><i class="fa fa-desktop"></i> Parametros <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="parametro.php">Parametros</a></li>
                                    <li><a href="tipodona.php">Tipo de donaci&oacute;n</a></li>
                                    <li><a href="voluntario.php">Voluntarios</a></li>
                                </ul>
                            </li>
                            
                        </ul>
                        ';
                    
                    }
                 echo'
                
               
                </ul>
              </div>
              <!--
              <div class="menu_section">
                <h3>Live On</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="e_commerce.html">E-commerce</a></li>
                      <li><a href="projects.html">Projects</a></li>
                      <li><a href="project_detail.html">Project Detail</a></li>
                      <li><a href="contacts.html">Contacts</a></li>
                      <li><a href="profile.html">Profile</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="page_403.html">403 Error</a></li>
                      <li><a href="page_404.html">404 Error</a></li>
                      <li><a href="page_500.html">500 Error</a></li>
                      <li><a href="plain_page.html">Plain Page</a></li>
                      <li><a href="login.html">Login Page</a></li>
                      <li><a href="pricing_tables.html">Pricing Tables</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#level1_1">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="level2.html">Level Two</a>
                            </li>
                            <li><a href="#level2_1">Level Two</a>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                        <li><a href="#level1_2">Level One</a>
                        </li>
                    </ul>
                  </li>                  
                  <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
                </ul>
              </div>
              -->
            </div>
            
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
          </div>
        </div>
    ';
}

function menu_lateral_v2()
{
    echo '
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="index.php" class="site_title"> <span>#GuayaquilSolidario</span></a>
                </div>
                
                <div class="clearfix"></div>
                
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <!-- <img src="images/img.jpg" alt="..." class="img-circle profile_img"> -->
                    </div>
                    <div class="profile_info">
                        <span> Bienvenid@ </span>
                        <h2> '.$_SESSION['nombre'].' </h2>
                    </div>
                </div>
                
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>'.$_SESSION['rol'].'</h3>
                        <ul class="nav side-menu">
                        ';
                        //var_dump("SELECT m.idtablamenu,m.nombre_ventana FROM tb_menu m, tb_rol_menu rm where rm.idrol=".$_SESSION['idrol']." and rm.idmenu=m.idtablamenu and m.id_tablamenu_padre=0");
                        $menu_padre = Conexion::buscarVariosRegistro("SELECT m.idtablamenu,m.nombre_ventana FROM tb_menu m, tb_rol_menu rm where rm.idrol=".$_SESSION['idrol']." and rm.idmenu=m.idtablamenu and m.id_tablamenu_padre=0");
                        foreach($menu_padre as $value){
                            echo '
                                <li>
                                    <a><i class="fa fa-home"></i> '.$value['nombre_ventana'].' <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li>';
                                        
                                        $menu_hijo = Conexion::buscarVariosRegistro("SELECT m.idtablamenu,m.nombre_ventana,m.nombre_archivo FROM tb_menu m, tb_rol_menu rm where rm.idrol=".$_SESSION['idrol']." and rm.idmenu=m.idtablamenu and m.id_tablamenu_padre=".$value['idtablamenu']);
                                        foreach($menu_hijo as $value2){
                                            echo '
                                            <a href="'.$value2['nombre_archivo'].'">
                                                '.$value2['nombre_ventana'].'
                                            </a>
                                            ';
                                        }
                                        // $sql = "SELECT m.idtablamenu,m.nombre_ventana,m.nombre_archivo FROM tb_menu m, tb_rol_menu rm where rm.idrol=".$_SESSION['idrol']." and rm.idmenu=m.idtablamenu and m.id_tablamenu_padre=".$value['idtablamenu'];
                                        echo' 
                                        </li>
                                    </ul>
                                </li>
                            ';
                        }
                        echo '
                        </ul>
                    </div>
                </div>
            
                <div class="sidebar-footer hidden-small">
                    
                    <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
        </div>
    ';
}

function navBar()
{
   $navbarr = '<div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <!-- <img src="images/img.jpg" alt=""> -->'.$_SESSION['nombre'].'
                    <span class=" fa fa-angle-down"></span> 
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <!--
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    -->
                    <li>
                        <a data-toggle="modal" data-target="#myModal">
                            Cambiar Contrase&ntilde;a
                        </a>
                    </li>
                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Salir</a></li>
                  </ul>
                </li>
            <!--
                <li role="presentation" class="dropdown">
                 
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    
                  </ul>
                </li>
                -->
              </ul>
            </nav>
          </div>
          
          
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="formContrasena">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Actualizar Contrase&ntilde;a</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="item form-group">
                                            <label class="control-label" for="nombreUsuario">Usuario: </label>
                                            <input type="text" class="form-control text-uppercase" id="nombreUsuario" readonly value="'.$_SESSION['nombre'].'" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="item form-group">
                                            <label class="control-label" for="nombreMail">Correo Electr&oacute;nico: </label>
                                            <input type="text" class="form-control text-uppercase" id="nombreMail" readonly value="'.$_SESSION['usuario'].'" />
                                        </div>
                                    </div>
                                </div>
                            
                                <hr />
                    
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="item form-group">
                                            <label class="control-label" for="contrasenaActual">Contrase&ntilde;a Actual: </label>
                                            <input type="password" class="form-control" id="contrasenaActual" name="contrasenaActual" required placeholder="Ingrese contrase&ntilde;a actual" />
                                        </div>
                                    </div>
                                </div> 
                    
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label" for="contrasenaNueva">Nueva Contrase&ntilde;a: </label>
                                        <input type="password" class="form-control" id="contrasenaNueva" name="contrasenaNueva" pattern="[A-Za-z0-9@$%&]{5,}" required placeholder="Ingrese nueva contrase&ntilde;a" />
                                        <small>M&iacute;nimo 5 caracteres</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label" for="repetirContrasena">Repetir Contrase&ntilde;a: </label>
                                        <input type="password" class="form-control" id="repetirContrasena" name="repetirContrasena" pattern="[A-Za-z0-9@$%&]{5,}" required placeholder="Repita la nueva contrase&ntilde;a" />
                                        <small>M&iacute;nimo 5 caracteres</small>
                                    </div>
                                </div>
                    
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary cambiarCorreo">Cambiar Contrase&ntilde;a</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        ';
          
        print_r( $navbarr );
}


?>