<?php
include __DIR__ . '/../header.php';
?>

<h1>Welcome to the Game World!</h1>

<?php
foreach ($model as $game) {
?>

<h2><?= $game->title ?></h2>
<p><i><?= $game->description ?></i></p>
<p><?= $game->price ?></p>

<?php
}
include __DIR__ . '/../footer.php';
?>