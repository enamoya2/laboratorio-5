<?php
session_start();
include_once ("funcionalidades.php");

function crearFormLogin(){
	echo 
		'<form action="login.php" method="post" class="login">
			<h2> Identificacion de Usuario </h2>
			<div>Username<input name="email" type="text" required></div>
			<div>Password<input name="pass" type="password" required></div>
			<div><input id="login" name="login" type="submit" value="login"></div>
		</form>';
}

function verificarLogin($email, $pass){
	$mysqli = conect();
	$usuarios = mysqli_query($mysqli, "select * from usuario where Email='$email' and Password='$pass'");
	$cont= mysqli_num_rows($usuarios);
	if($cont==0){
		echo '<p>Los datos no son correctos, intentalo de nuevo.</p></br>';
		crearFormLogin();
	}
	else{
		$row = mysqli_fetch_assoc( $usuarios );
		echo "Bienvenido,". $row['Nombre'];
		session_start();
		date_default_timezone_set("Europe/Madrid");
		$date = date('Y-m-d H:i:s');
		$_SESSION["date"] = $date;
		$_SESSION["email"] = $row['Email'];
		$_SESSION["nombre"] = $row['Nombre'];
		//$_SESSION["rol"] = $row['Rol'];

		header("location:InsertarPregunta.php");
	}
	mysqli_close($mysqli);
}

?>

<!DOCTYPE html>
<html>
  <head>
	<?php include('../adds/StyleAndMeta.php'); ?>
	<title>Login</title>
  </head>
  <body>
  <div id='page-wrap'>
	<?php include('../adds/header.php'); ?>
	<?php include('../adds/navegation.php'); ?>
    <section class="main" id="s1">
		<div>
		<?php			
			if(!isLogueado()){
				if(isset($_POST['email']) && isset($_POST['pass'])){
					$email = $_POST['email'];
					$pass = sha1($_POST['pass']);
					verificarLogin($email, $pass);
				}
				else{
					crearFormLogin();
				}
			}
			else{
				echo 'Ya estas logueado '.$_SESSION["nombre"].'.';
			}
		?>
		</div>
    </section>
	<?php include('../adds/footer.php'); ?>
</div>
</body>
</html>
