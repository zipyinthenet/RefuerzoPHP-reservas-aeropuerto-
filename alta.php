<?php
// esto es alta en php 
 // llama al script conectar y si existe error , se para
 require("conectar.php");

$dni='';
$nombre ='';
$apellidos ='';
$user = '';

if($_SERVER['REQUEST_METHOD']=='POST'){   //if(isset ($_POST['Registrar']) ----> esto es igual a request method de server
  $dni = trim(htmlspecialchars( $_POST['dni'])); //prim elimina espacio blanco y htmlspecialchars no deja ejecutar codigo como llaves 
  $nombre =trim(htmlspecialchars( $_POST['nombre']));
  $apellidos =trim(htmlspecialchars( $_POST['apellidos']));
  $user =trim(htmlspecialchars( $_POST['user']));
  $password = $_POST['password'];
  $password2 = $_POST['password2'];


// ponemos la variable validacionOk a true antes de utilizarla
  $validacionOk = true;


//-----------------------------------------------------------------------------------------------------------
// si NO esta vacio , es decir , si contiene algo (es por que no esta vacio),entonces pasara al siguiente if 
  if(!empty($dni) && !empty($nombre) && !empty($user) && !empty($apellidos) && !empty($password)) {
	// si las contraseñas no coinciden, muestra por pantalla mensaje
    if($password != $password2){
      $errores[] = 'Las contraseñas no coinciden';
      $validacionOk = false;
    }
  }
// si esta VACIO , entonces saca el siguiente mensaje  
  else {
    $errores[] = 'Alguno de los campos requeridos está vacío';
    $validacionOk = false;
  }


  if($validacionOk){

    $link = conectar();

    $sql="select * from cliente where user='$user' and dni='$dni'";
    if(!($result=mysqli_query($link,$sql)))
      die(mysqli_error($link));
  
    if(mysqli_num_rows($result)==0){
      $sql="insert into cliente values ('$dni','$nombre','$apellidos', '$user', '$password')";
      if(!mysqli_query($link,$sql))
        die(mysqli_error($link));
      mysqli_free_result($result);
      mysqli_close($link);
      header("Location:portal.html");
      exit();
    }
    // en caso de no ser 0 la ejecucion sql , es por que si que existe algun campo como dni o usuario
    else{
      echo '<h2><font color="red">El usuario ya existe</font></h2>';
      echo '<p><a href="portal.html">Volver al portal</a></p>';
      mysqli_free_result($result);
      mysqli_close($link);
    }
  
  }
  else
    foreach($errores as $error)
      echo "<p style=\"color:red\">$error</p>";
}

require('alta.view.php');
?>
