<?php
require("seguridad.php");
require("conectar.php");
?>
<html>

<head>
<title>Anular vuelos de una reserva</title>
</head>

<body>


<?php

$plazas_solicitadas=0;
$codigo='';

// if isset eliminar deberia de ir abajo solo? Creo que es solo para cuando se presione eliminar a partir de ahi comience a hacer otras cosas... ??
if(isset($_POST['eliminar'])){
 
  $link = conectar();
  $codigo = $_POST['codigo'];
  $dni=$_SESSION['dni'];
  $apellidos=$_SESSION['apellidos'];

  
//  $codigo = $_POST['codigo'];
//  $dni = $_SESSION['dni'];
//  $apellidos = $_SESSION['apellidos'];
// aqui arriba deberia de coger los valores siendo el usuario que es con su DNI
	
//--------------------------------------------------------	
// podria probar , y realizar un foreach aqui arriba sobre los destinos que se han reservado.
// primero una consulta a la tabla reservas y el codigo de las reservas meterlo en una variable
// esa variable codigo reservas que es lo que guarda, despues consultar los destinos que tienen ese codigo
// despues con el destino de ese codigo de reservas , poner cada valor de destino (texto) en un for each , en caso de ser cada uno de ellos bueno con if elseif elseif , meter el valor en variables y en caso de que pase el forearch por bueno y se obtenga esa variable qye guarda el nombre , meter ese nombre en el destino a borrar
// apoyarse de reserva que ya esta hecho.

//$sql="SELECT r.dni,r.codigo,r.clase,r.reserva,r.equipaje,r.seguro,r.num_plazas,v.destino,v.precio from reserva r,vuelos v where r.codigo=v.codigo and dni='$dni'";
//  if(!($result=mysqli_query($link,$sql)))
//    die('No se ha podido realizar la consulta' . mysqli_error($link));
}
?>	

<h2>Aeropuerto de Castellon</h2>
<h3 style="color:blue"><i>Seleccione la reserva que desea eliminar:</i></h3>

<?php
      
//  echo '<table border="1" align="center">';
//  echo "<tr><td><b>Codigo</b></td><td><b>Destino</b></td><td><b>Clase</b></td><td><b>Extra Reserva</b></td><td><b>Extra Equipaje</b></td><td><b>Extra Seguro</b></td><td><b>Plazas Solicitadas</b></td><td><b>Precio Reserva</b></td></tr>";
 //       $precio_total='0';
//  while ($row = mysqli_fetch_array($result)){
//        $clase=$row['clase'];
//        $reserva=$row['reserva'];
//        $equipaje=$row['equipaje'];
//        $seguro=$row['seguro'];
//        $num_plazas=$row['num_plazas'];
//        $destino=$row['destino'];
//        $precio=$row['precio'];
//        $codigo=$row['codigo'];

//      se calcula si la reserva tiene cualquier de los 3 extras
 //       $precio_extra=0;
//        if ($reserva=='1'){
 //         $reserva_text='si';
 //         $precio_extra=$precio_extra+20;
 //       }
 //       else{
 //         $reserva_text='no';
 //       }
 //       if ($equipaje=='1'){
  //        $equipaje_text='si';
 //         $precio_extra=$precio_extra+20;
   //     }
 //       else{
   //       $equipaje_text='no';
  //      }
   //     if ($seguro=='1'){
  //        $seguro_text='si';
 //         $precio_extra=$precio_extra+20;
//        }
   //     else{
 //         $seguro_text='no';
//	}

//      aqui abajo , si la clase es turista , entonces el cargo es de 0 , si no else , el cargo es del 20 por que se supone que es diferente a turista , osea bussiness
 //       if ($clase=='Turista'){
  //      $cargo='0';
   //     $precio_extras_todasplazas=$precio_extra*$num_plazas;
  //      $precio_final=$precio*$num_plazas + $precio_extras_todasplazas;
 //       }
//        else{
 //       $cargo='20';
 //       $cientoporciento='100';
 //       $precio_cargo=$precio*$cargo/$cientoporciento;
 //       $precio_cargo_con_plazas=$precio_cargo*$num_plazas;
 //       $precio_extras_todasplazas=$precio_extra*$num_plazas;
 //       $precio_final=$precio*$num_plazas + $precio_extras_todasplazas + $precio_cargo_con_plazas;
   //     }
   //     $precio_total=$precio_total+$precio_final;
 // echo "<tr>";
//  echo "<td>".$codigo."</td><td>".$destino."</td><td>".$clase."</td><td>".$reserva_text."</td><td>".$equipaje_text."</td><td>".$seguro_text."</td><td>".$num_plazas."</td><td>".$precio_final."</td>";
//  echo "</tr>";
//  }
//  echo "</table>";

?>

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













