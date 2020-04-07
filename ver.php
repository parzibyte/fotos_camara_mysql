<?php
include_once "bd.php";
$id = $_GET["id"];
if (empty($id)) {
    exit("No existe el parámetro id en la URL");
}

$sentencia = $base_de_datos->prepare("SELECT foto FROM fotos WHERE id = ?");
$sentencia->execute([$id]);
$foto = $sentencia->fetchObject();
if (!$foto) {
    exit("No hay foto con ese ID");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver foto</title>
</head>
<body>
    <h1>Foto:</h1>
    <img src="data:image/png;base64,<?php echo $foto->foto; ?>">
</body>
</html>