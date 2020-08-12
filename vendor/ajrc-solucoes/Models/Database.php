<?php

namespace Ajrc\Models;

use \PDO;
use \PDOException;

class Database
{
    
    private static $pdo;
    
    private static $host;
    private static $dbname;
    private static $user;
    private static $pass;
    private static $port;
   
    private static function conectar()
    {
        
        self::$host =   (ENVIROMENT!="DEV")?DBHOST["PRD"]:DBHOST["DEV"];
        self::$dbname = (ENVIROMENT!="DEV")?DBNAME["PRD"]:DBNAME["DEV"];
        self::$user =   (ENVIROMENT!="DEV")?DBUSER["PRD"]:DBUSER["DEV"];
        self::$pass =   (ENVIROMENT!="DEV")?DBPASS["PRD"]:DBPASS["DEV"];
        self::$port =   (ENVIROMENT!="DEV")?DBPORT["PRD"]:DBPORT["DEV"];
    
        try {

            self::$pdo = new PDO("mysql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$dbname.";charset=utf8;collate=utf8_bin", self::$user, self::$pass);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            self::$pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);

            return self::$pdo;

        } catch(\PDOException $exception) {
            var_dump($exception); die;
            //return $exception;
            
        }

    }

    public static function QUERY(string $query, array $bindParams=[])
    {
        //---| REALIZA A CONEXÃO COM O BANCO DE DADOS |---
        $con = self::conectar();
        //---
            
        try { 

            $operacao = $con->prepare($query);

            if(count($bindParams)>0) {
                
                foreach ($bindParams as $key => $value) {
                    $typeParam = PDO::PARAM_STR;
                    $operacao->bindValue($key, $value, $typeParam); 
                }

            }

            $operacao->execute();
            
            if(substr(strtoupper($query),0,6) == "SELECT"){ $rs = $operacao->fetchAll(); }
            if(substr(strtoupper($query),0,6) == "INSERT"){ $rs = (int) $con->lastInsertId(); }
            if(substr(strtoupper($query),0,6) == "UPDATE"){ $rs = true; }
            if(substr(strtoupper($query),0,6) == "DELETE"){ $rs = true; }
            
        }
        catch(PDOException $e){  return $e; }
        catch(Exception $e){ return $e; }
        
        return $rs;
        
    }

    
    public static function Fetch(string $query, array $bindParams=[])
    {
        
        $con = self::conectar();

        try {

            $operacao = $con->prepare($query);

            if(count($bindParams)>0) {
                
                foreach ($bindParams as $key => $value) {
                    if(is_numeric($value)){ $typeParam = PDO::PARAM_INT; } 
                    elseif(is_bool($value)){ $typeParam = PDO::PARAM_BOOL; }  
                    else{ $typeParam = PDO::PARAM_STR; }
                    $operacao->bindValue($key, $value, $typeParam); 
                }
            }
            
            $operacao->execute(); 
            $rs = $operacao->fetch();

        } catch(PDOException $e) { return $e; }
        
        return $rs;
        
    }

    public static function Binder(array $bind, int $tipo): array
    {
        $campos = NULL;
        $ttItensArray = (int) count($bind);
        $contador = 1;
        foreach ($bind as $key => $value) {
            if($key!=":id") {
                $campos.= substr($key,1)."=".$key;
                if($contador<$ttItensArray){ $campos.=", "; }
            }
            $contador++;
        }
        $campos2 = null;
        
        if($tipo == 1) //INSERT
        {
            $campos = "(";
            $campos2 = "(";
            $contador = 1;
            foreach ($bind as $key => $value) {
                $campos.= substr($key,1);
                $campos2.= $key;
                if($contador<count($bind)){ $campos.=", "; $campos2.=", "; }
                $contador++;
            }
            $campos.= ")";
            $campos2.= ")";

        }
        
        return [ $campos, $campos2 ];

    }

    final private function __construct(){}

    final private function __clone(){}

    final private function __wakeup(){}


}