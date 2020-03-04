<?php

$dsn = "mysql:host=localhost;dbname=netland";
$user = "root";
$passwd = "";

$pdo = new PDO($dsn, $user, $passwd);
$series_request = $pdo->prepare("SELECT * FROM series WHERE id=?");
$series_request->execute([$_GET['id']]);
$to_show = $series_request->fetch(PDO::FETCH_ASSOC);
if(isset($_POST['title'])) {
    $updating_series = $pdo->prepare("UPDATE series SET title=?, rating=?, description=?, has_won_awards=?, seasons=?, country=?, language=? WHERE id=?");
    $updating_series->execute(
        [$_POST['title'], 
        $_POST['rating'], 
        $_POST['description'], 
        $_POST['has_won_awards'], 
        $_POST['seasons'], 
        $_POST['country'], 
        $_POST['language'], 
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
textarea[name=description] {
    resize: none;
}
</style>
</head>
<body>
    <main>
        <h1>Welkom op het netland beheerderspaneel</h1>
        <h2>Hier kunt u alle data van<?php echo PHP_EOL . $to_show['title']; ?> wijzigen:</h2>
        <form method="post">
            <div class='sort'>
                <h2>Titel</h2>
                <input type="text" name="title" value="<?php echo $to_show['title'];?>">
            </div>
            <div class='sort'>
                <h2>Rating</h2>
                <input type="text" name="rating" value="<?php echo $to_show['rating'];?>">
            </div>
            <div class='sort'>
                <h2>Description</h2>
                <textarea rows="15" cols="40"type="text" name="description"><?php echo $to_show['description'];?></textarea>
            </div>
            <div class='sort'>
                <h2>Amount of Awards</h2>
                <input type="text" name="has_won_awards" value="<?php echo $to_show['has_won_awards'];?>">
            </div>
            <div class='sort'>
                <h2>Seasons</h2>
                <input type="text" name="seasons" value="<?php echo $to_show['seasons'];?>">
            </div>
            <div class='sort'>
                <h2>Country of Origin</h2>
                <input type="text" name="country" value="<?php echo $to_show['country'];?>">
            </div>
            <div class='sort'>
                <h2>Language</h2>
                <input type="text" name="language" value="<?php echo $to_show['language'];?>">
            </div>
            <input type="submit" name='submit' value='Wijzig'>
        </form>
    </main>
</body>
</html>