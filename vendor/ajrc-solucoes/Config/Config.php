<?php

/** AMBIENTE : DEV - DESENVOLVIMENTO | PRD - PRODUÇÃO */
define("ENVIROMENT","DEV");
//define("ENVIROMENT","PRD");


/** CREDENCIAIS DE BANCO DE DADOS - MYSQL */
define("DBHOST",["DEV"=>"localhost",    "PRD"=>""]);
define("DBNAME",["DEV"=>"oncar",        "PRD"=>""]);
define("DBUSER",["DEV"=>"root",         "PRD"=>""]);
define("DBPASS",["DEV"=>"",             "PRD"=>""]);
define("DBPORT",["DEV"=>"3306",         "PRD"=>""]);
//---


?>