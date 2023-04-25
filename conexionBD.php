<?php
require_once ("constants.php");

$host_name = Constants::HOST_NAME;
$user_name = Constants::USER_NAME;
$password = Constants::PASSWORD;
$data_base = Constants::DATA_BASE;
$link_bd = mysqli_connect ($host_name, $user_name , $password, $data_base) or die ('Error'. mysqli_error ($link_bd));
function getByIdGenero ($id){
	$query="SELECT * FROM generos WHERE ID = ". $id;
	$result = mysqli_query($GLOBALS['link_bd'], $query);
	if ($result)
		return mysqli_fetch_assoc($result);
	else
		die('Query Invalido: ' . mysqli_error() . '\n');
}
function getByIdPlataforma ($id){
	$query="SELECT * FROM plataformas WHERE ID = ". $id;
	$result = mysqli_query($GLOBALS['link_bd'], $query);
	if ($result)
		return mysqli_fetch_assoc($result);
	else
		die('Query Invalido: ' . mysqli_error() . '\n');
}
function getByNombreAndGeneroAndPlataformaOrderByNombre($nombre, $genero, $plataforma){
	$query="SELECT * FROM juegos j JOIN generos g ON j.id_genero = g.id JOIN plataformas p ON j.id_plataforma = p.id ";
	$query_where="WHERE j.nombre like '%".$nombre."%' AND g.id = ".$genero." AND p.id = ".$plataforma;
	if (empty($nombre))
		$query_where="WHERE j.nombre = '' AND g.id = ".$genero." AND p.id = ".$plataforma;
	$query_order=" ORDER BY j.nombre";
	$result = mysqli_query($GLOBALS['link_bd'], $query.$query_where.$query_order);
	if ($result)
        return $result;
	else
		die('Query Invalido: ' . mysqli_error() . '\n');
	return null;
}

function select_datos ($link, $seccion = 'juegos') {
	$query = mysqli_query($link, "SELECT * FROM $seccion");
	if ($query)
		return $query; // mejor lo saco y afuera hago lo que quiera. No se me debe olvidar poner el mysqli_free_result($query);
	else
    	die('Query Invalido: ' . mysqli_error() . '\n');
}
function updateHeader () {
	if ($GLOBALS['link_bd']) return $GLOBALS['link_bd'];
}

// Creo que funciona bien
// carga la lista completa de elementos, creando $link (con todos los archivos) y seleccionando los datos de los juegos
function cargar_lista_completa () {
	return select_datos ($GLOBALS['link_bd']);
}

// Nunca se usó. Se puede borrar si después lo vemos inutil
function insert() {
	$link = mysqli_connect ('localhost', 'root', 'root', 'juegos_online') // carga el proyecto_php
	or die("Error " . mysqli_error($link)); // o dice el error si lo hay
	mysqli_query($link, "INSERT INTO juegos VALUES ('valor')"); // insertar dato. En este caso sólo me va a interesar usar este módulo para insertar juegos, si total los generos y plataformas los pongo yo
	printf("Id del registro creado %d\n", mysqli_insert_id($link));
	// valor debería ser la variable de los datos recopilados post-formulario.
}

// RESUMEN: comprueba si faltan géneros y plataformas. La página funciona de forma deficiente sin estos módulos, por lo que se debe priorizar su carga.
function emptyEntity () {
	$gen = "SELECT * FROM generos";
	$result = mysqli_query($GLOBALS['link_bd'], $gen);
	require_once (cargar_datos.php);
	if (!mysqli_num_rows($gen)) {
		cargar_generos($GLOBALS['link_bd']);
	}
	$plat = "SELECT * FROM plataformas";
	$result = mysqli_query($GLOBALS['link_bd'], $plat);
	if (!mysqli_num_rows($plat)) {
		cargar_plataformas($GLOBALS['link_bd']);
	}	
}
?>