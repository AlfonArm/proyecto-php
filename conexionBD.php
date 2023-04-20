<?php
error_reporting(E_ALL);
ini_set ("display_errors", true);

// FUNCIONA BIEN
function select_datos ($link, $seccion = 'juegos') {
	$query = mysqli_query($link, "SELECT * FROM $seccion"); // de link tomo todos los query, que cargados modularmente serían options
	if ($query) { 
		return $query; // mejor lo saco y afuera hago lo que quiera. No se me debe olvidar poner el mysqli_free_result($query);
	} else { // sino
    	die('Query Invalido: ' . mysqli_error() . '\n'); // dice que el query está inválido porque probablemente esté vacío
	}
}

// FUNCIONA BIEN
function cargar_barras_de_busqueda_header () {
	$link = mysqli_connect ('localhost', 'root', '', 'proyecto_php') // carga el proyecto_php
	or die ('Error'. mysqli_error ($link)); // o dice el error si lo hay
	if ($link) {
		return $link;
	}
}

// PASARON COSAS (?)
function cargar_lista_completa () {
	$link = mysqli_connect ('localhost', 'root', '', 'proyecto_php') // carga el proyecto_php
	or die ('Error'. mysqli_error ($link)); // o dice el error si lo hay
	return select_datos ($link);
}

// NO COMPROBADO
function insert() {
	$link = mysqli_connect ('localhost', 'root', '', 'proyecto_php') // carga el proyecto_php
	or die("Error " . mysqli_error($link)); // o dice el error si lo hay
	mysqli_query($link, "INSERT INTO juegos VALUES ('valor')"); // insertar dato. En este caso sólo me va a interesar usar este módulo para insertar juegos, si total los generos y plataformas los pongo yo
	printf("Id del registro creado %d\n", mysqli_insert_id($link));
	// valor debería ser la variable de los datos recopilados post-formulario.
}
?>