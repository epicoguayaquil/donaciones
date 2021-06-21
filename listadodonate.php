<?php
    session_start();
    ini_set('display_errors', 1);
    require "funciones.php";
    if(!isLogin())
    {
        header("location: ../login.php");
    }
    header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
        titulo_header();
    ?>
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
   
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
   
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <link href="../build/css/custom.min.css" rel="stylesheet">
    
    
        <link rel="stylesheet" href="js/load/jquery.loadingModal.css">
    
    <!-- DataTable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" />  
  </head>

  <body class="nav-md">
    
    <div class="container body">
      <div class="main_container">
        <?php
            menu_lateral_v2();
        ?>
        <div class="top_nav">
            <?
                navBar();
            ?>
        </div>

        <div class="right_col" role="main">
            <!-- <div class="page-title">
                <div class="title_left">
                    <h3>Listado de Donantes</h3>
                </div>
             </div> -->
            <div class="x_content" style="float:none">
                  <!--
                  <table class="table" id="tabladonacion">
                      <thead>
                          <tr>
                              <th>
                                  ID DONANTE
                              </th>
                              <th>
                                  NÚMERO DE IDENTIFICACIÓN
                              </th>
                              <th>
                                  APELLIDOS Y NOMBRES
                              </th>
                              <th>
                                  PERSONA CONTACTO
                              </th>
                              <th>
                                  NÚMERO CONTACTO
                              </th>
                              <th>
                                  CORREO ELECTRÓNICO
                              </th>
                              <th>
                                  DIRECCIÓN
                              </th>
                              <th>
                                  TOTAL DE DONACIONES
                              </th>
                          </tr>
                      </thead>
                  </table>
                  -->
                
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs nav-justified" role="tablist">
                        <li role="presentation" class="active" id="home">
                            <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
                                Visualizar todos los donante
                            </a>
                        </li>
                        <li role="presentation" class="" id="menu">
                            <a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">
                                Actualizar o registrar un nuevo donante
                            </a>
                        </li>
                    </ul>
                    
                    <div id="myTabContent" class="tab-content">
                        <hr />
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                            <h2>
                                Listado de donante
                            </h2>
                            <hr />
                            <table class="table tabledonante" width="100%">
                                <thead>
                                    <tr>
                                        <th>
                                            GESTIÓN
                                        </th>
                                        <th>
                                            ID DONANTE
                                        </th>
                                        <th>
                                            TIPO DONANTE
                                        </th>
                                        <th>
                                            N° DOCUMENTO
                                        </th>
                                        <th>
                                            RAZON SOCIAL
                                        </th>
                                        <th>
                                            PERSONA CONTACTO
                                        </th>
                                        <th>
                                            NÚMERO DE CONTACTO
                                        </th>
                                        <th>
                                            DIRECCIÓN
                                        </th>
                                        <th>
                                            LATTITUD
                                        </th>
                                        <th>
                                            LONGITUD
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                            <h1 class="text-center">
                                Registro de donante
                            </h1
                            <br />
                            <form id="registrarbeneficiario"enctype="multipart/form-data">
                                <div class="text-center">
                                    <img style="width:20%" src="images/logo/logo_ico.png" />
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                        <div class="item form-group">
                                            <select id="tipopersona" name="tipopersona" class="form-control">
                                                <option value="0">Seleccione un tipo de persona</option>
                                                <option value="1">Natural</option>
                                                <option value="2">Jur&iacute;dica</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div cass="tipoPersona">
                                    <fieldset>
                                        <div id="personaNatural" class="persona" style="display:none">
                                            <div class="row">
                            	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                	                <div style="text-align: left;">
                                                        <label for="txt_razonSocialN">Apellidos y Nombres (*)</label>
                                                        <input type="text" id="txt_razonSocialN" style="margin: 0 0 5px;" name="txt_razonSocialN" placeholder="Ingrese sus Nombres" required aria-required="true" class="form-control"/>
                                                    </div>
                            	                </div>
                                            </div>
                                            
                                            <div class="row">
                            	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                                    <div style="text-align: left;">
                                                        <label> N&uacute;mero Doc. (*)</label>
                                                        <input type="text" class="form-control" id="txt_numDocN" style="margin: 0 0 5px;" name="txt_numDocN" onkeypress="return valideKey(event);" placeholder="Ingrese su N&uacute;mero de documento" required="" />
                                                    </div>
                            	                </div>
                                            </div>
                                            
                                            <div class="row">
                            	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                                    <div style="text-align: left;">
                                                        <label> Número de teléfono (*)</label>
                                                        <input type="text" class="form-control" id="txt_telefonoContactoN" style="margin: 0 0 5px;"  onkeypress="return valideKey(event);" maxlength="15" name="txt_telefonoContactoN" placeholder="Número de telefono" onlyNumber required="" />
                                                    </div>
                            	                </div>
                                            </div>
                                            
                                            <div class="row">
                            	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                                    <div style="text-align: left;">
                                                        <label> Correo (*)</label>
                                                        <input type="text" class="form-control" id="txt_correoN" style="margin: 0 0 5px;" name="txt_correoN" placeholder="Ingrese su Correo" onlyNumber required="" />
                                                    </div>
                            	                </div>
                                            </div>
                                            
                                            <div class="row">
                            	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                                    <div style="text-align: left;">
                                                        <label> Direcci&oacute;n (*)</label>
                                                        <textarea type="text" class="form-control" id="txt_addressN" style="margin: 0 0 5px;" name="txt_addressN" placeholder="Ingrese su direcci&oacute;n"></textarea>
                                                    </div>
                            	                </div>
                                            </div>
                                            
                                            <div id="map-container-google-18" class="z-depth-1-half map-container-11"  style="height: 400px;">
                                                <fieldset class="gllpLatlonPicker" style="text-align: center;">
                                                    <h2 style="color: #09198b;"><b style="font-weight: 700; font-size: 28px;">Se&ntilde;ala tu direcci&oacute;n en el mapa</b></h2>
                                                    <iframe src="busqueda_lugar.php" id="busqueda_lugar_n" style="width: 100%;height: 300px;"></iframe>
                                                </fieldset>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="text-center">
                                                    <button type="button" class="btn btn-sm btn-success pernatural">Guardar Donante</button>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    
                                    <fieldset>
                                        <div id="personaJuridica" class="persona" style="display:none">
                                        
                                        <div class="row">
                        	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                            	                <div style="text-align: left;">
                                                    <label> Raz&oacute;n Social (*)</label>
                                                    <input type="text" class="form-control" id="txt_razonSocialJ" style="margin: 0 0 5px;" name="txt_razonSocialJ" placeholder="Ingrese raz&oacute;n social" required="" />
                                                </div>
                        	                </div>
                                        </div>
                                        
                                        <div class="row">
                        	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                                <div style="text-align: left;">
                                                    <label> N&uacute;mero Doc (*).</label>
                                                    <input type="text" class="form-control" id="txt_numDocJ" style="margin: 0 0 5px;" name="txt_numDocJ" onkeypress="return valideKey(event);" placeholder="Ingrese su N&uacute;mero de documento" required="" />
                                                </div>
                        	                </div>
                                        </div>
                                        
                                        <div class="row">
                        	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                                <div style="text-align: left;">
                                                    <label> Persona Contacto (*)</label>
                                                    <input type="text" class="form-control" id="txt_personaContactoJ" style="margin: 0 0 5px;" name="txt_personaContactoJ" placeholder="Ingrese sus persona contacto" required="" />
                                                </div>
                        	                </div>
                                        </div>
                                        
                                        <div class="row">
                        	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                                <div style="text-align: left;">
                                                    <label> Tel&eacute;fono Contacto (*)</label>
                                                    <input type="text" class="form-control" id="txt_telefonoContactoJ" onkeypress="return valideKey(event);" style="margin: 0 0 5px;" name="txt_telefonoContactoJ" placeholder="Ingrese su t&eacute;lefono contacto" required="" />
                                                </div>
                        	                </div>
                                        </div>
                                        
                                        <div class="row">
                        	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                                <div style="text-align: left;">
                                                    <label> Correo (*)</label>
                                                    <input type="text" class="form-control" id="txt_correoJ" style="margin: 0 0 5px;" name="txt_correoJ" placeholder="Ingrese su Correo" onlyNumber required="" />
                                                </div>
                        	                </div>
                                        </div>
                                        
                                        <div class="row">
                        	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                                <div style="text-align: left;">
                                                    <label> Direcci&oacute;n (*)</label>
                                                    <input type="text" class="form-control" id="txt_addressJ" style="margin: 0 0 5px;" name="txt_addressJ" placeholder="Ingrese su direcci&oacute;n" onlyNumber required="" />
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div id="map-container-google-18" class="z-depth-1-half map-container-11"  style="height: 400px;">
                                            <fieldset class="gllpLatlonPicker" style="text-align: center;">
                                                <h2 style="color: #9d1d96;"><b style="font-weight: 700; font-size: 28px;">Se&ntilde;ala tu direcci&oacute;n en el mapa</b></h2>
                                                <iframe src="busqueda_lugar.php" id="busqueda_lugar_j" style="width: 100%;height: 300px;"></iframe>
                                            </fieldset>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="text-center">
                                                <button type="button" class="btn btn-sm btn-success perjuridica">Guardar Donante</button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </fieldset>
                                </div>
                            </form>
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
    <script src="../build/js/custom.min.js"></script>
      
    <!--datatable- -->
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    
        <!-- SWEET-ALERT -->
    <script type="text/javascript" language="javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
    
    <script type="text/javascript" language="javascript" src="js/load/jquery.loadingModal.js"></script>
    
    <!-- JS SCRIPT APP -->
    <script type="text/javascript" language="javascript" src="js/cambiarContrasena.js" ></script>
    
    <script>
    
    
        $(document).ready(function(){
            listadonante();
            
            $('#tipopersona').on('change',function(){
                var tipopersona = parseInt( $(this).val() )
                if( tipopersona == 1 )
                {
                    $('#personaNatural').show()
                    $('#personaJuridica').hide()
                }else if( tipopersona == 2)
                {
                    $('#personaJuridica').show()
                    $('#personaNatural').hide()
                }
            });
            
            
            $('.pernatural').on('click',function(){
                var data = $(this).closest('fieldset').serialize();
                var error = []
                
                if(
                    $("#txt_razonSocialN").val().length == 0
                )
                {
                    error.push("Los nombres y apellidos no deben ir vacio")
                }
                
                if(
                    $("#txt_numDocN").val().length == 0
                )
                {
                    error.push("El número de documento no debe ir vacio")
                }
                
                if(
                    $("#txt_telefonoContactoN").val().length == 0
                )
                {
                    error.push("El telefono de comntacto no debe ir vacio")
                }
                
                if(
                    $("#txt_correoN").val().length == 0
                )
                {
                    error.push("Debe incluir un correo electronico")
                }
                
                if(
                    $("#txt_addressN").val().length == 0
                )
                {
                    error.push("Debe incluir la dirección")
                }
                
                if( error.length == 0 ){
                    guardar( data, 1 )
                }else{
                    alert("debe llenar los campos requeridos");
                }
            });
            
            $('.perjuridica').on('click',function(){
                var data = $(this).closest('fieldset').serialize();
                var error = []
                
                if(
                    $("#txt_razonSocialJ").val().length == 0
                )
                {
                    error.push("Debe incluir la razon social");
                }
                
                if(
                    $("#txt_numDocJ").val().length == 0
                )
                {
                    error.push("DEbe incluir un número de documento");
                }
                
                if(
                    $("#txt_personaContactoJ").val().length == 0
                )
                {
                    error.push("Debe incluir nombre de la persona de contacto");
                }
                
                if(
                    $("#txt_telefonoContactoJ").val().length == 0
                )
                {
                    error.push("Debe incluir número de la persona de contacto");
                }
                
                if(
                    $("#txt_correoJ").val().length == 0
                )
                {
                    error.push("Debe incluir correo electronico");
                }
                
                if(
                    $("#txt_addressJ").val().length == 0
                )
                {
                    error.push("Debe incluir la direccion");
                }
                
                
                if( error.length == 0 ){
                    guardar( data, 2 )
                }else{
                    alert("Debe llenar los campos requeridos");
                }
            });
            
             $('.tabledonante').on('click', '.btneditar', function(){
                var data = $('.tabledonante').DataTable().row( $(this).closest('tr') ).data();

                $(`#tipopersona option[value='${data["tipodonante"]}'`).prop({'selected':true});
                $(`#tipopersona`).prop({ 'disabled': true })
                
                if( parseInt(data['tipodonante']) == 1 )
                {
                    
                    $(`#txt_educativoN option[value=${data['nivel_academico']}]`).prop({'selected':true});
                    $(`#txt_generoN option[value=${data['genero2']}]`).prop({'selected':true});
                    
                    $("#txt_razonSocialN").val(data['nombres']);
                    $('#txt_numDocN').val(data['num_doc'])
                    $('#txt_telefonoContactoN').val(data['numero_contacto'] || '0000000000000')
                    $('#txt_correoN').val(data['correo'] || 'Sin correo')
                    $('#txt_parroquiaN').val(data['parroquias'])
                    $('#txt_fechaNacimientoN').val(data['fecha_nac'])
                    $('#txt_addressN').val(data['direccion'] || 'Por Asignar')
                    
                    $('#personaNatural').show()
                    $('#personaJuridica').hide()
                    
                }else if( parseInt(data['tipodonante']) == 2 )
                {
                    $('#txt_razonSocialJ').val(data['nombres'])
                    $('#txt_numDocJ').val((data['num_doc']))
                    $('#txt_personaContactoJ').val(data['persona_contacto'] || 'Por aplicar')
                    $('#txt_telefonoContactoJ').val(data['numero_contacto'])
                    
                    $('#txt_correoJ').val(data['correo'] || 'Por aplicar')
                    $('#txt_addressJ').val(data['direccion'] || 'Por Asignar')
                    
                    $('#personaJuridica').show()
                    $('#personaNatural').hide()
                }
                
                $("#myTab a[href='#tab_content2']").tab("show");
             });
        });
        
        function guardar( formDatas, tipopersona )
            {
            
            if(tipopersona==1){
                var iframe = document.getElementById('busqueda_lugar_n');
                var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
                var lat= innerDoc.getElementById('txt_latitud_frm');
                var lon= innerDoc.getElementById('txt_longitud_frm');
            }else{
                var iframe = document.getElementById('busqueda_lugar_j');
                var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
                var lat= innerDoc.getElementById('txt_latitud_frm');
                var lon= innerDoc.getElementById('txt_longitud_frm');
            }
            lat=lat.value;
            lon=lon.value;
                
                    
                        formDatas+=`&tipopersona=${tipopersona}&latitude=${lat}&longitude=${lon}`
                        // formDatas+=`&tipopersona=${tipopersona}`
                        $.ajax({
                            type: 'POST',
                            url: 'dist/ajax/donantes-donaciones/registrar.php',
                            dataType: 'json',
                            data: formDatas,
                            error: function(err)
                            {
                                console.log(err)
                            },
                            beforeSend: function()
                            {
                                $(".pernatural, .perjuridica").prop({disabled: true}).css({cursor: 'no-drop'}).html(` <i class="fa fa-spinner fa-spin"></i> ${ $('#tipopersona').attr('disabled') ? 'Actualizando' : 'Guardando' } Donante`)
                            },
                            success: function(response)
                            {
                                //console.log( response )
                                 switch( response.estado )
                                 {
                                     case 1:
                                         listadonante()
                                         $("#myTab a[href='#tab_content1']").tab("show");
                                         $("#registrarbeneficiario").trigger("reset")
                                         $('#personaJuridica').hide()
                                         $('#personaNatural').hide()
                                         break;
                                     case 2:
                                        alert( response.msj )
                                         break;
                                 }
                            },
                            complete: function()
                            {
                                $(".pernatural, .perjuridica").prop({disabled: false}).css({cursor: 'auto'}).html(` Guardar Donante`)
                                $(`#tipopersona option[value='0'`).prop({'selected':true});
                                $(`#tipopersona`).prop({ 'disabled': false })
                            }
                        });
                        
            }
        
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
            
        
        function listadonante(){
            $.ajax({
                type:'GET',
                url: 'dist/ajax/donantes-donaciones/listarDonantes.php',
                dataType: 'json',
                beforeSend: function()
                {
                    loadingModal( 'Obteniendo lista de donantes, espere....' )
                },
                error: function(err){
                    console.log(err);
                },
                success:function(response){
                            $.extend( $.fn.dataTable.defaults, {
                                destroy: true,
                                language:{
                                    url: "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                                },
                                destroy: true,
                            } );
                    switch(response.estado){
                        case 1:
                            $('.tabledonante').DataTable({
                                data: response.data,
                                columns:[
                                    {
                                        data: null,
                                        defaultContent: "<button type='button' class='btn btn-sm btn-success btneditar'><i class='fa fa-edit'></i></button>"
                                    },
                                    {
                                        data:'iddonante',
                                        visible: false
                                    },
                                    {
                                        data:'tipo',
                                    },
                                    {
                                        data:'num_doc',
                                    },
                                    {
                                        data:'nombres',
                                    },
                                    {
                                        data:'persona_contacto',
                                    },
                                    
                                    {
                                        data:'numero_contacto',
                                    },
                                    {
                                        data:'direccion',
                                    },
                                    {
                                        data:'latitud',
                                    },
                                    {
                                        data:'longitud',
                                    }
                                ],
                            });
                            break;
                        case 2:
                            alert(response.msj);
                            $('.tabledonante').DataTable();
                            break;
                    }
                },
                complete: function(  )
                {
                    loadingModal( "", false )
                }
            });
        }
        
        // Funcion para validar solo numeros
        function valideKey(e){
            var code = (e.which )? e.which : e.keyCode
             if(!(code >=48 && code <=57)){e.preventDefault();}
        }
        
        
    
    </script>
    </body>
    </html>
              