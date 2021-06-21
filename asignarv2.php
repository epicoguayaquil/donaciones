<?
    session_start();
    require 'funciones.php'; 
    
    if( !isLogin() )
    {
        header("location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head><meta charset="gb18030">
        
        <!-- Meta, title, CSS, favicons, etc. -->
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">
        <!-- DATATABLE CSS -->
        <link rel='stylesheet' type="text/css" href='https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css' />
        <!-- CHOSEN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" />
        
        <link rel="stylesheet" href="js/load/jquery.loadingModal.css">
        <?php
            titulo_header();
        ?>
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
                            <h3>Listado de donaciones para asignar</h3>
                        </div>
                    </div>
                    <div class="x_content" style="float:none">
                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs nav-justified" role="tablist" style="padding: 0 !important">
                                <li role="presentation" class="active" id="home">
                                    <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
                                        Visualizar todas las donaciones
                                    </a>
                                </li>
                                <li role="presentation" class="" id="home" style="display: none">
                                    <a href="#tab_content2" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
                                        Gestionar todas la donaciones
                                    </a>
                                </li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <hr />
                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
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
                                    <div class='table-responsive'>
                                        <table id="tableAsigDonaciones" class="table table-bordered display nowrap" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>
                                                    </th>
                                                    <!--<th style="display: none">-->
                                                    <!--    GESTIONAR-->
                                                    <!--</th>-->
                                                    <th>
                                                        NOMBRE DE LA CAUSA
                                                    </th>
                                                    <th>
                                                        PROP&Oacute;SITO
                                                    </th>
                                                    <th>
                                                        FECHA INICIO
                                                    </th>
                                                    <th>
                                                        FECHA FIN
                                                    </th>
                                                    <th>
                                                        ASIGNAR
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                
                                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="home-tab">
                                    <form id="formGesLogis" enctype="multipart/form-data" class="form-horizontal form-label-left">
                                        <input type="hidden" name="idgesDonacion" id="idgesDonacion" value="0" />
                                        <input type="hidden" name="idcausa" id="idcausa" value="0" />
                                        <br />
                                        <h1 class="text-center">
                                            Repartir las donaciones entre los gestores de log&iacute;stica
                                        </h1>
                                        
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12 parsley-error" for="nombre_causa">Nombre de causa</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="nombre_causa" readonly class="form-control col-md-7 col-xs-12" >
                                            </div>
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12 parsley-error" for="proposito">Prop&oacute;sito de la causa</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea id="proposito" readonly class="form-control col-md-7 col-xs-12"></textarea>
                                            </div>
                                        </div>
                                        
                                        <h3 class='text-center' style="margin-top: 1%">Detalles del donante</h3>
                                        
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12 parsley-error" for="nombres">Razon Social</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="nombres" readonly class="form-control col-md-7 col-xs-12" />
                                            </div>
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12 parsley-error" for="persona_contacto">Persona de contacto</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" class="form-control col-md-7 col-xs-12" id="persona_contacto" readonly />
                                            </div>
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12 parsley-error" for="numero_contacto">N&uacute;mero de contacto</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" class="form-control col-md-7 col-xs-12" id="numero_contacto" readonly />
                                            </div>
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12 parsley-error" for="direccion">Direcci&oacute;n</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea id="direccion" readonly class="form-control col-md-7 col-xs-12"></textarea>
                                            </div>
                                        </div>
                                        
                                        <h3 class='text-center' style="margin-top: 1%">Donaci&oacute;n</h3>
                                        
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12 parsley-error" for="producto">Producto de donaci&oacute;n</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="producto" readonly class="form-control col-md-7 col-xs-12" />
                                            </div>
                                        </div>
                                        
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12 parsley-error" for="cantidad">Cantidad</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="number" id="cantidad" readonly class="form-control col-md-7 col-xs-12" />
                                            </div>
                                        </div>
                                        
                                        <style type="text/css">
                                            .centrar{
                                                text-align: center !important;
                                            }
                                        </style>
                                        
                                        <div class="row" style="margin-top: 1%">
                                            <div class="col-md-6 col-md-offset-5">
                                                <button style="background-color: #054b88; border-color: #26312b; color: aliceblue;" class="alignright" onclick="duplicateLine('tablaGestores',event)" title="Agregar fila">
                                                    <i class="fa fa-plus" style="text"></i>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <div class="row" style="margin-top: 1%">
                                            <div class="col-md-10 col-md-offset-1">
                                                <table class="table" border=1 id="tablaGestores">
                                                    <thead style="background-color: #303030; color: white;">
                                                        <tr>
                                                            <th class="centrar">
                                                                Seleccione el gestor de logistica
                                                            </th>
                                                            <th class="centrar">
                                                                Selecciones el centro de acopio
                                                            </th>
                                                            <!--
                                                            <th class="text-center">
                                                                Seleccione un beneficiario
                                                            </th>
                                                            -->
                                                            <th class="centrar">
                                                                Ingrese la cantidad
                                                            </th>
                                                            <th class="centrar">
                                                                Eliminar
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tabla_producto_donar">
                                                        <tr>
                                                            <td>
                                                                <select id="gesLog" class="form-control gestor" name="gesLog[]" onchange="listarCentros(this, value)">
                                                                    <option value='0'>Seleccione Gestor Log&iacute;stico</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select id="centroacopio" class="form-control centroacopio" disabled name="centroacopio[]" onchange="habilitarCantidad(this, value)">
                                                                    <option value='0'>Seleccione un centro de acopio</option>
                                                                </select>
                                                            </td>
                                                            <!--
                                                            <td>
                                                                <select id="idbeneficiario" name="idbeneficiario[]" disabled class="form-control beneficiario" onchange="habilitarCantidad(this, value)">
                                                                    <option value='0'>Seleccione un beneficiario</option>
                                                                </select>
                                                            </td>
                                                            -->
                                                            <td>
                                                                <input type="number" min="1" disabled id="cantAsignada" name="cantAsignada[]" class="form-control cantidad" />
                                                            </td>
                                                            <td class="text-center">
                                                                <button type="button" onclick="eliminar_(this, event)" class="btn btn-primary btn-md text-center" style="margin-top: 5px;margin-bottom: 5px; background-color: #054b88; border-color: #26312b; font-size: 11px;padding: 7px 15px;">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        
                                        <div class="row" style="margin-top: 1%">
                                            <div class="col-md-6 col-md-offset-3 text-center">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fa fa-save"></i> Guardar Gestor 
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div
                        
                        <!-- MODAL DE DESPACHO -->
                        
                        <div class="modal fade modalasignardonaciones" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Asignar donaciones a gestor de log&iacute;stica</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3 id="donacion"></h3>
                                                <h2 id="cantidaddonacion"></h2>
                                            </div>
                                        </div>
                                        
                                        <form id="formLogisitico">
                                            <!--<input type="hidden" id="idtabledonaciones" name="idtabledonaciones" />-->
                                            <!--<input type="hidden" id="idcausadonacion" name="idcausadonacion" />-->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <!--
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button style="background-color: #054b88; border-color: #26312b;" class="alignright" onclick="duplicateLine('tabledespachardonaciones',event)" title="Agregar fila">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    -->
                                                    
                                                    
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <table border=1 class="table" id="tabledespachardonaciones">
                                                                <thead style="background-color: #303030; color: white;">
                                                                    <tr >
                                                                        <th style="text-align: center;">
                                                                            Seleccione el gestor logist&iacute;co
                                                                        </th>
                                                                        <!--
                                                                        <th style="text-align: center;">
                                                                            Indique la cantidad
                                                                        </th>
                                                                        <th style="text-align: center;">
                                                                            Eliminar
                                                                        </th>
                                                                        -->
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tbodyTable">
                                                                    <tr>
                                                                        <!-- onchange="habilitarCantidad(this, value)" -->
                                                                        
                                                                        <td style="text-align: center;">
                                                                            <select id="idgeslogistico" name="idgeslogistico" class="form-control idgeslogistico" required ></select>
                                                                        </td>
                                                                        
                                                                        <!--
                                                                        <td style="text-align: center;">
                                                                            <input type="number" class='form-control cantidadPorDonacion' min="1" id="cantidad" name="cantidad[]" class="form-control" required disabled >
                                                                        </td>
                                                                        <td style="text-align: center;">
                                        								    <button type="button" class="eliminar_fila btn btn-primary btn-lg" style="margin-top: 5px;margin-bottom: 5px; background-color: #054b88; border-color: #26312b; font-size: 11px;padding: 7px 15px;" onclick="eliminar_(this, event);">
                                        								        <i class="fa fa-trash"></i> 
                                        								    </button>
                                                                        </td>
                                                                        -->
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6 col-md-offset-5">
                                                    <button type="submit" class="btn btn-success asignarGestor">Asignar gestor de logística</button>
                                                </div>
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>    
            </div>
        </div>
        <!-- jQuery -->
        <script type="text/javascript" language="javascript" src="../vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script type="text/javascript" language="javascript" src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- DATATABLE JAVASCRIPT -->
        <script type="text/javascript" language="javascript" src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
        <!--<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>-->
        <!-- SWEET-ALERT -->
        <script type="text/javascript" language="javascript" src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script> 
        <!-- CHOSEN -->
        <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script> 
        <!-- Custom Theme Scripts -->
        <script type="text/javascript" language="javascript" src="../build/js/custom.js"></script>
        
            <!-- SWEET-ALERT -->
    <script type="text/javascript" language="javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
    
    <script type="text/javascript" language="javascript" src="js/load/jquery.loadingModal.js"></script>
    
    <!-- JS SCRIPT APP -->
    <script type="text/javascript" language="javascript" src="js/cambiarContrasena.js" ></script>
        <!-- SCRIPT PAGES APP -->
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
                
                cargardonaciones()
                
                /*
                $('#tableAsigDonaciones').on('click', '.btn-editar', function(){
                    var data = $('#tableAsigDonaciones').DataTable().row( $(this).closest('tr') ).data()
                    
                    $("#idcausa").val( data['idcausa'] )
                    $("#idgesDonacion").val(data['idtabledonaciones'])
                    $("#nombre_causa").val(data['nombre_causa'])
                    $("#proposito").val(data['proposito'])
                    
                    $("#nombres").val(data['nombres'])
                    $("#persona_contacto").val(data['persona_contacto'])
                    $("#numero_contacto").val(data['numero_contacto'])
                    $("#direccion").val(data['direccion'])
                    
                    $("#producto").val(data['nombre'])
                    $("#cantidad").val( data['cantidad'])
                    
                    $("#cantAsignada").prop({'max': data['cantidad']})
                    
                    $("#myTab a[href='#tab_content2']").tab("show");
                })
                */
                
                /*
                $("#formGesLogis").submit(function(event){
                    event.preventDefault()
                    var flagGuardar = false,
                        gestoreUnicos = [],
                        total = 0
                        
                    try{
                        $('select.gestor,select.centroacopio,select.beneficiario').each((index, item)=>{
                                    alertaError(item)
                                    flagGuardar = false
                                    throw 'Debe seleccionar un centro de acopio'
                            if( $(item).val() == 0 )
                            {
                                if( $(item).hasClass("gestor") )
                                {
                                    alertaError(item)
                                    flagGuardar = false
                                    throw 'Debe seleccionar un gestor'
                                }else if( $(item).hasClass("centroacopio") )
                                {
                                    alertaError(item)
                                    flagGuardar = false
                                    throw 'Debe seleccionar un centro de acopio'
                                }/* else if( $(item).hasClass("beneficiario") )
                                {
                                    alertaError(item)
                                    flagGuardar = false
                                    throw 'Debe seleccionar un beneficiario'
                                }
                                
                            }else{
                                flagGuardar = true
                                $(item).css({'border': '1px solid lightgrey'});
                                if( $(item).hasClass("gestor") )
                                {
                                    gestoreUnicos.push($(item).val())
                                }
                            }
                        })
                    
                        $('input[type=number].cantidad').each((index, item)=>{
                            if( parseInt( $(item).val() ) == 0 || $(item).val() == '' )
                            {
                                flagGuardar = false
                                alertaError(item)
                                throw "La cantidad debe ser mayor a 0"
                            }else{
                                total += parseInt( $(item).val() )
                            }
                        })
                    
                        var gestoresUnicos = Array.from(new Set(gestoreUnicos))
                        if( gestoreUnicos.length != gestoresUnicos.length )
                        {
                            flagGuardar = false
                            throw 'No se deben repetir los gestores'
                        }
                        
                        if( total != parseInt( $('#cantidad').val() ) )
                        {
                            flagGuardar = false
                            throw 'La cantidad designada a la donaci\u00F3n debe coincidir con la repartida entre los gestores'
                        }
                    }catch(e){
                        // alert(e)
                        Swal.fire({
                            icon: 'info',
                            title: 'Gestor Log\u00F3stica',
                            text: e,
                            confirmButtonText: 'Cerrar'
                        })
                    }
                    
                    if(flagGuardar)
                    {
                        var formData = new FormData($("#formGesLogis")[0])
                        formData.append('metodo', 'GESTIONARDONACIONES')
                        
                        $.ajax({
                            type: 'POST',
                            url: 'dist/ajax/logisitico/listardonaciones.php',
                            data: formData,
                            dataType: 'json',
                            cache: false,
                            processData: false,
                            contentType: false,
                            error: function(err)
                            {
                                console.log(err)
                            },
                            success: function(response)
                            {
                                switch( response.success )
                                {
                                    case 1:
                                        location.reload()
                                        break
                                    case 2:
                                        alert(response.mensaje)
                                        break
                                    case 3:
                                        location.reload()
                                        break
                                }
                            }
                        })
                    }
                    
                    return false
                })
                */
                
                
                var cantAsignada = [],
                    producto = [],
                    donacion = []
                    
                    
                $(".modalasignardonaciones").on('hidden.bs.modal', function () {
                    cantAsignada = [],
                    producto = [],
                    donacion = []
                });
                
                $("#tableAsigDonaciones").on('click', '.btn-asignar', function(){
                    var data = $('#tableAsigDonaciones').DataTable().row( $(this).closest('tr') ).data()
                    
                    $("#idtabledonaciones").val( data['idtabledonaciones'] )
                    
                    try{
                        var checked = false, cont = 0
                        $("#subCausaDetalle").find("input[name=asignar]:checked").each(function(index, item){
                            checked = true;
                            
                            var cantidadTotalDonacion = $(item).parent().parent().find(".cantidadDisponible").val(),
                                cantidadAsignadaDonacion = $(item).parent().parent().find(".cantidadAsignar").val(),
                                iddonacion = $(item).parent().parent().find(".cantidadAsignar").data('iddonacion'),
                                iproducto = $(item).parent().parent().find(".cantidadAsignar").data('idproducto')
                                
                            if( parseInt( cantidadAsignadaDonacion ) <= 0 )
                            {
                                cantAsignada = [] 
                                donacion = []
                                producto = []
                                throw 'No se permite esos valores'
                            }
                            
                            if( !parseInt( cantidadAsignadaDonacion ) > 0 )
                            {
                                cantAsignada = [] 
                                donacion = []
                                producto = []
                                throw 'La asignación no debe ser cero o vacio'
                                cont = 0
                            }else if( parseInt( cantidadAsignadaDonacion ) <= parseInt( cantidadTotalDonacion ) )
                            {
                                cantAsignada.push(cantidadAsignadaDonacion)
                                donacion.push(iddonacion)
                                producto.push(iproducto)
                                
                                cont++;
                            }else{
                                cantAsignada = [] 
                                donacion = []
                                producto = []
                                cont = 0
                                throw 'No debe superar la cantidad establecida'
                            }
                        })
                        
                        if( cont )
                        {
                            $(".modalasignardonaciones").modal('show')
                        }
                        
                        
                        if( checked == 0)
                        {
                            throw 'Debe seleccionar al menos una donación'
                        }
                    }catch(e)
                    {
                        Swal.fire({
                            icon: 'info',
                            text: e
                        })
                    }
                })
                
                $("#formLogisitico").submit(function(){
                    var flagPasar = true
                    try
                    {
                        if( parseInt( $("select.idgeslogistico").val() ) == 0 )
                        {
                            $("select.idgeslogistico").css('border', '1px solid red')
                            flagPasar = false
                            throw "Debe elegir un gestor"
                        }   
                    }catch(e)
                    {
                        alert(e)
                    }
                    
                    
                    
                    if( flagPasar )
                    {
                        var formData = new FormData( $("#formLogisitico")[0] )
                        formData.append('metodo', 'DESPACHARDONACIONES')
                        
                        formData.append("idtabladonacion", JSON.stringify(donacion))
                        formData.append("cantAsignada", JSON.stringify(cantAsignada))
                        formData.append("idproducto", JSON.stringify(producto))
                        
                        $.ajax({
                            type: 'POST',
                            url: 'dist/ajax/logisitico/listardonaciones.php',
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
				$(".asignarGestor").prop({'disabled': true}).html('<i class="fa fa-spinner fa-spin"></i> Asignando Gestor ');
			},
                            success: function(response)
                            {
                                switch( response.success )
                                {
                                    case 1:
                                        document.location.reload()
                                        break
                                    case 2:
                                        alert(response.mensaje)
                                        break
                                }
                            }, 

                        })
                    }
                    
                    return false
                })
                
            })
            
            // <!-- FUNCIONES -->
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
            
            function cargarDonacionesAcopio(elemento, valor)
            {
                if( parseInt( valor ) > 0 )
                {
                    $.ajax({
                        type: 'POST',
                        url: 'dist/ajax/logisitico/listardonaciones.php',
                        data: {
                            metodo: 'LISTARLOGISTICA',
                            idsucursal: parseInt(valor),
                            iddonacion: parseInt( $("#idtabledonaciones").val() ),
                            idcausa: parseInt( $("#idcausadonacion").val() )
                        },
                        dataType: 'json',
                        error: function( err )
                        {
                            console.log( err )
                        },
                        success: function( response )
                        {
                            switch( response.success )
                            {
                                case 1:
                                    $("#gestorLogistica").val(response.data[0]['nombre'])
                                    $("#gestorLogisticaCantidad").val(response.data[0]['cantidad'])
                                    $("#tbodyTable").html(response.tabla)
                                    $(".btnbnene").prop({'disabled': false})
                                    break
                            }
                        }
                    })
                }else{
                    $(elemento).val(0)
                }
            }
            
            function alertaError(items)
            {
                $(items).css({'border': '1px solid red'})
            }
            
            function cargardonaciones()
            {
                $.ajax({
                    type: 'POST',
                    url: 'dist/ajax/causas/listarSolicitud.php',
                    data:{
                        metodo: 'LISTARDONACIONESV2'
                    },
                    dataType: 'json',
                    beforeSend: function()
                    {
                        loadingModal( 'Obteniendo donaciones para asignar, espere...' )
                    },
                    error: function(err)
                    {
                        console.log( err )
                    },
                    success: function(response)
                    {
                        // console.log( response )
                        switch(response.success)
                        {
                            case 1:
                                var longitudCaracter = 20,
                                    table = $("#tableAsigDonaciones").DataTable({
                                        data: response.data,
                                        // scrollX: true,
                                        responsive: true,
                                        columns: [
                                            {
                                                className: 'text-center details-control',
                                                orderable:      false,
                                                data:           null,
                                                defaultContent: ''
                                            },
                                            {
                                                className: 'text-center',
                                                render: function( data, type, row )
                                                {
                                                    return `
                                                        ${ row["nombre_causa"].length <= longitudCaracter ? row["nombre_causa"] : row["nombre_causa"].substr(0,longitudCaracter)+"...." }
                                                    `
                                                }
                                            },
                                            {
                                                className: 'text-center',
                                                render: function( data, type, row )
                                                {
                                                    return `
                                                        ${ row["proposito"].length <= longitudCaracter ? row["proposito"] : row["proposito"].substr(0,longitudCaracter)+"...." }
                                                    `
                                                }
                                            },
                                            {
                                                className: 'text-center',
                                                data: 'fecha_inicio'
                                            },
                                            {
                                                className: 'text-center',
                                                data: 'fecha_fin'
                                            },
                                            {
                                                className: 'text-center',
                                                data: null,
                                                render: function( data, type, row )
                                                {
                                                    // console.log( row['detalleCausa'] == undefined )
                                                    return `<button type='button' class='btn btn-success btn-asignar' ${ row['estado'] == 'P' || row['beneficiarios'].length == 0 || row['detalleCausa'] == undefined ? 'disabled' : '' }> ASIGNAR </button>`
                                                }
                                            }
                                        ],
                                    })
                                
                            
                                $('#tableAsigDonaciones tbody').on('click', 'td.details-control', function () {
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
                                
                                break;
                            case 2:
                                alert(response.mensaje)
                                break;
                            case 3:
                                location.reload()
                                break;
                        }
                    },
                    complete: function()
                    {
                        cargarGesLogistica()
                        
                        loadingModal( '', false )
                    }
                })
            }
            
            function format ( d )
            {
                var subtable = `
                    <table cellpadding="5" cellspacing="0" border="1" style="margin: auto" id="subCausaDetalle">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    DONANTE
                                </th>
                                <th class="text-center">
                                    PRODUCTO
                                </th>
                                <th class="text-center">
                                    CANTIDAD <br> TOTAL
                                </th>
                                <th class="text-center">
                                    CANTIDAD <br> DISPONIBLE
                                </th>
                                <th class="text-center">
                                    CANTIDAD A <br> ASIGNAR
                                </th>
                                <th class="text-center">
                                    ASIGNAR A <br> GESTOR LOG&Oacute;STICO
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                    `
                    if( d['beneficiarios'].length > 0 )
                    {
                        // if( d['detalleCausa'].length > 0 )
                        if( d['detalleCausa'] != undefined )
                        {
                            d['detalleCausa'].forEach(function(item){
                                subtable += `
                                    <tr>
                                        <td>
                                            ${ item['nombres'] }
                                        </td>
                                        <td>
                                            ${ item['nombre'] }
                                        </td>
                                        <td>
                                            <input type="number" readonly value="${ item['cantidadAux'] }" class="text-center" style="border: none" />
                                        </td>
                                        <td>
                                            <input type="number" id="cantidadDisponible" readonly value="${ item['cantidad'] }" class="text-center cantidadDisponible" style="border: none" />
                                        </td>
                                        <td>
                                                <input type="number" min="0" id="cantidadAsignar" data-iddonacion="${ item['idtabledonaciones'] }" data-idproducto="${ item['idproducto'] }" max="${ item['cantidad'] }" placeholder="${ item['cantidad'] }" ${ parseInt(item['cantidad']) == 0 ? 'disabled' : ' '} class="form-control text-center cantidadAsignar"  />
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="asignar" id="asignar" ${ parseInt(item['cantidad']) == 0 ? 'disabled' : ' '} class="asignar"  />
                                        </td>
                                    </tr>
                                `
                            })
                        }else{
                            subtable += `
                                <tr>
                                    <td colSpan="10" class="text-center">
                                        No hay productos asignados a esta causa
                                    </td>
                                </tr>
                            `
                        }
                    }else{
                        subtable += `
                            <tr>
                                <td colSpan="20" class='text-center'>
                                    Debe seleccionar al menos un beneficiario para la causa
                                </td>
                            </tr>
                        `
                    }
                subtable += `
                        </tbody>
                    </table>
                `
                
                return subtable
            }
                        
            function cargarGesLogistica()
            {
                $.ajax({
                    type: 'POST',
                    url: 'dist/ajax/usuarios/listarUSuarios.php',
                    data:{
                        metodo: 'GLOGISTICO'
                    },
                    dataType: 'json',
                    success: function(response)
                    {
                        // console.log( response )
                       
                        switch( response.success )
                        {
                            case 1:
                                var optionGes = "<option value='0'>Seleccione gestor logistico</option>",
                                    propDisabled = true,
                                    gestor = response.data
                                if( gestor.length > 0 ) 
                                {
                                    propDisabled = false
                                    gestor.forEach((index)=>{
                                        optionGes += `<option value='${index['usu_id']}' > GESTOR LOG&Iacute;STICO - ${index['nombre']}</option>`
                                    })
                                }else{
                                    optionGes = "<option value='0'>No hay gestor disponible</option>"
                                }
                                $("#idgeslogistico").html(optionGes).prop({'disabled': propDisabled})
                                break;
                        }
                        
                    }
                })
            }
            
            function eliminar_(element, event)
            {
            	event.preventDefault();	
            	
            	var tabla = $(element).parent().parent().parent()[0].rows
            	
            	if( tabla.length > 1 ){
            	    $(element).parent().parent().remove();
            	}else if( tabla.length == 1)
            	{
            	    $(element).parent().parent().find('select,input[type=number]').val(0)
            	}
            	
                formatearFilas()
            }
            
            function formatearFilas(div)
            {
                $(div).find('tr').each(function (index, item){
                    $(item).find("select,input[type=number],button").attr({'data-posicion': index});
                });
            }
            
            function listarCentros(element, value)
            {
                if( parseInt( value ) > 0 )
                {
                    $.ajax({
                        type: 'POST',
                        url: 'dist/ajax/acopio/centrosAcopio.php',
                        data:{
                            idgestor: parseInt(value),
                            accion: 'LISTAR'
                        },
                        dataType: 'json',
                        success: function(response)
                        {
                            console.log(response)
                            switch( response.success )
                            {
                                case 1:
                                        var optionAcopio = "<option value='0'> Seleccione el centro de acopio </option>",
                                        selectAcopio = $(element).parent().parent().find('select#centroacopio'),
                                        data = response.data,
                                        propDisabled = true
                                        
                                        if( data.length > 0 )
                                        {
                                            propDisabled = false
                                            data.forEach((index)=>{
                                                optionAcopio += `<option value='${ index['idsucursal'] }'> ${ index['nombre'] } </option>`
                                            })
                                        }else{
                                            optionAcopio = "<option value='0'> No hay centros de acopio disponibles </option>"
                                        }
                                        $(selectAcopio).html(optionAcopio).prop({'disabled': propDisabled})
                                    break;
                                case 2:
                                    alert(response.mensaje)
                                    break;
                                case 3:
                                    location.reload()
                                    break;
                            }
                        }
                    })
                }else{
                    alert('Debe seleccionar un gestor')
                }
            }
            
            function habilitarCantidad(element, value)
            {
                var propDisabled = true
                if( parseInt( value ) > 0 )
                {
                    propDisabled = false
                }
                $(element).parent().parent().find('input[type=number]').prop({'disabled': propDisabled})
            }
            
            function duplicateLine(DIV,event)
            {
            	event.preventDefault();
            	
            	var element = "#"+DIV+" tbody tr:last";
            	
            	var fila = $(element)
            	fila.clone().appendTo('#'+DIV+' tbody')
            	
                formatearFilas(`#${DIV}`)
            }
        </script>
    </body>
</html>