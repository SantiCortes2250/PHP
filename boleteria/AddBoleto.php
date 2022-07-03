

<?php
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtDocumento=(isset($_POST['txtDocumento']))?$_POST['txtDocumento']:"";
$txtTren=(isset($_POST['txtTren']))?$_POST['txtTren']:"";
$txtFecha=(isset($_POST['txtFecha']))?$_POST['txtFecha']:"";
$txtHora=(isset($_POST['txtHora']))?$_POST['txtHora']:"";
$txtSilla=(isset($_POST['txtSilla']))?$_POST['txtSilla']:"";
$txtEstado=(isset($_POST['txtEstado']))?$_POST['txtEstado']:"";


$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("administrador/config/bd.php");
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
        header("Location:AddBoleto.php");
        break;

}
$sentanciaSQL=$conexion->prepare("SELECT * FROM boletos");
$sentanciaSQL->execute();
$listaLibros=$sentanciaSQL->fetchAll(PDO::FETCH_ASSOC);



?>
<body id="fondo">
    <div class="contUno">
    <img id="logo" src="img/LOGO.png" alt="">
    </div>

<div class="contDos">
    <div class="con2_2">
        <?php include("template/cabecera.php"); ?>
    </div>

    <div class="con2_3ForAdd">
        <div class="cardFor">
            <div class="card-header">
                Datos de boletos
            </div>
            
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" >
                    <div class = "form-group">
                        <label for="txtNombre">Documento Identidad</label>
                        <input type="text" required class="form-control" value="<?php echo $txtDocumento; ?>" name="txtDocumento" id="txtDocumento" placeholder="Identificación">
                    </div>

                    <div class = "form-group">
                        <label for="txtNombre">Numero de tren</label>
                        <input type="text" required class="form-control" value="<?php echo $txtTren; ?>" name="txtTren" id="txtTren" placeholder="Num Tren">
                    </div>

                    <div class = "form-group">
                        <label for="txtNombre">Fecha de partida</label>
                        <input type="date" required class="form-control" value="<?php echo $txtFecha; ?>" name="txtFecha" id="txtFecha" placeholder="Fecha">
                    </div>

                    <div class = "form-group">
                        <label for="txtNombre">Hora de partida</label>
                        <input type="time" required class="form-control" value="<?php echo $txtHora; ?>" name="txtHora" id="txtHora" placeholder="Hora">
                    </div>

                    <div class = "form-group">
                        <label for="txtNombre">Estado boleto</label>
                        <select name="txtEstado" required class="form-control" value="<?php echo $txtEstado; ?>" id="txtEstado" placeholder="Estado">
                            <option>Activo</option>
                            <option>En espera</option>
                            <option>Desactivado</option>
                        </select>
                    </div>

                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":"";?> value="Agregar" class="btnbotonAdd">RESERVAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>
    
</body>


<?php include("template/pie.php"); ?>