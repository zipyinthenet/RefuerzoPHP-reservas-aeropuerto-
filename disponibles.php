<html>

<head>
<title>Vuelos Disponibles</title>
</head>

<body>

<?php
require("conectar.php");

$link = conectar();

$sql="SELECT * from vuelos";
if(!($result=mysqli_query($link,$sql)))
  die('No se ha podido realizar la consulta' . mysqli_error($link));

echo '<h1><font color="blue">VUELOS DISPONIBLES </font></h1>';
echo '<table border="1">';
echo '<tr><th>CODIGO</th><th>DESTINO</th><th>PRECIO</th><th>PLAZAS LIBRES</th></tr>';

while ($row = mysqli_fetch_array($result)){
  echo '<tr>'; 
  echo '<td style="text-align:center">'.$row['codigo'].'</td><td style="text-align:center">'.$row['destino'].'</td><td style="text-align:center">'.$row['precio'].'€</td><td style="text-align:center">'.$row['plazas_libres'].'</td>';
  echo '</tr>';
}
echo '</table>';
		
mysqli_free_result($result);
mysqli_close($link);
?>
<p>
<a href="portal.html">Volver página principal</a>
</p>
</body>
</html>

