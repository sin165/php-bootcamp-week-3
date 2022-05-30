<?php 
require_once "../functions.php";
$pdo = require_once "../database.php";
$statement = $pdo->prepare("SELECT * FROM monsters");
$statement->execute();
$monsters = $statement->fetchAll(PDO::FETCH_ASSOC);

require_once "../views/header.html";

foreach ($monsters as $monster) {
    require "../views/card.php";
}
?>
</div>
</body>
</html>
