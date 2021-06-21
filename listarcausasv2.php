<?
    session_start();
    require 'funciones.php';   
    
    $conexion = new Conexion();
    
    if(!isLogin())
    {
        header("location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
        titulo_header();
    ?>
    
    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    
    <!-- Choseen -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chosen-js@1.8.7/chosen.min.css"/>
    
        <link rel="stylesheet" href="js/load/jquery.loadingModal.css">
    <style type="text/css">
        @charset "utf-8";
/* CSS Document */
#menu>div>img {
    width: 200px;
}


*{
    box-sizing: border-box;
    /*margin: 0;*/
    outline: none;
    padding: 0;
    
}

*:after,
*:before {
    box-sizing: border-box;
}

button#nuevo_usuario:hover {
    background-color: #ffffff;
    color: #00ddd4;
    border-bottom: 5px solid;
}

.subtitulo {
    margin: 6px 0 12px 0;
    text-align: center;
    background-color: #9D1D96;
    font-size: 14px;
    color: white;
    border-radius: 5px;
}

button#nuevo_usuario:active {
    background-color: #ffffff;
    color: #00ddd4;
    border-bottom: 5px solid;
}

div.tab button:hover {
     background-color: #ffffff; 
     color: #913189; 
     border-bottom: 5px solid; 
}

a.close, a.close_popup, a.close_popup_error,a.close_popup_editar, a.close_archivo, a.close_editar_archivo {
    background-color: rgb(204,204,204);
    border-radius: 50%;
    color: rgb(255,255,255);
    display: block;
    font-family: 'Varela Round', sans-serif;
    font-size: .8em;
    padding: .2em .5em;
    position: absolute;
    top: 1.25rem;
    transition: all 400ms ease;
    right: 1.25rem;
}
    
    a.close:hover, a.close_popup:hover, a.close_popup_error:hover, a.close_archivo:hover, a.close_editar_archivo:hover {
        background-color: #1bc5b3;
        cursor: pointer;
    }

/*
*    LOG-IN BOX
*/
div.overlay2, div.popup, div.popup-error,div.popup_editar, div.popup-archivo, div.popup-editar-archivo {
    background-color: rgba(0,0,0,.25);
    bottom: 0;
    display: flex;
    justify-content: center;
    left: 0;
    position: fixed;
    top: 0;
    width: 100%;
    z-index:25;
        overflow: auto;
}

    div.overlay2 > div.login-wrapper, div.popup > div.login-wrapper, div.popup_editar > div.login-wrapper, div.popup-error > div.login-wrapper, div.popup-archivo > div.login-wrapper, div.popup-editar-archivo > div.login-wrapper{
        align-self: center;
        background-color: rgba(0,0,0,.25);
        border-radius: 2px;
        padding: 6px;
        width: 800px;
    }
    
        div.overlay2 > div.login-wrapper > div.login-content, div.popup > div.login-wrapper > div.login-content, div.popup_editar > div.login-wrapper > div.login-content, div.popup-error > div.login-wrapper > div.login-content,  div.popup-archivo> div.login-wrapper > div.login-content, div.popup-editar-archivo > div.login-wrapper > div.login-content{
            background-color: rgba(255, 255, 255, 0.8);;
            border-radius: 2px;
            padding: 24px;    
            position: relative;
        }
        
            div.overlay2 > div.login-wrapper > div.login-content > h3, div.popup > div.login-wrapper > div.login-content > h3,div.popup_editar > div.login-wrapper > div.login-content > h3, div.popup-error > div.login-wrapper > div.login-content > h3, div.popup-archivo > div.login-wrapper > div.login-content > h3 {
                /*color: rgb(0,0,0);*/
                font-family: 'Varela Round', sans-serif;
                font-size: 1.8em;
                /*margin: 0 0 1.25em;*/
                padding: 0;
            }
/*
*    FORM
*/




form label {
    /* color: rgb(0,0,0); */
    display: block;
    /* font-family: 'Varela Round', sans-serif; */
    /* font-size: 1.25em; */
    margin-top: .75em;  
}

    form input[type="text"],
    form input[type="email"],
    form input[type="number"],
    form input[type="search"],
    form input[type="password"],
    form textarea {
        background-color: rgb(255,255,255);
        border: 1px solid rgb( 186, 186, 186 );
        border-radius: 2px;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.08);
        display: block;
        font-size: .85em;
        margin: 6px 0 12px 0;
        padding: .4em .55em;    
        text-shadow: 0 1px 1px rgba(255, 255, 255, 1);
        transition: all 400ms ease;
        width: 100%;
    }
    
    form input[type="text"]:focus,
    form input[type="email"]:focus,
    form input[type="number"]:focus,
    form input[type="search"]:focus,
    form input[type="password"]:focus,
    form textarea:focus,
    form select:focus { 
        border-color: #4195fc;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1), 0 0 8px #4195fc;
    }
    
        form input[type="text"]:invalid:focus,
        form input[type="email"]:invalid:focus,
        form input[type="number"]:invalid:focus,
        form input[type="search"]:invalid:focus,
        form input[type="password"]:invalid:focus,
        form textarea:invalid:focus,
        form select:invalid:focus { 
            border-color: rgb(248,66,66);
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1), 0 0 8px rgb(248,66,66);
        }
    
form button {
    background-color: #50c1e9;
    border: 1px solid rgba(0,0,0,.1);
    color: rgb(255,255,255);
    font-family: 'Varela Round', sans-serif;
    font-size: .85em;
    padding: .55em .9em;
    transition: all 400ms ease;    
}

    form button:hover {
        background-color: #1bc5b3;
        cursor: pointer;
    }

.login_titulo, .editar_archivo_titulo {
    /* background-color: #1c4480; */
    background: #9D1D96 ;
    margin-left: -24px;
    width: 108.3%;
    margin-top: -25px;
    height: 50px;
    justify-content: center;
    align-content: center;
    display: flex;
    flex-direction: column;
    color: white;
    font-weight: bolder;
}

#nav, #nav ul {
    list-style: none outside none;
    margin: 0;
    padding: 0;
}
#nav {
    width: 50%;
    right: 0;
    height: 50px;
    padding: 10px 0 10px 5px;
    position: absolute;
}
#nav > li {
    float: right;
    height: 50px;
    right: 100px;
    padding-right: 6px;
    position: relative;
    text-align: left;
}
#nav > li > a {
    border: 1px solid transparent;
    color: #FFFFFF;
    display: block;
    font-size: 12px;
    font-weight: bold;
    height: 50px;
    line-height: 27px;
    margin: -3px 0 0 -1px;
    padding: 0 1px 0 11px;
    text-decoration: none;
    text-shadow: 0 -1px rgba(0, 0, 0, 0.5);
}
#nav > li:hover > a, #nav > a:hover {
    border-radius: 2px 2px 2px 2px;
    color: #FFFFFF;
    margin-right: -8px;
    padding: 0 9px 0 11px;
    position: relative;
    z-index: 1;
}
#nav > li.subs:hover > a {
    /*background-color: #FFFFFF;*/
    border: 1px solid rgba(100, 100, 100, 0.4);
    border-bottom-width: 0;
    border-radius: 2px 2px 0 0;
    color: #000000;
    text-shadow: 0 0 transparent;
    z-index: 2;
}
#notify_li{
	position:relative
}
#notificationContainer {
    border-radius: 0px 5px 5px 5px;
    background-color: #fff;
    border: 1px solid rgba(100, 100, 100, .4);
    -webkit-box-shadow: 0 3px 8px rgba(0, 0, 0, .25);
    overflow: visible;
    position: absolute;
    top: 50px;
    margin-left: 0px;
    min-width: 100px;
    font-size: 12px;
    z-index: 9999;
    display: none;
}
#notificationContainer:before {
    content: '';
    display: block;
    position: absolute;
    width: 0;
    height: 0;
    color: transparent;
    border: 10px solid #040404;
    border-color: transparent transparent white;
    margin-top: -20px;
    margin-left: 0px;
}
#notificationTitle {
	z-index: 1000;
	font-weight: bold;
	padding: 8px;
	font-size: 13px;
	background-color: #ffffff;
	border-bottom: 1px solid #dddddd;
	display:none;
}
#notificationsBody {
    padding: 2px 0px 0px 0px !important;
    min-height: 50px;
}
#notificationFooter {
	background-color: #e9eaed;
	text-align: center;
	font-weight: bold;
	padding: 8px;
	font-size: 12px;
	border-top: 1px solid #dddddd;
	display: none;
}
#msg_count {
	padding: 3px 7px 3px 7px;
	background: #cc0000;
	color: #ffffff;
	font-weight: bold;
	margin-left: 77px;
	border-radius: 9px;
	position: absolute;
	margin-top: -11px;
	font-size: 11px;
}
.notifications .content {
    cursor: pointer !important;
    border-left: 6px solid #4e71e9 !important;
    padding: 5px !important;
    margin-left: 5px !important;
    margin-bottom: 7px !important;
    text-align: left !important;
    color: #555ee9 !important;
}

.notifications .content:hover {
    border-left: 6px solid #00DDD4 !important;
    color: #00DDD4 !important;
}

.notifications .content > img {
    display: none;
}
		
/* Style the tab */
div.tab {
    overflow: hidden;
    border: 1px solid #f7f7f7;
    background-color: #f7f7f7;
    background: #f7f7f7;
    /* color: gray; */
}

/* Style the buttons inside the tab */
div.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    border-bottom: 5px solid;
    color: #c7c0c0;
}

