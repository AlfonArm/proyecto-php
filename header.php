<header>
    <div class = "inicio">
        <img src = "images/png-online-7.png" class = "reducir_img"></img>
        <h1>Gamepedia</h1>
        <p>Donde los gamers se unen</p>
    </div>
    <form method = "get" action = "index.php">
        <div class = "barra" id = "info_busqueda">
            <div class = "bloques_header">
                <label>Buscar:</label>
                <input name = "nombre"><br><br>
            </div>
            <div class = "bloques_header">
                <label>Género:</label>
                <select id = "header_genero" name = "genero">
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
                <select id = "header_plataforma" name = "plataforma">
                    <?php
                        if ($plataformas) {
                            foreach ($plataformas as $plat) {
                                $nombre_plat = $plat["nombre"];
                                $id_plat = $plat["id"];
                                echo "<option value ='$id_plat'>$nombre_plat</option>";
                            }
                        }
                    ?>
                </select><br><br>
            </div>
		    <div>
				<input type = "submit" class = "bloques_header" value = "Buscar" id = "busqueda_juego" name = 'buscar'></input>
			</div>
        </div>
    </form>
</header>