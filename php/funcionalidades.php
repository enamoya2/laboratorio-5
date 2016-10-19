<?php

function conect(){
	//$mysqli =mysqli_connect("mysql.hostinger.es","u875296919_root","rootena","u875296919_usu") or die(mysql_error()); //hostinger
	$mysqli = mysqli_connect("localhost", "root", "", "quiz");  //local
	if (!$mysqli) {
		echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
		exit;
	}
	return $mysqli;
}

function isLogueado(){
	if (isset($_SESSION["email"]))
		return true;
	else
		return false;
}

function GetUserIP() {
    if (isset($_SERVER)) {
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
            return $_SERVER["HTTP_X_FORWARDED_FOR"];

        if (isset($_SERVER["HTTP_CLIENT_IP"]))
            return $_SERVER["HTTP_CLIENT_IP"];
        return $_SERVER["REMOTE_ADDR"];
    }
    if (getenv('HTTP_X_FORWARDED_FOR'))
        return getenv('HTTP_X_FORWARDED_FOR');

    if (getenv('HTTP_CLIENT_IP'))
        return getenv('HTTP_CLIENT_IP');
    return getenv('REMOTE_ADDR');
}

function anadirAccion($tipo){
	date_default_timezone_set("Europe/Madrid");
	$date = date('Y-m-d H:i:s');
	$ip = GetUserIP();
	$mysqli = conect();
	
	if (isLogueado()){
		$email = $_SESSION["email"];
		$conexion = $_SESSION["conexion"];
		$sql="INSERT INTO acciones(Id_Conexion, Email, Tipo, Hora, IP) VALUES ($conexion, '$email','$tipo', '$date', '$ip')";
	}else{
		$sql="INSERT INTO acciones(Tipo, Hora, IP) VALUES ('$tipo', '$date', '$ip')";
	}

	if (!mysqli_query($mysqli ,$sql)){
		echo "Error: " . mysqli_error($mysqli);
		return;
	}
	mysqli_close($mysqli);
}

?>