/* Change background color of buttons on hover */
div.tab button:hover {
   // background-color: #ddd;
}



/* Create an active/current tablink class */
div.tab button.active {
    background-color: #ededed;
    color: #9D1D96;
    border-bottom: 5px solid;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
}	


#notifylink > img {
    width: 50px;
}

#notifylink{
	font-size:25px;
}

.modal {
  text-align: center;
  padding: 0!important;
}

.modal:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -4px;
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}
    </style>

<script>
//var i =0
// function duplicateLine(element,event)
// DAVID
function duplicateLine(DIV,event)
{
	event.preventDefault();
	
	var element = "#"+DIV+" tbody tr:last";
	
	var fila = $(element)
	
	fila.clone().appendTo('#'+DIV+' tbody')
	
    formatearFilas(DIV)
}

function eliminar_(element, event)
{
    event.preventDefault();
    
    var idcausa = $("#idcausa").val(),
        idtabla = $(element).parent().parent().parent()[0].id,
        elemento = $(element).parent().parent().find("select.productos").val()
    
    $.ajax({
        type: 'POST',
        url: 'dist/ajax/causas/listarProductosCausa.php',
        data: {
            idcausa,
            elemento,
            metodo: 'BUSCARPRODUCTOPORCAUSA'
        },
        dataType: 'json',
        success: function(response)
        {
            switch( response.estado )
            {
                case 1:
                    if( response.productos.length > 0 )
                    {
                        Swal.fire({
                            icon: 'info',
                            title: 'Producto asignado',
                            confirmButtonText: 'Cerrar',
                            text: 'El producto ya está asignado a una donación'
                        })
                    }else{
                        var tabla = $(element).parent().parent().parent()[0].rows
	
                    	if( tabla.length > 1 ){
                    	    $(element).parent().parent().remove();
                    	}else if( tabla.length == 1 )
                    	{
                    	   $(element).parent().parent().find('input[type=number]').val('').prop({ 'disabled': true, 'placeholder': '0'}).css({ 'cursor': 'no-drop' })
                    	   $(element).parent().parent().find('select.productoCausa, select.unidadMedidaDonacion').val(0).prop({ 'disabled': true })
                    	   $(element).parent().parent().find("select.categorias").val("0")
                    	}
                    	
                        // formatearFilas(idtabla)
                    }
                    break
            }
        }
    })
    /* 	
	
	var tabla = $(element).parent().parent().parent()[0].rows
	
	if( tabla.length > 1 ){
	    $(element).parent().parent().remove();
	}
	
    formatearFilas()
    */
}
   
