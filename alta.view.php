<!-- esto es alta en php view -->
<html>

<head>
<title>Alta usuario Aeropuerto</title>
</head>

<body>
<h2>Registrate en el Aeropuerto de Castellon</h2>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<table border="0">
			<tr>
				<td>USUARIO:</td>
				<td><input type="Text" name="user" size="15" value="<?= $user?>"/></td>
			</tr>
			<tr>
				<td>PASSWORD:</td>
				<td><input type="password" name="password" size="15" /><td>
			</tr>
			<tr>
				<td>Repite PASSWORD:</td>
				<td><input type="password" name="password2" size="15" /><td>
			</tr>
			<tr>
				<td>DNI:</td>
				<td><input type="Text" name="dni" size="15" value="<?= $dni?>"/></td>
			</tr>
			<tr>
				<td>NOMBRE:</td>
				<td><input type="Text" name="nombre" size="25" value="<?= $nombre?>"/></td>
			</tr>
			<tr>
				<td>APELLIDOS:</td>
				<td><input type="Text" name="apellidos" size="25" value="<?= $apellidos?>"/></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
				<input type="submit" name='registrar' value="Registrar"/></td>
			</tr>
		</table>
	</form>

</body>

</html>

