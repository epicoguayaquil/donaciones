<?php

require_once "config.php";
//require_once "class/c_logs.php";

class Conexion {

    private static $conexion;

    public static function abrir() {
        if (!isset(self::$conexion)) {
            try {
                self::$conexion = new PDO("mysql:host=" . servidor . "; dbname=" . db, usuario, contrasena);
                /* Atribuir errores a la variable */
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                /* Recupera con caracter especial de la base de datos */
                self::$conexion->exec("SET NAMES 'UTF8'");
            } catch (Exception $ex) {
                print 'Error :' . $ex->getMessage() . "<br>";
            }
        }
    }

    public static function cerrar() {
        if (!isset(self::$conexion)) {
            self::$conexion = null;
        }
    }

    public static function obtenerConexion() {
        self::abrir();
        return self::$conexion;
    }

    public static function buscarRegistro($sql) {
        /* retorna los datos de un refistro en un array de una dimensi贸n */
        try {
            $con = self::obtenerConexion();
            $rs = $con->prepare($sql);
            $rs->execute();
            return $rs->fetchAll();
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }
    
    public static function UpdateRegistro($sql) {
        /* retorna los datos de un refistro en un array de una dimensi贸n */
        try {
            $con = self::obtenerConexion();
            $rs = $con->prepare($sql);
            return $rs->execute();
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }

    public static function buscarVariosRegistro($sql, $data = null) {
        /* retorna los datos de un refistro en un array de una dimensi贸n */
        try {
            $con = self::obtenerConexion();
            $rs = $con->prepare($sql);
            $rs->execute($data);
            return $rs->fetchAll();
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }

    public static function ejecutar($sql, $data) {

        $con = self::obtenerConexion();
        $rs = $con->prepare($sql);
        if ($rs->execute($data)) {
            return true;
        }
        return false;
    }
    
    public static function lastId()
    {
        try
        {
        $con = self::obtenerConexion();
        $lastid =$con->lastInsertId();
        return $lastid;
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }
    
    public static function logsLogin($cod_user,$success)
    {
    
    $LogsLogin =new RegisterLogs();
    $return = $LogsLogin->login($cod_user,$success);  
    return $return;
    }
    
    public static function logs($tipo,$accion,$datelle,$medio,$cod_user)
    {
    
    $LogsLog =new RegisterLogs();
    $return = $LogsLog->logsGeneral($tipo,$accion,$datelle,$medio,$cod_user);
    return $return;
    }

}
