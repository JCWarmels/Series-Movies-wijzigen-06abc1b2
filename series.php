<?php

$dsn = "mysql:host=localhost;dbname=netland";
$user = "root";
$passwd = "";

$pdo = new PDO($dsn, $user, $passwd);
$series_request = $pdo->prepare("SELECT * FROM series WHERE id=?");
$series_request->execute([$_GET['id']]);
$to_show = $series_request->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <main>
        <h1>Welkom op het netland beheerderspaneel</h1>
        <h2>Hier vindt u all data over<?php echo PHP_EOL . $to_show['title']; ?>:</h2>
        <div style="display:flex; flex-direction:row; width:150px; justify-content: space-around;">
            <h3><?php echo $to_show['title']?></h3>
            <h4><?php echo $to_show['rating']?>/5.0</h4>
        </div>
        <div style="display:flex; flex-direction:row; width:150px; justify-content: space-around;">
            <h4><?php echo $to_show['has_won_awards'].PHP_EOL?>awards won</h4>
            <h4><?php echo $to_show['seasons'].PHP_EOL?>seasons</h4>
        </div>
        <div style="display:flex; flex-direction:row; width:150px; justify-content: space-around;">
            <h4><?php echo $to_show['language'].PHP_EOL?></h4>
            <h4><?php echo $to_show['country'].PHP_EOL?></h4>
        </div>
        <div style="display:flex; flex-direction:row; width:800px;">
            <p style="width:350px;"><?php echo $to_show['description']?></p>
        </div>
        <div>
            <button onclick="location.href='edit_series.php?id=<?php echo $_GET['id'] ?>'">Edit, Only admins ok? I trust you!</button>
        </div>
    </main>
</body>
</html>