</script>    
    <!-- DataTable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" />
    
    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    
    
    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
    
    <!-- SWEETALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>
    <!-- SELECT 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php
            menu_lateral_v2();
        ?>

        <!-- top navigation -->
        <div class="top_nav">
            <?
                navBar();
            ?>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="page-title">
              <div class="title_left">
                <h3>Listado de Solicitudes</h3>
              </div>
            </div>
            <div class="x_content" style="float:none">
                <div class="row">
                    <div class="tab">
						<button class="tablinks active" style="display:inherit;" onclick="openCity(event, 'Actividades');limpiarForm();" id="Actividades_1" >Listado de necesidades</button>
	      		    	<button class="tablinks " id="Actividades_3" onclick="openCity(event, 'Vista')">Registrar o actualizar nueva necesidad</button>
                    </div>
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="">
                            <div class="tabcontent" id="Actividades" style="display:block;">
                                
                            </div>
                            <div class="tabcontent" id="Vista">
                                <form id="formSolRequi" class="form-horizontal form-label-left" enctype="multipart/form-data" >
                                    
                                    <input type="hidden" id="idcausa" name="idcausa" value="0" />
                                    
                                    <div class="item form-group" style="display: none">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12 parsley-error" for="idproposito">Codigo de Donación <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="number" id="idproposito" required="required" name="idproposito" readonly value="0" class="form-control col-md-7 col-xs-12" placeholder="Describa el propósito de la donación" />
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12 parsley-error" for="nombreproposito">
                                            Nombre de la necesidad <span class="required">*</span>
                                        </label>
                                        
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="nombreproposito" name="nombreproposito" class="form-control" required placeholder="Describa el nombre del propósito" maxlength="50" style="margin-bottom: 0px;" />
                                            <small>Máximo 50 caracteres</small>
                                        </div>
                                    </div>
                                    
                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12 parsley-error" for="proposito">Prop&oacute;sito de la necesidad <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea id="proposito" required="required" name="proposito" class="form-control col-md-7 col-xs-12" placeholder="Describa el propósito de la donación" maxlength="200"  style="margin-bottom: 0px;"></textarea>
                                            <small>Máximo 200 caracteres</small>
                                        </div>
                                    </div>
                                    
                                    <div class="item form-group">
                                        <label for="fechaInicio" class="control-label col-md-3 col-sm-3 col-xs-1">Fecha inicio de la necesidad</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <? date_default_timezone_set("America/Guayaquil"); $date = date("Y-m-d");  ?>
                                            <input type="date" id="fechaInicio" name="fechaInicio" class="form-control" min="<? echo $date ?>" value="<? echo $date ?>"/>
                                        </div>
                                    </div>
                                    
                                    <div class="item form-group">
                                        <label for="fechaFin" class="control-label col-md-3 col-sm-3 col-xs-1">Fecha fin de la necesidad</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="date" id="fechaFin" name="fechaFin" class="form-control" min="<? echo $date ?>" value="<? echo date("Y-m-d", strtotime($date."+ 2 month" )) ?>" />
                                        </div>
                                    </div>
                                    
                                    <div class="item form-group">
                                        <label for="imagenCausa" class="control-label col-md-3 col-sm-3 col-xs-1">Seleccione una imagen</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div style="border: 1px solid black;border-radius: 10px;padding: 0;width: 250px;">
                                                <img id="imagenCausa" src="images/causas/camara-default.png" style="width: 100%; height: 200px; cursor: pointer; border-radius: 10px" onclick="prepararImagen(this)" />
                                                <input type="file" accept="image/png,image/jpg,image/jpeg" class="form-control" style="display: none" name="imagenCausa" id="imagenCausa" onchange="validarImagen(this)"  />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?
                                        if( intval( $_SESSION['usu_id'] ) == 1 )
                                        {
                                            $asginarGestor = '<div class="item form-group">
                                                    <label for="gesDonacion" class="control-label col-md-3 col-sm-3 col-xs-1">Gestor de donaci&oacute;n *</label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select id="gesDonacion" name="gesDonacion[]" required multiple data-placeholder="Seleccione gestores de donaci&oacute;n" required class="form-control js-example-basic-single">
                                                    </select> </div> </div>';
                                            
                                            print_r($asginarGestor);
                                        }
                                    ?>
                                    
                                    <div id="productos_tabla" style="text-align: center" class="item form-group">
                                        
                                        <!--
                                        <button style="margin-top: 5px;margin-bottom: 5px; background-color: #054b88; border-color: #26312b; font-size: 11px;padding: 7px 15px;" onclick="duplicateLine('tablaAgregarProductos',event)">Agregar más productos</button>
                                        -->
                                        
                                        <div class="row">
                                            <div class="col-md-5 col-md-offset-4">
                                                <button style="background-color: #054b88; border-color: #26312b;" class="alignright" onclick="duplicateLine('tablaAgregarProductos',event)" title="Agregar fila">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table width="80%" border="1" style="margin-left:10%;margin-top:1%;" id="tablaAgregarProductos" >
                                            <thead style="background-color: #303030; color: white;">
                        						<tr style="height: 25px;">		
                        							<th align="center" style="text-align:center !important;"><strong>Categoria</strong></th>
                        							<th align="center" style="text-align:center !important;"><strong>Producto</strong></th>
                        							<th align="center" style="text-align:center !important;"><strong>Unidad Medida</strong></th>
                        							<th align="center" style="text-align:center !important;"><strong>Cantidad</strong></th>
                        							<th align="center" style="text-align:center !important;"><strong>Eliminar</strong></th>
                        						</tr>
                                            </thead>
                                            <tbody id="duplicarFilas">
                                                <tr>
                                                    <td align="center" style="text-align:center !important;">
                    								     <select id="categoriasPrincipal" name="categorias[]"  class="form-control categorias" data-placeholder="Selecione categoria" onchange="mostrat_sub_categoria(this,value)">
                                                            
                                                        </select>
                                                    </td>
                                                    <td align="center" style="text-align:center !important;">
                    								    <select id="productos" name="productos[]"  class="form-control productos" disabled onchange="asignar_unidadMedida(this, value)" data-placeholder="Selecione un producto">
                                                            <option value='0' >Seleccione un producto de la categoria</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select id="unidadMedida" name="unidadMedida[]" class="form-control unidadMedidad" disabled onchange="habilitarCantidad(this, value)">
                                                             <option value='0' >Seleccione una unidad de medida</option>
                                                        </select>
                                                    </td>
                                                    </td>										
                    							    <td align="center" style="text-align:center !important;">
                    								    <input type="number" style="cursor: no-drop; margin-bottom: 0px" disabled onkeypress='soloNumeros(event)' pattern="[0-9]{1,5}" min="1" maxlength='6' required placeholder='0' oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" title="Tiene que ser un valor mayor que 0"  name="cantidad_lista_producto[]" id="cantidad_lista_producto"  maxlength="100" title="agrega Sub-Categorias que deseas" style="width: 97%;margin-left: 2%;color:black;margin-bottom: 0px" >
                    							        <small>M&aacute;ximo 6 digitos</small>
                    							    </td>
                    							    <td align="center" style="width: 18%;">
                    								    <button type="button" class="eliminar_fila btn btn-primary btn-lg" style="margin-top: 5px;margin-bottom: 5px; background-color: #054b88; border-color: #26312b; font-size: 11px;padding: 7px 15px;" onclick="eliminar_(this, event);">
                    								        <i class="fa fa-trash"></i> 
                    								    </button>
                    							    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="item form-group text-center">
                                        <div class="col-md-3 col-md-offset-4">
                                            <button type="submit" class="btn btn-block btn-round btn-success btnText"> Solicitar donaci&oacute;n de la necesidad</button>
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
        
        <div class="modal fade bs-example-modal-lg modaldonaciones" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel">Consulta de Donantes</h4>
                    </div>
                    <div class="modal-body">
                        
                        
                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTabbeneficiario" class="nav nav-tabs bar_tabs nav-justified" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="false">
                                        Listado de donantes
                                        </a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">
                                        Seleciona donante de la necesidad
                                    </a>
                                </li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active  in" id="tab_content1" aria-labelledby="home-tab">
                                    <br />
                                    <table class="table tabladonantes" width="100%">
                                      <thead>
                                          <tr>
                                              <th>
                                                  ID DONANTE
                                              </th>
                                              <th>
                                                  N° DOCUMENTO
                                              </th>
                                              <th>
                                                  APELLIDOS Y NOMBRE DEL DONANTE
                                              </th>
                                              <th>
                                                  NOMBRE DEL PRODUCTO
                                              </th>
                                              <th>
                                                  CANTIDAD DEL PRODUCTO
                                              </th>
                                              <th>
                                                  FECHA CREACI&Oacute;N
                                              </th>
                                          </tr>
                                      </thead>
                                  </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade text-center" id="tab_content2" aria-labelledby="profile-tab">
                                    <form id="formDonantes"  enctype="multipart/form-data" >
                                        <input id="idcausamodal" name="idcausamodal" type="hidden" />
                                        <div class="item form-group">
                                            <br />
                                            <h2><label for="selectdonante">Seleccione un donante</label></h2>
                                            <hr />
                                            <select id="selectdonante" name="selectdonante" onchange="seleccion_donante(value,event);" class="form-control" data-placeholder="Selecione"> </select>
                                        </div>
                                        <hr />
                                        <div class="item form-group" id="productos_donar" style="display:none;">
                                            <div class="row">
                                                <div class="col-md-11 col-sm-11 col-md-offsset-6">
                                                    <!-- <button style="background-color: #054b88; border-color: #26312b;" class="alignright" onclick="duplicateLine('tabla_producto_donar',event)">Agregar más productos</button> -->
                                                    <button type="button" onclick="duplicateLine('tabla_producto_donar',event)" style="background-color: #054b88; border-color: #26312b; " class="alignright" title="Agregar más productos">
                                                        <i class="fa fa-plus " style="font-size: 15px"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table width="82%" border="1" style="margin-left:10%;margin-top:1%;" id="tabla_producto_donar" >
                    						    <thead style="background-color: #303030; color: white;">
                            						<tr style="height: 25px;">
                            							<th align="center" style="text-align:center !important;"><strong>Categoria</strong></th>		
                            							<th align="center" style="text-align:center !important;"><strong>Producto</strong></th>
                            							<th align="center" style="text-align:center !important;"><strong>P / T</strong></th>
                            							<th align="center" style="text-align:center !important;"><strong>Cantidad</strong></th>
                            							<!--<th align="center" style="text-align:center !important;"><strong>Disponible para donación</strong></th> -->
                            							<th align="center" style="text-align:center !important;"><strong>Eliminar</strong></th>
                            										
                            						</tr>
                                                </thead>
                                                <tbody id="tbody_donaciones">	
                        						    <tr class="duplicarFila">
                        						        <td align="center" style="text-align:center !important; width: 22.5%; padding: .5%">
                        								    <!--<input type="text"  name="agregar_lista_producto_hijos[]" id="agregar_lista_producto_hijos" maxlength="100" title="agrega Sub-Categorias que deseas" style="width: 97%;margin-left: 2%;color:black;" >-->
                        							        <select id="categoria_producto_causa" name="categoria_producto_causa[]"  class="form-control categorias" data-placeholder="Selecione" onchange="cargarProductosCausa(this,value)" title="Seleccione una categoria">
                                                                <option value="0">Seleccione una categoria</option>
                                                        
                                                            </select>
                        							    </td>
                        							    <td align="center" style="text-align:center !important; width: 22.5%; padding: .5%">
                        							        <select id="productos_causa" name="productos_causa[]" disabled class="form-control productoCausa" data-placeholder="Selecione" onchange="visualizarUnidadMedida(this, value);" title="Seleccione un producto de la categoria" >
                                                                <option value='0'> SELECCIONE EL PRODUCTO </option>
                                                            </select>
                        							    </td>	
                        							    
                        							    <td align="center" style="text-align:center !important; width: 22.5%; padding: .5%">
                        							        <select id="unidadMedidaDonacion" name="unidadMedidaDonacion[]" required disabled class="form-control unidadMedidaDonacion" onchange="habilitarCantidad(this)">
                        							            <option value="0"> Selecciones </option>
                        							        </select>
                        							    </td>
                        							   
                        							    <td align="center" style="text-align:center !important; width: 22.5%; padding: .5%">
                        								    <input type="number" min="1" pattern="[0-9]{1,}" required name="cantidad_producto[]" disabled placeholder="1" id="cantidad_producto" style="width: 97%;margin-left: 2%;color:black;cursor: no-drop;" >
                        							    </td>	
                        							    
                        							    <td align="center" style="width: 10%;">
                        							        <!--  eliminar_(this, event);-->
                        								    <button type="button" onclick="eliminar_(this, event);" class="eliminar_fila_donacion btn btn-primary btn-lg" style="margin-top: 5px;margin-bottom: 5px; background-color: #054b88; border-color: #26312b; font-size: 11px;padding: 7px 15px;" >
                        								    <i class="fa fa-trash" style="font-size: 15px"></i></button>
                        							    </td>				
                                                    </tr>
                                                </tbody>
                    					    </table>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br />
                                        <button type="submit" class="btn btn-sm btnDonante">Guardar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
              </div>
            </div>
          </div>
          
          <!-- MODAL BENEFICIARIO -->
        <div class="modal fade bs-example-modal-lg modalbeneficiarios" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel">Ver beneficiario causa</h4>
                    </div>
                    <div class="modal-body">
                        
                        
                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab2" class="nav nav-tabs bar_tabs nav-justified" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#tab_content10" id="home-tab" role="tab" data-toggle="tab" aria-expanded="false">
                                        Listado de beneficiarios
                                        </a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#tab_content11" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">
                                        Seleciona beneficiarios para la causa
                                    </a>
                                </li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active  in" id="tab_content10" aria-labelledby="home-tab">
                                    <br />
                                    <table class="table tablabeneficiarios" width="100%">
                                      <thead>
                                          <tr>
                                              <th>
                                                  ID BENEFICIARIO
                                              </th>
                                              <th>
                                                  TIPO PERSONA
                                              </th>
                                              <th>
                                                  N° DOCUMENTO
                                              </th>
                                              <th>
                                                  APELLIDOS Y NOMBRE DEL DONANTE
                                              </th>
                                              <th>
                                                  NOMBRE DE CONTACTO
                                              </th>
                                              <th>
                                                  NÚMERO DE CONTACTO
                                              </th>
                                          </tr>
                                      </thead>
                                  </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade text-center" id="tab_content11" aria-labelledby="profile-tab">
                                    <form id="formbeneficiario"  enctype="multipart/form-data" >
                                        <input id="idcausabeneficiario" name="idcausabeneficiario" type="hidden" />
                                        <div class="item form-group">
                                            <br />
                                            <h2><label for="selectdonante">Selecciones los benficiarios de la causa</label></h2>
                                            <hr />
                                            <select id="selectbeneficiario" name="selectbeneficiario[]" multiple class="form-control" data-placeholder="Seleccione el/los beneficiarios"> </select>
                                        </div>
                                        <button type="submit" class="btn btn-sm btnBeneficiario">Guardar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
              </div>
            </div>
          </div>
          
         <!-- MODAL DEL GESTOR DE LOGISTICO -->
         <div class="modal fade" id="myModalGesLogis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Gestor Log&iacute;stico</h4>
              </div>
              <div class="modal-body gesLogis">
                <span>Producto: </span> <br />
                <span>Cantidad: </span> <br />
                <p>No debe superar la cantidad antes mensionada, para asignar a los gestores de logística</p>
                <br />
                <button style="background-color: #054b88;border-color: #26312b;padding: 5px;color: white;" class="alignright" onclick="duplicateLine('tablaGesLogid',event)" title="Agregar más Gestores">
                    <i class="fa fa-plus " style="font-size: 15px"></i>
                </button>
                <table class="table" border=1 id="tablaGesLogid">
                    <thead style="background-color: #303030; color: white;">
                        <tr>
                            <th>
                                Gestor de Logística
                            </th>
                            <th>
                                Seleccione una sucursal
                            </th>
                            <th>
                                Cantidad asignada
                            </th>
                            <th>
                                Eliminar Gestor
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select id="idGesLogis" name="gesLogis[]" required class="form-control" onchange="seleccionarSucursal(value, this);">
                                    <option>Seleccione el gestor de logística</option>
                                </select>
                            </td>
                            <td>
                                <select id="idSucursal" name="sucursal[]" required class="form-control sucursal" disabled>
                                    <option>Seleccione una sucursal</option>
                                </select>
                            </td>
                            <td>
                                <input type="number" class="form-control gesCant" required placeholder="Cantidad asignada al Gestor" disabled>
                            </td>
                            <td align="center" style="width: 18%;">
							    <button class="eliminar_fila btn btn-primary btn-lg" style="margin-top: 5px;margin-bottom: 5px; background-color: #054b88; border-color: #26312b; font-size: 11px;padding: 7px 15px;" onclick="eliminar_(this, event);">
							    <i class="fa fa-trash" style="font-size: 15px"></i></button>
						    </td>
                        </tr>
                    </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary guardar">Guardar Gestor/es de Logística</button>
                <button type="button" class="btn btn-default vaciarArreglo">Cerrar</button>
              </div>
            </div>
          </div>
        </div>
         
        <!-- footer content -->
        <!--<footer>-->
        <!--  <div class="pull-right">-->
        <!--    Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>-->
        <!--  </div>-->
        <!--  <div class="clearfix"></div>-->
        <!--</footer>-->
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.js"></script>
    <!--datatable- -->
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <!-- Chosen -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
    <!-- CHOSEN -->
    <script type="text/javascript" language="javascript" src="https://cdn.jsdelivr.net/npm/chosen-js@1.8.7/chosen.jquery.min.js"></script>
    <!-- SELECT 2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
        <!-- SWEET-ALERT -->
    <script type="text/javascript" language="javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
    
    <script type="text/javascript" language="javascript" src="js/load/jquery.loadingModal.js"></script>
    
    <!-- JS SCRIPT APP -->
    <script type="text/javascript" language="javascript" src="js/cambiarContrasena.js" ></script>
    
    <script type="text/javascript" language="javascript">
        $(document).ready(function(){
            // ESTABLECIMIENTO DE LOS VALORES POR DEFAULT DE DATATABLE
            $.extend( $.fn.dataTable.defaults, {
                destroy: true,
                responsive: true,
                language:{
                emptyTable: "No se encontraron resultados",
                    url: "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                },
            } );
            
            // SWEETALERT
            $("#Actividades").on('change', '.js-switch', function(){
                
                Swal.fire({
                    title: "¿Desea iniciar la causa?",
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: `Si`,
                    denyButtonText: `No`,
                    icon: 'question'
                }).then((result)=>{
                    if( result.isConfirmed )
                    {
                        $.ajax({
                            type: 'POST',
                            url: 'dist/ajax/causas/registrarCausa.php',
                            data: {
                                metodo: 'ACEPTARCAUSA',
                                estado: 'I',
                                idcausa: Number( $(this).val() )
                            },
                            dataType: 'json',
                            error: function(err)
                            {
                                console.log(err)
                            },
                            success: function(response)
                            {
                                switch(response.estado)
                                {
                                    case 1:
                                        listarCausas()
                                        break;
                                }
                            }
                        })
                    }else{
                        listarCausas()
                    }
                })
            })
            
            listarCausas()
            
            if( <? echo $_SESSION['usu_id'] ?> == 1 )
            {
                cargarGesDonacion()
            }
            
            $(".modaldonaciones").on('hidden.bs.modal', function () {
                $("#productos_donar").css({'display': 'none'})
                $("#selectdonante").trigger("chosen:updated")
                $('#myTabbeneficiario a[href="#tab_content1"]').tab('show')
                
                $("#tabla_producto_donar tbody").find("tr:gt(0)").remove()
                $("#tabla_producto_donar tbody tr").each(function(index, item){
                    $(item).find("input[type=number]").val('').prop({ disabled: true, placeholder: '0', max:0 }).css({ 'cursor': 'no-drop' })
                    $(item).find("select.productoCausa, select.unidadMedidaDonacion").val('0').prop({ disabled: true })
                    $(item).find("select.categorias").val('0')
                })
            });
            
            /**
             * SECCIÓN DE FORMULARIOS
             */
            $("#formSolRequi").submit(function(event){
                event.preventDefault();
                
                var optionSelected = $("#gesDonacion").val(), 
                    productosUnicos = [],
                    flag = true
                
                if( <? echo $_SESSION['usu_id'] ?> == 1 )
                {
                    if( optionSelected.some( element =>  parseInt(element) == 0 ) )
                    {
                        flag = false
                        alert("Debe seleccionar al menos un gestor")
                        
                    }
                }
                
                try
                {
                    if( Number( $("#idcausa").val() ) == 0 )
                    {
                        var imgSubir = $("#formSolRequi").find("input[type=file]").val()
                        if( imgSubir == "" )
                        {
                            flag = false
                            throw 'Debe seleccionar una imagen para la causa'
                        }
                    }
                    
                    $('select#categorias,select#productos,select#unidadMedida').each(function(index, item){
                        if( parseInt( $(item).val() ) == 0 )
                        {
                            if( $(item).hasClass("categorias") )
                            {
                                alertaError(item)
                                flag = false
                                throw 'Debe seleccionar una categoria'
                            }else if( $(item).hasClass("productos") )
                            {
                                alertaError(item)
                                flag = false
                                throw 'Debe seleccionar un producto de la categoria'
                            }else  if( $(item).hasClass("unidadMedidad") )
                            {
                                alertaError(item)
                                flag = false
                                throw 'Debe seleccionar una unidad de medida'
                            }
                        }else{
                            flag = true
                            $(item).css({'border': '1px solid lightgrey'});
                            if( $(item).hasClass("productos") )
                            {
                                productosUnicos.push( parseInt( $(item).val() ) )
                            }  
                        }
                    })
                    
                    $('input[type=number]#cantidad_lista_producto').each(function (index, item){
                        if( parseInt( $(item).val() ) == 0 || $(item).val() == '' || parseInt( $(item).val() ) <= 0 )
                        {
                            flag = false
                            alertaError(item)
                            throw "La cantidad debe ser mayor a 0"
                        }
                    })
                    
                    var ProductosUnicos = Array.from(new Set(productosUnicos))
                    if( productosUnicos.length != ProductosUnicos.length )
                    {
                        flag = false
                        throw 'No se deben repetir los productos'
                    }
                    
                    
                    var fechaInicio = $("#fechaInicio").val(),
                        fechaFin = $("#fechaFin").val();
                        
                    if( new Date(fechaInicio).getTime() > new Date(fechaFin).getTime() )
                    {
                        flag = false
                        throw 'La fecha de inicio de la causa no debe ser mayor de que la fecha final de la misma'
                    }
                }catch(e){
                    Swal.fire({
                        icon: 'info',
                        title: 'Selecci&oacute;n incorrecta',
                        text: e,
                        confirmButtonText: 'Cerrar'
                    })
                }
            
                if( flag )
                {
                    var formData = new FormData( $("#formSolRequi")[0] )
                    
                    formData.append('metodo', "")
                    
                    $.ajax({
                        type: 'POST',
                        url: "dist/ajax/causas/registrarCausa.php",
                        data: formData,
                        dataType: "json",
                        cache: false,
                        processData: false,
                        contentType: false,
                        error: function(err)
                        {
                            console.log(err)
                        },
                        beforeSend: function()
                        {
                            $(".btnText").prop({'disabled': true}).html(`<i class="fa fa-spinner fa-spin"></i> ${ Number( $("#idcausa").val() ) == 0 ? 'Guardando' : 'Actualizando' }  Necesidad `);
                        },
                        success: function(response)
                        {
                            // console.log( response )
                            switch(response.estado)
                            {
                                case 1:
                                    limpiarForm()
                                    openCity(event, "Actividades") 
                                    listarCausas()
                                    break;
                                case 2:
                                    // alert(response.msj);
                                    Swal.fire({
                                        icon: 'info',
                                        text: response.msj,
                                        confirmButtonText: 'Cerrar'
                                    })
                                break;
                                case 3:
                                    location.reload()
                                break;
                            }
                        },
                        complete: function()
                        {
                            $(".btnText").prop({'disabled': false}).text("Solicitar donación de la causa")
                        }
                    });
                
                }
                
                return false;
            })
            
            $("#formbeneficiario").submit(function(event){
                event.preventDefault()
                
                if( $('#selectbeneficiario :selected').length > 0 )
                {
                    var formData = new FormData( $(formbeneficiario)[0] )
                    
                    $.ajax({
                        type: 'POST',
                        url: "dist/ajax/causas/registrarbeneficiario.php",
                        data: formData,
                        dataType: "json",
                        cache: false,
                        processData: false,
                        contentType: false,
                        error: function(err)
                        {
                            console.log(err)
                        },
                        beforeSend: function()
                        {
                            $(".btnBeneficiario").prop({'disabled': true}).html('<i class="fa fa-spinner fa-spin"></i> Guardando Beneficiario ');
                        },
                        success: function(response)
                        {
console.log( response )
                            switch( response.estado )
                            {
                                case 1:
                                    openCity(event, "Actividades")
                                    $("#myTab2 a[href='#tab_content10']").tab("show")
                                    listarCausas()
                                    $("#formbeneficiario").trigger('reset');
                                    $(".modalbeneficiarios").modal("hide");
					cargarBeneficiarioSinCausa( Number( $("#idcausabeneficiario").val() ) )
                                    break;
                                case 2:
                                    // alert( response.mensaje)
Swal.fire({
                                        icon: 'info',
                                        text: response.msj,
                                        confirmButtonText: 'Cerrar'
})
                                    break
                                case 3:
                                    location.reload();
                                    break
                            
                            }
                        },
                        complete: function()
                        {
                            $(".btnBeneficiario").prop({'disabled': false}).text("Guardar")
                        }
                    });
                }else{
                    alert("Debe asginar al menos un beneficiario para la necesidad");
                }
                
                return false;
            })
            
            $("#formDonantes").submit(function(event){
                
                if( parseInt( $("#selectdonante").val() ) > 0 )
                {
                    var flag = true, productos = []
                    
                    try{
                        $("select#categoria_producto_causa,select#productos_causa,select#unidadMedidaDonacion").each(function(index, item){
                            if( parseInt( $(item).val() ) == 0 )
                            {
                                if( $(item).hasClass("categorias") )
                                {
                                    flag = false
                                    alertaError(item)
                                    throw 'Seleccione una categoria'
                                }else if( $(item).hasClass("productoCausa") )
                                {
                                    flag = false
                                    alertaError(item)
                                    throw 'Seleccione un producto de la categoria'
                                }else if( $(item).hasClass("unidadMedidaDonacion") )
                                {
                                    flag = false
                                    alertaError(item)
                                    throw 'Seleccione la unidad de medida'
                                }
                            }else{
                                flag = true
                                $(item).css('border-color','lightgreen')
                                if( $(item).hasClass("productoCausa") )
                                {
                                    productos.push( parseInt( $(item).val() ) )
                                }
                            }
                        })
                        
                        $("input#cantidad_producto").each(function(index, item){
                            if( $(item).val().length == 0 )
                            {
                                flag = false
                                $(item).css('border',' 1px solid red')
                                throw 'Ingrese la cantidad del producto'
                            }else{
                                $(item).css('border',' 1px solid ligthgrey')
                            }
                        })
                        
                        var prodRepetidos = Array.from(new Set(productos))
                        
                        if( parseInt( productos.length ) != parseInt( prodRepetidos.length )  )
                        {
                            flag = false
                            throw 'No deben existir productos repetidos'
                        }
                        
                    }catch(e){
                        alert(e)
                    }
                    
                    if( flag )
                    {
                        var formData = new FormData($('#formDonantes')[0])
                        formData.append('metodo', 'REGISTRARCAUSAS')
                        
                        $.ajax({
                            type: 'POST',
                            url: 'dist/ajax/causas/asignardonador.php',
                            data: formData,
                            dataType: 'json',
                            cache: false,
                            processData: false,
                            contentType: false,
                            error: function(err)
                            {
                                console.log(err)
                            },
                            beforeSend: function()
                            {
                                $(".btnDonante").prop({'disabled': true}).html('<i class="fa fa-spinner fa-spin"></i> Guardando Donación ');
                            },
                            success: function(response)
                            {
                                // console.log(response)
                                switch(response.estado)
                                {
                                    case 1:
                                        listarCausas()
                                        $("#formDonantes").trigger("reset")
                                        $(".modaldonaciones ").modal("hide")
                                        $("#selectdonante").trigger("chosen:updated")
                                        $("#productos_donar").css({'display': 'none'})
                                        $('.nav-tabs a[href="#tab_content1"]').tab('show')
                                        $("#tabla_producto_donar tbody").find("tr:gt(0)").remove()
                                        $("#tabla_producto_donar tbody tr").find("select").each(function(index, item){
                                            if( index == 1 )
                                            {
                                                $(item).val(0).prop({'disabled': true})
                                                $("input[type=number]").val("").attr({'placeholder': '0'}).prop({ 'disabled': true })
                                            }
                                            $(item).css({'border-color': 'lightgray'})
                                            $("input[type=number]").css({'border-color': 'lightgray'})
                                        })
                                        
                                        break;
                                    case 2:
                                        Swal.fire({
                                            icon: 'warning',
                                            title: 'Atenci&oacute;n',
                                            text: response.mensaje,
                                            confirmButtonText: 'Cerrar'
                                        })
                                        break
                                    case 3:
                                        location.reload()
                                        break
                                    
                                }
                            },
                            complete: function()
                            {
                                $(".btnDonante").prop({'disabled': false}).text("Guardar")
                            }
                        })
                    }
                }else{
                    alert("Debe seleccionar al menos un donante")
                }
                return false;
            })
            
            /**
             * SECCION DE FUNCIONES DE EDITAR
             */
            $('#Actividades').on('click','.btn-editar', function(){
                
                // console.log( $(this).data() )
                
                var gestores = [],
                    editarFecha = true,
                    data = $(this).data()
                
                if( <? echo $_SESSION['usu_id'] ?> == 1)
                {
                    data.idgestores.forEach(function(index){
                        gestores.push( Number( index['id_gestor_donacion'] ) )
                    })
                    
                    editarFecha = false
                }
                
                let Fulldate = new Date(),
                    min = `${ Fulldate.getFullYear() }-${ ( (Fulldate.getMonth() + 1) > 9 ? (Fulldate.getMonth() + 1) : '0'+(Fulldate.getMonth() + 1) ) }-${ ( (Fulldate.getDate()) > 9 ? (Fulldate.getDate()) : '0'+(Fulldate.getDate()) ) }`
                
                if( Number( data['idcausa'] ) > 0 )
                {
                    min = data['fechainiciocausa']
                }
                
                $("#idcausa").val(data['idcausa'])
                $('#proposito').val(data['propositocausa'])
                $('#nombreproposito').val(data['nombrecuasa'])
                $('img#imagenCausa').attr({ 'src':  data['imagencausa'] })
                $('#fechaFin').val(data['fechafincausa']).prop({'required': false, 'disabeld': editarFecha, 'min': min})
                $('#fechaInicio').val(data['fechainiciocausa']).prop({'min': min, 'required': false, 'disabeled': editarFecha })
                
                $.ajax({
                    type: 'POST',
                    data:{
                        iddatos: data.idproductos,
                        metodo: "PRODUCTOSCAUSA",
                        idcausa: data.idcausa,
                    },
                    url: "dist/ajax/causas/listarProductosCausa.php",
                    dataType: 'json',
                    /*
                    error: function(err)
                    {
                        console.log(err)
                    },
                    */
                    success: function(response)
                    {
                        switch(response.estado){
                            case 1:
                                $("#duplicarFilas").html(response.select)
                                
                                if( <? echo $_SESSION['usu_id'] ?>  == 1)
                                {
                                    $("#gesDonacion").val(gestores).trigger('change')
                                }
                                
                                break;
                            case 2:
                                break;
                        }
                    },
                    complete: function()
                    {
                        $('.btnText').text("Editar Necesidad")
                    }
                })
            
                openCity(event, "Vista")
            })
            
            //- MODAL BENEFICIARIOS
            $("#Actividades").on('click', '.btnasignarbeneficiarios', function(){
                
                $("#idcausabeneficiario").val( Number( $(this).val() ) )
                
                //DAVID: CARGA TODOS LOS BENEFICIARIOS QUE ESTÁN INCRITO A UNA CAUSA
                cargarbeneficiario( Number( $(this).val() ) );
                
                // DAVID: MUESTRO TODOS LOS BENEFICIARIOS QUE NO ES ESTÁN INSCRITO A NINGUNA CAUSA
                cargarBeneficiarioSinCausa( Number( $(this).val() ) )
                
                $(".modalbeneficiarios").modal("show");
            })
            
            //- MODAL DONANTES
            $('#Actividades').on('click','.btnasignardonantes', function(){
                
                cargardonante( Number( $(this).val() ) ); //jeff
                cargardonante_todos();
                $("#idcausamodal").val( Number( $(this).val() ) )
                
                //cargarProductos()
                
                // DAVID: CARGAR CATEGORIAS A PARTIR DEL ID CAUSA
                cargarCategoriasPorCausa( Number( $(this).val() ) )
                
                $(".modaldonaciones").modal("show");
            })
        })
        
        /**
        * FUNCIONES
        */
        
        function loadingModal(text = null, cargar = true )
        {
            if( cargar )
            {
                $('body').loadingModal({text});
                $('body').loadingModal('animation', 'foldingCube').loadingModal('backgroundColor', 'black');
                $('body').css({cursor: 'no-drop'})
            }else{
                $('body').loadingModal('hide');
                $('body').loadingModal('destroy');
                $('body').css({cursor: 'auto'})
            }
        }
        
        function cargarCategorias()
        {
            $.ajax({
                type: 'POST',
                url: 'dist/ajax/causas/listarProductoPorCategoria.php',
                data: {
                    metodo: 'LISTARALLCATEGORIAS'
                },
                dataType: 'json',
                error: function(err)
                {
                    console.log(err);
                },
                success: function(response)
                {
                    switch(response.success)
                    {
                        case 1:
                            var select = $("select#categoriasPrincipal")
                            var optioproductos = "",
                                disabledCategorias = true
                            if( response.data.length > 0 ){
                                disabledCategorias = !disabledCategorias
                                optioproductos =`<option value='0'> SELECCIONE UNA CATEGORIA </option>`
                                response.data.forEach(function(item)
                                {
                                    optioproductos +=`<option value='${item['id_categoria']}'  > ${item['nombre']} </option>`;
                                })
                            }else{
                                optioproductos +=`<option value='0'> ${ response.mensaje } <option>`
                                // $(event).parent().parent().find("input[type=number]").prop({'disabled': true})
                            }
                            $(select).html(optioproductos).prop({'disabled': disabledCategorias })
                            break;
                        case 2:
                            alert(response.mensaje)
                            break;
                        case 3:
                            document.location.reload()
                            break
                    }
                }
            })
        }
        
        function prepararImagen(elemento)
        {
            $(elemento).siblings().trigger("click")
        }
        
        function validarImagen(imagen)
        {
            var imagenGuardada = imagen.files[0];
            
            if( !window.FileReader )
            {
                alert("El navegador no soporta la lectura de archivos");
                return
            }
            
            if( !(/\.(jpg|png|jpeg)$/i).test(imagenGuardada.name) )
            {
                $(imagen).val("")
                Swal.fire({
                    icon: 'info',
                    title: 'Imagen incorrecta',
                    text: "El archivo a adjuntar no es una imagen, solo permitidas (jpeg, jpg, png)",
                    confirmButtonText: 'Cerrar'
                })
            }else{
                var leerArchivo = new FileReader()
                var hermanoAnt = $(imagen).prev()
                leerArchivo.onload = function( elem )
                {
                    $(hermanoAnt).attr({ "src": elem.target.result })
                }
                leerArchivo.readAsDataURL(imagen.files[0]);
            }
        }
        
        function limpiarForm()
        {
            $("#formSolRequi").trigger('reset')
            
            $("#formSolRequi").find("input[type=hidden]").val(0)
            
            let date = new Date(),
                fechaMin = `${ date.getFullYear() }-${ ( date.getMonth() > 9 ? ( date.getMonth() ) : ( "0" + ( date.getMonth() + 1 ) ) ) }-${ ( date.getDate() > 9 ? date.getDate() : "0"+date.getDate() ) }`
            
            $("#formSolRequi").find("input[type=date]").prop({ 'min': fechaMin })
            
            $("#formSolRequi").find("select#gesDonacion").trigger('change');
            $("#formSolRequi").find("img").attr({ "src": "images/causas/camara-default.png" })
            
            $("#tablaAgregarProductos tbody").find("tr:gt(0)").remove(); 
            // $("#tablaAgregarProductos tbody tr").find("select.categorias").val(0)
            cargarCategorias()
            $("#tablaAgregarProductos tbody tr").find("select.unidadMedidad, select.productos").val(0).prop({ 'disabled': true })
            $("#tablaAgregarProductos tbody tr").find("input[type=number]").val('').prop({'placeholder': '0', disabled: true})
            $("#tablaAgregarProductos tbody tr").find("select.categorias").val('0').prop({'placeholder': '0'})
            
            $(".btnText").text(" Solicitar donación de la necesidad")
        
        }
        
        function cargarCategoriasPorCausa( idcausa )
        {
            $.ajax({
                type: 'POST',
                url: 'dist/ajax/causas/listarProductoPorCategoria.php',
                data: {
                    idcausa,
                    metodo: 'LISTARCATEGORIAS'
                },
                dataType: 'json',
                success: function( response )
                {
                    switch( response.success )
                    {
                        case 1:
                            var optionCategoria = "<option value='0'>Selecciones una categoria</option>",
                                categorias = response.data,
                                flagDisabled = true
                                if( categorias.length > 0 )
                                {
                                    flagDisabled = false
                                    categorias.forEach(function(item){
                                        optionCategoria += `<option value='${ item['id_categoria'] }'>${ item['nombre'] }</option>`
                                    })
                                }else{
                                    optionCategoria = "<option value='0'>No hay categoria disponible</option>"
                                }
                            $("#categoria_producto_causa").html(optionCategoria).prop({'disabled': flagDisabled})
                            break
                    }
                }
            })
        }
        
        function alertaError(items)
        {
            $(items).css({'border': '1px solid red'})
        }
        
        function listarCausas()
        {
            $.ajax({
                type: 'POST',
                url: 'dist/ajax/causas/listarSolicitud.php',
                data: {
                    metodo: ''
                },
                dataType: 'json',
                beforeSend: function()
                {
                    loadingModal( 'Obteniendo necesidades espere....' )
                },
                error: function(err)
                {
                    console.log(err);
                },
                success: function(response)
                {
                    switch(response.estado)
                    {
                        case 1:
                            var propVisibled = (<? echo $_SESSION['usu_id'] ?> == 1 ? true : false),
                                tarjetasdata = response.data,
                                tarjetas = ``
                                
                            if( tarjetasdata.length > 0 )
                            {
                                var longCaracter = 20
                                
                                tarjetas += `<div class="row">`
                                
                                tarjetasdata.forEach(function(item, index){
                                    var nameCausaCorto = item['nombre_causa'].charAt(0).toUpperCase() + item['nombre_causa'].slice(1).toLowerCase(),
                                        propositoCorto = item['proposito'].charAt(0).toUpperCase() + item['proposito'].slice(1).toLowerCase(),
                                        flagCheckbox = "none"
                                        
                                        if( <? print_r( $_SESSION['usu_id'] ) ?> == 1 )
                                        {
                                            flagCheckbox = ""
                                        }
                                        
                                    
                                    tarjetas += `
                                        <div class="col-md-4">
                                            <div class="x_panel" style="padding: 0px; ">
                                                <div class="x_title" style="padding: 10px 17px; margin-bottom: -5px; height: 50px">
                                                    ${ ( index + 1 ) } .-
                                                    <strong> ${ item['nombre_causa'].length <= longCaracter ? nameCausaCorto : nameCausaCorto.slice(0, longCaracter)+"....".toLowerCase() } </strong>
                                                    
                                                    <ul class="nav navbar-right">
                                                        <li>
                                                            <button type="button" class="btn btn-success btn-sm btn-editar"
                                                                ${
                                                                    item['estado'] == "P" || <? print_r($_SESSION['usu_id']) ?> == 1 ? '' : 'disabled'
                                                                }
                                                            
                                                                data-idcausa="${ item["idcausa"] }" 
                                                                data-imagenCausa="${ item['imagenCausa'] }"
                                                                data-fechaFinCausa="${ item['fecha_fin'] }"
                                                                data-nombreCuasa="${ item['nombre_causa'] }"
                                                                data-propositoCausa="${ item['proposito'] }"
                                                                data-fechaInicioCausa="${ item['fecha_inicio'] }"
                                                                data-idgestores=${ JSON.stringify( item['gestores'] ) }
                                                                data-idproductos=${ JSON.stringify( item['producto'] ) }
                                                                data-idUnidaMedida=${ JSON.stringify( item['idUnidadMedida'] ) }
                                                            >
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="x_content" style="padding: 0px; "> 
                                                    <img src="${ item['imagenCausa'] }" width="100%" height="200" />
                                                    <div style="padding: 10px 17px; word-wrap: break-word;">
                                                        <p>${ item['proposito'].length <= 40 ? propositoCorto : propositoCorto.slice(0, 40)+"....".toLowerCase() }</p>
                                                    </div>
                                                    <hr/ style="margin: 10px 0">
                                                    <ul class="list-unstyled" style="padding: 0 10px">
                                                        <li style="margin-bottom: 5px">
                                                            <small>FECHA INICIO:</small> <strong>${ item["fecha_inicio"] }</strong>
                                                        </li>
                                                        <li style="margin-bottom: 5px">
                                                            <small>FECHA FIN:</small> <strong>${ item["fecha_fin"] }</strong>
                                                        </li>
                                                        <li style="margin-bottom: 5px">
                                                            <small>DIAS RESTANTE:</small> <strong>${ item["diasRestantesAux"] }</strong>
                                                        </li>
                                                        <li style="margin-bottom: 5px">
                                                            <small>ESTADO ACTUAL:</small> <strong>${ item["estadoA"] }</strong>
                                                        </li>
                                                        <li style="margin-bottom: 5px; display: ${ flagCheckbox }">
                                                            <small>ACEPTAR O <br> RECHAZAR LA CAUSA: </small> <input type="checkbox" value="${ item['idcausa'] } " class="js-switch" ${item['estado'] == 'P' ? '' : 'disabled checked'} style="" /> ${item['estado'] == 'P' ? 'EN ESPERA' : 'ACEPTADO'}
                                                        </li>
                                                    </ul>
                                                    <hr / style="margin: 10px 0">
                                                    <div style="padding: 10px 17px">
                                                        <div class="progress right" style="border-radius: 10px;margin: 0; " >
                                                            <div class="progress-bar progress-bar-success" data-transitiongoal="${ item['porcentaje'] }" aria-valuenow="${ item['porcentaje'] }" style="width: ${ item['porcentaje'] }%; animation: show 0.35s forwards ease-in-out 0.5s;">
                                                                <span class="title" style="color: ${ Number( item['porcentaje'] ) == 0 ? 'black' : 'white' }">${ item['porcentaje'] }%</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr / style="margin: 10px 0">
                                                    <div class="row" style="padding: 10px 17px">
                                                        <div class="col-md-6">
                                                            <button type="button" class="btn btn-block btn-success btnasignarbeneficiarios" ${item['estado'] == 'P' ? 'disabled ' : ' '} value="${ item['idcausa'] }">Ver Beneficiario</buton>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button type="button" class="btn btn-block btn-success btnasignardonantes" ${item['estado'] == 'P' ? 'disabled ' : ' '} value="${ item['idcausa'] }">Ver Donantes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    `
                                })
                                
                                tarjetas += `</div`
                            }else{
                                tarjetas += `
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="x_panel">
                                                <div class="x_title">
                                                    Sin causas activas
                                                </div>
                                                <div class="x_content text-center">
                                                    No hay causas activas en este momento
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `
                            }
                            // tarjetas += `</div>`
                            $("#Actividades").html(tarjetas)
                            break;
                    }
                },
                complete: function()
                {
                    cargarCategorias()
                    $("#Actividades").find('.js-switch').each(function(item, index){
                        new Switchery(index, {
                            size:"small"
                        })
                    })
                    
                    loadingModal( '', false )
                }
            })
        }
        
        function openCity(evt, cityName) 
        {
            // Declare all variables
            var i, tabcontent, tablinks;
        
            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
        
            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
        
            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
            if(cityName=='Actividades'){
                $('#Actividades').css("display","block");
                $("#Actividades_1").addClass("tablinks active");
                
            }else if (cityName=='Vista'){
                    $('#Vista').css("display","block");
                    $("#Actividades_3").addClass("tablinks active");
            }
        }
        
        function prepararDatosBeneficiarios(idcausa)
        {
            if( Number(idcausa) > 0 )
            {
                cargarbeneficiario(idcausa)
                cargarBeneficiarioSinCausa(idcausa)
                
                $("#idcausabeneficiario").val(idcausa)
                
                $(".modalbeneficiarios").modal("show");
            }
        }
        
        function prepararDatosDonantes(idcausa)
        {
            if( Number(idcausa) > 0)
            {
                cargardonante(idcausa)
                cargardonante_todos()
                cargarCategoriasPorCausa( idcausa )
                
                $("#idcausamodal").val(idcausa)
                
                $(".modaldonaciones").modal("show");
            }
        }
        
        // DAVID: BENEFICIARIO POR CAUSA
        function cargarbeneficiario(data)
        {
            var parametro = {
                id_causa: data
            }
            
            $.ajax({
                type: 'POST', // DAVID: GET -> POST
                url: "dist/ajax/causas/listarbenefeciariocuasa.php",
                dataType: 'json',
                data: parametro,
                error: function(err)
                {
                    console.log(err);
                },
                success: function(response)
                {
                    // console.log(response)
                    switch(response.estado)
                    {
                        case 1:
                            $('.tablabeneficiarios').DataTable({
                                data: response.data,
                                pageLength: 50,
                                "bLengthChange": false,
                                "bFilter": false,
                                columns:[
                                    {
                                        'data':'idbeneficiario',className: 'text-center',
                                    },
                                    {
                                        'data':'tipo',className: 'text-center',
                                    },
                                    {
                                        'data':'num_doc',className: 'text-center',
                                    },
                                    {
                                        'data':'nombres',className: 'text-center',
                                    },
                                    {
                                        'data':'persona_contacto',className: 'text-center',
                                    },
                                    {
                                        'data':'numero_contacto',className: 'text-center',
                                    }
                                ]
                            })
                            break;
                        case 2:
                            $('.tablabeneficiarios').DataTable({data: []})
                            break;
                    }
                },
                complete: function()
                {
                    // $("#selectbeneficiario").chosen({width: "50%"})
                }
            });
            
        }
        
        // DAVID: BENEFICIARIO QUE NO ESTÉN EN LA CAUSA
        function cargarBeneficiarioSinCausa(data)
        {
            
            var parametro = {
                id_causa: data
            }
            
            $.ajax({
                type: 'POST', // David GET -> POST
                url: "dist/ajax/causas/listarbenefeciarioSinCuasa.php",
                dataType: 'json',
                data: parametro,
                error: function(err)
                {
                    console.log(err);
                },
                success: function(response)
                {
                    switch(response.estado)
                    {
                        case 1:
                            var chose = "<option value='0'>Selecione un donante</option>";
                            response.data.forEach(function(item){
                                chose += `<option value='${item['idbeneficiario']}'>${item['num_doc']} - ${item['nombres']}</option>`;
                            });
                            $("#selectbeneficiario").html(chose);
                            break;
                        case 2:
                            console.log(response.msj)
                        
                            $("#selectbeneficiario").html([]).chosen().trigger("chosen:updated");
                            break;
                    }
                },
                complete: function()
                {
                    $("#selectbeneficiario").chosen({width: "50%"}).trigger("chosen:updated")
                }
                
            })
        }
        
         function cargardonante(data)
        {
            var parametros={
                id_causa:data
            }
            
            $.ajax({
                type: 'POST',  //Jeff GET-> POST
                url: "dist/ajax/causas/listardonantecausa.php",
                data:parametros,
                dataType: 'json',
                error: function(err) //JEFF este error va abajo por favor guiarse de los fuentes de muestra
                {
                    console.log(err);
                },
                success: function(response)
                {
                    // console.log('donantes -> ',response);
                    switch(response.estado)
                    {
                        case 1:
                    // console.log(response)
                    
                            $('.tabladonantes').DataTable({
                                data: response.data,
                                pageLength: 100,
                                "bLengthChange": false,
                                "bFilter": false,
                                columns:[
                                    {
                                        'data':'iddonante',className: 'text-center',
                                        visible: false
                                    },
                                    {
                                        'data':'num_doc',className: 'text-center',
                                    },
                                    {
                                        'data':'nombres',className: 'text-center',
                                    },
                                    {
                                        'data':'nombre',className: 'text-center',
                                    },
                                    {
                                        'data':'cantidad',className: 'text-center',
                                    },
                                    {
                                        'data':'fechaCreacion',className: 'text-center',
                                    }
                                ]
                            });
                            break;
                        case 2:
                            $('.tabladonantes').DataTable({ destroy: true, data: [] });
                            break;
                    }
                },
                /**
                 * David
                */
                
                complete: function()
                {
                    //$("#selectdonante").chosen({width: "50%"})
                    cargardonante_todos()
                }
                
            });
        }
        
        function cargardonante_todos()
        {
            $.ajax({
                type: 'GET',  //Jeff GET-> POST
                url: "dist/ajax/causas/listardonantes.php",
                dataType: 'json',
                /*
                error: function(err) //JEFF este error va abajo por favor guiarse de los fuentes de muestra
                {
                    console.log(err);
                },
                */
                beforeSend: function()
                {
                    $("#selectdonante").chosen("destroy")
                },
                success: function(response)
                {
                    // console.log(response);
                    switch(response.estado)
                    {
                        case 1:
                            
                            var chose = "<option value='0'>Selecione un donante</option>";
                            response.data.forEach(function(item){
                                chose += `<option value='${item['iddonante']}' >${item['num_doc']} - ${item['nombres']}</option>`;
                            });
                            $("#selectdonante").html(chose);
                            break;
                        case 2:
                            break;
                    }
                },
                complete: function()
                {
                    $("#selectdonante").chosen({width: "50%"})
                }
            });
        }
        
        function seleccion_donante(valor, event)
        {
            event.preventDefault();
            // console.log(valor)
            //var id_donante=$("#selectdonante").val();
            if(parseInt(valor) == 0){
                $("#productos_donar").css("display","none");
            }else{
                $("#productos_donar").css("display","block");
            }
        }
        
        function cargarProductosCausa(event, data)
        {
            if( Number( data ) > 0 )
            {
                var parametros = {
                    idcausa: $("#idcausamodal").val(),
                    idcategoria: data,
                    metodo: "CATEGORIA"
                }
                
                $.ajax({
                    type: 'POST',
                    url: 'dist/ajax/causas/listarProductosCausa.php',
                    dataType: 'json',
                    data: parametros,
                    error: function(err)
                    {
                        console.log(err)
                    },
                    success: function(response)
                    {
                        switch(response.estado)
                        {
                            case 1:
                                var select = $(event).parent().parent().find("select.productoCausa")
                                var optioproductos = ""
                                if( response.data.length > 0 ){
                                    optioproductos =`<option value='0'> SELECCIONE EL PRODUCTO </option>`
                                    response.data.forEach(function(item)
                                    {
                                        optioproductos +=`<option value='${item['id_producto']}' data-cantidad='${item['cantidad']}' > ${item['nombre']} </option>`;
                                    })
                                }else{
                                    optioproductos +=`<option value='0'> NO HAY PRODUCTOS PARA ESA CATEGORIA <option>`
                                    $(event).parent().parent().find("input[type=number]").prop({'disabled': true})
                                }
                                $(select).html(optioproductos).prop({'disabled': response.data.length > 0 ? false : true })
                                break;
                            case 2:
                                alert(response.msj)
                                break;
                        }
                        
                    },
                    complete: function()
                    {
                        $("#idproductocausa").chosen({width: "50%"})
                    }
                })
            }else{
                $(event).parent().parent().find('select.productoCausa, select.unidadMedidaDonacion').val("0").prop({ 'disabled': true })
                $(event).parent().parent().find('input[type=number]').val("").prop({ 'disabled': true, 'placeholder': '0' }).css({ 'cursor': 'no-drop' })
            }
        }
        
        function asignarCantidad(element, valor)
        {
            var idcausa = Number( $("#idcausamodal").val() ),
                idproducto = Number( valor )
                
            $.ajax({
                type: 'POST',
                url: 'dist/ajax/causas/listarProductosCausa.php',
                data: {
                    idcausa,
                    idproducto,
                    metodo: 'CANTIDADPRODUCTOSDISPONIBLE'
                },
                dataType: 'json',
                error: function(err)
                {
                    console.log(err)
                },
                success: function(response)
                {
                    switch( response.estado )
                    {
                        case 1:
                            var flagDisabled = true,
                                max = 0
                                
                            if( Number( $(element).val() ) > 0 )
                            {
                                var data = Number( $(element).find('option:selected').data('cantidad') )
                                if( data > 0 )
                                {
                                    var totaldonada = Number( response.cantidad )
                                
                                    if( data == totaldonada )
                                    {
                                        var totalFilas =  $(element).parent().parent().parent()[0].rows
                                        if( totalFilas.length > 1 )
                                        {
                                            $(element).parent().parent().remove()
                                        }else{
                                            $(element).parent().parent().find('select.categorias').val("0").prop({'selected': true})
                                            $(element).parent().parent().find('input[type=number]').val("").prop({'disabled': true, placeholder:'0'}).css({'cursor': 'auto'})
                                            $(element).parent().parent().find('select.productoCausa, select.unidadMedidaDonacion').val("0").prop({'selected': true, disabled: true})
                                        }
                                        Swal.fire({
                                            icon: 'info',
                                            title: 'No hay donación disponible',
                                            text: 'Supero la cantidad máxima de donación! Solicite una extención'
                                        })
                                    }else{
                                        max = ( data - totaldonada )
                                        flagDisabled = false
                                    }
                                    $(element).parent().parent().find('input[type=number]').prop({'max': max}).css({'cursor': 'auto'})
                                }
                            }
                            break
                    }
                }
            })
        }
        
        function formatearFilas(div)
        {
            var total = $(`#${div} tbody`).find('tr')
            
            $(`#${div} tbody`).find('tr').each(function (index, item){
                
                if( parseInt( total.length ) == parseInt( index + 1 ) )
                {
                    $(item).find("input[type=number]").val('').prop({ disabled: true, placeholder: '0', max: 0 }).css({ 'cursor': 'no-drop' })
                    $(item).find("select.productoCausa, select.unidadMedidaDonacion").val('0').prop({ disabled: true })
                    $(item).find("select.categorias").val('0')
                }else{
                    $(item).find("select,input[type=number],button").attr({'data-posicion': index});
                }
                    
            });
        }
        
        function cargarGesDonacion()
        {
            $.ajax({
                type: 'POST',
                url: 'dist/ajax/usuarios/listarUSuarios.php',
                dataType: 'json',
                data: {
                    metodo: 'GDONACION'
                },
                error: function(err)
                {
                    console.log(err);
                },
                success: function(response)
                {
                    switch( response.success)
                    {
                        case 1:
                            // var optionGesDonante = "<option value='0' selected> Seleccion es gestor de donaci&oacute;n </option>",
                            var optionGesDonante = "",
                                propDisabled = true;
                            if( response.data.length > 0 )
                            {
                                propDisabled = false
                                response.data.forEach(function(index){
                                    optionGesDonante += `<option value='${ index['usu_id'] }'> ${ index['rol'] } - ${ index['nombre'] }</option>`
                                })
                            }else{
                                optionGesDonante = "<option value='0'> No hay gestor disponible </option>"
                            }
                            $('#gesDonacion').html(optionGesDonante).prop({'disabled': propDisabled})
                            break;
                    }
                },
                complete: function()
                {
                    // $('#gesDonacion').chosen({'width':'100%', 'placeholder_text_single': "Seleccione un gestor"})
                    $('.js-example-basic-single').select2({
                        placeholder: 'Selecciones donante',
                        width: '100%',
                        language: "es"
                    })
                }
            })
        }
        
        function mostrat_sub_categoria(element=null, valor)
        {
            if(valor > 0)
            {
                $.ajax({
                    type: 'POST',
                    url: 'dist/ajax/causas/listarProductoPorCategoria.php',
                    data:{
                        idcategoria: valor
                    },
                    dataType: 'json',
                    error: function(err)
                    {
                        console.log(err)
                    },
                    success: function(response)
                    {
                        // console.log(response)
                        switch( response.success )
                        {
                            case 1:
                                var select = $(element).parent().parent().find("select.productos")
                                
                                var optionProductoCategoria = "", flagProd = true;
                                
                                if(response.data.length > 0)
                                {
                                    flagProd = false
                                    optionProductoCategoria += `<option value='0' >Seleccione un producto de la categoria</option>`
                                    response.data.forEach(function(item){
                                        optionProductoCategoria += `<option value='${item['id_producto']}' >${item['nombre']}</option>`
                                    })
                                }else{
                                    optionProductoCategoria += `<option>No hay productos para esa categoria</option>`
                                }
                                
                                $(select).html(optionProductoCategoria).prop({'disabled': flagProd })
                                // $(element).parent().parent().find("input[type=number]").prop({'disabled':flagProd })
                                
                                break;
                        }
                    }
                })
            }else{
                $(element).parent().parent().find("select.productos,select.unidadMedidad").val("0").prop({ 'disabled': true })
                $(element).parent().parent().find("input[type=number]").val("").prop({ 'disabled': true, 'placeholder':'0'}).css({ 'cursor': 'not-allowed' })
            }
        }
        
        function asignar_cantidad(element, valor)
        {
            if( parseInt(valor) > 0 )
            {
                $(element).parent().parent().find("input[type=number]").prop({'disabled': false }).css({ 'cursor': 'auto' }) 
            }else{
                $(element).parent().parent().find("input[type=number]").prop({'disabled': true }).css({ 'cursor': 'no-drop' }) 
            }
        }
        
        
         //Solo permite introducir números.
        function soloNumeros(e)
        {
            var key = window.event ? e.which : e.keyCode;
            if (key < 48 || key > 57) {
                //Usando la definición del DOM level 2, "return" NO funciona.
                e.preventDefault();
            }
        }
        
        function asignar_unidadMedida(element, idproducto)
        {
            if(idproducto > 0)
            {
                $.ajax({
                    type: 'POST',
                    url: 'dist/ajax/productoCategoria/unidadMedidas.php',
                    data:{
                        idproducto,
                        metodo: "listarunidadmedidaporidproducto"
                    },
                    dataType: 'json',
                    error: function(err)
                    {
                        console.log(err)
                    },
                    success: function(response)
                    {
                        switch( response.success )
                        {
                            case 1:
                                var select = $(element).parent().parent().find("select.unidadMedidad")
                                
                                var optionUnidadMedida = "", flagProd = true;
                                
                                if(response.data.length > 0)
                                {
                                    flagProd = false
                                    optionUnidadMedida += `<option value='0' >Seleccione una unidad de medida</option>`
                                    response.data.forEach(function(item){
                                        optionUnidadMedida += `<option value='${item['idunidadmedida']}' >${item['definicion']}</option>`
                                    })
                                }else{
                                    optionUnidadMedida += `<option>${ response.mensaje }</option>`
                                }
                                
                                $(select).html(optionUnidadMedida).prop({'disabled': flagProd })
                        //         // $(element).parent().parent().find("input[type=number]").prop({'disabled':flagProd })
                                
                                break;
                        }
                    }
                })
            }else{
                $(element).parent().parent().find("select.unidadMedidad").val("0").prop({ 'disabled': true })
                $(element).parent().parent().find("input[type=number]").val("").prop({ 'disabled': true, 'placeholder':'0'}).css({ 'cursor': 'not-allowed' })
            }
        }
        
        function visualizarUnidadMedida( element, idproducto )
        {
            if( Number( idproducto ) > 0 )
            {
                $.ajax({
                    type: 'POST',
                    url: 'dist/ajax/causas/listarProductosCausa.php',
                    data:{
                        idproducto,
                        metodo: "PRODUCTOUNIDADMEDIDA",
                        idcausa: Number( $("#idcausamodal").val() )
                    },
                    dataType: 'json',
                    error: function(err)
                    {
                        console.log(err)
                    },
                    success: function(response)
                    {
                        console.log( response )
                        switch( response.estado )
                        {
                            case 1:
                                var select = $(element).parent().parent().find("select.unidadMedidaDonacion")
                                
                                var optionUnidadMedida = "", flagProd = true;
                                
                                if(response.data.length > 0)
                                {
                                    flagProd = false
                                    optionUnidadMedida += `<option value='0' >Seleccione una unidad de medida</option>`
                                    response.data.forEach(function(item){
                                        optionUnidadMedida += `<option value='${item['idunidadmedida']}' >${item['definicion']}</option>`
                                    })
                                }else{
                                    optionUnidadMedida += `<option>${ response.mensaje }</option>`
                                }
                                
                                $(select).html(optionUnidadMedida).prop({'disabled': flagProd })
                                
                                if( !flagProd )
                                {
                                    asignarCantidad(element, idproducto)
                                }
                                
                                break;
                            case 2:
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Atenci&oacute;n',
                                    text: response.msj,
                                    confirmButtonText: 'Cerrar'
                                })
                                break;
                            case 3:
                                break 
                        }
                    }
                })
            }else{
                $(element).parent().parent().find("select.unidadMedidaDonacion").val("0").prop({ 'disabled': true })
                $(element).parent().parent().find("input[type=number]").val("").prop({ 'disabled': true, 'placeholder': '0' })
            }
        }
        
        function habilitarCantidad(element)
        {
            var disabledInput = true,
                cursorInput = "no-drop"
                
            if( Number( $(element).val() ) > 0 )
            {
                disabledInput = !disabledInput,
                cursorInput = "auto"
            }
            
            $(element).parent().parent().find("input[type=number]").prop({ 'disabled': disabledInput}).css({ 'cursor': cursorInput })
        }
    </script>
    
    </body>
</html>