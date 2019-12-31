<?php
// script de SEGURIDAD en php
// llamada de retorno read para recuperar cualquier informacion de sesion existente
// usada para rellenar automaticamente variable superglobal $_SESSION
session_start();
if(!isset($_SESSION['clave']) || $_SESSION['clave']!='entrar') {
header("Location: error.html");
exit();
}
?>
