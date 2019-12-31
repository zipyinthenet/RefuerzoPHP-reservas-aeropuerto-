<?php
 // esto es COMPROBAR en php
 
// si existe o se ha pulsado entrar(desde portal) guarda en la variables user y pass lo que se ha introducido en los campos usuario y password desde portal
if(isset($_POST['entrar'])){
 $user = $_POST['user'];
 $pass = $_POST['pass'];

 // llama al script conectar y si existe error , se para
 require("conectar.php");

 // guarda en variable link la funcion conectar
 $link = conectar();

 // guarda en una variable la consulta a la tabla cliente con el usuario y password introducido
 $sql="select * from cliente where user='$user' and password='$pass'";

 // guarda en variable resul la EJECUCION de la SENTENCIA SQL (consulta sql) con variable link (conectar) y sql (consulta sql) y si no muere
 if(!($resul=mysqli_query($link,$sql)))
   die(mysqli_error($link).'---> '.$sql);

 // devuelve el num de filas y si es igual a 1 , entonces guarda en una variable row , un vector con los resultados obtenidos
 if(mysqli_num_rows($resul) == 1){
   $row=mysqli_fetch_array($resul);

// llamada de retorno read para recuperar cualquier informacion de sesion existente
// usada para rellenar automaticamente variable superglobal $_SESSION 
   session_start();
   $_SESSION['clave']='entrar';
   $_SESSION['user']=$user;
   $_SESSION['dni']=$row['dni'];
   $_SESSION['nombre']=$row['nombre'];
   $_SESSION['apellidos']=$row['apellidos'];
   
   // liberar espacio ocupado por los resultados obtenidos de la memoria  
   mysqli_free_result($resul);

   // cerrar la conexion con el servidor de la base de datos MySQL
   mysqli_close($link);

   // te lleva a MAIN en php
   header("Location:main.php");
 }
 // cuando NO devuelve el mismo numero de filas hace lo siguiente
 else{
    // libera de la memoria y cierra conexion con la base de datos y te lleva a ERROR en html 
    mysqli_free_result($resul);
    mysqli_close($link);
    header("Location:error.html");
    // cuando acaba SI NO devuelve filas
    }
// cuando acaba si existe
}
// cuando NO existe hace lo siguiente , te lleva a PORTAL en html
else
  header("Location:portal.html");

?>
