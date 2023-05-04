<?php
    require_once ('conexionBD.php');
    if(empty(session_id())) session_start();
    emptyEntity();
?>

<script>
    function agregarJuego () {
        window.location.href = "altaJuego.php"
    }
    function volverAIndex () {
        window.location.href = "index.php"
    }
</script>
<header>
    <div>
        <div class = "inicio">
            <img src="images/logo.png" class = "logo">
            <h1><span>Game</span>pedia</h1>
            <p>Donde los gamers se unen</p>
        </div>
    </div>
</header>