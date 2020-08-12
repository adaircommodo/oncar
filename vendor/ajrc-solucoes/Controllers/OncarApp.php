<?php

namespace Ajrc\Controllers;

class OncarApp
{

    public function any() : array
    {
        $method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_ENCODED);
        $class = filter_input(INPUT_SERVER,'REQUEST_URI', FILTER_SANITIZE_STRING);
        
        return $this->getController($method, ucfirst(substr($class,1)) );

    }

    public function getController($method, $classe)
    {

        //---| TRATA A REQUISIÇÃO OBTENDO ID |---
        $pos = strripos($classe, "/");
        if ($pos !== false) {
            $vt = explode("/",$classe);
            $classe = $vt[0];
            $id = (int) $vt[1];
        }

        //---| VERIFICA SE O CONTROLADOR EXISTE, SENÃO SETA VeiculosController |---
        $class = (file_exists("../vendor/ajrc-solucoes/Controllers/".$classe."Controller.php"))
                    ?'\\Ajrc\\Controllers\\'. $classe . 'Controller':0;
        
        //---| SE NÃO EXISTIR A CLASSE RETORNA ERRO |---
        if(!$class){ return ["success"=>0, "result"=>"Recurso Indisponível!!!", "msg"=>"Classe ".$classe." Inexistente!"]; }
        
        switch ($method) 
        {
            case 'POST':
                return $class::record();
                break;
            case 'PUT':
                return $class::alter();
                break;
            case 'DELETE':
                return $class::delete( $id );
                break;
            case 'GET':
            default:
                return $class::listAll(); 
                break;
        }

    }

}