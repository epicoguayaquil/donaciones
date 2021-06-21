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
        <!-- Switchery -->
        <link rel='stylesheet' href="../vendors/switchery/dist/switchery.min.css" >
        <!-- Choseen -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chosen-js@1.8.7/chosen.min.css"/>
        
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
                            <h3>Listado de productos</h3>
                        </div>
                    </div>
                    <div class="x_content" style="float:none">
                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs nav-justified" role="tablist" style="padding: 0 !important">
                                <li role="presentation" class="active" id="home">
                                    <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
                                        PRODUCTOS
                                    </a>
                                </li>
                            </ul>
                            
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                    <hr />
                                    <div class='row'>
                                        <div class='col-md-7'>
                                            <table class='table table-bordered' id="tablaProductos">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            GESTI&Oacute;N
                                                        </th>
                                                        <th class="text-center">
                                                            NOMBRE DEL PRODUCTO
                                                        </th>
                                                        <th class="text-center">
                                                            DESCRIPCI&Oacute;N DEL PRODUCTO
                                                        </th>
                                                        <th class='text-center'>
                                                            CATEGORIA DEL PRODUCTO
                                                        </th>
                                                        <th class="text-center">
                                                            ESTADO
                                                        </th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class='col-md-5'>
                                            <form id="formProducto">
                                                <input type='hidden' id='idproducto' name='idproducto' value='0' />
                                                <div class="row">
                                                    <div class='col-md-12 text-center'>
                                                        <h3>Registro y Actualizaci&oacute;n de productos</h3>
                                                    </div>
                                                </div>
                                                
                                                <hr />
                                                
                                                <div class='row' style='margin-bottom: 3%'>
                                                    <div class='col-md-12'>
                                                        <div class='form-group'>
                                                            <label for='nombreProducto' class='control-form-label'>Nombre del producto *</label>
                                                            <input type='text' placeholder='Ingrese el nombre del producto' class='form-control' name='nombreProducto' id='nombreProducto' required />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class='row' style='margin-bottom: 3%'>
                                                    <div class='col-md-12'>
                                                        <div class='form-group'>
                                                            <label for='descripcionProducto' class='control-form-label'>Descripci&oacute;n del producto *</label>
                                                            <textarea class='form-control' id='descripcionProducto' name='descripcionProducto' placeholder='Ingrese descripci&oacute;n del producto'></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class='row' style='margin-bottom: 3%'>
                                                    <div class='col-md-12'>
                                                        <div class='form-group'>
                                                            <label for='categoriaProducto' class='control-form-label'>Seleccione unidades de medidas *</label>
                                                            <select class='form-control chosen-select' id='unidadesmedidas' name='unidadesmedidas[]' multiple  data-placeholder="Seleccione la unidad de medida">
                                                                <!--<option value='0'> Seleccione la unidad de medida </option>-->
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class='row' style='margin-bottom: 3%'>
                                                    <div class='col-md-12'>
                                                        <div class='form-group'>
                                                            <label for='categoriaProducto' class='control-form-label'>Seleccione un categoria *</label>
                                                            <select class='form-control' id='categoriaProducto' name='categoriaProducto'>
                                                                <option value='0'> Escoja una categoria </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class='row'>
                                                    <div class='col-md-6'>
                                                        <div class='form-group'>
                                                            <button type='submit' class='btn btn-block btn-success btn-round' id='buttonGuardar'>Guardar Nuevo Producto</button>
                                                        </div>
                                                    </div>
                                                    <div class='col-md-6'>
                                                        <div class='form-group'>
                                                            <button type='reset' class='btn btn-block btn-info btn-round' id='buttonFormatear'>Limpiar Formulario</button>
                                                        </div>
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
        </div>
        <!-- jQuery -->
        <script type="text/javascript" language="javascript" src="../vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script type="text/javascript" language="javascript" src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- Custom Theme Scripts -->
        <script type="text/javascript" language="javascript" src="../build/js/custom.js"></script>
        <!--DATATABLE JS-->
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <!-- Switchery -->
        <script type="text/javascript" language="javascript" src="../vendors/switchery/dist/switchery.min.js"></script>
        <!--SWEET-ALERT-JS-->
        <script type="text/javascript" language="javascript" src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        
            <!-- SWEET-ALERT -->
    <script type="text/javascript" language="javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
    
        <!-- CHOSEN -->
    <script type="text/javascript" language="javascript" src="https://cdn.jsdelivr.net/npm/chosen-js@1.8.7/chosen.jquery.min.js"></script>
    <!-- JS SCRIPT APP -->
    <script type="text/javascript" language="javascript" src="js/cambiarContrasena.js" ></script>
    
    <script type="text/javascript" language="javascript" src="js/load/jquery.loadingModal.js"></script>
        
        <!--SCRIPT APP PAGE-->
        <script type="text/javascript" language="javascript">
            $(document).ready(function(){
                
                // ESTABLECIMIENTO DE LOS VALORES POR DEFAULT DE DATATABLE
                $.extend( $.fn.dataTable.defaults, {
                    destroy: true,
                    responsive: true,
                    data: [],
                    language:{
                        url: "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                    },
                } );
                
                // LISTAR PRODUCTOS
                cargarProducto()
                
                $("#buttonFormatear").on('click', function(){
                    limpiarFomulario( 'formProducto', 'Guardar Nuevo Producto' )
                     listarCategoriaProductos()
                })
                
                $("#tablaProductos").on('click', '.btnEditar', function(){
                    let data = $("#tablaProductos").DataTable().row($(this).closest('tr')).data()
                    
                    var arrayValueChosen = []
                    data['unidadMedida'].forEach(function(item){
                        arrayValueChosen.push( Number( item['idmedida'] ) )
                    })
                    $("#unidadesmedidas").val(arrayValueChosen).trigger('chosen:updated');
                    
                    listarCategoriaProductos( 1, parseInt(data['id_categoria']) )
                    
                    $("#idproducto").val( data['id_producto'] )
                    $("#nombreProducto").val( data['nombre'] )
                    $("#descripcionProducto").val( data['descripcion'] )
                    
                    $("#buttonGuardar").text("Actualizar Producto")
                })
                
                $("#tablaProductos").on('click', '.js-switch', function(){
                    let data = $("#tablaProductos").DataTable().row($(this).closest('tr')).data()
                    
                    Swal.fire({
                        title: 'Cambiar estado del producto!',
                        text: `Esta seguro de '${ ( data['estado'] == 'A' ? 'DESACTIVAR' : 'ACTIVAR' ) }' este producto`,
                        icon: 'info',
                        confirmButtonText: 'Confirmar',
                        showCancelButton: true,
                        cancelButtonText: `Cancelar`,
                    }).then((result)=>{
                        if( result.isConfirmed )
                        {
                            $.ajax({
                                type: 'POST',
                                url: 'dist/ajax/productoCategoria/productoCategoria.php',
                                data: {
                                    idproducto: data['id_producto'],
                                    estado: ( data['estado'] == 'A' ? 'I' : 'A' ),
                                    metodo: 'PRODUCTO',
                                    submetodo: 'ACTUALIZARESTADO'
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
                                            cargarProducto()
                                            break
                                        case 3:
                                            location.reload()
                                            break
                                    }
                                }
                            })
                        }else{
                            cargarProducto()
                        }
                    })
                })
                
                
                $("#formProducto").submit(function(event){
                    // event.preventDefault()
                    
                    var flagFormulario = true,
                        optionSelected = $("#unidadesmedidas").val()
                    
                    try{
                        if( parseInt( $("#categoriaProducto").val() ) == 0 )
                        {
                            throw 'Debe selecionar la categoria del producto'
                        }
                        
                        if( optionSelected == null || optionSelected.includes("0") )
                        {
                            throw("Debe seleccionar al menos una unidad de medida")
                        }
                        
                    }catch(e)
                    {
                        alert( e )
                        flagFormulario = false
                    }
                    
                    if( flagFormulario )
                    {
                        var formData = new FormData( $("#formProducto")[0] )
                        formData.append('metodo', 'PRODUCTO')
                        formData.append('submetodo', 'ACTUALIZARPRODUCTOS')
                        
                        $.ajax({
                            type: 'POST',
                            url: 'dist/ajax/productoCategoria/productoCategoriav2.php',
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            error: function( err )
                            {
                                console.log( err )
                            },
                            beforeSend: function()
                            {
                                $("#buttonGuardar").prop({'disabled': true}).html('<i class="fa fa-spinner fa-spin"></i> Guardando Nuevo Producto ');
                            },
                            success: function( response )
                            {
                                // console.log( response )
                                switch( response.success )
                                {
                                    case 1:
                                        cargarProducto()
                                        limpiarFomulario( 'formProducto', 'Guardar Nuevo Producto' )
                                        $("#unidadesmedidas").val('').trigger("chosen:updated")
                                        break
                                    case 2:
                                        console.log("Error Interno")
                                        break
                                    case 3:
                                        location.reload()
                                        break
                                }
                            },
                            complete: function()
                            {
                                $("#buttonGuardar").prop({'disabled': false}).html(' Guardar Nuevo Producto ');
                            },
                        })
                    }
                    
                    return false
                })
            })
            
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
            
            function cargarProducto()
            {
                $.ajax({
                    type: 'POST',
                    url: 'dist/ajax/productoCategoria/productoCategoriav2.php',
                    data:{
                        metodo: 'PRODUCTO',
                        submetodo: 'LISTARPRODUCTOS'
                    },
                    beforeSend: function()
                    {
                        loadingModal('Obteniendo productos espere....')
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
                                $("#tablaProductos").DataTable({
                                    data: response.data,
                                    columns:[
                                        {
                                            className: 'text-center',
                                            render: function( )
                                            {
                                                return `<button type='button' class='btn btn-success btnEditar'> <i class='fa fa-pencil'></i> </button>`
                                            }
                                        },
                                        {
                                            className: 'text-center',
                                            data: 'nombre'
                                        },
                                        {
                                            className: 'text-center',
                                            data: 'descripcion'
                                        },
                                        {
                                            className: 'text-center',
                                            data: 'nombreCategoria'
                                        },
                                        {
                                            className: 'text-center',
                                            render: function( data, type, row, meta ){
                                                return `
                                                    <label>
                                                        <input type="checkbox" class="js-switch" ${ row['estado'] == 'A' ? 'checked' : '' }  />
                                                        ${ row['estado'] == 'A' ? 'ACTIVO' : 'INACTIVO' }
                                                    </label>
                                                `
                                            }
                                        },
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
                                    }
                                })
                                break
                            case 3:
                                location.reload()
                                break
                        }
                    },
                    complete: function()
                    {
                        listarCategoriaProductos()
                        listarUnidadesMedidasDisponibles()
                        loadingModal('', false)
                    }
                })
            }
            
            function listarCategoriaProductos( cargarTodasCategoria = 0, idcategoria = 0 )
            {
                $.ajax({
                    type: 'POST',
                    url: 'dist/ajax/productoCategoria/productoCategoria.php',
                    data:{
                        metodo: 'CATEGORIAS',
                        submetodo: 'LISTARCATEGORIAS'
                    },
                    success: function( response )
                    {
                        switch( response.success )
                        {
                            case 1:
                                var optionCategoria = "<option value='0'> Escoja una categoria </option>",
                                    dataCategoria = response.data,
                                    flagDisabeld = true
                                    
                                    if( dataCategoria.length > 0)
                                    {
                                        flagDisabeld = false
                                        dataCategoria.forEach(function(item){
                                            if( parseInt(cargarTodasCategoria) == 0 )
                                            {
                                                if( item['estado'] == 'A' )
                                                {
                                                    optionCategoria += `<option value='${ item['id_categoria'] }'> ${ item['nombre'] } </option>`
                                                }
                                            }else{
                                                flagDisabeld = true
                                                optionCategoria += `<option value='${ item['id_categoria'] }' ${ parseInt( item['id_categoria'] ) == idcategoria ? 'selected' : '' } > ${ item['nombre'] } </option>`
                                            }
                                        })
                                    }else{
                                        optionCategoria = "<option value='0'> No hay categoria disponible </option>"
                                    }
                                    
                                    $("#categoriaProducto").html(optionCategoria).prop({'disabled': flagDisabeld})
                                break;
                            case 2:
                                alert( response.mensaje )
                                break
                            case 3:
                                location.reload()
                                break
                        }
                    }
                })
            }
            
            function limpiarFomulario( idFormulario, textSubmit = 'Guardar' )
            {
                $(`#${idFormulario}`).trigger('reset')
                $(`#${idFormulario}`).find('input[type=hidden]').val(0)
                $(`#${idFormulario}`).find('button[type=submit]').text(textSubmit)
                $(`#${idFormulario}`).find("select").val('').trigger("chosen:updated");
            }
            
            function listarUnidadesMedidasDisponibles()
            {
                $.ajax({
                    type: 'POST',
                    url: 'dist/ajax/productoCategoria/unidadMedidas.php',
                    data:{
                        metodo: 'listarunidadmedidaactivas',
                    },
                    success: function( response )
                    {
                        switch( response.success )
                        {
                            case 1:
                                var optionCategoria = "",
                                    dataCategoria = response.data,
                                    flagDisabeld = true
                                    
                                    if( dataCategoria.length > 0)
                                    {
                                        flagDisabeld = false
                                        dataCategoria.forEach(function(item){
                                            optionCategoria += `<option value='${ item['idunidadmedida'] }'> ${ item['definicion'] } </option>`
                                        })
                                    }else{
                                        optionCategoria = "<option value='0'> No hay categoria disponible </option>"
                                    }
                                    
                                    $("#unidadesmedidas").html(optionCategoria).prop({'disabled': flagDisabeld})
                                break;
                            case 2:
                                alert( response.mensaje )
                                break
                            case 3:
                                location.reload()
                                break
                        }
                    },
                    complete: function()
                    {
                        $("#unidadesmedidas").chosen()
                    }
                })
            }
        </script>
    </body>
</html>