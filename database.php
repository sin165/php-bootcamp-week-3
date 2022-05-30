<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=dnd_monsters', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

return $pdo;