<?php
require_once ("conexionBD.php");
if (isset($_POST["buscar"])) { // recibo la notificación post. Puedo ver qué datos me mandaron. Para el caso, voy a separarlos en partes más cómodas
    $nombre = $_POST["nombre"];
    $genero = $_POST["genero"];
    $plataforma = $_POST["plataforma"];
    $datos = cargar_lista_completa(); // carga todos los juegos
    $aux = array ();
    if (($nombre != null) || ($nombre != "")) {
        foreach ($dato as $datos) {
            if (strpos($dato["nombre"], $nombre)) {
                array_push ($aux, $dato);
            }
        }
        $datos = $aux;
        $aux = array ();
    } 
    if ($genero != 1) {
        foreach ($dato as $datos) {
            if ($dato["id_genero"] == $genero) {
                array_push ($aux, $dato);
            }
        }
        $datos = $aux;
        $aux = array ();
    }
    if ($plataforma != 1) {
        foreach ($dato as $datos) {
            if ($dato["id_plataforma"] == $plataforma) {
                array_push ($aux, $dato);
            }
        }
        $datos = $aux;
        $aux = array ();
    }
    // y acá terminé de filtrar los datos, almacenados en $datos
    // y este es el momento en el que le pido el favor a chat-gpt
    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => http_build_query(array('datos' => $datos))
        )
    );
    $context = stream_context_create($options);
    $resultado = file_get_contents('index.php', false, $context);
    
    // Verifica si la solicitud fue exitosa y haz algo con la respuesta
    if ($resultado !== false) {
        require_once("index.php");
    } else {
        echo "Ocurrió un error al enviar los datos.";
    }
    // y acá hice una solicitud a index. Esta, de ser null, cargaría todos los juegos
}