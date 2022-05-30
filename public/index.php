<?php

$search = $_GET['search'] ?? null;
if($search && isset($_GET['need_more_monsters']) && $_GET['need_more_monsters']==='yup'){
    $need_more_monsters=true;
}else{
    $need_more_monsters=false;
}

require_once "../functions.php";
$pdo = require_once "../database.php";

if($need_more_monsters){
    require_once "../moremonsters.php";
}

if($search){
    $search = validate_text($search);
}

$display=0;
$monsters = null;
if($search){
    $statement = $pdo->prepare("SELECT * FROM monsters WHERE name like '%$search%' or slug like '%$search%'");
    $statement->execute();
    $monsters = $statement->fetchAll(PDO::FETCH_ASSOC);
    if($monsters){
        $display = 1;
    }else if (!$need_more_monsters){
        header('Location: '."index.php?need_more_monsters=yup&search=$search");
    }
}

require_once "../views/header.php";
if($display){
    foreach ($monsters as $monster) {
        require "../views/card.php";
    }
}
?>

</div>

<?php if($search && !$need_more_monsters){ ?>
    <a href="index.php?search=<?=$search?>&need_more_monsters=yup" class="block w-64 p-2 text-center mx-auto rounded bg-fuchsia-700 text-white ">There has to be more monsters!</a>
<?php } ?>

<?php if(isset($message)){ ?>
    <p class="text-center text-fuchsia-700 italic p-2"><?=$message?></p>
<?php } ?>

</body>
</html>
