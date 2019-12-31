<?php
// script de conectar

function conectar()
{
  $link=mysqli_connect('localhost','root','alumno','aeropuerto');
  if(!$link)
	die('Error al conectar con el servidor: ' . mysqli_connect_error());
  return $link;
}
?>
