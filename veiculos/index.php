<?php
   
    require_once __DIR__ . "/../vendor/autoload.php";
    
    //--| CORS |---
    header('Access-Control-Allow-Origin: *'); //verificar se vai ficar "ABERTO" mesmo
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE"); 
    header('Access-Control-Max-Age: 86400');
    header("Content-type: application/json; charset=utf-8");

    date_default_timezone_set('America/Sao_Paulo');
    
    $app = new \Ajrc\Controllers\OncarApp();

    echo json_encode( $app->any() );