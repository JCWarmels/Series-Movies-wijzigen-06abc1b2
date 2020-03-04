<?php

$dsn = "mysql:host=localhost;dbname=netland";
$user = "root";
$passwd = "";

$pdo = new PDO($dsn, $user, $passwd);
$film_request = $pdo->prepare("SELECT * FROM films WHERE volgnummer=?");
$film_request->execute([$_GET['id']]);
$to_show = $film_request->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <main>
        <h1>Welkom op het netland beheerderspaneel</h1>
        <h2>Hier vindt u all data over<?php echo PHP_EOL . $to_show['titel']; ?>:</h2>
        <div style="display:flex; flex-direction:row; width:200px; justify-content: space-around;">
            <h3><?php echo $to_show['titel'] ?></h3>
            <h4><?php echo $to_show['duur_in_min'] . PHP_EOL ?>min</h4>
        </div>
        <div style="display:flex; flex-direction:row; width:200px; justify-content: space-around;">
            <h4><?php echo $to_show['datum_van_uitkomst'] . PHP_EOL ?></h4>
            <h4><?php echo $to_show['land_van_uitkomst'] . PHP_EOL ?></h4>
        </div>
        <div style="display:flex; flex-direction:row; width:800px;">
            <p style="width:350px;"><?php echo $to_show['omschrijving'] ?></p>
            <?php
            echo '<iframe width="420" height="315" src="https://www.youtube.com/embed/' . $to_show['trailer_id_youtube'] . '"></iframe>'
            ?>
        </div>
        <div>
            <button onclick="location.href='edit_films.php?id=<?php echo $_GET['id'] ?>'">Edit, Only admins ok? I trust you!</button>
        </div>
    </main>
</body>

</html>