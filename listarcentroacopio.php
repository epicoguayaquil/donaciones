<?
    session_start();
    require 'funciones.php';   

   // ini_set('display_errors', '1');
    //ini_set('display_startup_errors', '1');
   // error_reporting(E_ALL);
    
    $conexion = new Conexion();
        
    if(!isLogin())
    {
        header("location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <?php
            titulo_header();
        ?>
        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- DataTable CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" />
        <!-- Switchery -->
        <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">
    </head>
    <body  class="nav-md">
        <div class="container body">
            <div class="main_container">
                <?
                    menu_lateral_v2();
                ?>
                <!-- top navigation -->
                <div class="top_nav">
                    <?
                        navBar();
                    ?>
                </div>
                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Listado de centros de acopio</h3>
                        </div>
                    </div>
                    <div class="x_content">
                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs nav-justified" role="tablist">
                                <li role="presentation" class="active" id="home">
                                    <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
                                        Visualizar todos los centro de acopio
                                    </a>
                                </li>
                                <li role="presentation" class="" id="menu">
                                    <a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">
                                        Actualizar o registrar un centro de acpio
                                    </a>
                                </li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <hr />
                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                    <div cass="table-responsive">
                                        <table class="table tablecentroacopio" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Gesti&oacute;n
                                                    </th>
                                                    <th>
                                                        Nombres
                                                    </th>
                                                    <th>
                                                        Direcci&oacute;n
                                                    </th>
                                                    <th>
                                                        Estado
                                                    </th>
                                                    <th>
                                                        Ubicación
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                                    <form id="registrarcentroacopio"enctype="multipart/form-data">
                                        
                                        <input type="hidden" value="0" name="idsucursal" id="idsucursal" />
                                        
                                        <div class="row" style="margin-bottom: 1%">
                        	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                                <div style="text-align: left;">
                                                    <label for="nombreAcopio"> Nombre del centro de acopio *</label>
                                                    <input id="nombreAcopio" name="nombre" type="text" class="form-control" required maxlength="200" autocomplete="off" />
                                                </div>
                        	                </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 1%">
                        	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                                <div style="text-align: left;">
                                                    <label for="direccionAcopio"> Direcci&oacute;n del centro de acopio *</label>
                                                    <textarea id="direccionAcopio" name="direccion" class="form-control" required autocomplete="off"></textarea>
                                                </div>
                        	                </div>
                                        </div>
                                        
                                        <div class="row" style="margin-bottom: 1%">
                        	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                                <iframe name="location" src="busqueda_lugar.php" style="width: 100%; height: 250px;"></iframe>
                        	                </div>
                        	           </div>
                                        
                                        <div class="row" style="margin-bottom: 1%">
                        	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                                <div style="text-align: center;">
                                                    <button type="submit" class="btn btn-success actualizarCentroAcopio">Guardar centro de acopio</button>
                                                </div>
                        	                </div>
                                        </div>
                                        
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
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
        <!-- Custom Theme Scripts -->
        <script src="../build/js/custom.js"></script>
        <!--datatable- -->
        <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
        <!-- Switchery -->
        <script src="../vendors/switchery/dist/switchery.min.js"></script>
            <!-- SWEET-ALERT -->
    <script type="text/javascript" language="javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
        <script type="text/javascript" language="javascript" src="js/cambiarContrasena.js" ></script>
        
        <!-- SCRIPT WEB -->
        <script type="text/javascript" >
            $(document).ready(function(){
                
                // ESTABLECIMIENTO DE LOS VALORES POR DEFAULT DE DATATABLE
                $.extend( $.fn.dataTable.defaults, {
                    data: [],
                    destroy: true,
                    responsive: true,
                    language:{
                        emptyTable: "No se encontraron resultados",
                        url: "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                    },
                } );
                
                listarCentrosAcopio()
                
                $("#registrarcentroacopio").submit(function(event){
                    event.preventDefault();
                    
                    var latitud = $('iframe[name=location]').contents().find('#txt_latitud_frm').val(),
                        longitud = $('iframe[name=location]').contents().find('#txt_longitud_frm').val()
                    
                    var formData = new FormData($("#registrarcentroacopio")[0]);
                    formData.append('accion', "REGISTRAR");
                    
                    formData.append('latitud', latitud);
                    formData.append('longitud', longitud);
                    
                    
                    $.ajax({
                        type: 'POST',
                        url: 'dist/ajax/acopio/centrosAcopio.php',
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
				$(".actualizarCentroAcopio").prop({'disabled': true}).html(`<i class="fa fa-spinner fa-spin"></i> ${ Number( $("#idsucursal").val() ) == 0 ? 'Guardando' : 'Actualizando' } centro de acopio `)
			},
                        success: function(response)
                        {
                            // console.log(response)
                            switch( response.success )
                            {
                                case 1:
                                    alert(response.mensaje)
                                    listarCentrosAcopio()
                                    $("#registrarcentroacopio").trigger('reset')
                                    $("#idsucursal").val(0)
                                    
                                    $('.actualizarCentroAcopio').text('Guardar centro de acopio')
                                    $("#myTab a[href='#tab_content1']").tab("show")
                                    break;
                                case 2:
                                    alert(response.mensaje)
                                    break;
                            }
                        },
			complete: function()
			{
				$(".actualizarCentroAcopio").prop({'disabled': true}).html(`Guardar centro de acopio `)
			}
                    })
                    return false
                })
                
                $(".tablecentroacopio").on('click', '.btn-editar', function(){
                    var data = $('.tablecentroacopio').DataTable().row( $(this).closest('tr') ).data()
                    $('#idsucursal').val(data['idsucursal'])
                    $('#nombreAcopio').val(data['nombre'])
                    $('#direccionAcopio').val(data['direccion'])
                    
                    $('.actualizarCentroAcopio').text('Actualizar centro de acopio')
                    
                    $("#myTab a[href='#tab_content2']").tab("show");
                })
                
                $(".tablecentroacopio").on('click', '.js-switch', function(){
                    var data = $('.tablecentroacopio').DataTable().row( $(this).closest('tr') ).data()
                    
                    if( data['estado'] == 'A' )
                    {
                        data['estado'] = 'I'
                    }else{
                        data['estado'] = 'A'
                    }
                    
                    data['accion'] = 'REGISTRAR'
                    
                    $.ajax({
                        type: 'POST',
                        url: 'dist/ajax/acopio/centrosAcopio.php',
                        data: data,
                        dataType: "json",
                        error: function(err)
                        {
                            console.log(err)
                        },
                        success: function(response)
                        {
                            switch(response.success)
                            {
                                case 1:
                                    listarCentrosAcopio()
                                    break;
                                case 2:
                                    alert(response.mensaje)
                                    break;
                                case 3:
                                    break;
                            }
                            
                        }
                    })
                })
                
                $('#home-tab').on('click', function (e) {
                    $("#registrarcentroacopio").trigger('reset')
                    $('.actualizarCentroAcopio').text('Guardar centro de acopio')
                                    $("#idsucursal").val(0)
                })
            })
            
            function listarCentrosAcopio()
            {
                $.ajax({
                    type: 'POST',
                    url: 'dist/ajax/acopio/centrosAcopio.php',
                    data: {
                        accion: 'LISTAR'
                    },
                    dataType: "json",
                    error: function(err)
                    {
                        console.log(err)
                    },
                    success: function(response)
                    {
                        switch(response.success)
                        {
                            case 1:
                                $(".tablecentroacopio").DataTable({
                                    data: response.data,
                                    columns:[
                                        {
                                            data: null,
                                            defaultContent: "<button type='button' class='btn btn-success btn-editar'><i class='fa fa-pencil'> </i></button>",
                                            className:'text-center'
                                        },
                                        {
                                            data: 'nombre',
                                            className:'text-center'
                                        },
                                        {
                                            data: 'direccion',
                                            className:'text-center'
                                        },
                                        {
                                            className:'text-center',
                                            render: function( data, type, row, meta ){
                                                return `
                                                    <label>
                                                        <input type="checkbox" class="js-switch" ${row['estado'] == 'I' ? '' : 'checked'} />  ${row['estado'] == 'A' ? 'Activo' : 'Inactivo'}
                                                    </label>
                                                `
                                            }
                                        },
                                        {
                                            className: "text-center",
                                            render: function( data, type, row, meta )
                                            {
                                                if( row['latitud'] != "" && row['longitud'] != "" )
                                                {
                                                return ` 
                                                    <a target="_blank" href="https://maps.google.com/?q=${ row['latitud'] },${ row["longitud"] }" >
                                                    <i class='fa fa-map-marker fa-2x'> </i>
                                                    </a>
                                                `
                                                }else{
                                                    return `
                                                        Sin ubicación
                                                    `   
                                                }
                                            }
                                        }
                                    ],
                                    initComplete : function() {
                                        this.api().rows().every( function ( rowIdx, tableLoop, rowLoop ) {
                                            this.nodes().to$().find('.js-switch').each(function(i, e) {
                                                var switchery = new Switchery(e, {
                                                    color: '#26B99A',
                                                    size:"small"
                                                })
                                            })
                                       })  
                                    },
                                })
                                break;
                            case 2:
                                alert(response.mensaje)
                                break;
                            case 3:
                                document.reload();
                                break;
                        }
                    }
                })
            }
        </script>
    </body>
</html>