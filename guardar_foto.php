<?php
/*
    Tomar una fotografía y guardarla en MySQL
    @date @date 2020-04-06
    @author parzibyte
    @web parzibyte.me/blog
*/

$imagenCodificada = file_get_contents("php://input"); //Obtener la imagen
if(strlen($imagenCodificada) <= 0) exit("No se recibió ninguna imagen");
//La imagen traerá al inicio data:image/png;base64, cosa que debemos remover

//Venía en base64 pero sólo la codificamos así para que viajara por la red, ahora la decodificamos y
//todo el contenido lo guardamos en un archivo
$imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));
$imagenDecodificada = base64_decode($imagenCodificadaLimpia);

include_once "bd.php";
$sentencia = $base_de_datos->prepare("INSERT INTO fotos(foto) VALUES(?)");
$sentencia->execute([$imagenCodificadaLimpia]);
$id = $base_de_datos->lastInsertId();

//Terminar y regresar el nombre de la foto
exit($id);
?>