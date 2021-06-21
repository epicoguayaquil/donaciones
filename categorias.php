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
                            <h3>Listado de categorias</h3>
                        </div>
                    </div>
                    <div class="x_content" style="float:none">
                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs nav-justified" role="tablist" style="padding: 0 !important">
                                <li role="presentation" class="active" id="home">
                                    <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
                                        CATEGORIAS
                                    </a>
                                </li>
                            </ul>
                            
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                    <hr />
                                    <div class='row'>
                                        <div class='col-md-7'>
                                            <table class='table table-bordered' id="tablaCategorias">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            GESTIONAR
                                                        </th>
                                                        <th class="text-center">
                                                            NOMBRE DE LA CATEGORIA
                                                        </th>
                                                        <th class="text-center">
                                                            ESTADO
                                                        </th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class='col-md-5'>
                                            <form id="formCategoria">
                                                <input type='hidden' id='idcategoria' name='idcategoria' value='0' />
                                                <div class="row">
                                                    <div class='col-md-12 text-center'>
                                                        <h3>Registrar o Actualizar Categoria</h3>
                                                    </div>
                                                </div>
                                                
                                                <hr />
                                                
                                                <div class='row' style='margin-bottom: 3%'>
                                                    <div class='col-md-12'>
                                                        <div class='form-group'>
                                                            <label for='nombreCategoria' class='control-form-label'>Nombre de la categoria *</label>
                                                            <input type='text' placeholder='Ingrese el nombre de la categoria' class='form-control' name='nombreCategoria' id='nombreCategoria' required />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class='row'>
                                                    <div class='col-md-6'>
                                                        <div class='form-group'>
                                                            <button type='submit' class='btn btn-block btn-success btn-round' id='buttonGuardar'>Guardar Nueva Categoria</button>
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
    
    <script type="text/javascript" language="javascript" src="js/load/jquery.loadingModal.js"></script>
    
    
    <!-- JS SCRIPT APP -->
    <script type="text/javascript" language="javascript" src="js/cambiarContrasena.js" ></script>
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
                
                $("#buttonFormatear").on('click', function(){
                    limpiarFomulario( 'formCategoria', 'Guardar Nueva Categoria' )
                     listarCategorias()
                })
                
                listarCategorias()
                
                $("#tablaCategorias").on('click', '.js-switch', function(){
                    let data = $("#tablaCategorias").DataTable().row($(this).closest('tr')).data()
                    
                    Swal.fire({
                        title: 'Cambiar estado de la categoria!',
                        text: `Esta seguro de '${ ( data['estado'] == 'A' ? 'DESACTIVAR' : 'ACTIVAR' ) }' esta categoria`,
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
                                    idcategoria: data['id_categoria'],
                                    estado: ( data['estado'] == 'A' ? 'I' : 'A' ),
                                    metodo: 'CATEGORIAS',
                                    submetodo: 'ACTUALIZARESTADOCAUSA'
                                },
                                error: function( err )
                                {
                                    console.log( err )
                                },
                                success: function( response )
                                {
                                    // console.log( response )
                                    switch( response.success )
                                    {
                                        case 1:
                                            listarCategorias()
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
                
                
                $("#tablaCategorias").on('click', '.btnEditar', function(){
                    let data = $("#tablaCategorias").DataTable().row($(this).closest('tr')).data()
                    
                    $("#nombreCategoria").val( data['nombre'] )
                    $("#idcategoria").val( data['id_categoria'] )
                    
                    $("#buttonGuardar").text("ACTUALIZAR CATEGORIA")
                })
                
                $("#formCategoria").submit(function(){
                    
                    var formData = new FormData( $("#formCategoria")[0] )
                    
                    formData.append('metodo', 'CATEGORIAS')
                    formData.append('submetodo', 'REGISTRARACTUALIZARCAUSA')
                    
                    $.ajax({
                        type: 'POST',
                        url: 'dist/ajax/productoCategoria/productoCategoria.php',
                        data: formData,
                        // cache: false,
                        processData: false,
                        contentType: false,
                        error: function(err)
                        {
                            console.log( err )
                        },
                        beforeSend: function()
                        {
                            $("#buttonGuardar").prop({'disabled': true}).html('<i class="fa fa-spinner fa-spin"></i> Guardando Categoria ');
                        },
                        success: function( response )
                        {
                            switch( response.success )
                            {
                                case 1:
                                    listarCategorias()
                                            limpiarFomulario( 'formCategoria', 'Guardar Nueva Categoria' )
                                    break
                                case 2:
                                    alert( respose.mensaje )
                                    break
                                case 3:
                                    location.reload()
                                    break
                            }
                        },
                        complete: function()
                        {
                            $("#buttonGuardar").prop({'disabled': false}).text("Guardar Nueva Categoria")
                        }
                    })
                    
                    return false
                })
            })
            
            function listarCategorias()
            {
                $.ajax({
                    type: 'POST',
                    url: 'dist/ajax/productoCategoria/productoCategoria.php',
                    data:{
                        metodo: 'CATEGORIAS',
                        submetodo: 'LISTARCATEGORIAS'
                    },
                    beforeSend: function()
                    {
            				OpenLoadtext("Obteniendo categorias espere....")
            		},
                    // error: function( err )
                    // {
                    //     console.log( err )
                    // },
                    success: function( response )
                    {
                        switch( response.success)
                        {
                            case 1:
                                $("#tablaCategorias").DataTable({
                                    data: response.data,
                                    columns: [
                                        {
                                            className: 'text-center',
                                            data: null,
                                            defaultContent: '<button type="button" class="btn btn-success btnEditar"> <i class="fa fa-pencil"></i> </button>'
                                        },
                                        {
                                            className: 'text-center',
                                            data: "nombre"
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
                        CloseLoad()
                    }
                })
            }
            
            function limpiarFomulario( idFormulario, textSubmit = 'Guardar' )
            {
                $(`#${idFormulario}`).trigger('reset')
                $(`#${idFormulario}`).find('input[type=hidden]').val(0)
                $(`#${idFormulario}`).find('button[type=submit]').text(textSubmit)
            }
            
            function OpenLoadtext(text)
            {
              $('body').loadingModal({text});
              $('body').loadingModal('animation', 'foldingCube').loadingModal('backgroundColor', 'black');
              $('body').css({cursor: 'no-drop'})
            }
            
            function CloseLoad()
            {
              $('body').loadingModal('hide');
              $('body').loadingModal('destroy');
              $('body').css({cursor: 'auto'})
            }

        </script>
    </body>
</html>