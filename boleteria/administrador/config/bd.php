<?php 
$host="localhost";
$bd="boleteria";
$usuario="root";
$contasenia="";

try {
    $conexion=new PDO("mysql:host=$host;dbname=$bd", $usuario,$contasenia );
} catch (Exception $ex) {

    echo $ex->getMessage();
}

?>