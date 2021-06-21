<?php
    session_start();
    
    ini_set("display_errors","1");
    
    require 'funciones.php';
    //require_once "conexion.php";

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
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

        <!-- DATATABLE CSS -->
        <link rel='stylesheet' type="text/css" href='https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css' />


    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

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
            <div class="x_content">
                
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs nav-justified" role="tablist" style="padding: 0">
                        <li role="presentation" class="active" id="home">
                            <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
                                Visualizar todos las donaciones asignadas
                            </a>
                        </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <hr />
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                            <h2>
                                Listado de donaciones para asignar
                            </h2>
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
                            <table class="display table table-bordered" id="tabladonacionasignada"  style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                        </th>
                                        <th>
                                            CAUSA
                                        </th>
                                        <th>
                                            PROP&Oacute;SITO DE LA CAUSA
                                        </th>
                                        <th>
                                            DESPACHAR
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                
                
                <!-- MODAL DESPACHO -->
                <div class="modal fade modaldespacho" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Despachar Donaciones</h4>
                            </div>
                            <div class="modal-body">
                                <form id="formLogisitico">
                                    <input type="hidden" id="iddonacion" name="iddonacion" />
                                    <div class="row">
                                        <div class="col-md-12">
                                            <hr />
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table border=1 class="table" id="tableVerificador">
                                                        <thead style="background-color: #303030; color: white;">
                                                            <tr >
                                                                <th style="text-align: center;">
                                                                    Seleccione Gestor Verificador
                                                                </th>
                                                                <th style="text-align: center;">
                                                                    Seleccione el centro de acopio
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tbodyTable">
                                                            <tr>
                                                                <td style="text-align: center;" >
                                                                    <select id="idgesVerificador" name="idgesVerificador" class="form-control idgesVerificador" required>
                                                                        
                                                                    </select>
                                                                </td>
                                                                <td style="text-align: center;" >
                                                                    <select id="idcentroacopio" name="idcentroacopio" class="form-control idcentroacopio" required>
                                                                        
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-md-6 col-md-offset-5">
                                            <button type="submit" class="btn btn-success asignarVerificador">Guardar Despacho</button>
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
        <script type="text/javascript" language="javascript" src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    <!-- DATATABLE JAVASCRIPT -->
    <script type="text/javascript" language="javascript" src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <!-- SWEET-ALERT -->
    <script type="text/javascript" language="javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
    
    
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
            
            cargarDonaciones()
            
            var donacionBeneficiario = [],
                beneficiarioCant = [],
                iddonacion = [],
                idtabla = []
                
            $(".modaldespacho").on('hidden.bs.modal', function () {
                donacionBeneficiario = []
                beneficiarioCant = []
                iddonacion = []
                idtabla = []
            });
                
            $("#tabladonacionasignada").on('click', '.btn-asignar', function(){
                var data = $("#tabladonacionasignada").DataTable().row( $(this).closest('tr') ).data()
                console.log( data )
                
                // $("#iddonacion").val( data['idtabledonaciones'] )
                
                try{
                    var checked = true, cont = 0
                    $("#subDetalleProducto").find('input[name=despacharDonacion]:checked').each(function(index, item){
                        checked = false;
                        
                        var donacionAsigna = parseInt( $(item).parent().parent().find('input[type=number].cantidadDisponible').val() ),
                            beneficiarioSelect = ( $(item).parent().parent().find(`.idbeneficiarios_${data['idcausa']}`).val() ),
                            iddonacionAux = parseInt( $(item).parent().parent().find('.cantidadDisponible').data('iddonacion') ),
                            idtablaAux = parseInt( $(item).parent().parent().find('.cantidadDisponible').data('idtabla') ),
                            beneficiarioCantidad = ( $(item).parent().parent().find('.cantidadADespachar').val() )
                            
                        if( parseInt( beneficiarioSelect ) == 0 ) throw 'Debe seleccionar el beneficiario'
                    
                        if( beneficiarioCantidad == '' || parseInt(beneficiarioCantidad) == 0 ) throw 'La cantidad para asignar no debe estar vacio, ni tener el valor de cero'
                        
                        if( parseInt(beneficiarioCantidad) <= 0 ) throw 'No debe tener valores negativo, ni cero'
                        
                        if( !( parseInt(beneficiarioCantidad) <= donacionAsigna ) ) throw 'La danación para despachar no debe superar la cantidad establecida'
                        
                        cargarCentroAcopio()
                        cargarGVerificador()
                        
                        donacionBeneficiario.push( beneficiarioSelect )
                        beneficiarioCant.push( beneficiarioCantidad )
                        iddonacion.push( iddonacionAux )
                        idtabla.push( idtablaAux )
                    })
                    
                    if( checked )
                    {
                        throw 'Debe seleccionar al menos una donación para despachar'
                    }
                    
                    $(".modaldespacho").modal('show')
                    
                }catch(e)
                {
                    donacionBeneficiario = []
                    beneficiarioCant = []
                    iddonacion = []
                    donacion = []
                    
                    Swal.fire({
                        icon: 'info',
                        text: e,
                        confirmButtonText: 'Cerrar'
                    })
                }
            })
            
            $("#formLogisitico").submit(function(event){
                event.preventDefault()
                
                var flag = false

                try{
                    if( parseInt( $("#idgesVerificador").val() ) == 0 ) throw 'Debe seleccionar un gestor de logística'
                    
                    if( parseInt( $("#idcentroacopio").val() ) == 0 ) throw 'Debe seleccionar un centro de acopio'
                    
                    flag = true
                }catch(e)
                {
                    Swal.fire({
                        icon: 'info',
                        text: e,
                        confirmButtonText: 'Cerrar'
                    })
                    
                }
                
                if(flag)
                {
                    var formData = new FormData($("#formLogisitico")[0])
                    formData.append('metodo', 'GESTIONARDONACIONESV1')
                    
                    formData.append("donacionBeneficiario", JSON.stringify( donacionBeneficiario ) )
                    formData.append("beneficiarioCant", JSON.stringify( beneficiarioCant ) )
                    formData.append('iddonacion', JSON.stringify(iddonacion) )
                    formData.append("idtabla", JSON.stringify( idtabla ) )
                    
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
                                $(".asignarVerificador").prop({'disabled': true}).html('<i class="fa fa-spinner fa-spin"></i> Despachando donación');
                            },
                        success: function(response)
                        {
                            // console.log( response )
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
            
        })
        
        function alertaError(items)
        {
            $(items).css({'border': '1px solid red'})
        }
        
        function habilitarSelect( element, select, valor)
        {
            var flagDisabled = true
            if( parseInt( valor ) > 0 )
            {
                flagDisabled = false
            }
            
            $(element).parent().parent().find(select).prop({'disabled': flagDisabled})
        }
        
        function cargarbeneficiarios( idcausa )
        {
            if( idcausa > 0)
            {
                $.ajax({
                    type: 'POST',
                    url: 'dist/ajax/causas/listarbenefeciariocuasa.php',
                    data: { 
                        id_causa: idcausa
                    },
                    dataType: 'json',
                    error: function( err )
                    {
                        console.log( err )
                    },
                    success: function( response )
                    {
                        switch( response.estado )
                        {
                            case 1:
                                var optionBeneficiario = "<option value='0' > Seleccione un beneficiario </option>",
                                    beneficiario = response.data,
                                    flagDisabled = true
                                    if( beneficiario.length > 0 )
                                    {
                                        flagDisabled = false
                                        beneficiario.forEach(function(item){
                                            optionBeneficiario += `<option value='${ item['idbeneficiario'] }'> ${ item['num_doc'] } - ${ item['nombres'] } </option>`
                                        })
                                    }else{
                                        optionBeneficiario = "<option value='0' > No hay beneficiario para la causa </option>"
                                    }
                                    $(`.idbeneficiarios_${idcausa}`).html(optionBeneficiario).prop({'disabled': flagDisabled})
                                break
                        }
                    },
                    complete: function()
                    {
                        cargarCentroAcopio()
                        cargarGVerificador()
                    }
                    
                })
            }else{
                // $(`.idbeneficiarios_${idcausa}`).parent().parent().find("select.idgesVerificador, select.idcentroacopio, input[type=number]").val(0).prop({'disabled': true})
                alert("Debe seleccionar un beneficiario")
            }
        }
        
        function cargarCentroAcopio()
        {
            $.ajax({
                type: 'POST',
                url: 'dist/ajax/logisitico/listardonaciones.php',
                dataType: 'json',
                data: {
                    // iddata: parseInt( data['idtabledonaciones'] ),
                    metodo: 'LISTARDESPACHO',
                },
                error: function( err )
                {
                    console.log( err )
                },
                success: function( response )
                {
                    switch( response.success )
                    {
                        case 1:
                            var optionAcopio = "<option value='0'> Seleccione un centro de acopio </option>",
                                centroacopio = response.sucursal,
                                propDisabled = true
                                
                            if( centroacopio.length > 0 )
                            {
                                propDisabled = false
                                centroacopio.forEach(function(index){
                                    optionAcopio += `<option value='${index['idsucursal']}' > ${ index['nombre'] } </option>`
                                })
                            }else{
                                optionAcopio = "<option value='0'> No hay centro de acopio disponible </option>"
                            }
                            $(".idcentroacopio").html(optionAcopio).prop({'disabled': propDisabled})
                            break
                    }
                    
                },
            })
        }
        
        function cargarGVerificador()
        {
            $.ajax({
                type: 'POST',
                url: 'dist/ajax/usuarios/listarUSuarios.php',
                dataType: 'json',
                data: {
                    // iddata: parseInt( data['idtabledonaciones'] ),
                    metodo: 'GESTORVERIFICADOR',
                },
                error: function( err )
                {
                    console.log( err )
                },
                success: function( response )
                {
                    switch( response.success )
                    {
                        case 1:
                            var optionAcopio = "<option value='0'> Seleccione un gestor verificador </option>",
                                centroacopio = response.data,
                                propDisabled = true
                                
                            if( centroacopio.length > 0 )
                            {
                                propDisabled = false
                                centroacopio.forEach(function(index){
                                    optionAcopio += `<option value='${index['usu_id']}' > ${ index['nombre'] } </option>`
                                })
                            }else{
                                optionAcopio = "<option value='0'> No hay gestor verificador disponible </option>"
                            }
                            $(".idgesVerificador").html(optionAcopio).prop({'disabled': propDisabled})
                            break
                    }
                    
                },
            })
        }
        
        function duplicateLine(DIV,event)
        {
        	event.preventDefault();
        	
        	var element = "#"+DIV+" tbody tr:last";
        	
        	var fila = $(element)
        	fila.clone().appendTo('#'+DIV+' tbody')
        	
            formatearFilas(`#${DIV}`)
        }

        function eliminar_(element, event)
        {
            event.preventDefault()
            
            var tabla = $(element).parent().parent().parent()[0].rows
	
        	if( tabla.length > 1 ){
        	    $(element).parent().parent().remove();
        	}else if( tabla.length == 1 )
        	{
        	    $(element).parent().parent().find('select,input[type=number]').val(0)
        	}
        }
        
        function formatearFilas(div)
        {
            $(div).find('tr').each(function (index, item){
                $(item).find("select.categorias,select.productoCausa,input[type=number]#cantidad_producto,button.eliminar_fila_donacion").attr({'data-posicion': index});
            });
        }
        
        function cargarDonaciones()
        {
            $.ajax({
                type: 'POST',
                url: 'dist/ajax/logisitico/listardonaciones.php',
                data: {
                    metodo: 'GESTIONARDONACIONESID-V2'
                },
                dataType: 'json',
                error: function(err)
                {
                    console.log( err )
                },
                success: function(response)
                {
                    console.log( response )
                    switch(response.success)
                    {
                        case 1:
                            var table = $("#tabladonacionasignada").DataTable({
                                data: response.data,
                                columns: [
                                    {
                                        className: 'text-center details-control',
                                            orderable:      false,
                                            data:           null,
                                            defaultContent: ''
                                    },
                                    {
                                        data: 'nombre_causa',
                                        className: 'text-center',
                                    },
                                    {
                                        data: 'proposito',
                                        className: 'text-center'
                                    },
                                    {
                                        className: 'text-center',
                                        data: null,
                                        render: function ( data, type, row ){
                                            return `<button type="button" class=" btn btn-success btn-asignar"> Despachar </button>`
                                        }
                                    }
                                ]
                            })
                            
                            $('#tabladonacionasignada tbody').on('click', 'td.details-control', function () {
                                    var tr = $(this).closest('tr');
                                    var row = table.row( tr );
                                    
                                    if ( row.child.isShown() ) {
                                        // This row is already open - close it
                                        row.child.hide();
                                        tr.removeClass('shown');
                                    } else {
                                        // Open this row
                                        row.child( format( row.data() ) ).show();
                                        tr.addClass('shown');
                                    }
                                } );
                            break
                        case 2:
                            alert(respons.mensaje)
                            break
                        case 3:
                            location.reload()
                            break
                    }
                }
            })
        }
        
       function format ( data )
        {
            console.log( data )
            cargarbeneficiarios( data['idcausa'] )
            var donaciones = data['detalleDonacion'],
                tabla = ""
                
            tabla = `
                <table cellpadding="5" cellspacing="0" border="1" style="margin: auto" id="subDetalleProducto">
                    <thead>
                        <tr>
                            <th class='text-center'>
                                BENEFICIARIOS
                            </th>
                            <th class='text-center'>
                                PRODUCTO
                            </th>
                            <th class='text-center'>
                                CANTIDAD DE PRODUCTO DISPONIBLE
                            </th>
                            <th class='text-center'>
                                CANTIDAD DE PRODUCTO PARA DESPACHAR
                            </th>
                            <th class='text-center'>
                                ASIGNAR GESTOR VERIFICADOR
                            </th>
                        </tr>
                    </thead>
                    <tbody>
            `
            
            if( donaciones.length > 0 )
            {
                donaciones.forEach(function(item){
                    tabla += `
                        <tr>
                            <td>
                                <select id="idbeneficiarios" class="form-control idbeneficiarios_${data['idcausa']}" required>
                                    <option value='0'> SELECCIONE UN BENEFICIARIO </option>
                                </select>
                            </td>
                            <td class='text-center'>
                                ${ item['producto'] }
                            </td>
                            <td>
                                <input type="number" class='form-control text-center cantidadDisponible' required min='1' data-iddonacion="${ item['idtabledonaciones'] }" data-idtabla='${ item['idtabla'] }' max='${ item['cantidad'] }' value='${ item['cantidad'] }' readonly style='border: none' />
                            </td>
                            <td>
                                <input type="number" class='form-control text-center cantidadADespachar' required min='1' max='${ item['cantidad'] }' placeholder='${ item['cantidad'] }' ${ parseInt(item['cantidad']) == 0 ? 'disabled' : '' }  />
                            </td>
                            <td class='text-center'>
                                <input type='checkbox' id="despacharDonacion" name="despacharDonacion" required ${ parseInt(item['cantidad']) == 0 ? 'disabled' : '' } />
                            </td>
                        </tr>
                    `
                })
            }else{
                tabla += `
                    <tr>
                        <td colSpan="10" class="text-center">
                            No hay datos para mostrar
                        </td>
                    </tr>
                `
            }
            
            
            tabla += `
                    </tbody>
                </table>
            `
            return tabla
        }
    </script>
  </body>
</html>