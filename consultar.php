<?php

// incluido script seguridad
require("seguridad.php");

// incluido script conectar 
require("conectar.php");

?>

<html>
<head>
<title>Consultar vuelos Aeropuerto de Castellon Reservados</title>
</head>
<body>

<?php

// declaramos variables
$dni=$_SESSION['dni'];
$nombre=$_SESSION['nombre'];
$apellidos=$_SESSION['apellidos'];	

$link = conectar();
// seleccion tabla reserva campos * y vuelos campos destino,precio
$sql="SELECT r.dni,r.codigo,r.clase,r.reserva,r.equipaje,r.seguro,r.num_plazas,v.destino,v.precio from reserva r,vuelos v where r.codigo=v.codigo and dni='$dni'";
  if(!($result=mysqli_query($link,$sql)))
    die('No se ha podido realizar la consulta' . mysqli_error($link));

  echo "<h2>Pedido de D. $nombre $apellidos</h2>";
  echo '<table border="1" align="center">';
  
  echo "<tr><td style='text-align:center'><b>Codigo Vuelo</b></td><td style='text-align:center'><b>Destino</b></td><td style='text-align:center'><b>Clase</b></td><td style='text-align:center'><b>Extra Reserva</b></td><td style='text-align:center'><b>Extra Equipaje</b></td><td style='text-align:center'><b>Extra Seguro</b></td><td style='text-align:center'><b>Plazas Solicitadas</b></td><td style='text-align:center'><b>Precio Billete Unitario</b></td><td style='text-align:center'><b>Precio Reserva</b></td></tr>";
  	$precio_total='0';
  while ($row = mysqli_fetch_array($result)){ 
        $clase=$row['clase'];
        $reserva=$row['reserva'];
  	$equipaje=$row['equipaje'];
  	$seguro=$row['seguro'];
  	$num_plazas=$row['num_plazas'];
  	$destino=$row['destino'];
  	$precio=$row['precio'];	
	$codigo=$row['codigo'];

//	se calcula si la reserva tiene cualquier de los 3 extras	
	$precio_extra=0;
	if ($reserva=='1'){
	  $reserva_text='si';
	  $precio_extra=$precio_extra+20;
	}
	else{
	  $reserva_text='no';
	}
	if ($equipaje=='1'){
	  $equipaje_text='si';
	  $precio_extra=$precio_extra+20;
	}
	else{
	  $equipaje_text='no'; 
	}
	if ($seguro=='1'){
	  $seguro_text='si';
	  $precio_extra=$precio_extra+20;
	}
	else{
	  $seguro_text='no';
	}
//	aqui abajo , si la clase es turista , entonces el cargo es de 0 , si no else , el cargo es del 20 por que se supone que es diferente a turista , osea bussiness	
	if ($clase=='Turista'){
	$cargo='0';
        $precio_extras_todasplazas=$precio_extra*$num_plazas;
	$precio_final=$precio*$num_plazas + $precio_extras_todasplazas;
	}
	else{
	$cargo='20';
	$cientoporciento='100';
	$precio_cargo=$precio*$cargo/$cientoporciento;
	$precio_cargo_con_plazas=$precio_cargo*$num_plazas;	
        $precio_extras_todasplazas=$precio_extra*$num_plazas;
	$precio_final=$precio*$num_plazas + $precio_extras_todasplazas + $precio_cargo_con_plazas;
	}
	$precio_total=$precio_total+$precio_final;
  echo "<tr>";
  echo "<td style='text-align:center'>".$codigo."</td><td style='text-align:center'>".$destino."</td><td style='text-align:center'>".$clase."</td><td style='text-align:center'>".$reserva_text."</td><td style='text-align:center'>".$equipaje_text."</td><td style='text-align:center'>".$seguro_text."</td><td style='text-align:center'>".$num_plazas."</td><td style='text-align:center'>".$precio."</td><td style='text-align:center'>".$precio_final."</td>";
  echo "</tr>"; 
  }
  echo "</table>";
  echo "<h2>La suma Total de las reservas asciende a: ".$precio_total." Euros.</h2>";


mysqli_free_result($result);
mysqli_close($link);
?>

<a href="main.php">Volver a Principal</a><br/>

</body>
</html>

