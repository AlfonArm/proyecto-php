<?php
	require_once ("conexionBD.php");
	$link = updateHeader();

    if (isset($_GET["buscar"])) { // si hay solicitud, la acepta
	    // al parecer no es necesario limpiar $lista porque el cambio de instancia lo limpia por sí solo
        $nombre = $_GET["nombre"];
        $genero = $_GET["genero"];
        $plataforma = $_GET["plataforma"];

        $lista = getByNombreAndGeneroAndPlataformaOrderByNombre($nombre, $genero, $plataforma);
    } else
        $lista = cargar_lista_completa();

    $generos = select_datos ($link, "generos");
	$plataformas = select_datos ($link, "plataformas");
?>
<html>
    <head>
        <link href="css/estilos.css" rel="stylesheet" type="text/css"/>
        <title>Gamepedia - inicio</title>
        <script>
            /*
            nombre_ventana = document.getElementById("ventana_confirmacion_juego");
            if ((nombre_ventana != null) || (nombre_ventana != "")) {
                // mostrar una ventana flotante
            }
            */
        </script>
    </head>
    <body>
        <?php include_once 'header.php'; ?>
        <div class = "lista">
        <?php
            if (isset($_SESSION["mostrar_nombre"])) { // nop, no lo acepta
                require("subir.php");
                $nuevo_juego = $_SESSION["mostrar_nombre"];
                echo "<p id = 'ventana_confirmacion_juego'>$nuevo_juego</p>";
                // acá estaría bueno poner que se quede un par de segundos
                unset($_SESSION["mostrar_nombre"]);
            }
            if ($lista) {
                while ($juego=mysqli_fetch_array($lista)){
                    $juego_nombre = $juego["nombre"];
                    $juego_imagen = $juego["tipo_imagen"]; // esto también hay que revisarlo. Ver preguntas
                    $juego_desc = $juego["descripcion"];
                    $juego_url = $juego["url"];
                    $genero_filtrado = getByIdGenero ($juego["id_genero"]);
                    $juego_genero = $genero_filtrado["nombre"];
                    $plataforma_filtrado = getByIdPlataforma ($juego["id_plataforma"]);
                    $juego_plataforma = $plataforma_filtrado["nombre"];
                    echo
                    "<div class = 'bloque_info' id = 'agregar_juego'>
                        <img src = '$juego_imagen' class = 'reducir_img'/>
                        <div class = 'info_right'>
                            <p>$juego_nombre</p>
                            <p>$juego_desc</p>
                            <p>Género: $juego_genero</p>
                            <p>Plataforma: $juego_plataforma</p>
                            <p>Página web: $juego_url</p>
                        </div>
                     </div>";
                }
            } else {
                echo
                "<div class = 'bloque_info centrar'>
                 <img src = 'images/not_found.png' class = 'reducir_img centrar'/>
                 <p class = 'centrar'>No se han encontrado resultados</p>
                 </div>";
            }
        ?>
        </div>
        <?php include_once 'footer.php' ?>
    </body>
</html>