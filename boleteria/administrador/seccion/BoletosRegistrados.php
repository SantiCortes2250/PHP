

<?php
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtDocumento=(isset($_POST['txtDocumento']))?$_POST['txtDocumento']:"";
$txtTren=(isset($_POST['txtTren']))?$_POST['txtTren']:"";
$txtFecha=(isset($_POST['txtFecha']))?$_POST['txtFecha']:"";
$txtHora=(isset($_POST['txtHora']))?$_POST['txtHora']:"";
$txtSilla=(isset($_POST['txtSilla']))?$_POST['txtSilla']:"";
$txtEstado=(isset($_POST['txtEstado']))?$_POST['txtEstado']:"";

$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../config/bd.php");

switch($accion){
    case "Agregar":

        $sentanciaSQL=$conexion->prepare("INSERT INTO boletos (docPasajeros, numTren, fecha, hora, silla, estado ) VALUES (:docPasajeros, :numTren, :fecha, :hora, :silla, :estado);");
        $sentanciaSQL->bindParam(':docPasajeros', $txtDocumento);
        $sentanciaSQL->bindParam(':numTren', $txtTren);
        $sentanciaSQL->bindParam(':fecha', $txtFecha);
        $sentanciaSQL->bindParam(':hora', $txtHora);
        $sentanciaSQL->bindParam(':silla', $txtSilla);
        $sentanciaSQL->bindParam(':estado', $txtEstado);

        $sentanciaSQL->execute();
        header("Location:productos.php");
        break;

    case "Modificar":
        $sentanciaSQL=$conexion->prepare("UPDATE boletos SET docPasajeros=:docPasajeros, numTren=:numTren, fecha=:fecha, hora=:hora, silla=:silla, estado=:estado WHERE id=:id");
        $sentanciaSQL->bindParam(':docPasajeros', $txtDocumento);
        $sentanciaSQL->bindParam(':numTren', $txtTren);
        $sentanciaSQL->bindParam(':fecha', $txtFecha);
        $sentanciaSQL->bindParam(':hora', $txtHora);
        $sentanciaSQL->bindParam(':silla', $txtSilla);
        $sentanciaSQL->bindParam(':estado', $txtEstado);
        $sentanciaSQL->bindParam(':id', $txtID);
        $sentanciaSQL->execute();
        header("Location:productos.php");        
        break;

    case "Cancelar":
        header("Location:productos.php");
        break;
    case "Buscar":
        //echo "Precionado botón Selccionar";
        $sentanciaSQL=$conexion->prepare("SELECT * FROM boletos WHERE id=:id");
        $sentanciaSQL->bindParam(':id', $txtID);
        $sentanciaSQL->execute();
        $boletos=$sentanciaSQL->fetch(PDO::FETCH_LAZY);

        $txtDocumento=$boletos['docPasajeros'];
        $txtTren=$boletos['numTren'];
        $txtFecha=$boletos['fecha'];
        $txtHora=$boletos['hora'];
        $txtSilla=$boletos['silla'];
        $txtEstado=$boletos['estado'];
        break;

    case "Seleccionar":
        //echo "Precionado botón Selccionar";
        $sentanciaSQL=$conexion->prepare("SELECT * FROM boletos WHERE id=:id");
        $sentanciaSQL->bindParam(':id', $txtID);
        $sentanciaSQL->execute();
        $boletos=$sentanciaSQL->fetch(PDO::FETCH_LAZY);

        $txtDocumento=$boletos['docPasajeros'];
        $txtTren=$boletos['numTren'];
        $txtFecha=$boletos['fecha'];
        $txtHora=$boletos['hora'];
        $txtSilla=$boletos['silla'];
        $txtEstado=$boletos['estado'];        
        header("Location:productos.php");
        break;


    case "Borrar":        
        $sentanciaSQL=$conexion->prepare("DELETE FROM boletos WHERE id=:id");
        $sentanciaSQL->bindParam(':id', $txtID);
        $sentanciaSQL->execute();
        header("Location:productos.php");
        break;
}

$sentanciaSQL=$conexion->prepare("SELECT * FROM boletos");
$sentanciaSQL->execute();
$listaBoletos=$sentanciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentanciaSQL=$conexion->prepare("SELECT * FROM boletos WHERE estado='Espera'");
$sentanciaSQL->execute();
$EsperaLista=$sentanciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body class="fondoAdministrador">
    <div>
    <?php include("../template/cabecera.php"); ?>
    </div>
    <div class="conBusqueda" >
        <form method="post">
            <input type="number" name="txtID" id="inputBuscar" value="<?php echo $boletos['id'] ?>" placeholder="Buscar"/>
            <input type="submit" name="accion" value="Buscar" class="btn-buscar"/>        
        </form>
    </div>
    <br>
    <div class="conTablas">
    <h1 id="espera">LISTA DE BOLETOS</h1>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Doc Pasajeros</th>
                        <th>Num Tren</th>
                        <th>Fecha (aaaa/mm/dd)</th>
                        <th>Hora</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listaBoletos as $boletos) { ?> 
                    <tr>
                        <td><?php echo $boletos['id'] ?></td>
                        <td><?php echo $boletos['docPasajeros'] ?></td>
                        <td><?php echo $boletos['numTren'] ?></td>
                        <td><?php echo $boletos['fecha'] ?></td>
                        <td><?php echo $boletos['hora'] ?></td>
                        <td><?php echo $boletos['silla'] ?></td>
                        <td><?php echo $boletos['estado'] ?></td>
                        <td>

                        <form method="post">

                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $boletos['id'] ?>"/>            
                            <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>            
                        
                        </form>

                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        </div>

        <h1 id="espera">LISTA DE ESPERA</h1>
        <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-12">

            <table class="table table-bordered">
                <thead id="espera">
                </thead>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Doc Pasajeros</th>
                        <th>Num Tren</th>
                        <th>Fecha (aaaa/mm/dd)</th>
                        <th>Hora</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($EsperaLista as $boletos) { ?> 
                    <tr>
                        <td><?php echo $boletos['id'] ?></td>
                        <td><?php echo $boletos['docPasajeros'] ?></td>
                        <td><?php echo $boletos['numTren'] ?></td>
                        <td><?php echo $boletos['fecha'] ?></td>
                        <td><?php echo $boletos['hora'] ?></td>
                        <td><?php echo $boletos['silla'] ?></td>
                        <td><?php echo $boletos['estado'] ?></td>
                        <td>

                        <form method="post">

                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $boletos['id'] ?>"/>
                            <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>            
                        
                        </form>

                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        </div>
        </div>
    </div>
    

</body>
</html>
