<?php
require_once ("constants.php");

$host_name = Constants::HOST_NAME;
$user_name = Constants::USER_NAME;
$password = Constants::PASSWORD;
$data_base = Constants::DATA_BASE;
$connect_bd = mysqli_connect ($host_name, $user_name , $password, $data_base);
$link_bd = mysqli_connect ($host_name, $user_name , $password, $data_base) or die ('Error'. mysqli_error ($link_bd));
function select_datos ($link, $seccion = 'juegos') {
	$query = mysqli_query($link, "SELECT * FROM $seccion"); // de link tomo todos los query, que cargados modularmente serían options
	if ($query) { 
		return $query; // mejor lo saco y afuera hago lo que quiera. No se me debe olvidar poner el mysqli_free_result($query);
	} else { // sino
    	die('Query Invalido: ' . mysqli_error() . '\n'); // dice que el query está inválido porque probablemente esté vacío
	}
}
function cargar_barras_de_busqueda_header () {
	if ($GLOBALS['connect_bd']) return $GLOBALS['connect_bd'];
}

// Creo que funciona bien
// carga la lista completa de elementos, creando $link (con todos los archivos) y seleccionando los datos de los juegos
function cargar_lista_completa () {
	return select_datos ($GLOBALS['connect_bd']);
}

// Nunca se usó. Se puede borrar si después lo vemos inutil
function insert() {
	$link = mysqli_connect ('localhost', 'root', 'root', 'juegos_online') // carga el proyecto_php
	or die("Error " . mysqli_error($link)); // o dice el error si lo hay
	mysqli_query($link, "INSERT INTO juegos VALUES ('valor')"); // insertar dato. En este caso sólo me va a interesar usar este módulo para insertar juegos, si total los generos y plataformas los pongo yo
	printf("Id del registro creado %d\n", mysqli_insert_id($link));
	// valor debería ser la variable de los datos recopilados post-formulario.
}
?>
