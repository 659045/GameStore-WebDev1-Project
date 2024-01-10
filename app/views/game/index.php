<?php
include __DIR__ . '/../header.php';
?>

<body>
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
                    echo '<tr>';
                    echo '<td>'.$game->title.'</td>';
                    echo '<td>'.$game->description.'</td>';
                    echo '<td>'.$game->price.'</td>';
                    echo '<td><button id="btnEdit" value="'.$game->id.'">Edit</button></td>';
                    echo '<td><button id="btnDelete" value="'.$game->id.'">Delete</button></td>';
                    echo '</tr>';
                }
            ?>
        </tbody>    
    </table>
</body>

<script src="../javascript/general.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('#btnDelete'); 

        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const gameId = button.value;
                
                deleteGame(gameId);
            });
        });
    })

    function deleteGame(id) {  
        if (confirm('are you sure you want to remove this game?')) {
        
            //FIX
            const data = new FormData;
            data.append('post_type', 'delete');
            data.append('id', 'id');

            try {
                //TODO change to localhost later
                postForm('http://localhost:8888/api/game', data);
            } catch(error) {
                throw error;
            }
        }
    }
</script>

<?php
include __DIR__ . '/../footer.php';
?>
