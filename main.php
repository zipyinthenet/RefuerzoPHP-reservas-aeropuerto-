<?php
// MAIN en php

// incluido script seguridad
require("seguridad.php");

$nombre=$_SESSION['nombre'];
$apellidos=$_SESSION['apellidos'];

echo "<h2>Bienvenido <font color=\"red\">$nombre $apellidos</font></h2>";
echo "<h3>Elige entre las diferentes opciones:</h3>";
?>
<p><a href="reservar.php">Reservar vuelo</a><br/>
<p><a href="consultar.php">Consultar vuelo</a><br/>
<p><a href="anular.php">Anular vuelo</a><br/>
<p><a href="baja.php">Darse de Baja como USUARIO</a></br>
<p><a href="salir.php">Salir , cerrar sesion</a><br/>
</body>
</html>
