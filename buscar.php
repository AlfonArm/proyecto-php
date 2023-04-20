<?php
require_once ("conexionBD.php");
if (isset($_POST["buscar"])) { // recibo la notificación post. Puedo ver qué datos me mandaron. Para el caso, voy a separarlos en partes más cómodas
    $nombre = $_POST["nombre"];
    $genero = $_POST["genero"];
    $plataforma = $_POST["plataforma"];
    $datos = cargar_lista_completa(); // carga todos los juegos
    $aux = array ();
    if (($nombre != null) || ($nombre != "")) {
        foreach ($datos as $dato) {
            if (strpos($dato["nombre"], $nombre)) {
                array_push ($aux, $dato);
            } else {
                if (strpos($dato["descripcion"], $nombre)) { // se fija también si fue mencionado en la descripción
                    array_push ($aux, $dato);
                }
            }
        }
        $datos = $aux;
        $aux = array ();
    } 
    if ($genero != 1) {
        foreach ($datos as $dato) {
            if ($dato["id_genero"] == $genero) {
                array_push ($aux, $dato);
            }
        }
        $datos = $aux;
        $aux = array ();
    }
    if ($plataforma != 1) {
        foreach ($datos as $dato) {
            if ($dato["id_plataforma"] == $plataforma) {
                array_push ($aux, $dato);
            }
        }
        $datos = $aux;
        $aux = array ();
    }
    array_multisort(array_column($datos, 'nombre'), SORT_ASC, $datos); // supuestamente esto ordena los datos por nombre. Comprobar
    /*
    y acá terminé de filtrar los datos, almacenados en $datos
    y este es el momento en el que le pido el favor a chat-gpt

    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded', // que alguien me explique esto porfavor
            'content' => http_build_query($datos)
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

    No funciona
    plan para probar cómo funciona la recepción de datos

    */
}

?>
<!--
<html>
    <form action="index.php" method="POST">
        <?php //echo "<button name='datos' value = 'Subir'/>"?>
    </form>
</html>

Formulario de prueba para ver cómo se enviaban los datos
