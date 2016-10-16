<?php 
session_start(); 
include_once ("funcionalidades.php");

function validarComplejidad($comp){
	$re = '/^[1-5]$/';
	return preg_match($re, $comp);
}
function guardarPregunta(){
	$mysqli = conect();
	$num_pregunta = mysqli_query($mysqli, "select * from pregunta where Numero = (select MAX(Numero) from pregunta)");
	$cont= mysqli_num_rows($num_pregunta);
	$numero=0;
	if($cont!=0){
		$row = mysqli_fetch_assoc( $num_pregunta );
		$numero = $row['Numero']+1;
	}
	$comp=$_POST['complejidad'];
	$email=$_SESSION["email"];
	$pregunta=$_POST['pregunta'];
	$respuesta=$_POST['respuesta'];
	
	if(!validarComplejidad($comp)){
		$comp=0;
	}
	$sql="INSERT INTO pregunta(Numero, Email, Pregunta, Respuesta, Complejidad) VALUES ($numero,'$email','$pregunta','$respuesta',$comp)";
	if (!mysqli_query($mysqli ,$sql)){
		echo "Error: " . mysqli_error($mysqli);
		return;
	}
	else{
		echo 'Pregunta almacenada, si desea almacenar otra pregunta <a href="InsertarPregunta.php">pulsa aqui</a>.';
	}
	
	mysqli_close($mysqli);
}

function crearFormularioPregunta(){
	echo 
		'<form id="inspregunta" method="post" action="InsertarPregunta.php">
					<table BORDER=0 align="center">
						<tr>
							<td>Pregunta (*)</td>
							<td> <input type="text" name="pregunta" id="pregunta" required></td>
						</tr>
						<tr>
							<td>Respuesta (*)</td>
							<td><input type="text" name="respuesta" id="respuesta" required></td>
						</tr>
						<tr>
							<td>Complejidad</td>
							<td>
								<select id="complejidad" name="complejidad">
									<option value="0" selected="selected"></option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan=2><input type="submit" value="Enviar"></td>
						</tr>
					</table>
				</form>';
}
?>





<!DOCTYPE html>
<html>
  <head>
	<?php include('../adds/StyleAndMeta.php'); ?>
	<title>Insertar Pregunta</title>
  </head>
  <body>
	<div id='page-wrap'>
		<?php include('../adds/header.php'); ?>
		<?php include('../adds/navegation.php'); ?>
		<section class="main" id="s1">
			<div>
				<?php 
					if(isLogueado()){
						if(isset($_POST['respuesta']) && isset($_POST['pregunta'])){
							guardarPregunta();
						}
						else{
							crearFormularioPregunta();
						}
					}
					else{
						echo "Para acceder aqui se debe estar registrado.";
					}
				?>
			</div>
		</section>
		<?php include('../adds/footer.php'); ?>
	</div>
</body>
</html>

