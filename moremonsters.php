<?php

$url = "https://api.open5e.com/monsters/?search=$search";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$json = curl_exec($ch);
curl_close($ch);
$data = json_decode($json, true);

$count = $data['count'] ?? 0;
if ($count==0){
    $message = "Can't find any monsters. Maybe you should check under your bed.";
    return;
} else if ($count>100) {
    $message = "Whoa! That's a lot of monsters! You can't fight them all. You need to be more specific.";
    return;
} else {
    $message = "That's all the monsters we could find. Oh and the one standing behind you.";
}

foreach ($data['results'] as $monster_data){
    $slug = $monster_data['slug'];
    $name = $monster_data['name'];
    $size = $monster_data['size'];
    $type = $monster_data['type'];
    $armor_class = $monster_data['armor_class'];
    $hit_points = $monster_data['hit_points'];
    $strength = $monster_data['strength'];
    $dexterity = $monster_data['dexterity'];
    $constitution = $monster_data['constitution'];
    $intelligence = $monster_data['intelligence'];
    $wisdom = $monster_data['wisdom'];
    $charisma = $monster_data['charisma'];
    $image_url = $monster_data['img_main'] ?? null;
    
    $image_path = '';
    
    $statement = $pdo->prepare("SELECT * FROM monsters WHERE slug = '$slug'");
    $statement->execute();
    $exists = $statement->fetchAll(PDO::FETCH_ASSOC);

    if(!$exists && $image_url){
        
        if(!is_dir('images')) {
            $oldmask = umask(0);
            mkdir('images');
            umask($oldmask);
        }

        $image_dir = 'images/'.$slug;
        
        if(!is_dir($image_dir)) { 
            $oldmask = umask(0);
            mkdir($image_dir, 0777);
            umask($oldmask);
        }
    
        $image_path = $image_dir . '/' . pathinfo($image_url, PATHINFO_BASENAME);
        
        if($image_url[4]===':'){
            $image_url = substr_replace($image_url, 's', 4, 0);
        }
        $ch = curl_init($image_url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $raw_data = curl_exec($ch);
        curl_close($ch);
        $fp = fopen($image_path, 'x');
        fwrite($fp, $raw_data);
        fclose($fp);
    }
    
    if(!$exists){
        $statement = $pdo->prepare("INSERT INTO monsters 
        (slug, name, size, type, armor_class, hit_points, strength, dexterity, constitution, intelligence, wisdom, charisma, image) VALUES 
        (:slug, :name, :size, :type, :armor_class, :hit_points, :strength, :dexterity, :constitution, :intelligence, :wisdom, :charisma, :image)");
        $statement->bindValue(':slug', $slug);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':size', $size);
        $statement->bindValue(':type', $type);
        $statement->bindValue(':armor_class', $armor_class);
        $statement->bindValue(':hit_points', $hit_points);
        $statement->bindValue(':strength', $strength);
        $statement->bindValue(':dexterity', $dexterity);
        $statement->bindValue(':constitution', $constitution);
        $statement->bindValue(':intelligence', $intelligence);
        $statement->bindValue(':wisdom', $wisdom);
        $statement->bindValue(':charisma', $charisma);
        $statement->bindValue(':image', $image_path);
        $statement->execute();
    }
}
