<?php session_start(); ?>

<!doctype html public>
<html>
	<head>
		<?php include('../adds/StyleAndMeta.php'); ?>
		<title> Pagina de registro </title>
		<script type="text/javascript" src="../JavaScript/Validaciones.js"></script>
	</head>
	<body>
		<div id='page-wrap'>
		<?php include('../adds/header.php'); ?>
		<?php include('../adds/navegation.php'); ?>
		<section class="main" id="s1">
		<form id="registro" method="post" onSubmit='return validar()' action="../php/RegistrarConFoto.php" enctype="multipart/form-data">
			Registro de un usuario, los campos marcados con (*) son obligatorios
			<TABLE BORDER=0>
				<TR>
					<TD>Nombre y Apellidos (*)</TD>
					<TD><INPUT type=text name="nombre" id="nombre" required></TD>
				</TR>
				<TR>
					<TD>Email (*)</TD>
					<TD><INPUT type=text name="email" id="email" required></TD>
				</TR>
				<TR>
					<TD>Password (*)</TD>
					<TD><INPUT type=password name="password" id="password" required></TD>
				</TR>
				<TR>
					<TD>Numero de telefono (*)</TD>
					<TD><INPUT type=text name="tlf" id="tlf" required></TD>
				</TR>
				<TR>
					<TD>Especialidad (*)</TD>
					<TD>
						<SELECT name="especialidad" id="especialidad" onchange="modificarcampo()" required>
							<OPTION VALUE="hardware">Ingenieria de computadores</OPTION>
							<OPTION VALUE="compu">Computacion</OPTION>
							<OPTION VALUE="software">Ingenieria del software</OPTION>
							<OPTION VALUE="otro">Otro</OPTION>
						</SELECT>
						<span name="textootro" id="textootro" style="display: none">Introduce la otra especialidad</span>
						<input type="text" name="otraesp" id="otraesp" style="display: none">
					</TD>
				</TR>
				<TR>
					<TD>Tecnologias y herramientas en las que esta interesado</TD>
					<TD>
					<TEXTAREA name="intereses" id="intereses"></TEXTAREA>
					</TD>
				</TR>
				<TR>
					<TD>Sube una imagen tuya si lo deseas</TD>
					<TD>
					<input name="foto" id="foto" type="file" accept="image/*" onchange="loadFile(event)" />
					</TD>
				</TR>
				<TR>
					<TD></TD>
					<TD>
						<img id="output" width="150px" style="display: none"  src=""/>
					</TD>
				</TR>
				<TR>
					<TD COLSPAN=2>
						<INPUT type="submit" value="Enviar">
					</TD>
				</TR>
			</TABLE>
		</form>
		</section>
		<?php include('../adds/footer.php'); ?>
	</div>
	</body>
</html>
