<?php
	
	date_default_timezone_set('America/El_Salvador');

    define("user","root");
    define("pass","");
    define("host","localhost");
    define("database","bd_analiticasal");

    $conex = new mysqli(host,user,pass,database);

    if ($conex->connect_errno) {
        echo "Error de conexión: " . $mysqli->connect_error;
    }

?>