<?php
    require_once ("conexionBD.php");
	$link = cargar_barras_de_busqueda_header ();
    $lista = cargar_lista_completa(); // la lista completa va a ser necesaria para poner algo en una primera instancia. Luego se podrán hacer búsquedas específicas
    $generos = select_datos ($link, "generos");
	$plataformas = select_datos ($link, "plataformas");
?>
<html>
<head>
    <link href="css/estilos.css" rel="stylesheet" type="text/css"/>
    <title>Subir juego</title>
    <script>
        function dio_click () {
            function es_mas_corto_que (elem, long) {
                return elem.lenght <= long;
            }

            nombre_juego = document.getElementById("nombre_juego").value;
            descripcion = document.getElementById("descripcion").value;
            plataforma = document.getElementById("plataforma").value;
            url_juego = document.getElementById("url_juego").value;
            imagen = document.getElementById("imagen").value; // .value copia el elemento? Se necesita mandar en binario
            cont = 0;

            if ((nombre_juego == null) || (nombre_juego == "")) {
                document.getElementById("return_nombre").innerHTML = "Este campo es obligatorio";
                cont++;
            }
            if (imagen == null) {
                document.getElementById("return_imagen").innerHTML = "Este campo es obligatorio";
                cont++;
            }
            if (plataforma == 1) {
                document.getElementById("return_plataforma").innerHTML = "Inserte una opción válida";
                cont++;
            }
            if ((descripcion == null) || (descripcion == "")) {
                document.getElementById("return_desc").innerHTML = "Este campo es obligatorio";
                cont++;
            } else {
                if (!es_mas_corto_que(descripcion, 255)) {
                    document.getElementById("return_desc").innerHTML = "La descripción es muy larga";
                    cont++;
                }
            }
            if ((url_juego == null) || (url_juego == "")) {
                document.getElementById("return_enlace").innerHTML = "Este campo es obligatorio";
                cont++;
            } else {
                if (!es_mas_corto_que(url_juego, 80)) {
                    document.getElementById("return_enlace").innerHTML = "El enlace es muy largo";
                    cont++;
                }
            }
            return (cont == 0);
        }
    </script>
</head>
<body>
    <?php include_once 'header.php'; ?>
    <form class="cuadro" onsubmit = "return dio_click()" method = "post" action="subir.php"> <!--Se envían los datos sin tener en cuenta si se cumplen con los requisitos-->
        <div class = "flex"> 
            <div class="espacio_form">
                <fieldset>
                    <legend>Nombre</legend>
                    <input type="" placeholder="Nombre del juego" id = "nombre_juego" name = "nombre_juego">
                    <p id = "return_nombre"></p>
                </fieldset>
                <fieldset>
                    <legend>Descripción</legend>
                    <textarea placeholder = "Hasta 255 caracteres" class = "texto_grande" id = "descripcion" name = "descripcion"></textarea>
                    <p id = "return_desc"></p>
                </fieldset>
            </div>
            <div class="espacio_form">
                <fieldset>
                    <legend>Plataforma</legend>
                    <select id = "plataforma" name = "plataforma">
                        <?php
                            if ($plataformas) {
                                foreach ($plataformas as $plat) {
                                    $nombre_plat = $plat["nombre"];
                                    $id_plat = $plat["id"];
                                    echo "<option value ='$id_plat'>$nombre_plat</option>";
                                }
                            }
                        ?>
                    </select>
                    <p id = "return_plataforma"></p>
                </fieldset>
                <fieldset>
                    <legend>Dirección</legend>
                    <input type="url" placeholder="Máximo 80 caracteres" id = "url_juego" name = "url_juego">
                    <p id = "return_direccion"></p>
                </fieldset>
            </div>
            <div class="espacio_form">
                <fieldset>
                    <legend>Género:</legend>
                    <select id = "genero_juego" name = "genero_juego">
                        <?php
                            if ($generos) {
                                foreach ($generos as $gen) {
                                    $nombre_gen = $gen["nombre"];
                                    $id_gen = $gen["id"];
                                    echo "<option value ='$id_gen'>$nombre_gen</option>";
                                }
                            }
                        ?>
                    </select>
                </fieldset>
                <div>
                    <p>Seleccionar imagen</p>
                    <input type = "file" id = "imagen" name = "imagen">
                    <p id = "return_imagen"> </p>
                </div>
            </div>
        </div>
        <button type = "submit" id = "confirmar" name = confirmar>Subir</button>
    </form>    
    <?php include_once 'footer.php' ?>
