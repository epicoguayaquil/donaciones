<?
    require "../../config.php";
    require "../../conexion.php";
    require "../../funciones.php";
    
    session_start();
    
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    
    if(isLogin())
    {
        $conexion = new Conexion();
        
        $return['estado'] = 1;
        
        $cedula = "";
        
        $validacedula = false;
        
        if(
            isset($_POST['dni']) && !empty($_POST['dni'])
        ){
            $cedula = $_POST['dni'];
        }
        
        if( strlen($cedula) == 10 )
        {
            $arrayElement = str_split ($cedula);
            $endElement = array_pop($arrayElement);
            
            $total = 0;
            
            for( $i=0; $i<count($arrayElement); $i++ )
            {
                if( ($i%2) == 0 )
                {
                    $aux = intval($arrayElement[$i]*2);
                    
                    if( $aux > 9 ) $aux -= 9;
                    
                    $total += $aux;
                }else{
                    $total += intval($arrayElement[$i]);
                }
            }
            
            $total = $total % 10 ? 10 - $total % 10 : 0;
            
            if($total == $endElement)
            {
                $validacedula = true;
            }else{
                $return['estado'] = 2;
                $return['msg'] = "Cédula Incorrecta";
            }
        }else{
            $return['estado'] = 2;
            $return['msj'] = html_entity_decode("Longitud de c&eacute;dula incorrecta");
        }
        
        if( $validacedula )
        {
            $nombres = "";
            $apellidos = "";
            $direccion = "";
            $parroquia = "";
            $latitd = "";
            $longitud = "";
            
            if(
                ( isset($_POST['nombres'])  && !empty($_POST['nombres'])) &&
                ( isset($_POST['apellidos'])  && !empty($_POST['apellidos'])) &&
                ( isset($_POST['direccion'])  && !empty($_POST['direccion'])) &&
                ( isset($_POST['parroquia'])  && !empty($_POST['parroquia'])) &&
                ( isset($_POST['latitude'])  && !empty($_POST['latitude'])) &&
                ( isset($_POST['longitude'])  && !empty($_POST['longitude']))
            ){
                $nombres = htmlentities($_POST['nombres']);
                $apellidos = htmlentities($_POST['apellidos']);
                $direccion = htmlentities($_POST['direccion']);
                $parroquia = htmlentities($_POST['parroquia']);
                $latitd = htmlentities($_POST['latitude']);
                $longitud = htmlentities($_POST['longitude']);
            }
            
            if(
                empty($cedula) ||
                empty($nombres) ||
                empty($apellidos) ||
                empty($direccion) ||
                empty($parroquia) ||
                empty($latitd) ||
                empty($longitud)
            )
            {
                $return['estado'] = 2;
                $return['msg'] = html_entity_decode("Algunos par&aacute;metros est&aacuten vac&iacuteos");
            }
            
            $totalExiste = false;
            
            $existebeneficiario = $conexion->buscarRegistro("SELECT * FROM tb_beneficiario WHERE cedula = '$cedula' LIMIT 1");
            
            if( $existebeneficiario ) $totalExiste = true;
            
            if($totalExiste)
            {
                $return['msj'] = "Si existe";
            }else{
                $return['msj'] = "No existe"; 
            
                $sqlbeneficiario = "
                    INSERT INTO tb_beneficiario
                    (nombres,
                    cedula,
                    direcion,
                    parroquias,
                    latitud,
                    longitud)
                    VALUES
                    (?,?,?,?,?,?);
                ";
                
                $sqldatobeneficiario = array($apellidos." ".$nombres, $cedula, $direccion, $parroquia, $latitd, $longitud);
                
                $resbeneficiario = $conexion->ejecutar($sqlbeneficiario, $sqldatobeneficiario);
                
                if($resbeneficiario)
                {
                    $return['estado'] = 1;
                    $return['msg'] = html_entity_decode("Registrado con éxito");
                }else{
                    $return['estado'] = 2;
                    $return['msg'] = html_entity_decode("Error al registrar");
                }
            }
        
            $return['SQL'] = $_POST;
        }
    }else{
        $return['estado'] = 2;
        $return['msj'] = "";
        $return['data'] = array();
    }

    print_r( json_encode( $return ) );