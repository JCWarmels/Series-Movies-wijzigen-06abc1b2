<?php

$dsn = "mysql:host=localhost;dbname=netland";
$user = "root";
$passwd = "";

$pdo = new PDO($dsn, $user, $passwd);
$film_request = $pdo->prepare("SELECT * FROM films WHERE volgnummer=?");
$film_request->execute([$_GET['id']]);
$to_show = $film_request->fetch(PDO::FETCH_ASSOC);
if(isset($_POST['titel'])) {
    $updating_series = $pdo->prepare("UPDATE films SET titel=?, duur_in_min=?, omschrijving=?, datum_van_uitkomst=?, land_van_uitkomst=?, trailer_id_youtube=? WHERE volgnummer=?");
    $updating_series->execute(
        [$_POST['titel'], 
        $_POST['duur_in_min'], 
        $_POST['omschrijving'], 
        $_POST['datum_van_uitkomst'], 
        $_POST['land_van_uitkomst'], 
        $_POST['trailer_id_youtube'], 
        $_GET['id']]
    );
}
?>

<!DOCTYPE html>
<html>

<head>
<style>
.sort {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    width: 30%;
    align-self: center;
}
input:not([name=submit]) {
    text-align: center;
    width: 300px;
}
textarea[name=omschrijving] {
    resize: none;
}
</style>
</head>

<body>
    <main>
        <h1>Welkom op het netland beheerderspaneel</h1>
        <h2>Hier kunt u alle data van<?php echo PHP_EOL . $to_show['titel']; ?> wijzigen:</h2>
        <form method="post">
            <div class='sort'>
                <h2>Titel</h2>
                <input type="text" name="titel" value="<?php echo $to_show['titel'];?>">
            </div>
            <div class='sort'>
                <h2>Duration</h2>
                <input type="text" name="duur_in_min" value="<?php echo $to_show['duur_in_min'];?>">
            </div>
            <div class='sort'>
                <h2>Description</h2>
                <textarea rows="15" cols="40"type="text" name="omschrijving"><?php echo $to_show['omschrijving'];?></textarea>
            </div>
            <div class='sort'>
                <h2>Release Date</h2>
                <input type="text" name="datum_van_uitkomst" value="<?php echo $to_show['datum_van_uitkomst'];?>">
            </div>
            <div class='sort'>
                <h2>Country of Origin</h2>
                <input type="text" name="land_van_uitkomst" value="<?php echo $to_show['land_van_uitkomst'];?>">
            </div>
            <div class='sort'>
                <h2>Trailer ID for Youtube</h2>
                <input type="text" name="trailer_id_youtube" value="<?php echo $to_show['trailer_id_youtube'];?>">
            </div>
            <input type="submit" name='submit' value='Wijzig'>
        </form>
    </main>
</body>

</html>