<?php
	require_once ("conexionBD.php");
	$link = cargar_barras_de_busqueda_header ();

    if (isset($_POST)) { 
        $lista = $_POST;
    } else {
        $lista = cargar_lista_completa();
    }
    $generos = select_datos ($link, "generos");
	$plataformas = select_datos ($link, "plataformas");

    if (($generos == null) && ($plataformas == null)) { // esto sirve basicamente para que, si es la primera vez que se mete, estén todos los géneros y plataformas cargados.
    // dado que no se pueden subir desde la página, sino que son definidos por el servidor, este método asegura que se puedan interactuar con los elementos sin tener que
    // asignarlos manualmente.
        require_once ("cargar_datos.php");
        cargar_gen_y_plat (); // en clase comprobar esto
    }
    function limpiar_lista () {
        mysqli_free_result($lista_completa); // esto debe aplicarse cuando se quiere limpiar la lista. Es decir, al hacer click en buscar.
    }
?>
<html>
<head>
    <link href="css/estilos.css" rel="stylesheet" type="text/css"/>
    <title>Gamepedia - inicio</title>
    <script>
        function agregarJuego () {
            window.location.href = "altaJuego.php"
        }
    </script>
</head>
<body>
    <?php include_once 'header.php'; ?>
    <div>
        <button  class = "bloques_header" id = "ir_a_agregar" onclick = "agregarJuego()">
            Agregar
        </button>
    </div>
    <div class = "lista">
        <?php
            if ($lista) {
                foreach ($lista as $juego) {
                    $juego_nombre = $juego["nombre"];
                    $juego_imagen = $juego["tipo_imagen"]; // esto también hay que revisarlo. Ver preguntas
                    $juego_desc = $juego["descripcion"];
                    $juego_url = $juego["url"];
                /*
                    $juego_id_genero = $juego["id_genero"];
                    $juego_id_plataforma = $juego["id_plataforma"];
                    $juego_genero = ($generos['$juego_id_genero'])["nombre"];
                    $juego_plataforma = ($plataformas['$juego_id_plataforma'])["nombre"];
                
                    También saqué del echo de abajo lo siguiente (iría arriba del p de la url):
                    <p>$juego_genero</p>
                    <p>$juego_plataforma</p>
                    Esta sección hay que revisarla porque no se cargan los IDs
                */
                    echo
                    "<div class = 'bloque_info' id = 'agregar_juego'>
                        <img src = '$juego_imagen' class = 'reducir_img transicion borde_img'/>
                        <div class = 'info_right'>
                            <p>$juego_nombre</p>
                            <p>$juego_desc</p>
                            <p>$juego_url</p>
                        </div>
                    </div>";
                }
            } else { echo
                "<div class = 'bloque_info centrar'>
                    <img src = 'images/not_found.png' class = 'reducir_img centrar'/>
                    <p class = 'centrar'>No se han encontrado resultados</p>
                </div>";
            }
        ?>
    </div>
    <?php include_once 'footer.php' ?>