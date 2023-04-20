<?php
	require_once ("conexionBD.php");
	$link = cargar_barras_de_busqueda_header ();

    // POR FAVOR PREGUNTAR POR ESTO QUE ESTOY PONIENDO CON TANTA SEGURIDAD ACÁ ABAJO
    if (isset($_POST["buscar"])) { // si hay solicitud, la acepta
	    mysqli_free_result($lista); // limpia la lista anterior, que sí o sí tendrá contenido
        // proceso de buscar.php, que ahora está acá para no tener que hacer pases inútiles
        $nombre = $_POST["nombre"];
        $genero = $_POST["genero"];
        $plataforma = $_POST["plataforma"];
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
        array_multisort(array_column($lista, 'nombre'), SORT_ASC, $lista); // supuestamente esto ordena los datos por nombre. Comprobar




    } else { // sino carga la lista completa
        $lista = cargar_lista_completa(); 
    }
    // Las solicitudes se van a dar desde buscar.php. La cosa es que, al poner datos, los enviamos a buscar, donde se agarran todos los datos y se empiezan a filtrar. Una vez
    // filtrados, se decide enviar los datos usando el método post. Acá se reciben en caso de haberlos

    // bueno, esto es para cargar la lista de géneros y plataformas. Sirven para llenar de contenido los options que corresponden
    $generos = select_datos ($link, "generos");
	$plataformas = select_datos ($link, "plataformas");

    if (($generos == null) && ($plataformas == null)) { // esto sirve basicamente para que, si es la primera vez que se mete, estén todos los géneros y plataformas cargados.
    // dado que no se pueden subir desde la página, sino que son definidos por el servidor, este método asegura que se puedan interactuar con los elementos sin tener que
    // asignarlos manualmente.
        require_once ("cargar_datos.php");
        cargar_gen_y_plat (); // en clase comprobar esto
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
			
                    $juego_id_genero = $juego["id_genero"];
                    $juego_id_plataforma = $juego["id_plataforma"];
                    $juego_genero = ($generos['$juego_id_genero'])["nombre"];
                    $juego_plataforma = ($plataformas['$juego_id_plataforma'])["nombre"];
                
                    echo
                    "<div class = 'bloque_info' id = 'agregar_juego'>
                        <img src = '$juego_imagen' class = 'reducir_img transicion borde_img'/>
                        <div class = 'info_right'>
                            <p>$juego_nombre</p>
                            <p>$juego_desc</p>
			    <p>$juego_genero</p>
               		    <p>$juego_plataforma</p>
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
