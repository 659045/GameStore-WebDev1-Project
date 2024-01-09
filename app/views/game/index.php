<?php
include __DIR__ . '/../header.php';
?>

<h1>Manage games</h1>    
<a href="/game/create" class="btn btn-primary">Create game</a>
<table class="table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($games as $game) {
            echo "<tr>";
            echo "<td>$game->title</td>";
            echo "<td>$game->description</td>";
            echo "<td>$game->price</td>";
            echo "</tr>";
        }
        ?>
    </tbody>    
</table>

<script src="/../../public/javascript/game.js"></script>

<?php
include __DIR__ . '/../footer.php';
?>
