<?php // Made by Marek_p

session_start();
session_destroy(); // Odhlášení (zničení session)

header("Location: ../auth/login.php"); // Přesměrování na login stránku

?>
