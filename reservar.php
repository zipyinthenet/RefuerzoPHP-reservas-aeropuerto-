<?php 

// incluido script seguridad
require("seguridad.php");
  
// incluido script conectar  
require("conectar.php");

?>

<head>
<title>Reserva de vuelos</title>
</head>

<body>

<?php

// declaramos variables
$nombre='';
$destino='';
$claseText='';
$res=$equip=$seg='';
$plazas_solic=0; //plazas solicitadas =0 ??
$env_text_uno=$env_text_dos=$env_text_tres='';

if(isset($_POST['enviar'])){

  $nombre=$_POST['nombre'];
  $destino=$_POST['destino'];
  $clase=$_POST['clase'];
  $plazas_solic=$_POST['num'];
  $dni=$_SESSION['dni'];

    $precio_extra=0;
  if(isset($_POST['opciones'])){
    $opciones=$_POST['opciones'];
    foreach($opciones as $opc){
      if($opc=='R'){
        $env_text_uno='Si';
	$res='1';
      }
      elseif($opc=='E'){
        $env_text_dos='Si';
	$equip='1';
      }
      elseif($opc=='S'){
        $env_text_tres='Si';
	$seg='1';
      }
      $precio_extra=$precio_extra+20;
    }
  }


    if($clase=='T'){
      $claseText='Turista';
      $cargo='0';
    }
    else{
      $claseText='Bussiness';
      $cargo='20';
    }
//Fin de if(isset...)
}

//Aquí colocamos el formulario. De este modo los mensajes de la compra salen debajo

require("reservar.view.php");


//Otra forma de que se ejecute el código cuando se ha enviado el formulario
if($_SERVER['REQUEST_METHOD']=='POST'){

    $link = conectar();
    
    $sql="SELECT codigo,destino,precio,plazas_libres from vuelos where destino='$destino'";
    if(!($result=mysqli_query($link,$sql)))
      die('No se ha podido realizar la consulta 1' . mysqli_error($link));
    
    $row=mysqli_fetch_array($result);
    $destino_tabla=$row['destino'];
    $plazas_libres=$row['plazas_libres']; 
    $codigo_tabla_vuelo=$row['codigo'];
    $precio=$row['precio'];

    $sql = "SELECT dni,codigo,clase,reserva,equipaje,seguro,num_plazas from reserva where dni='$dni' and codigo='$codigo_tabla_vuelo'";
    if(!($result=mysqli_query($link,$sql)))
      die('No se ha podido realizar la consulta 2' . mysqli_error($link));
    $row=mysqli_fetch_array($result);
    $codigo_tabla_reserva=$row['codigo'];
     
    if($codigo_tabla_reserva!=$codigo_tabla_vuelo){
	    
      if($destino==$destino_tabla && $plazas_solic<=$plazas_libres){
      
      $sql = "INSERT INTO reserva (dni, codigo, clase, reserva, equipaje, seguro, num_plazas) VALUES ('$dni', '$codigo_tabla_vuelo', '$claseText', '$res', '$equip', '$seg', '$plazas_solic')";
        if (!mysqli_query($link,$sql))
          die('No se ha podido realizar la consulta 3 '. mysqli_error($link));
      
      $plazas_libres=$plazas_libres-$plazas_solic;    
      $sql = "UPDATE vuelos SET plazas_libres='$plazas_libres' WHERE codigo='$codigo_tabla_vuelo'";
      if (!mysqli_query($link,$sql))
        die('No se ha podido realizar la consulta 4' . mysqli_error($link));
      echo '<h2><font color="green">Reserva realizada correctamente</font></h2>';
      
        if($clase=='T'){
        $preciofinal=$precio*$plazas_solic + $precio_extra;
        echo '<table border="1" align="center">'; 
        echo '<tr><td style="text-align:center">DNI</td><td style="text-align:center">Codigo</td><td style="text-align:center">Clase</td><td style="text-align:center">Reserva</td><td style="text-align:center">Equipaje</td><td style="text-align:center">Seguro</td><td style="text-align:center">Numero Plazas Solicitadas</td><td style="text-align:center">Precio</td></tr>';
        echo '<tr><td style="text-align:center">'.$dni.'</td><td style="text-align:center">'.$codigo_tabla_vuelo.'</td><td style="text-align:center">'.$claseText.'</td><td style="text-align:center">'.$env_text_uno.'</td><td style="text-align:center">'.$env_text_dos.'</td><td style="text-align:center">'.$env_text_tres.'</td><td style="text-align:center">'.$plazas_solic.'</td><td style="text-align:center">'.$preciofinal.'</td></tr>';
        echo '</table>';
        }
        else{ 
        $cientoporciento='100';
        $precio_cargo=$precio*$cargo/$cientoporciento;
        $precio_cargo_con_plazas=$precio_cargo*$plazas_solic;
        $preciofinal=$precio*$plazas_solic + $precio_extra + $precio_cargo_con_plazas;
        echo '<table border="1" align="center">'; 
        echo '<tr><td style="text-align:center">DNI</td><td style="text-align:center">Codigo</td><td style="text-align:center">Clase</td><td style="text-align:center">Reserva</td><td style="text-align:center">Equipaje</td><td style="text-align:center">Seguro</td><td style="text-align:center">Numero Plazas Solicitadas</td><td style="text-align:center">Precio</td></tr>';
        echo '<tr><td style="text-align:center">'.$dni.'</td><td style="text-align:center">'.$codigo_tabla_vuelo.'</td><td style="text-align:center">'.$claseText.'</td><td style="text-align:center">'.$env_text_uno.'</td><td style="text-align:center">'.$env_text_dos.'</td><td style="text-align:center">'.$env_text_tres.'</td><td style="text-align:center">'.$plazas_solic.'</td><td style="text-align:center">'.$preciofinal.'</td></tr>';
        echo '</table>';
        }
      }
      else{  
      echo '<h2><font color="green">No se puede realizar la Reserva , no quedan plazas suficientes.</font></h2>';
      echo '<h2><font color="black">Plazas libres: '.$plazas_libres.'</font></h2>';
      }    
    }
    else{
    echo '<h2><font color="green">No se puede realizar la Reserva en destino: '.$destino_tabla.' , destino ya reservado.</font></h2>';
    
    }
}    
    mysqli_free_result($result);
    mysqli_close($link);

?>

<a href="main.php">Volver a Principal</a>

</body>
</html>
