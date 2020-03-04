<?php

$dsn = "mysql:host=localhost;dbname=netland";
$user = "root";
$passwd = "";

$pdo = new PDO($dsn, $user, $passwd);
$result_series = "";
$result_films = "";
if(isset($_GET['series_title'])){
    if($_GET['series_title'] == 'ASC'){
        $result_series = $pdo->query("SELECT id, title, rating FROM series ORDER BY title ASC");
    }
    else {
        $result_series = $pdo->query("SELECT id, title, rating FROM series ORDER BY title DESC");
    }
}
if(isset($_GET['series_rating'])){
    if($_GET['series_rating'] == 'ASC'){
        $result_series = $pdo->query("SELECT id, title, rating FROM series ORDER BY rating ASC");
    }
    else {
        $result_series = $pdo->query("SELECT id, title, rating FROM series ORDER BY rating DESC");
    }
}
if(isset($_GET['films_title'])){
    if($_GET['films_title'] == 'ASC'){
        $result_films = $pdo->query("SELECT volgnummer, titel, duur_in_min FROM films ORDER BY titel ASC");
    }
    else {
        $result_films = $pdo->query("SELECT volgnummer, titel, duur_in_min FROM films ORDER BY titel DESC");
    }
}
if(isset($_GET['films_duration'])){
    if($_GET['films_duration'] == 'ASC'){
        $result_films = $pdo->query("SELECT volgnummer, titel, duur_in_min FROM films ORDER BY duur_in_min ASC");
    }
    else {
        $result_films = $pdo->query("SELECT volgnummer, titel, duur_in_min FROM films ORDER BY duur_in_min DESC");
    }
}
if($result_series == ""){
    $result_series = $pdo->query("SELECT id, title, rating FROM series");
}
if($result_films == ""){
    $result_films = $pdo->query("SELECT volgnummer, titel, duur_in_min FROM films");
}
$remember_sort = "";
$remember_sort2 = "";
if(array_key_exists('series_title', $_GET)){
    $remember_sort = "&series_title=".$_GET['series_title'];
}
if(array_key_exists('series_rating', $_GET)){
    $remember_sort = "&series_rating=".$_GET['series_rating'];
}
if(array_key_exists('films_title', $_GET)){
    $remember_sort2 = "&films_title=".$_GET['films_title'];
}
if(array_key_exists('films_duration', $_GET)){
     $remember_sort2 = "&films_duration=".$_GET['films_duration'];
}

$series_title = "index.php?series_title=";
if(isset($_GET['series_title'])) {
    $series_title .= $_GET['series_title'] === 'DESC' ? 'ASC' : 'DESC';
}else {
    $series_title .= 'DESC';
} 
$series_title .= $remember_sort2;

$series_rating = "index.php?series_rating=";
if(isset($_GET['series_rating'])) {
    $series_rating .= $_GET['series_rating'] === 'DESC' ? 'ASC' : 'DESC';
}else {
    $series_rating .= 'DESC';
} 
$series_rating .= $remember_sort2;

$films_title = "index.php?films_title=";
if(isset($_GET['films_title'])) {
    $films_title .= $_GET['films_title'] === 'DESC' ? 'ASC' : 'DESC';
}else {
    $films_title .= 'DESC';
} 
$films_title .= $remember_sort;

$films_duration = "index.php?films_duration=";
if(isset($_GET['films_duration'])) {
    $films_duration .= $_GET['films_duration'] === 'DESC' ? 'ASC' : 'DESC';
}else {
    $films_duration .= 'DESC';
} 
$films_duration .= $remember_sort;
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <main>
        <h1>Welkom op het netland beheerderspaneel</h1>
        <h2 >Series</h2>
        <table>
        <tr><th style='width:150px'><a href=<?php echo $series_title; ?>>Title</a></th>
        <th style='width:150px'><a href=<?php echo $series_rating; ?>>Rating</a></th></tr>
        <?php 
        while($row_series = $result_series->fetch()) {
            echo '<tr><td><a href="series.php?id='.$row_series['id'].'">';
            echo($row_series['title'] . '</a></td><td style="text-align:center;">' .  $row_series['rating']);
            echo '</td></tr>';
        }
        ?>
        </table>
        <h2>Films</h2>
        <table>
        <tr><th style='width:150px'><a href=<?php echo $films_title ?> >Title</a></th>
        <th style='width:150px'><a href=<?php echo $films_duration ?> >Duration</a></th></tr>
        <?php 
        while($row_films = $result_films->fetch()) {
            echo '<tr><td><a href="films.php?id='.$row_films['volgnummer'].'">';
            echo($row_films['titel'] . '</td><td style="text-align:center;">' .  $row_films['duur_in_min']);
            echo '</td></tr>';
        }
        ?>    
        </table>
    </main>
</body>
</html>