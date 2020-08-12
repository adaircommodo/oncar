<?php

namespace Ajrc\Controllers;

class VeiculosController
{

    private static $table = "tb_veiculos";
    private static $vwtable = "vw_veiculos";

    public static function listAll(?str $where = null) : ?array
    {

        try{
            
            $result = \Ajrc\Controllers\MysqlDbController::QUERY("SELECT * FROM " . self::$vwtable);
            
            return ["success"=>1, "result"=>$result];
        
        }catch(\PDOException $pe){
        
            return ["success"=>0, "result"=>$pe];
        
        }catch(\Exception $e){
        
            return ["success"=>0, "result"=>$e];

        }

    }

    public static function record()
    {

        try{
            
            $_POST[":created"] = date("Y-m-d H:i:s");
            $campos = \Ajrc\Controllers\MysqlDbController::Binder($_POST,1);
            $result = \Ajrc\Controllers\MysqlDbController::QUERY("INSERT INTO " . self::$table . $campos[0] . " VALUES " . $campos[1], $_POST);
            
            return ["success"=>1, "result"=>$result];
            
        }catch(\PDOException $pe){
        
            return ["success"=>0, "result"=>$pe];
        
        }catch(\Exception $e){
        
            return ["success"=>0, "result"=>$e];

        }
        

    }

    public static function alter()
    {

        try{

            $bind = [];
            parse_str(file_get_contents("php://input"),$post_vars);
            $values = explode('&',urldecode($post_vars['dados']));
            $bind[":vendido"] = 0;
            $bind[":updated"] = date("Y-m-d H:i:s");
            foreach($values as $value){
                $item = explode("=",$value);
                $bind[$item[0]] = $item[1];
            }

            $campos = \Ajrc\Controllers\MysqlDbController::Binder($bind, 2); //2 = UPDATE
            $result = \Ajrc\Controllers\MysqlDbController::QUERY("UPDATE " . self::$table. " SET " . $campos[0] . " WHERE id=:id", $bind);
            
            return ["success"=>1, "result"=>$result, "id" =>$bind[":id"]];
            
        }catch(\PDOException $pe){
        
            return ["success"=>0, "result"=>$pe];
        
        }catch(\Exception $e){
        
            return ["success"=>0, "result"=>$e];

        }
        

    }
    
    public static function delete(int $id) : ?array
    {

        try{
            
            $result = "Veículo inválido!";
            if(is_integer($id)){
                $result = \Ajrc\Controllers\MysqlDbController::QUERY("DELETE FROM " . self::$table . " WHERE id=:id",[":id"=>$id]);
            }
            return ["success"=>1, "result"=>$result];
        
        }catch(\PDOException $pe){
        
            return ["success"=>0, "result"=>$pe];
        
        }catch(\Exception $e){
        
            return ["success"=>0, "result"=>$e];

        }

    }

}