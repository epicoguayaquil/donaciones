<?php
    session_start();
    
    //ini_set("display_errors","1");
    
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
        <link rel='stylesheet' type="text/css" href='//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css' />


    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

        <link rel="stylesheet" href="js/load/jquery.loadingModal.css">
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
                <h3>Listado de usuario</h3>
              </div>
            </div>
            <div class="x_content" style="float:none;">
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab" class="nav nav-tabs bar_tabs nav-justified" role="tablist">
                        <li role="presentation" class="active" id="home">
                            <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true" onclick="limpiarForm()">
                                Visualizar todos los usuarios
                            </a>
                        </li>
                        <li role="presentation" class="" id="menu">
                            <a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">
                                Actualizar o registrar un usuario
                            </a>
                        </li>
                    </ul>
                    
                    <div id="myTabContent" class="tab-content">
                        <hr />
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                            <div cass="table-responsive">
                                <table class="table tablausuarios" width="100%">
                                    <thead>
                                        <tr>
                                            <th>
                                                Gesti&oacute;n
                                            </th>
                                            <th>
                                                Rol
                                            </th>
                                            <th>
                                                Apellidos y Nombres
                                            </th>
                                            <th>
                                                Usuario
                                            </th>
                                            <th>
                                                Celular
                                            </th>
                                            <th>
                                                Area
                                            </th>
                                            <th>
                                                Descripción
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                            <form id="formUsuario">
                                
                                <input type="hidden" value="0" name="idusuario" id="idusuario" />
                                
                                <div class="row" style="margin-bottom: 1%">
                	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                        <div style="text-align: left;">
                                            <label for="apellidosnombres"> Apellidos y Nombres del usuario *</label>
                                            <input id="apellidosnombres" name="apellidosnombres" type="text" class="form-control" required maxlength="200" autocomplete="off" placeholder="Apellidos y Nombres del usuario" />
                                        </div>
                	                </div>
                                </div>
                                
                                <div class="row" style="margin-bottom: 1%">
                	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                        <div style="text-align: left;">
                                            <label for="telefonousuario"> Número de celular del usuario *</label>
                                            <input id="telefonousuario" name="telefonousuario" type="number" class="form-control" required maxlength="10" onkeypress="soloNumeros(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" tocomplete="off" placeholder="Número de celular del usuario" />
                                        </div>
                	                </div>
                                </div>
                                
                                <div class="row" style="margin-bottom: 1%">
                	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                        <div style="text-align: left;">
                                            <label for="areausuario"> Area de usuario *</label>
                                            <input id="areausuario" name="areausuario" type="text" class="form-control" required maxlength="100" autocomplete="off"  placeholder="Area de usuario"/>
                                        </div>
                	                </div>
                                </div>
                                
                                <div class="row" style="margin-bottom: 1%">
                	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                        <div style="text-align: left;">
                                            <label for="descripcion"> Descripción Area *</label>
                                            <!--<input id="telefonousuario" name="telefonousuario" type="number" class="form-control" required maxlength="100" autocomplete="off" />-->
                                            <textarea id="descripcion" name="descripcion" class="form-control" required maxlength="200" autocomplete="off"  placeholder="Descripción del area"></textarea>
                                        </div>
                	                </div>
                                </div>
                                
                                <div class="row" style="margin-bottom: 1%">
                	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                        <div style="text-align: left;">
                                            <label for="rol"> Rol del usuario *</label>
                                                <?
                                                    $option = "<option value='0' selected>Seleccione un Rol</option>";
                                                    $rolesActivos = Conexion::buscarVariosRegistro("SELECT rol_id, rol FROM tb_rol");
                                                    
                                                    if( count( $rolesActivos ) > 0 )
                                                    {
                                                        foreach( $rolesActivos as $item )
                                                        {
                                                            $option .= " <option value='".$item['rol_id']."'> ".$item['rol']." </option> ";
                                                            
                                                        }
                                                    }else{
                                                        $option = "<option value='0' selected> No hay roles disponibles </option>";
                                                    }
                                                ?>
                                            <select id="rol" name="rol" class="form-control" required <? count( $rolesActivos ) > 0 ? '' : 'disabled' ?> >
                                                <?
                                                    print_r( $option );
                                                ?>
                                            </select>
                                        </div>
                	                </div>
                                </div>
                                
                                <div class="row" style="margin-bottom: 1%">
                	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                        <div style="text-align: left;">
                                            <label for="correoElectronico"> Correo Electrónico del usuario *</label>
                                            <input id="correoElectronico" name="correoElectronico" type="email" class="form-control" required maxlength="200" autocomplete="off" placeholder="Correo de Electrónico" />
                                        </div>
                	                </div>
                                </div>
                                
                                <div id="contrasena">
                                    <div class="row" style="margin-bottom: 1%">
                    	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                            <div style="text-align: left;">
                                                <label for="contrasenausuario"> Contraseña del usuario *</label>
                                                <input id="contrasenausuario" name="contrasenausuario" type="password" class="form-control" required min="5" autocomplete="off" />
                                            </div>
                    	                </div>
                                    </div>
                                    
                                    <div class="row" style="margin-bottom: 1%">
                    	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                            <div style="text-align: left;">
                                                <label for="confirmarContrasenaUsuario"> Confirmar Contraseña del usuario *</label>
                                                <input id="confirmarContrasenaUsuario" name="confirmarContrasenaUsuario" type="password" class="form-control" required min="5" autocomplete="off" />
                                            </div>
                    	                </div>
                                    </div>
                                </div>
                                
                                <div class="row" style="margin-bottom: 1%">
                	                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                        <div style="text-align: center;">
                                            <button type="submit" class="btn btn-success actualizarCentroAcopio">Guardar usuario</button>
                                        </div>
                	                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div
            </div>
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
    <!-- DATATABLE -->
    <script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    
    <!-- JS SCRIPT APP -->
    <script type="text/javascript" language="javascript" src="js/cambiarContrasena.js" ></script>
    
    <script type="text/javascript" language="javascript" src="js/load/jquery.loadingModal.js"></script>
    
    <script type="text/javascript" language="javascript">
        $(document).ready(function(){
            
            // ESTABLECIMIENTO DE LOS VALORES POR DEFAULT DE DATATABLE
            $.extend( $.fn.dataTable.defaults, {
                destroy: true,
                data: [],
                language:{
                    url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                },
            } );
                
            listar_usuarios()
            
            $("#formUsuario").submit(function(event){
                event.preventDefault()
                
                    var flagGuardar = true
                try
                {
                    
                    var contrasena = $("#contrasenausuario").val(),
                        confirmarContrasena = $("#confirmarContrasenaUsuario").val()
                        
                    if( contrasena != confirmarContrasena )
                    {
                        flagGuardar = !flagGuardar
                        throw "La contraseña deben ser iguales"
                    }
                    
                    if( Number( $("#rol").val() ) == 0 )
                    {
                        flagGuardar = !flagGuardar
                        throw "Debe seleccionar un rol"
                    }
                }catch(e)
                {
                    alert(e);
                }
                
                   
                    if( flagGuardar )
                    {
                        var formData = new FormData( $(this)[0] );
                        
                        if( Number( $("#idusuario").val() ) == 0 )
                        {
                            formData.append("metodo","guardarusuario")
                        }else{
                            formData.append("metodo","actualizarusuario")
                        }
                        
                        $.ajax({
                            type: 'POST',
                            url: "dist/ajax/usuarios/guardarUsuario.php",
                            data: formData,
                            dataType: "json",
                            cache: false,
                            processData: false,
                            contentType: false,
                            error: function( err )
                            {
                                console.log( err )
                            },			beforeSend: function(){	$(".actualizarCentroAcopio").prop({ 'disabled': true }).html(`<i class="fa fa-spinner fa-spin"></i> ${ Number( $("#idusuario").val() ) == 0 ? 'Guardando' : 'Actualizando' } usuario `)},
                            success: function( response )
                            {
                                switch( Number( response.success ) )
                                {
                                    case 1:
                                        $("#myTab a[href='#tab_content1']").tab("show");
                                        limpiarForm()
                                        listar_usuarios()
                                        break
                                    case 2:
                                        alert( response.mensaje )
                                        break
                                }
                            },complete: function(){	$(".actualizarCentroAcopio").prop({ 'disabled': false}).text(` Guardando usuario `)}
                        })
                    }
                
                return false
            })
            
            $(".tablausuarios").on('click', '.btnEditar', function(){
                var data = $('.tablausuarios').DataTable().row($(this).closest('tr')).data()
                
                $("#apellidosnombres").val(data['nombre'])
                $("#telefonousuario").val(data['telefono'])
                $("#areausuario").val(data['area'])
                $("#descripcion").val(data['descripcion'])
                $("#correoElectronico").val(data['usuario'])
                $(`#rol option[value=${ data['rol_id'] }] `).prop({'selected': true})
                
                $("#idusuario").val(data['usu_id'])
                
                $("#myTab a[href='#tab_content2']").tab("show");
                
                $("#contrasena").css({'display': 'none'})
                
                $("#confirmarContrasenaUsuario").prop({'required': false})
                $("#contrasenausuario").prop({'required': false})
            })
        })
        
        function listar_usuarios()
        {
            $.ajax({
                type: 'POST',
                url: "dist/ajax/usuarios/guardarUsuario.php",
                data: {
                    'metodo': 'listarUsuario'
                },
                dataType: "json",
                beforeSend: function()
                {
                    loadingModal('Obteniendo usuarios espere....')
                },
                error: function( err )
                {
                    console.log( err )
                },
                success: function( response )
                {
                    switch( Number( response.success ) )
                    {
                        case 1:
                            $(".tablausuarios").DataTable({
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
                                        data: 'rol'
                                    },
                                    {
                                        className: 'text-center',
                                        data: 'nombre'
                                    },
                                    {
                                        className: 'text-center',
                                        data: 'usuario'
                                    },
                                    {
                                        className: 'text-center',
                                        data: 'telefono'
                                    },
                                    {
                                        className: 'text-center',
                                        data: 'area'
                                    },
                                    {
                                        className: 'text-center',
                                        // data: 'descripcion'
                                        className: 'text-center',
                                        render: function( data, type, row, meta )
                                        {
                                            return `
                                                ${
                                                    row['descripcion'].length <= 15 ? row['descripcion'].charAt(0).toUpperCase() + row['descripcion'].slice(1).toLowerCase() : row['descripcion'].charAt(0).toUpperCase() + row['descripcion'].slice(1, 15)+"....".toLowerCase()
                                                }
                                            `
                                        }
                                    }
                                ]
                            })
                            break;
                        case 2:
                            $(".tablausuarios").DataTable()
                            break
                    }
                },
                complete: function()
                {
                    loadingModal('', false)
                }
            })
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
        
        function limpiarForm()
        {
            $("#formUsuario").trigger("reset")
            $("#idusuario").val('0')
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
    </script>    
    
    </body>
</html>
    