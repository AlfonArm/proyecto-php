<?php

// El archivo debe llamarse proyecto_php

error_reporting(E_ALL);
ini_set ("display_errors", true);
// el $access no funcionó, parece. Vuelvo a los cambios anteriores

// FUNCIONA BIEN
// recibe el total de datos y selecciona el apartado que le digas (juegos por default)
function select_datos ($link, $seccion = 'juegos') {
	$query = mysqli_query($link, "SELECT * FROM $seccion"); // de link tomo todos los query, que cargados modularmente serían options
	if ($query) { 
		return $query; // mejor lo saco y afuera hago lo que quiera. No se me debe olvidar poner el mysqli_free_result($query);
	} else { // sino
    	die('Query Invalido: ' . mysqli_error() . '\n'); // dice que el query está inválido porque probablemente esté vacío
	}
}

// FUNCIONA BIEN
// carga todos los datos. El nombre de la función es confuso, pero se llama así porque esos datos (completos) los usaré para cargar los datos de búsqueda del header
function cargar_barras_de_busqueda_header () {
	$link = mysqli_connect ('localhost', 'root', '', 'proyecto_php') // carga el proyecto_php
	or die ('Error'. mysqli_error ($link)); // o dice el error si lo hay
	if ($link) {
		return $link;
	}
}

// Creo que funciona bien
// carga la lista completa de elementos, creando $link (con todos los archivos) y seleccionando los datos de los juegos
function cargar_lista_completa () {
	$link = mysqli_connect ('localhost', 'root', '', 'proyecto_php') // carga el proyecto_php
	or die ('Error'. mysqli_error ($link)); // o dice el error si lo hay
	return select_datos ($link);
}

// Nunca se usó. Se puede borrar si después lo vemos inutil
function insert() {
	$link = mysqli_connect ('localhost', 'root', '', 'proyecto_php') // carga el proyecto_php
	or die("Error " . mysqli_error($link)); // o dice el error si lo hay
	mysqli_query($link, "INSERT INTO juegos VALUES ('valor')"); // insertar dato. En este caso sólo me va a interesar usar este módulo para insertar juegos, si total los generos y plataformas los pongo yo
	printf("Id del registro creado %d\n", mysqli_insert_id($link));
	// valor debería ser la variable de los datos recopilados post-formulario.
}
?>
