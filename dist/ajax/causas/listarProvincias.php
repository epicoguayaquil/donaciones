<?php
    session_start();
    
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    
    require "../../../funciones.php";
    
    if( isLogin() ){
        
        $conexion = new Conexion();
        $return['estado'] = 1;
        $return['mensaje'] = "";
        
        if( $_POST['metodo'] == 'PROVINCIAS' )
        {
            $qeury = "SELECT proid, pronombre FROM tb_provincias ";
            $res = $conexion->buscarVariosRegistro($qeury);
            
            foreach( $res as $key => $value )
            {
                
               $value['pronombre'] = html_entity_decode($value['pronombre']);
            
                $return['data'][] = $value;
                
            }
        }else if( $_POST['metodo'] == 'CIUDADES' )
        {
            $idprovincia = 0;
            $campo = "";
        
            if( isset($_POST{'provincia'}) )
            {
                $idprovincia = intval($_POST{'provincia'});
            }
            
            if( isset($_POST['campo']) ){
                $campo = $_POST['campo'];
            }
            
            $qeury = "SELECT ciuid, ciunombre FROM tb_ciudades WHERE proid = '$idprovincia' ";
            $res = $conexion->buscarVariosRegistro($qeury);
            
            foreach( $res as $key => $value )
            {
                
               $value['ciunombre'] = html_entity_decode($value['ciunombre']);
            
                $return['data'][] = $value;
                
            }
        }else if( $_POST['metodo'] == 'CANTONES' )
        {
            $idciudades = 0;
        
            if( isset($_POST{'ciudad'}) )
            {
                $idciudades = intval($_POST['ciudad']);
            }
            
            $qeury = "SELECT parid, parnombre FROM tb_parroquia WHERE ciuid = '$idciudades' ";
            $res = $conexion->buscarVariosRegistro($qeury);
            
            foreach( $res as $key => $value )
            {
                
               $value['parnombre'] = html_entity_decode($value['parnombre']);
            
                $return['data'][] = $value;
                
            }
        }
    }else{
        $return['estado'] = 3;
        $return['msg'] = "Debe Inicar session";
    }
    
    print_r( json_encode( $return ) );