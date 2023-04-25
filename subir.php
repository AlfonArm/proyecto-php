<?php
if (isset($_POST["confirmar"])) { // pregunta: esta operación espera la confirmación del onsubmit? Se realiza el chequeo de JS?
	// carga la información luego de que se confirmen los datos	
    // no sé que es esto, pero creo que no es necesario:    $post_data = file_get_contents('php://input');
    // primero vamos a cargar los elementos de manera ordenada:
    $nombre = $_POST["nombre_juego"];
    $imagen = $_POST["imagen"];
    $tipo_imagen = ".jpg";
    $descripcion = $_POST["descripcion"];
    $url = $_POST["url_juego"];
    $id_genero = $_POST["genero_juego"];
    $id_plataforma = $_POST["plataforma"];
    // se carga un elemento con los datos de la subida ordenados para insertar en la BD
    require_once "conexionBD.php";
    mysqli_query($link_bd, "INSERT INTO `juegos`(`id`, `nombre`, `imagen`, `tipo_imagen`, `descripcion`, `url`, `id_genero`, `id_plataforma`)
    VALUES ('null','$nombre','$imagen','$tipo_imagen','$descripcion','$url','$id_genero','$id_plataforma')");
    session_start();
    $_SESSION["mostrar_nombre"] = $nombre;
}
header('Location: index.php'); // va a index, donde dice que se ha subido el elemento
?>
