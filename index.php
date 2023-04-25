<?php
    if (empty(session_id())) {// por razones que desconozco esto debe ir acá arriba
        session_start();
    }
	require_once ("conexionBD.php");
    include_once 'header.php';
    emptyEntity();
    // lo mismo: $link se genera en header. Así mismo se generan las opciones del header

    if (isset($_GET["buscar"])) { // si hay solicitud, la acepta
	    // al parecer no es necesario limpiar $lista porque el cambio de instancia lo limpia por sí solo
        $nombre = $_GET["nombre"];
        $genero = $_GET["genero"];
        $plataforma = $_GET["plataforma"];

        $lista = getByNombreAndGeneroAndPlataformaOrderByNombre($nombre, $genero, $plataforma); 
    } else
        $lista = cargar_lista_completa(); // nunca quedó claro si esta lista también tiene que estar ordenada (?)
?>
<html>
    <head>
        <link href="css/estilos.css" rel="stylesheet" type="text/css"/>
        <title>Gamepedia - inicio</title>
        <script>
            function ventana_flotante() {
                nombre_ventana = document.getElementById("ventana_confirmacion_juego");
                if ((nombre_ventana != null) || (nombre_ventana != "")) {
                    document.getElementById("ventana_confirmacion_juego").innerHTML = ("Se subió el juego exitosamente");
                    document.getElementById("ventana_confirmacion_juego").style.display = "block";
                }
            }
        </script>
    </head>
    <body>
        <div class = "lista">
        <?php
            if (isset($_SESSION["mostrar_nombre"])) {
                $nuevo_juego = $_SESSION["mostrar_nombre"];
                echo "<p id = 'ventana_confirmacion_juego' class = 'entorno_confirmacion'>$nuevo_juego</p>";
                // acá estaría bueno poner que se quede un par de segundos
                unset($_SESSION["mostrar_nombre"]);
            }
        ?>
        <script>
            ventana_flotante();
            // aca iría un contador, si tuviera uno eficaz
            // document.getElementById("ventana_confirmacion_juego").style.display = "none";
            // se llama una vez se haya subido la session. De esta forma accedo al dato con JS, dejando que repose sobre HTML primero
        </script>
        <?php
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
