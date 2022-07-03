
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
        break;


    case "BORRAR":        
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
<body>
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
<div class="conFormularioAdmin">

<div class="card-administracion">
    
    <div class="card-header">
        Datos de boletos
    </div>
    
    <div class="card-body">
        
    <form method="POST" enctype="multipart/form-data" >
    <div class = "form-group">
    <label for="txtID">ID</label>
    <input type="text" required readonly  class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID">
    </div>

    <div class = "form-group">
    <label  for="txtDocumento">Documento Identidad</label>
    <input type="text" required class="form-control" value="<?php echo $txtDocumento; ?>" name="txtDocumento" id="txtDocumento" placeholder="Identificación">
    </div>

    <div class = "form-group">
    <label for="txtTren">Numero de tren</label>
    <input type="text" required class="form-control" value="<?php echo $txtTren; ?>" name="txtTren" id="txtTren" placeholder="Num Tren">
    </div>

    <div class = "form-group">
    <label for="txtFecha">Fecha de partida</label>
    <input type="date" required class="form-control" value="<?php echo $txtFecha; ?>" name="txtFecha" id="txtFecha" placeholder="Fecha">
    </div>

    <div class = "form-group">
    <label clas="txtHora" for="txtNombre">Hora de partida</label>
    <input type="time" required class="form-control" value="<?php echo $txtHora; ?>" name="txtHora" id="txtHora" placeholder="Hora">
    </div>

    <div class = "form-group">
    <label  for="txtNombre">Estado boleto</label>
    <select name="txtEstado" required class="form-control" value="<?php echo $txtEstado; ?>" id="txtEstado" placeholder="Estado">
        <option>Activo</option>
        <option>Espera</option>
        <option>Desactivado</option>
    </select>
    </div>

        <div class="btn-group" role="group" aria-label="">
            <button type="submit" name="accion" <?php echo ($accion=="Buscar")?"disabled":"";?> value="Agregar" class="btn-reservar">RESERVAR</button>
            <button type="submit" name="accion" <?php echo ($accion!="Buscar")?"disabled":"";?> value="Modificar" class="btn-modificar">MODIFICAR</button>
            <button type="submit" name="accion" <?php echo ($accion!="Buscar")?"disabled":"";?> value="Cancelar" class="btn-cancelar">CANCELAR</button>            
            <input type="submit" name="accion" value="BORRAR" class="btn-borrar"/>  
        </div>
    </form>
    </div>
</div>
</div>

</body>
</html>