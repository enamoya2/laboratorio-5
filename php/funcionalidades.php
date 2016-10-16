<?php

function conect(){
	$mysqli =mysqli_connect("mysql.hostinger.es","u875296919_root","rootena","u875296919_usu") or die(mysql_error()); //hostinger
	//$mysqli = mysqli_connect("localhost", "root", "", "quiz");  //local
	if (!$mysqli) {
		echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
		exit;
	}
	return $mysqli;
}

function isLogueado(){
	if (isset($_SESSION['email']))
		return true;
	else 
		return false;
}

?>