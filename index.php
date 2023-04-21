<?php
	require_once ("conexionBD.php");
	$link = cargar_barras_de_busqueda_header ();

    // Ahora funciona con el método get porque es más cómodo para el usuario. Creo
    if (isset($_GET["buscar"])) { // si hay solicitud, la acepta
	    // al parecer no es necesario limpiar $lista porque el cambio de instancia lo limpia por sí solo
        // proceso de buscar.php, que ahora está acá para no tener que hacer pases inútiles
        $nombre = $_GET["nombre"];
        $genero = $_GET["genero"];
        $plataforma = $_GET["plataforma"];
        $lista = cargar_lista_completa(); // carga todos los juegos
        $aux = array ();
        if (($nombre != null) || ($nombre != "")) {
            foreach ($lista as $dato) {
                if (strpos($dato["nombre"], $nombre)) {
                    array_push ($aux, $dato);
                } else {
                    if (strpos($dato["descripcion"], $nombre)) { // se fija también si fue mencionado en la descripción
                        array_push ($aux, $dato);
                    }
                }
            }
            $lista = $aux;
            $aux = array ();
        } 
        if ($genero != 1) {
            foreach ($lista as $dato) {
                if ($dato["id_genero"] == $genero) {
                    array_push ($aux, $dato);
                }
            }
            $lista = $aux;
            $aux = array ();
        }
        if ($plataforma != 1) {
            foreach ($lista as $dato) {
                if ($dato["id_plataforma"] == $plataforma) {
                    array_push ($aux, $dato);
                }
            }
            $lista = $aux;
            $aux = array ();
        }
    } else { // sino carga la lista completa
        $lista = cargar_lista_completa();
    }
    /* if ($la lista tiene elementos, para lo cuál habría que preguntar) {
        array_multisort(array_column($lista, 'nombre'), SORT_ASC, $lista); // supuestamente esto ordena los datos por nombre. Comprobar
    }
    */

    // bueno, esto es para cargar la lista de géneros y plataformas. Sirven para llenar de contenido los options que corresponden
    $generos = select_datos ($link, "generos");
	$plataformas = select_datos ($link, "plataformas");

    /*
    if ($generos no tiene elementos) { // esto sirve basicamente para que, si es la primera vez que se mete, estén todos los géneros y plataformas cargados.
    // dado que no se pueden subir desde la página, sino que son definidos por el servidor, este método asegura que se puedan interactuar con los elementos sin tener que
    // asignarlos manualmente.
    pero por alguna razón no funciona, por lo que dejo para preguntar
        require_once ("cargar_datos.php");
        cargar_gen_y_plat ($link);
    } else {
        echo "<p>:D</p>";
    }
    */

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
    <script>
        nombre_ventana = document.getElementById("ventana_confirmacion_juego");
        if ((nombre_ventana != null) or (nombre_ventana != "")) {
            // mostrar una ventana flotante
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
        if (isset($_SESSION["mostrar_nombre"])) { // nop, no lo acepta
            require("subir.php");
            $nuevo_juego = $_SESSION["mostrar_nombre"];
            echo "<p id = 'ventana_confirmacion_juego'>$nuevo_juego</p>";
            // acá estaría bueno poner que se quede un par de segundos
            unset($_SESSION["mostrar_nombre"]);
        }
    ?>
        <?php
            // función provicional: hasta que encontremos una mejor opción, está esto
            function buscar_por_id ($categoria ,$id_cat) {
                foreach ($categoria as $elemento) {
                    if ($elemento["id"] == $id_cat) {
                        return $elemento;
                    }
                }
            }
            if ($lista) {
                foreach ($lista as $juego) {
                    $juego_nombre = $juego["nombre"];
                    $juego_imagen = $juego["tipo_imagen"]; // esto también hay que revisarlo. Ver preguntas
                    $juego_desc = $juego["descripcion"];
                    $juego_url = $juego["url"];

                    $genero_filtrado = buscar_por_id ($generos, $juego["id_genero"]);                  
                    $juego_genero = $genero_filtrado["nombre"];

                    $plataforma_filtrado = buscar_por_id ($plataformas, $juego["id_plataforma"]);                  
                    $juego_plataforma = $plataforma_filtrado["nombre"];

                    echo
                    "<div class = 'bloque_info' id = 'agregar_juego'>
                        <img src = '$juego_imagen' class = 'reducir_img transicion borde_img'/>
                        <div class = 'info_right'>
                            <p>$juego_nombre</p>
                            <p>$juego_desc</p>
			                <p>Género: $juego_genero</p>
               		        <p>Plataforma: $juego_plataforma</p>
                            <p>Página web: $juego_url</p>
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
