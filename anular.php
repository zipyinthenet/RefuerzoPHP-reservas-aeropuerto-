<?php

// incluido script seguridad
require("seguridad.php");

// incluido script conectar
require("conectar.php");

?>

<html>

<head>
<title>Anular vuelos de una reserva</title>
</head>

<body>


<?php

// declaramos variables
$plazas_solicitadas=0;
$codigo='';

// if isset eliminar deberia de ir abajo solo? Creo que es solo para cuando se presione eliminar a partir de ahi comience a hacer otras cosas... ??
if(isset($_POST['eliminar'])){
 
  $link = conectar();
  $codigo = $_POST['codigo'];
  $dni=$_SESSION['dni'];
  $apellidos=$_SESSION['apellidos'];

	
}
?>	

<h2>Aeropuerto de Castellon</h2>
<h3 style="color:blue"><i>Seleccione la reserva que desea eliminar:</i></h3>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<p>Código vuelo: <input type="text" name="codigo" size="15" maxlength="20" value=""/></p>
<p><input type="submit" name="eliminar" value="Eliminar"></p>
</form>

<?php
if(isset($_POST['eliminar'])){

	$sql="SELECT * from reserva where dni='$dni' and codigo='$codigo'";
	if(!($result=mysqli_query($link,$sql)))
	  die('No se ha podido realizar la consulta' . mysqli_error($link));
	
	if(mysqli_num_rows($result)!=0){
	  $row=mysqli_fetch_array($result);
	  $plazas_solicitadas=$row['num_plazas'];
	    
	  $sql = "DELETE FROM reserva where dni='$dni' and codigo='$codigo'";
	  if (!mysqli_query($link,$sql))
            die('No se ha podido realizar la consulta  '. mysqli_error($link));
	  
	  $sql = "UPDATE vuelos SET plazas_libres=plazas_libres+$plazas_solicitadas WHERE codigo='$codigo'";
	  if (!mysqli_query($link,$sql))
            die('No se ha podido realizar la consulta  ' . mysqli_error($link));
          echo '<h2 style="color:green">Sr ' . $apellidos . ', el pedido se ha eliminado correctamente</h2>';
	 }
	 else{
	    echo '<h2 style="color:red">No se puede borrar pedido ' . $codigo . ' de  Sr. ' . $apellidos . ', no  existe el pedido</h2>';
	 }
  mysqli_free_result($result);
  mysqli_close($link);
}

?>

<p><a href="main.php">Volver a Principal</a></p>

</body>
</html>













