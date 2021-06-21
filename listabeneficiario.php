<?
    require 'funciones.php';
    session_start();
    
    if(!isLogin())
    {
        header("location: login.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- DATATABLE --->
        <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet" />
        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">
        
        <link rel="stylesheet" href="js/load/jquery.loadingModal.css">
        <?php
            titulo_header();
        ?>
    </head>
    <body class="nav-md">
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
                <!-- /top navigation -->
                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="x_content" style="float: none">
                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs nav-justified" role="tablist">
                                <li role="presentation" class="active" id="home">
                                    <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
                                        Visualizar todos los beneficiarios
                                    </a>
                                </li>
                                <li role="presentation" class="" id="menu">
                                    <a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">
                                        Actualizar o registrar un nuevo beneficiario
                                    </a>
                                </li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <hr />
                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                    <h2>
                                        Listado de beneficiarios
                                    </h2>
                                    <hr />
                                    <div class="table-responsive">
<table class="table tablebeneficiarios">
                                        <thead>
                                            <tr>
                                                <th>
                                                    GESTIONAR
                                                </th>
                                                <th>
                                                    N&Uacute;MERO DE DOCUMENTO
                                                </th>
                                                <th>
                                                    TIPO DE DOCUMENTO
                                                </th>
                                                <th>
                                                    RAZON SOCIAL
                                                </th>
                                                <th>
                                                    G&Eacute;NERO
                                                </th>
                                                <th>
                                                    NIVEL ACAD&Eacute;MICO
                                                </th>
                                                <th>
                                                    DIRECCI&Oacute;N
                                                </th>
                                                <th>
                                                    FECHA NACIMIENTO
                                                </th>
                                                <th>
                                                    PERSONA CONTACTO
                                                </th>
                                                <th>
                                                    N&Uacute;MERO CONTACTO
                                                </th>
                                                <th>
                                                    UBICACI&Oacute;N GEOGR&Aacute;FICA
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>

</div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="home-tab">
                                    <form  id="registrarbeneficiario" enctype="multipart/form-data">
                                        <input type="hidden" id="idbeneficiario" name="idbeneficiario" value='0' />
                                        <input type="hidden" id="idtipopersona" name="idtipopersona" value='0' />
                                        <div class="text-center">
                                            <img style="width:20%" src="images/logo/logo_ico.png" />
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                                <div class="item form-group">
                                                    <select id="tipopersona" name="idtipopersona" class="form-control" onchange="cargarFormulario(value);">
                                                        <option value="0">Seleccione un tipo de persona</option>
                                                        <option value="1">Natural</option>
                                                        <option value="2">Jur&iacute;dica</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="tipoPersona"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /page content -->
                <!-- footer content -->
                <!--<footer>-->
                <!--    <div class="pull-right">-->
                <!--        Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>-->
                <!--    </div>-->
                <!--    <div class="clearfix"></div>-->
                <!--</footer>-->
                <!-- /footer content -->
            </div>
        </div>
        <style type="text/css">
            .isDisabled {
                pointer-events: none;
                cursor: default;
            }
        </style>
        <!-- jQuery -->
        <script type="text/javascript" language="javascript" src="../vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script type="text/javascript" language="javascript" src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- DATATABLE -->
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <!-- SWEET-ALERT -->
        <script type="text/javascript" language="javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.all.min.js"></script>
        <!-- Custom Theme Scripts -->
        <script type="text/javascript" language="javascript" src="../build/js/custom.min.js"></script>
    
    <script type="text/javascript" language="javascript" src="js/load/jquery.loadingModal.js"></script>
    
    <!-- JS SCRIPT APP -->
    <script type="text/javascript" language="javascript" src="js/cambiarContrasena.js" ></script>
        
        <script type="text/javascript" language="javascript">
            $(document).ready(function(){
                // ESTABLECIMIENTO DE LOS VALORES POR DEFAULT DE DATATABLE
                $.extend( $.fn.dataTable.defaults, {
                    destroy: true,
                    responsive: true,
                    data: [],
                    language:{
                        url: "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                    }
                } );
                
                cargarbeneficiario()
                
                $('.tablebeneficiarios').on('click', '.btneditar', function(){
                    var data = $('.tablebeneficiarios').DataTable().row( $(this).closest('tr') ).data();
                    // console.log(data)
                    
                    cargarFormulario(data['tipo_persona'], data['idbeneficiario'])
                    
                    $(`#tipopersona option[value=${data['tipo_persona']}]`).prop({'selected': true})
                    $(`#tipopersona`).prop({'disabled': true})
                    
                    $(`#idtipopersona`).val(data['tipo_persona'])
                    $("#idbeneficiario").val(data['idbeneficiario'])
                    $("#myTab a[href='#tab_content2']").tab("show");
                    
                    $(".btnBeneficiario").html("Actualizar Beneficiario")
                })
                
                $(".tipoPersona").on('change', '#txt_provincia,#txt_ciudad', function(event){
                    if( event.target.id == 'txt_provincia' )
                    {
                        cargarCiudad($(this).val())
                    }else if( event.target.id == 'txt_ciudad' )
                    {
                        cargarCantones($(this).val())
                    }
                })
                
                $("#registrarbeneficiario").submit(function(event){
                    event.preventDefault()
                    var flag = true
                    
                    try{
                        if( !validarcedula_ruc( $("#txt_numDoc").val() ) )
                        {
                            flag = false
                        }
                        
                        if( parseInt( $("#tipopersona").val()  ) == 1 )
                        {
                            if( !verificar_edad( $("#txt_fechaNacimiento").val() ) )
                            {
                                flag = false
                                throw "Debe ser mayor de edad"
                            }
                            
                            if( $("#text_sector").val() == 0 )
                            {
                                flag = false
                                throw "Debe seleccionar el sector"
                            }
                            
                            if( $("#txt_genero").val() == 0 )
                            {
                                flag = false
                                throw "Debe seleccionar el genero"
                            }
                            
                            if( $("#txt_educativo").val() == 0 )
                            {
                                flag = false
                                throw "Debe seleccionar el nivel educativo"
                            }
                        }
                        
                        
                        if( $("#txt_provincia").val() == 0 )
                        {
                            flag = false
                            throw "Debe seleccionar una provincia"
                        }
                        
                        if( $("#txt_parroquia").val() == 0 )
                        {
                            flag = false
                            throw "Debe seleccionar una parroquia"
                        }
                        
                        if( $("#txt_ciudad").val() == 0 )
                        {
                            flag = false
                            throw "Debe seleccionar una ciudad"
                        }
                        
                    }catch(e)
                    {
                        flag = false
                        Swal.fire({
                            icon: 'warning',
                            title: 'Advertencia',
                            text: e,
                        })
                    }
                    
                    if( flag )
                    {
                        var formData = new FormData($("#registrarbeneficiario")[0])
                        $.ajax({
                            type: 'POST',
                            url: 'dist/ajax/beneficiario/registrar.php',
                            dataType: 'json',
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                            error: function(err)
                            {
                                console.log(err)
                            },
                            beforeSend: function()
                            {
                                $(".btnBeneficiario").prop({ disabled: true }).css({cursor: 'no-drop'}).html(` <i class="fa fa-spinner fa-spin"></i> ${ Number( $( "#idbeneficiario" ).val() ) == 0 ? 'Guardando' : 'Actualizando' } Beneficiario`)
                            },
                            success: function(response)
                            {
                                switch(response.success)
                                {
                                    case 1:
                                        $(`#tipopersona`).prop({'disabled': false})
                                        cargarbeneficiario()
                                        $(".tipoPersona").empty()
                                        $("#registrarbeneficiario").trigger('reset')
                                        $("#myTab a[href='#tab_content1']").tab('show')
                                        break
                                    case 2:
                                        alert(response.mensaje)
                                        break
                                    case 3:
                                        location.reload()
                                        break
                                }
                            },
                            complete: function()
                            {
                                $(".btnBeneficiario").prop({ disabled: false }).css({cursor: 'auto'}).html(` Guardando Beneficiario`)
                            }
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
            
            function cargarbeneficiario()
            {
                $.ajax({
                    type: 'POST',
                    url: 'dist/ajax/beneficiario/listarBeneficiario.php',
                    dataType: 'json',
                    data: {
                        metodo: 'LISTARBENEFICIARIOS'
                    },
                    beforeSend: function()
                    {
                        loadingModal( 'Obteniendo los beneficiarios, espere....' )
                    },
                    error: function(err)
                    {
                        console.log(err)
                    },
                    success: function(response)
                    {
                        switch(response.success)
                        {
                            case 1:
                                $('.tablebeneficiarios').DataTable({
                                    data: response.data,
                                    aaSorting: [[ 1, "desc" ]],
                                    columns: [
                                        {
                                            className: 'text-center',
                                            orderable:  false,
                                            render: function(  )
                                            {
                                                return `<button type="button" class='btn btn-success btneditar'> <i class="fa fa-pencil"></i> </button>`
                                            }
                                        },
                                        {
                                            className: 'text-center',
                                            data: 'num_doc'
                                        },
                                        {
                                            className: 'text-center',
                                            data: 'tipoPersonaAux'
                                        },
                                        {
                                            className: 'text-center',
                                            data: 'nombres'
                                        },
                                        {
                                            className: 'text-center',
                                            data: 'generoAux'
                                        },
                                        {
                                            className: 'text-center',
                                            data: 'nivelAcademicoAux'
                                        },
                                        {
                                            className: 'text-center',
                                            data: 'direccion'
                                        },
                                        {
                                            className: 'text-center',
                                            data: 'fecha_nac'
                                        },
                                        {
                                            className: 'text-center',
                                            data: 'persona_contacto'
                                        },
                                        {
                                            className: 'text-center',
                                            data: 'numero_contacto'
                                        },
                                        {
                                            className: 'text-center',
                                            render: function( data, type, row, meta )
                                            {
                                                return `
                                                        <a target='_blank' href="${ row['ubicaciongeo'] }" class="${ row['ubicaciongeo'] == null ? 'isDisabled' : '' }" >
                                                            <i class="fa fa-2x fa-map-marker"></i>
                                                        </a>
                                                `
                                            }
                                        }
                                    ]
                                })
                                break
                            case 2:
                                alert(response.mensaje)
                                break
                            case 3:
                                location.reload()
                                break
                        }
                    },
                    complete: function()
                    {
                        loadingModal( '', false )
                    }
                })
            }
            
            function cargarFormulario(valor, idbeneficiario = 0)
            {
                if( parseInt(valor) > 0 )
                {
                    $.ajax({
                        type: 'POST',
                        url: 'dist/ajax/beneficiario/formularioPersona.php',
                        data: {
                            METODO: 'BENEFICIARIO',
                            TIPOBENEFICIARIO: parseInt(valor),
                            beneficiario: idbeneficiario
                        },
                        dataType: 'json',
                        error: function(err)
                        {
                            console.log(err)
                        },
                        success: function(response)
                        {
                            // console.log(response)
                            switch(response.success)
                            {
                                case 1:
                                    $(".tipoPersona").html(response.reshtml)
                                    break;
                            }
                        },
                    })
                }else{
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tipo de persona',
                        text: 'Debe seleccionar un tipo de persona',
                    })
                    $(".tipoPersona").empty()
                }
            }
            
            function cargarProvincia()
            {
                $.ajax({
                    type: 'POST',
                    url: 'dist/ajax/causas/listarProvincias.php',
                    dataType: 'json',
                    data: { metodo: 'PROVINCIAS' },
                    error: function(err)
                    {
                        console.log(err)
                    },
                    success: function(response)
                    {
                        switch( response.estado)
                        {
                            case 1:
                                var optionProvincias = "<option value='0'> Seleccione un provincia</option>",
                                    provincias = response.data,
                                    propDisabled = true
                                    if( provincias.length > 0)
                                    {
                                        propDisabled = false
                                        provincias.forEach( (index) => {
                                            optionProvincias += `<option value='${ index['proid'] }'> ${ index['pronombre'] } </option>`
                                        })
                                    }else{
                                        optionProvincias = "<option value='0'> Hay provincias disponibles</option>"
                                    }
                                    $("#txt_provincia").html(optionProvincias).prop({'disabled': propDisabled})
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
            }
            
            function cargarCiudad(valor)
            {
                if( parseInt(valor) > 0 )
                {
                    $.ajax({
                    type: 'POST',
                    url: 'dist/ajax/causas/listarProvincias.php',
                    dataType: 'json',
                    data: { 
                        metodo: 'CIUDADES',
                        provincia: parseInt(valor)
                    },
                    error: function(err)
                    {
                        console.log(err)
                    },
                    success: function(response)
                    {
                        switch( response.estado)
                        {
                            case 1:
                                var optionProvincias = "<option value='0'> Seleccione una ciudad</option>",
                                    provincias = response.data,
                                    propDisabled = true
                                    if( provincias.length > 0)
                                    {
                                        propDisabled = false
                                        provincias.forEach( (index) => {
                                            optionProvincias += `<option value='${ index['ciuid'] }'> ${ index['ciunombre'] } </option>`
                                        })
                                    }else{
                                        optionProvincias = "<option value='0'> Hay ciudades disponibles</option>"
                                    }
                                    $("#txt_ciudad").html(optionProvincias).prop({'disabled': propDisabled})
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
                    Swal.fire({
                        icon: 'warning',
                        title: 'Provincias',
                        text: 'Debe seleccionar una provincia',
                    })
                }
            }
            
            function cargarCantones(valor)
            {
                if( parseInt(valor) > 0 )
                {
                    $.ajax({
                    type: 'POST',
                    url: 'dist/ajax/causas/listarProvincias.php',
                    dataType: 'json',
                    data: { 
                        metodo: 'CANTONES',
                        ciudad: parseInt(valor)
                    },
                    error: function(err)
                    {
                        console.log(err)
                    },
                    success: function(response)
                    {
                        switch( response.estado)
                        {
                            case 1:
                                var optionProvincias = "<option value='0'> Seleccione una parroquia </option>",
                                    provincias = response.data,
                                    propDisabled = true
                                    if( provincias.length > 0)
                                    {
                                        propDisabled = false
                                        provincias.forEach( (index) => {
                                            optionProvincias += `<option value='${ index['parid'] }'> ${ index['parnombre'] } </option>`
                                        })
                                    }else{
                                        optionProvincias = "<option value='0'> Hay parroquias disponibles</option>"
                                    }
                                    $("#txt_parroquia").html(optionProvincias).prop({'disabled': propDisabled})
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
                    Swal.fire({
                        icon: 'warning',
                        title: 'Ciudades',
                        text: 'Debe seleccionar una ciudad',
                    })
                }
            }
            
            function validarcedula_ruc(valor)
            {
                if( typeof valor == "string" && valor.length == 10 )
                {
                    var element = valor.split('').map(Number),
                        elementEnd = element.pop(),
                        total = 0
                        
                    var provinciaEmitida = ( parseInt(element[0]) * 10 ) + parseInt(element[1]); 
                    
                    if( provinciaEmitida >= 1 && ( provinciaEmitida <= 24 || provinciaEmitida == 30 ) )
                    {
                        element.forEach(function(index, item){
                            if( ( item % 2 ) == 0 )
                            {
                                var aux = ( parseInt( index ) * 2 )
                                if( aux > 9 ) aux -= 9
                                total += parseInt( aux )
                            }else{
                                total += parseInt(index)
                            }
                        })
                        total = total % 10 ? 10 - total % 10 : 0
                        if( total == parseInt( elementEnd ) )
                        {
                            return true
                        }else{
                            throw 'Cédula incorrecta'
                            return false
                        }
                    }else{
                        throw 'La cédula no corresponde a ninguna provincia'
                    }
                }else if( typeof valor == "string" && valor.length == 13 )
                {
                    var element = valor.split('').map(Number),
                        provinciaEmitida = ( parseInt(element[0]) * 10 ) + parseInt(element[1])
                    
                    if( provinciaEmitida >= 1 && ( provinciaEmitida <= 24  || provinciaEmitida == 30 ) )
                    {
                        var cuandoes6 = [3,2,7,6,5,4,3,2],
                            cuandoes9 = [4,3,2,7,6,5,4,3,2],
                            total = 0,
                            digito = parseInt( parseInt(element[10]) + parseInt(element[11]) + parseInt(element[12]) )
                        
                        if( digito > 0)
                        {
                            if( parseInt(element[2]) == 6 )
                            {
                                for( var i = 0; i < cuandoes6.length ; i++)
                                {
                                    total += parseInt( element[i] * cuandoes6[i] )
                                }
                                if( ( total % 11 ) == 0 )
                                {
                                    digito = 0
                                }else if( ( total % 11 ) == 1 ){
                                    return false
                                }else{
                                    digito = parseInt(11 - parseInt(total % 11))
                                }
                                
                                if( digito == parseInt(element[8]) )
                                {
                                    return true
                                }else{
                                    throw "El R.U.C del sector Público en incorrecto";
                                }
                                
                            }else if( parseInt(element[2]) == 9 )
                            {
                                for( var i = 0; i < cuandoes9.length ; i++)
                                {
                                    total += parseInt( element[i] * cuandoes9[i] )
                                }
                                if( ( total % 11 ) == 0 )
                                {
                                    digito = 0
                                }else if( ( total % 11 ) == 1 ){
                                    return false
                                }else{
                                    digito = parseInt(11 - parseInt(total % 11))
                                }
                                
                                if( digito == parseInt(element[9]) )
                                {
                                    return true
                                }else{
                                    throw "El R.U.C del sector Privado en incorrecto";
                                }
                            }else{
                                throw "El R.U.C no pertenece a ningún sector";
                            }
                        }else{
                            throw "El Ruc debe terminar en '001' ";
                            return false
                        }
                    }else{
                        throw "R.U.C no tiene valides";
                    }
                }
            }
            
            function verificar_edad(fecha_nac)
            {
                var fechaNac = new Date(fecha_nac),
                    fechaActual = new Date()
                    edad = parseInt(fechaActual.getFullYear() - fechaNac.getFullYear())
                    
                if( edad >= 18 )
                {
                    return true
                }else{
                    return false
                }
            }
            
            // Funcion para validar solo numeros
            function valideKey(e){
                var code = (e.which )? e.which : e.keyCode
                if(!(code >=48 && code <=57)){e.preventDefault();}
            }
        </script>
    </body>
</html>