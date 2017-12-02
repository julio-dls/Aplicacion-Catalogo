<?php
$hostname = 'localhost';
$database = 'db_catalogo';
$username = 'root';
$password = '';

try {
	$con = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}
catch (PDOException $e) {
	print "¡Error!: " .$e->getMessage();
	die();
}
?>
