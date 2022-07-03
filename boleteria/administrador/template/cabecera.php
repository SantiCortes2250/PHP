<?php 

session_start();
if(!isset($_SESSION['usuario'])){
  header("Location:../index.php");
}else{
  if($_SESSION['usuario']="ok"){
    $nombreUsuario=$_SESSION["nombreUsuario"];
  }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../../css/estilos.css">
  </head>
  <body>
    <?php $url="http://".$_SERVER['HTTP_HOST']."/boleteria" ?>
    <nav class="navegacion-administrador">
      <a class="nav-persona" href="<?php echo $url; ?>"><?php echo $nombreUsuario ?></a>
      <a class="nav-cerrar" href="<?php echo $url;?>/administrador/seccion/cerrar.php">Cerrar</a>
      <a class="nav-boletos" href="<?php echo $url;?>/administrador/seccion/productos.php">Boletos</a>
      <a class="nav-listaBoletos" href="<?php echo $url;?>/administrador/seccion/BoletosRegistrados.php">Listas de Boletos</a>
      <a href="http://localhost/boleteria/index.php"><img id="logo-administrador" src="../../img/LOGO.png" alt=""></a>
    </nav>