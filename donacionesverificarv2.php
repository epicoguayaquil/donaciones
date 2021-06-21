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
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
	
    formatearFilas()
}

function eliminar_(element, event)
{
	event.preventDefault();	
	
	var tabla = $(element).parent().parent().parent()[0].rows
	
	if( tabla.length > 1 ){
	    $(element).parent().parent().remove();
	}
	
    formatearFilas()
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
        <!-- DATATABLE CSS -->
        <link rel='stylesheet' href='//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css' />
    
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
                <h2>Listado de donaciones para verificar</h2>  
              </div>
            </div>
            <div class="x_content"> 
                <hr />
                <style type="text/css">
                    td.details-control,
                    tr.shown td.details-control
                    {
                        cursor: pointer;
                    }
                    
                    td.details-control {
                        background: url('https://raw.githubusercontent.com/DataTables/DataTables/1.10.7/examples/resources/details_open.png') no-repeat center center;
                    }
                    tr.shown td.details-control {
                        background: url('https://raw.githubusercontent.com/DataTables/DataTables/1.10.7/examples/resources/details_close.png') no-repeat center center;
                    }
                </style>
                <table class="table table-bordered" id="tablaverificador">
                    <thead>
                        <tr>
                            <th></th>
                            <th>
                                CAUSA
                            </th>
                            <th>
                                PROP&Oacute;SITO
                            </th>
                            <th>
                                VERIFICAR DONACI&Oacute;N
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
         </div>
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- DATATABLE JAVASCRIPT -->
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.js"></script>
    
        <!-- SWEET-ALERT -->
    <script type="text/javascript" language="javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
    
    
    <!-- JS SCRIPT APP -->
    <script type="text/javascript" language="javascript" src="js/cambiarContrasena.js" ></script>
    
    <script>
        $(document).ready(function(){
            // ESTABLECIMIENTO DE LOS VALORES POR DEFAULT DE DATATABLE
            $.extend( $.fn.dataTable.defaults, {
                destroy: true,
                // responsive: true,
                language:{
                    emptyTable: "No se encontraron resultados",
                    url: "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                },
            } );
            
            $("#tablaverificador").on('click', '.btn-asignar', function(){
                // var data = $("#tablaverificador").DataTable().row( $(this).closest('tr') ).data()
                // console.log( data )
                
                var donacionesSinCheck = true
                    donacionesCheck = [], 
                    donacion = []
                
                try{
                    $("#subCheckDonacion").find('input[name=verificarDonacion]:checked').each(function(index, item){
                        donacionesSinCheck = false
                        
                        donacionesCheck.push( $(item).data('iddespacho') )
                        donacion.push( $(item).data('donacion') )
                    })
                    
                    if( donacionesSinCheck ) throw 'Debe seleccionar al menos un donaci&oacute;n para verificar'
                    
                    if( donacionesCheck.length > 0 )
                    {
                        $.ajax({
                            type: 'POST',
                            url: 'dist/ajax/verificador/gestorVerificador.php',
                            dataType: 'json',
                            data: {
                                metodo: 'ACTUALIZARDONACIONV2',
                                donacionesCheck,
                                donacion
                            },
                            error: function( err )
                            {
                                console.log( err )
                            },

                            beforeSend: function()
                            {
                                $(".btn-asignar").prop({'disabled': true}).html('<i class="fa fa-spinner fa-spin"></i> Verificando la donación ');
                            },
                            success: function( response )
                            {
                                console.log( response )
                                switch( response.success )
                                {
                                    case 1:
                                        // cargarDonacionesVerficar()
                                        location.reload()
                                        break
                                }
                            }
                        })
                    }
                    
                }catch(e)
                {
                    alert(e)
                }
                
                
                /*
                $.ajax({
                    type: 'POST',
                    url: 'dist/ajax/verificador/gestorVerificador.php',
                    dataType: 'json',
                    data: {
                        metodo: 'ACTUALIZARDONACION',
                        id_despacho: parseInt( data['id_despacho'] ),
                        iddonacion: parseInt( data['iddonacion'] )
                    },
                    error: function( err )
                    {
                        console.log( err )
                    },
                    success: function( response )
                    {
                        // console.log(response)
                        switch( response.success )
                        {
                            case 1:
                                cargarDonacionesVerficar()
                                break;
                            case 2:
                                lert(response.mensaje)
                                break
                        }
                    }
                })
                */
            })
            cargarDonacionesVerficar()
        })
        
        function cargarDonacionesVerficar()
        {
            $.ajax({
                type: 'POST',
                url: 'dist/ajax/verificador/gestorVerificador.php',
                dataType: 'json',
                data: {
                    metodo: 'LISTARDONACIONVERIFICADORV1'
                },
                error: function( err )
                {
                    console.log( err)
                },
                success: function( response )
                {
                    console.log(response)
                    switch( response.success )
                    {
                        case 1:
                            var table = $("#tablaverificador").DataTable({
                                data: response.data,
                                columns: [
                                    {
                                        className: 'text-center details-control',
                                        data: null,
                                        orderable: false,
                                        defaultContent: ''
                                    },
                                    {
                                        className: 'text-center',
                                        data: 'nombre_causa',
                                    },
                                    {
                                        className: 'text-center',
                                        data: 'proposito',
                                    },
                                    {
                                        className: 'text-center',
                                        render: function( data, type, row, meta )
                                        {
                                            return ` <button type='button' class='btn btn-success btn-asignar' ${ row['buttonDisabled'] ? 'disabled': '' }> <i class='fa fa-pencil'></i> Verificar </button> `
                                        }
                                    },
                                ]
                            })
                            
                            $('#tablaverificador tbody').on('click', 'td.details-control', function () {
                                    var tr = $(this).closest('tr');
                                    var row = table.row( tr );
                                    
                                    if ( row.child.isShown() ) {
                                        // This row is already open - close it
                                        row.child.hide();
                                        tr.removeClass('shown');
                                    } else {
                                        // Open this row
                                        row.child( format(row.data()) ).show();
                                        tr.addClass('shown');
                                    }
                                } );
                            break
                        case 3:
                            location.reload();
                            break;
                    }
                }
            })
        }
        
        function format ( data )
        {
            console.log( data )
            var productosDetalles = data['detalleProducto']
            var tabla = `
                <table cellpadding="5" cellspacing="0" border="1" style="margin: auto" id="subCheckDonacion">
                    <thead>
                        <tr>
                            <th>
                                DATOS DEL BENEFICIARIO
                            </th>
                            <th>
                                CENTRO DE ACOPIO
                            </th>
                            <th>
                                PRODUCTO
                            </th>
                            <th>
                                CANTIDAD
                            </th>
                            <th>
                                VERIFICAR DONACI&Oacute;N
                            </th>
                        </tr>
                    </thead>
                    <tbody>
            `
            
            if( productosDetalles.length > 0 )
            {
                productosDetalles.forEach(function(item){
                    // console.log( item )
                    tabla += `
                        <tr>
                            <td>
                                ${ item['id_beneficiario'] }
                            </td>
                            <td>
                                ${ item['id_acopio'] }
                            </td>
                            <td>
                                ${ item['id_producto'] }
                            </td>
                            <td>
                                ${ item['cantidad'] }
                            </td>
                            <td class="text-center">
                                <input type='checkbox' required id="verificarDonacion" name="verificarDonacion" data-donacion="${ item['iddonacion'] }" data-iddespacho="${ item['id_despacho'] }"  ${ item['estado'] == 1 ? 'disabled title="Donación Verificada" ' : '' } />
                            </td>
                        </tr>
                    `
                })
            }else{
                tabla += `
                    <tr>
                        <td colSpan = '10'>
                            NO HAY DATOS DISPONIBLES
                        </td>
                    </tr>
                `
            }
            
            tabla +=`
                    </tbody>
                </table>
            `
            
            return tabla
        }
    </script>
    </body>
</html>