<?
    session_start();
    require "../../../funciones.php";
    
    if( isLogin() )
    {
        $return['success'] = 1;
        $return['reshtml'] = "";
        
        $conexion = new Conexion();
        
        $propDisabledNumDoc = '';
        if( isset( $_POST['beneficiario'] ) )
        {
            $idbeneficiario = $conexion->buscarRegistro("SELECT * FROM tb_beneficiario WHERE idbeneficiario = ".$_POST['beneficiario']);
            if( count($idbeneficiario) > 0 ) $propDisabledNumDoc = 'readonly';
            
            // PROVINCIA
            $provincia = $conexion->buscarVariosRegistro("SELECT proid, pronombre FROM tb_provincias");
            $optionProvincia = '<option value="0"> Seleccione una provincia</option>';
            foreach( $provincia as $key => $value)
            {
                $optionProvincia .= "<option value='".$value['proid']."' ".( $value['proid'] == $idbeneficiario[0]['provincia'] ? 'selected' : '' ).">".$value['pronombre']."</option>";
            }
            
            // CIUDADES
            $ciudades = $conexion->buscarVariosRegistro("SELECT ciuid, ciunombre FROM tb_ciudades");
            $optionCiudades = '<option value="0"> Seleccione una ciudad</option>';
            foreach( $ciudades as $key => $value)
            {
                $optionCiudades .= "<option value='".$value['ciuid']."' ".( $value['ciuid'] == $idbeneficiario[0]['ciudad'] ? 'selected' : '' ).">".$value['ciunombre']."</option>";
            }
            
            // CANTONES
            $parroquias = $conexion->buscarVariosRegistro("SELECT parid, parnombre FROM tb_parroquia");
            $optionParroquias = '<option value="0"> Seleccione una parroquia</option>';
            foreach( $parroquias as $key => $value)
            {
                $optionParroquias .= "<option value='".$value['parid']."' ".( $value['parid'] == $idbeneficiario[0]['parroquia'] ? 'selected' : '' ).">".$value['parnombre']."</option>";
            }
        }
        
        if( $_POST['METODO'] == "BENEFICIARIO" )
        {
            if( $_POST['TIPOBENEFICIARIO'] == 1 )
            {
                // NIVEL EDUCATIVO
                $optionEducativo = "<option value='0'>Seleccione el nivel educativo</option>";
                $nivelEducativo = $conexion->buscarVariosRegistro("SELECT * FROM tb_nivel_educativo WHERE estado = 'A'");
                foreach( $nivelEducativo as $key => $value )
                {
                    $optionEducativo .= "<option value='".$value['id_nivel_educativo']."' ".( $value['id_nivel_educativo'] == $idbeneficiario[0]['nivel_academico'] ? 'selected' : ''  )." >".$value['nombre']."</option>";
                }
                
                // SECTOR DEL BENEFICIARIO
                $sectorBeneficiario = array("Seleccione el sector", "Norte", "Centro", "Sur");
                $optionbeneficiario = "";
                foreach( $sectorBeneficiario as $key => $value)
                {
                    $optionbeneficiario .= "<option value='".$key."' ".( $key == $idbeneficiario[0]['sector'] ? 'selected' : ''  ).">".$value."</option>";
                }
                
                // GENERO DEL BENEFICIARIO
                $genero_beneficiario = array("Seleccione el género", "Masculino", "Femenino", "Otros");
                $optiongenero ="";
                foreach( $genero_beneficiario as $key => $value)
                {
                    $optiongenero .= "<option value='".$key."' ".( $key == $idbeneficiario[0]['genero'] ? 'selected' : ''  ).">".$value."</option>";
                }
                
                $return['reshtml'] = '
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                            <div style="text-align: left;">
                                <label> N&uacute;mero Doc. *</label>
                                <input type="text" value="'.$idbeneficiario[0]['num_doc'].'" class="form-control" '.( $propDisabledNumDoc ).' maxlength="10" id="txt_numDoc" style="margin: 0 0 5px;" name="txt_numDoc" onkeypress="return valideKey(event);" placeholder="Ingrese su N&uacute;mero de documento" required />
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                            <div style="text-align: left;">
                                <label for="txt_nombreApellidos">Apellidos y Nombres *</label>
                                <input type="text" value="'.$idbeneficiario[0]['nombres'].'" id="txt_nombreApellidos" style="margin: 0 0 5px;" name="txt_razonSocial" placeholder="Ingrese sus Nombre" required aria-required="true" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                            <div style="text-align: left;">
                                <label> Número de teléfono *</label>
                                <input type="text"  value="'.$idbeneficiario[0]['numero_contacto'].'" class="form-control" id="txt_telefonoContacto" style="margin: 0 0 5px;"  onkeypress="return valideKey(event);" maxlength="15" name="txt_telefonoContactoN" placeholder="Número de telefono" onlyNumber required="" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                            <div style="text-align: left;">
                                <label> Correo *</label>
                                <input type="text" value="'.$idbeneficiario[0]['correo'].'" class="form-control" id="txt_correo" style="margin: 0 0 5px;" name="txt_correo" placeholder="Ingrese su Correo" onlyNumber required="" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                            <div style="text-align: left;">
                                <label> Direcci&oacute;n *</label>
                                <input type="text" value="'.$idbeneficiario[0]['direccion'].'" class="form-control" id="txt_address" style="margin: 0 0 5px;" name="txt_address" placeholder="Ingrese su direcci&oacute;n" onlyNumber required="" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                            <div style="text-align: left;">
                                <label> Provincia *</label>
                                <select class="form-control" id="txt_provincia" style="margin: 0 0 5px;" name="txt_provincia" placeholder="Ingrese la parroquia"  required="">
                                    '.$optionProvincia.'
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                            <div style="text-align: left;">
                                    <label> Ciudad *</label>
                                    <select class="form-control" id="txt_ciudad"  style="margin: 0 0 5px;" '.( count($idbeneficiario) > 0 ? '' : 'disabled' ).' name="txt_ciudad" placeholder="Ingrese la parroquia" required="">
                                        '.$optionCiudades.'
                                    </select>
                                </div>
                            </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                            <div style="text-align: left;">
                                <label> Parroquia *</label>
                                <select class="form-control" id="txt_parroquia" style="margin: 0 0 5px;" '.( count($idbeneficiario) > 0 ? '' : 'disabled' ).' name="txt_parroquia" placeholder="Ingrese la parroquia" required="">
                                    '.$optionParroquias.'
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                            <div style="text-align: left;">
                            <label> Sector *</label>
                                <select class="form-control" id="text_sector" style="margin: 0 0 5px;" name="text_sector" placeholder="Ingrese la parroquia" required="">
                                    '.$optionbeneficiario.'
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                            <div style="text-align: left;">
                                <label> G&eacute;nero *</label>
                                <select id="txt_genero" name="txt_genero" class="form-control col-md-7 col-xs-12"   style="margin-bottom: 2%;">
                                    '.$optiongenero.'
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                            <div style="text-align: left;">
                                <label>Nivel Educativo *</label>
                                <select id="txt_educativo" name="txt_educativo" class="form-control col-md-7 col-xs-12"  style="margin-bottom: 2%;" >
                                    '.$optionEducativo.'
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                            <div style="text-align: left;">
                                <label> Fecha Nacimiento *</label>
                                <input type="date" value="'.$idbeneficiario[0]['fecha_nac'].'" id="txt_fechaNacimiento" class="form-control col-md-7 col-xs-12" style="margin: 0 0 5px;" name="txt_fechaNacimientoN" value="'.date("Y-m-d", strtotime ('-19 year' , strtotime(date("Y-m-d"))) ).'" placeholder="Ingrese su Fecha Nacimiento"  required="" />
                            </div>
                        </div>
                    </div>';
            }else if( $_POST['TIPOBENEFICIARIO'] == 2 )
            {
                $return['reshtml'] = '
                    <div id="personaJuridica" class="persona">
                        
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                <div style="text-align: left;">
                                    <label> N&uacute;mero Doc.</label>
                                    <input type="text" value="'.$idbeneficiario[0]['num_doc'].'" '.( $propDisabledNumDoc ).' class="form-control" id="txt_numDoc" style="margin: 0 0 5px;" name="txt_numDoc" onkeypress="return valideKey(event);" placeholder="Ingrese su N&uacute;mero de documento" required="" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                <div style="text-align: left;">
                                    <label> Raz&oacute;n Social</label>
                                    <input type="text" value="'.$idbeneficiario[0]['nombres'].'" class="form-control" id="txt_razonSocial" style="margin: 0 0 5px;" name="txt_razonSocial" placeholder="Ingrese raz&oacute;n social" required="" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                <div style="text-align: left;">
                                    <label> Persona Contacto</label>
                                    <input type="text" class="form-control" value="'.$idbeneficiario[0]['persona_contacto'].'" id="txt_personaContacto" style="margin: 0 0 5px;" name="txt_personaContacto" placeholder="Ingrese sus persona contacto" required="" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                <div style="text-align: left;">
                                    <label> Tel&eacute;fono Contacto</label>
                                    <input type="text" value="'.$idbeneficiario[0]['numero_contacto'].'" class="form-control" id="txt_telefonoContacto" onkeypress="return valideKey(event);" style="margin: 0 0 5px;" name="txt_telefonoContacto" placeholder="Ingrese su t&eacute;lefono contacto" required="" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                <div style="text-align: left;">
                                    <label> Correo</label>
                                    <input type="text" class="form-control" value="'.$idbeneficiario[0]['correo'].'" id="txt_correo" style="margin: 0 0 5px;" name="txt_correo" placeholder="Ingrese su Correo" onlyNumber required="" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                <div style="text-align: left;">
                                    <label> Direcci&oacute;n</label>
                                    <input type="text" value="'.$idbeneficiario[0]['direccion'].'" class="form-control" id="txt_address" style="margin: 0 0 5px;" name="txt_address" placeholder="Ingrese su direcci&oacute;n" onlyNumber required="" />
                                </div>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                <div style="text-align: left;">
                                    <label> Provincia *</label>
                                    <select class="form-control" id="txt_provincia" style="margin: 0 0 5px;" name="txt_provincia"  placeholder="Ingrese la parroquia"  required="">
                                        '.$optionProvincia.'
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                <div style="text-align: left;">
                                        <label> Ciudad *</label>
                                        <select class="form-control" id="txt_ciudad" style="margin: 0 0 5px;" '.( count($idbeneficiario) > 0 ? '' : 'disabled' ).' name="txt_ciudad" placeholder="Ingrese la parroquia" required="">
                                            '.$optionCiudades.'
                                        </select>
                                    </div>
                                </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                <div style="text-align: left;">
                                    <label> Parroquia *</label>
                                    <select class="form-control" id="txt_parroquia" style="margin: 0 0 5px;" '.( count($idbeneficiario) > 0 ? '' : 'disabled' ).' name="txt_parroquia" placeholder="Ingrese la parroquia" required="">
                                        '.$optionParroquias.'
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> 
                ';
            }
            
            $return['reshtml'] .= '        
                <div class="row" style="margin-top: 1%">
                    <div class="text-center">
                        <button type="submit" class="btn btn-sm btn-success btnBeneficiario">Guardar Beneficiario</button>
                    </div>
                </div>
            '; 
        }
    }else{
        $return['success'] = 3;
        $return['mensaje'] = "Debe inicar session";
    }
    
    print_r( json_encode( $return ) );