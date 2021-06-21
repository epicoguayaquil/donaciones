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
    <head>
        <meta charset="gb18030">
        
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
                            <h3>Listado de donaciones para asignar</h3>
                        </div>
                    </div>
                    <div class="x_content" style="float:none">
                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs nav-justified" role="tablist" style="padding: 0 !important">
                                <li role="presentation" class="active" id="home">
                                    <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
                                        Visualizar todas las unidades de medida
                                    </a>
                                </li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <hr />
                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class='table-responsive'>
                                                <table id="" class="table table-bordered display nowrap tablaUnidadMedidas" style="width:100%">
                                                    <thead>
                                                        <th>
                                                            GESTIONAR
                                                        </th>
                                                        <th>
                                                            DEFINICI&Oacute;N
                                                        </th>
                                                        <th>
                                                            NOMENCLATURA
                                                        </th>
                                                        <th>
                                                            ESTADO
                                                        </th>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <form id="formUnidadMedida">
                                                <input type="hidden" id="idunidadmedida" name="idunidadmedida" value="0" />
                                                <div class="row">
                                                    <div class='col-md-12 text-center'>
                                                        <h3>Registrar o Actualizar Unidad de medida</h3>
                                                    </div>
                                                </div>
                                                <hr/>
                                                
                                                <div class='row' style='margin-bottom: 3%'>
                                                    <div class='col-md-12'>
                                                        <div class='form-group'>
                                                            <label for='abreviatura' class='control-form-label'>Definici&oacute; de la unidad de medida *</label>
                                                            <input type='text' placeholder="kilogramo, litro, etc" onkeypress="return soloLetras(event)" class='form-control' id="definicion" name="definicion" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class='row' style='margin-bottom: 3%'>
                                                    <div class='col-md-12'>
                                                        <div class='form-group'>
                                                            <label for='abreviatura' class='control-form-label'>Abreviatura de la unidad de medida *</label>
                                                            <input type='text' placeholder="kg, lt, etc" onkeypress="return soloLetras(event)" class='form-control' id="abreviatura" name="abreviatura" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class='row'>
                                                    <div class='col-md-6'>
                                                        <div class='form-group'>
                                                            <button type='submit' class='btn btn-block btn-success btn-round' id='buttonGuardar'>GUARDAR NUEVA UNIDAD DE MEDIDA</button>
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
        <!-- JS SCRIPT APP -->
        <script type="text/javascript" language="javascript" src="js/cambiarContrasena.js" ></script>
        <!-- SWEET-ALERT -->
        <script type="text/javascript" language="javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>
        
        
        <script type="text/javascript" language="javascript" src="js/load/jquery.loadingModal.js"></script>
        
        <!--SCRIPT -->
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
                
                cargarUnidadesMedidas()
                
                $("#formUnidadMedida").submit(function(event){
                    event.preventDefault()
                    
                    
                    var formData = new FormData( $(this)[0] )
                    
                    if( Number( $("#idunidadmedida").val() ) == 0  )
                    {
                        formData.append("metodo", "crearunidadmedida")
                    }else{
                       formData.append("metodo", "actualizarunidadmedida") 
                    }
                    
                    $.ajax({
                        async: false,
                        type: 'POST',
                        url: 'dist/ajax/productoCategoria/unidadMedidas.php',
                        data: formData,
                        processData: false,
                        contentType: false,
                        error:  function( err )
                        {
                            console.log( err )
                        },
                        beforeSend: function()
                        {
                            $("#buttonGuardar").prop({ 'disabled': true}).html(" <i class='fa fa-spinner fa-spin'></i> GUARDANDO UNIDAD DE MEDIDA")
                        },
                        success: function( response )
                        {
                            switch( Number( response.success ) )
                            {
                                case 1:
                                    cargarUnidadesMedidas()
                                    limpiarForm()
                                    break
                                case 2:
                                    alert( response.mensaje )
                                    break
                            }
                        },
                        complete: function()
                        {
                            $("#buttonGuardar").prop({ 'disabled': false}).html("GUARDAR NUEVA UNIDAD DE MEDIDA")
                        }
                    }) 
                    
                    return false
                })
                
                $(".tablaUnidadMedidas").on('click', '.js-switch', function(){
                    let data = $(".tablaUnidadMedidas").DataTable().row($(this).closest('tr')).data()
                    
                    console.log("OK!")
                    
                    Swal.fire({
                        title: 'Cambiar estado de la Unidad de medida!',
                        text: `Esta seguro de '${ ( data['estado'] == 'A' ? 'INACTIVAR' : 'ACTIVAR' ) }' esta unidad de medida`,
                        icon: 'info',
                        confirmButtonText: 'Confirmar',
                        showCancelButton: true,
                        cancelButtonText: `Cancelar`,
                    }).then((result)=>{
                        if( result.isConfirmed )
                        {
                            $.ajax({
                                type: 'POST',
                                url: 'dist/ajax/productoCategoria/unidadMedidas.php',
                                data: {
                                    idunidadmedida: data['idunidadmedida'],
                                    estado: ( data['estado'] == 'A' ? 'I' : 'A' ),
                                    metodo: 'actualizarestadounidadmedida',
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
                                            cargarUnidadesMedidas()
                                            break
                                        case 2:
                                            alert( response.mensaje )
                                            break
                                        case 3:
                                            location.reload()
                                            break
                                    }
                                }
                            })
                        }else{
                            cargarUnidadesMedidas()
                        }
                    })
                })
                
                $(".tablaUnidadMedidas").on('click', '.btnEditar', function(){
                    let data = $(".tablaUnidadMedidas").DataTable().row($(this).closest('tr')).data()
                    
                    $("#idunidadmedida").val( data['idunidadmedida'] )
                    
                    $("#definicion").val( data['definicion'] )
                    $("#abreviatura").val( data['abreviatura'] )
                    
                    $("#buttonGuardar").text("ACTUALIZAR UNIDAD DE MEDIDA")
                })
                
                $("#buttonFormatear").click(function(){
                    limpiarForm()
                })
            })
            
            function cargarUnidadesMedidas()
            {
                $.ajax({
                    type: 'POST',
                    url: 'dist/ajax/productoCategoria/unidadMedidas.php',
                    data: {
                        'metodo': "listarunidadmedida"
                    },
                    dataType: "json",
                    beforeSend: function()
                    {
            				OpenLoadtext("Obteniendo unidades de medida espere....")
            		},
                    error:  function( err )
                    {
                        console.log( err )
                    },
                    success: function( response )
                    {
                        console.log(response.data)
                        switch( Number( response.success ) )
                        {
                            case 1:
                                $(".tablaUnidadMedidas").DataTable({
                                    data: response.data,
                                    columns: [
                                        {
                                            className: 'text-center',
                                            render: function( )
                                            {
                                                return `<button type='button' class='btn btn-success btnEditar'> <i class='fa fa-pencil'></i> </button>`
                                            }
                                        },
                                        {
                                            className: 'text-center',
                                            data: 'definicion'
                                        },
                                        {
                                            className: 'text-center',
                                            data: 'abreviatura'
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
                                break;
                        }
                    },
                    complete: function()
                    {
                        CloseLoad()
                    }
                }) 
            }
            
            function limpiarForm()
            {
                $("#idunidadmedida").val(0)
                $("#formUnidadMedida").trigger("reset")
            }
            
            function soloLetras(e)
            {
                key = e.keyCode || e.which;
                tecla = String.fromCharCode(key).toLowerCase();
                letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
                especiales = "8-37-39-46";
                
                tecla_especial = false
                for(var i in especiales){
                    if(key == especiales[i]){
                        tecla_especial = true;
                        break;
                    }
                }
                
                if(letras.indexOf(tecla)==-1 && !tecla_especial){
                    return false;
                }
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