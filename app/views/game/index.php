<?php
include __DIR__ . '/../header.php';
?>

<body>
    <h1>Manage games</h1>    
    <a href="/game/create" class="btn btn-primary">Create game</a>
    <div id="content-container">
        <table id="games-table" class="table">

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
    </div>
</body>

<script src="../javascript/general.js"></script>
<script>
    const gamesTable = document.getElementById('games-table');

    function loadGamesTable() {

    }

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
            const data = new FormData;
            data.append('post_type', 'delete');
            data.append('id', id);

            try {
                //TODO change to localhost later
                postForm('http://localhost:8888/api/game', data)
                .then(() => {
                   fetchData('http://localhost:8888/api/game')
                })
                .then((responseData) => {
                    refreshTable(responseData);
                })
                .catch((error) => {
                    console.error('Error:', error);
                });

            } catch(error) {
                throw error;
            }
        }
    }

    function refreshTable(data) {
        $('#games-table tr').remove();

        $.each(data, function (index, game) {
            $('#games-table').append('<tr><td>' + game.title + '</td><td>' + game.description + '</td><td>' + game.price + '</td>');
        });
    }
</script>

<?php
include __DIR__ . '/../footer.php';
?>
