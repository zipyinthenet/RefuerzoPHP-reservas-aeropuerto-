<?php

// script de BAJA en php

// incluido script seguridad
require("seguridad.php");

// incluido script conectar
require("conectar.php");

if(isset($_POST['baja'])){

// declaramos variables
  $user = $_SESSION['user'];
  $dni=$_SESSION['dni'];

  $link = conectar();

  $sql="SELECT * from reserva where dni='$dni'";
  if(!($result=mysqli_query($link,$sql)))
    die('No se ha podido realizar la consulta' . mysqli_error($link));

  $row=mysqli_fetch_array($result);
  if(mysqli_num_rows($result)==0){
    $sql="delete from cliente where user='$user'";
    if(!mysqli_query($link,$sql))
      die(mysql_error($link));
    mysqli_close($link);
    header("Location:salir.php");
  }
  // si el resultado de row es 1 quiere decir que el usuario tiene reservas por que en reservas hay un campo con dni
  else
    echo '<h2 style="color:red">No se le puede dar de baja teniendo reservas efectuadas</h2>';
}
?>
<html>
<body>

<h3><i><span style="color:red">ATENCIÓN:</span> Pulsando aquí se dará de baja de Aeropuerto de Castellon</i></h3>
<form name="formulario_baja" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
<p><input type="submit" name="baja" value="Baja"></p>
</form>
<p><a href="main.php">Regresar a la aplicación</a></p>
</body>
</html>


