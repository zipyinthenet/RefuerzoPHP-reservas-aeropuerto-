<?php 
// SALIR en php

// incluido script seguridad
include ("seguridad.php");

?>
<html>
<head>
<title>Desconectar</title>
</head>
<body>
<h2>Acaba de salir de la aplicación</h2>
<?php
session_destroy();
?>
</body>
</html>
