<?php

function cargar_plataformas ($link) {
mysqli_query($link, "INSERT INTO `plataformas`(`id`, `nombre`) VALUES 
(1, '--Ninguna asignada--'),
(2, 'PS5'),
(3, 'PS4'),
(4, 'PS3'),
(5, 'PS2'),
(6, 'PS1'),
(7, 'PSP'),
(8, 'PSVita'),
(9, 'Nintendo Switch'),
(10, 'Wii U'),
(11, 'Wii'),
(12, 'Nintendo 3DS'),
(13, 'Nintendo DS'),
(14, 'Gamecube'),
(15, 'Nintendo 64'),
(16, 'SNES'),
(17, 'NES'),
(18, 'Xbox One'),
(19, 'Xbox series'),
(20, 'Xbox 360'),
(21, 'Xbox'),
(22, 'Atari 2000'),
(23, 'PC')");
}
    
function cargar_generos ($link) {
mysqli_query($link, "INSERT INTO `generos`(`id`, `nombre`) VALUES
    (1, '--No asignado--'),
    (2, '4X'),
    (3, 'Acción'),
    (4, 'Arcade'),
    (5, 'ARPG'),
    (6, 'Aventura'),
    (7, 'Aventura conversacional'),
    (8, 'Aventura gráfica'),
    (9, 'Baile'),
    (10, 'Battle Royale'),
    (11, 'Beat\em Up'),
    (12, 'Brawler'),
    (13, 'Bullethell'),
    (14, 'CCG'),
    (15, 'Clicker'),
    (16, 'Creación musical'),
    (17, 'Dual Stick Shooter'),
    (18, 'Dungeon Crawler'),
    (19, 'Endless runner'),
    (20, 'Estrategia en tiempo real'),
    (21, 'Estrategia por turnos'),
    (22, 'First Person Shooter'),
    (23, 'First Person Walker'),
    (24, 'FPS'),
    (25, 'Gestión'),
    (26, 'God Game'),
    (27, 'Gran Estrategia'),
    (28, 'Hack \n\ Slash'),
    (29, 'Hero Shooter'),
    (30, 'Incremental'),
    (31, 'JRPG'),
    (32, 'Karaoke'),
    (33, 'Libro juego'),
    (34, 'Lucha'),
    (35, 'Matamarcianos'),
    (36, 'Mánager'),
    (37, 'Metroidvania'),
    (38, 'MMO'),
    (39, 'MMORPG'),
    (40, 'MOBA'),
    (41, 'Musical'),
    (42, 'Musou'),
    (43, 'Novela visual'),
    (44, 'Party game'),
    (45, 'Plataformas'),
    (46, 'Point and Click'),
    (47, 'Point and Shoot'),
    (48, 'Ritmo'),
    (49, 'RLS'),
    (50, 'Roguelike'),
    (51, 'Roguelite'),
    (52, 'RPG'),
    (53, 'RPG de Acción'),
    (54, 'RTS'),
    (55, 'Run and gun'),
    (56, 'Sandbox'),
    (57, 'Sandbox RPG'),
    (58, 'Shmup'),
    (59, 'Shoot\em Up'),
    (60, 'Shooter'),
    (61, 'Shooter On Rails'),
    (62, 'Sigilo'),
    (63, 'Sim'),
    (64, 'Simulación'),
    (65, 'Simulador'),
    (66, 'Simulador inmersivo'),
    (67, 'Soulslike'),
    (68, 'Survival'),
    (69, 'Survival Horror'),
    (70, 'TBS'),
    (71, 'TCG'),
    (72, 'Third Person Shooter'),
    (73, 'Tower Defense'),
    (74, 'TPS'),
    (75, 'Tycoon'),
    (76, 'Warzone')");
}
?>
