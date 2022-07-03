<?php

session_start();
if($_POST){
    if(($_POST['usuario']=="sebas")&&($_POST['contrasenia']=="1002633624")){
        $_SESSION['usuario']="ok";
        $_SESSION['nombreUsuario']="sebas";
        header('Location:seccion/productos.php');
    }else{
        $mensaje="Error: El usuario y contraseña son incorrectos";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos.css">
    <title>ADMIN</title>
</head>
<body class="body-admin">
    <div class="imagen-admin">
        <a href="http://localhost/boleteria/index.php"><img id="logo-admin" src="../img/LOGO.png" alt=""></a>
    </div>
    <br><br><br>
    <div class="card-admin">
        <div class="card-header-admin">
            Login
        </div>
        <div class="card-body-admin">

            <?php if(isset($mensaje)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $mensaje; ?>
            </div>
            <?php } ?>
                <form method="POST">
                    <div class = "form-group">
                    <label>Usuario</label>
                    <input type="text" class="form-control-admin" name="usuario" placeholder="Ingrese tu Usuario">
                    </div>

                    <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" class="form-control-admin" name="contrasenia" placeholder="Ingrese tu contraseña">
                    </div>

                    <button type="submit" class="btn-admin">Ingresar</button>
                </form>
            </div>
        </div>
    </div>    
</body>
</html>