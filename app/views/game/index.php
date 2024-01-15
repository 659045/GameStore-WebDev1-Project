<?php
include __DIR__ . '/../header.php';
?>

<head>  
    <title>Game Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div id="content-container">
        <label id="error"></label>
        <h1>Manage games</h1>    
        <table class="my-3">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form id="insertGameForm" method="POST">
                        <td><input type="text" id="title" name="title" required></td>
    
                        <td><input type="text" id="description" name="description" required></td>

                        <td><input type="float" id="price" name="price" required></td>

                        <td><input type="file" id="image" name="image" accept="image/*"></td>

                        <td><input type="submit" class="btn btn-primary ml-3" value="Add Game"></td>
                    </form>
                </tr>
            </tbody>
        </table>
        <table id="games-table" class="table my-5"></table>
    </div>
</body>

<script src="../javascript/general.js"></script>
<script>
    generateTable(<?php echo json_encode($games); ?>);

    label = document.getElementById('error');
    label.innerHTML = '';

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('#insertGameForm');
        form.addEventListener('submit', handleInsertGame);
    })

    function handleInsertGame(event) {
        event.preventDefault();
        const data = new FormData(event.target);

        insertGame(data);
    }

    function insertGame(data) {
        //TODO remember to change back to localhost
        postForm('http://localhost:8888/api/game', data).then((response) => {
            fetchData('/game').then((response) => {
                generateTable(response);
            }).catch(() => {
                label.innerHTML = 'Error fetching data';
            });

            label.innerHTML = 'Game added successfully';
        }).catch((error) => {
            console.error('Error:', error);
            label.innerHTML = 'Error adding game';
        }); 
    }

    function deleteGame(id) {  
        if (confirm('are you sure you want to remove this game?')) {
            const data = {
                id: id
            };

            //TODO change to localhost later
            deleteData('http://localhost:8888/api/game', data)
            .then(() => {
                fetchData('/game')
                .then((responseData) => {
                    console.log(responseData);
                    generateTable(responseData);
                })
                .catch((error) => {
                    label.innerHTML = 'Game deleted successfully';
                })
            })
            .catch((error) => {
                console.error('Error:', error);
                label.innerHTML = 'Error deleting game';
            });
        }
    }

    function generateTable(data) {
        const gamesTable = document.getElementById('games-table');
        gamesTable.innerHTML = '';

        generateTableHead(gamesTable);

        generateTableBody(gamesTable, data);

        document.getElementById('content-container').appendChild(gamesTable);
    }

    function generateTableHead(table) {
        const header = document.createElement('thead');
        const titleHeader = document.createElement('th');
        const descriptionHeader = document.createElement('th');
        const priceHeader = document.createElement('th');
        const imageHeader = document.createElement('th');

        titleHeader.innerHTML = 'Title';
        descriptionHeader.innerHTML = 'Description';
        priceHeader.innerHTML = 'Price';
        imageHeader.innerHTML = 'Image';

        header.appendChild(titleHeader);
        header.appendChild(descriptionHeader);
        header.appendChild(priceHeader);
        header.appendChild(imageHeader);

        table.appendChild(header);
    }

    function generateTableBody(table, data) {
        const body = document.createElement('tbody');

        data.forEach(function (game) {
            const row = document.createElement('tr');
            const title = document.createElement('td');
            const description = document.createElement('td');
            const price = document.createElement('td');
            const image = document.createElement('td');
            const editButtonContainer = document.createElement('td');
            const deleteButtonContainer = document.createElement('td');

            title.innerHTML = game.title;
            description.innerHTML = game.description;
            price.innerHTML = game.price;
            image.innerHTML = game.image;

            row.appendChild(title);
            row.appendChild(description);
            row.appendChild(price);
            row.appendChild(image);
            row.appendChild(editButtonContainer);
            row.appendChild(deleteButtonContainer);

            editButtonContainer.appendChild(generateEditButton(game));
            deleteButtonContainer.appendChild(generateDeleteButton(game));

            body.appendChild(row);
        });

        table.append(body);
    }

    function generateEditButton(data) {
        const editButton = document.createElement('button');
        editButton.innerHTML = 'Edit';
        editButton.value = data.id;
        editButton.classList.add('btn');
        editButton.classList.add('btn-primary'); 

        editButton.addEventListener('click', function () {
            const gameId = editButton.value;
            //TODO change to localhost later
            window.location.href =  "http://localhost:8888/game/edit?id=" + gameId;
        });

        return editButton;
    }

    function generateDeleteButton(data) {
        const deleteButton = document.createElement('button');
        deleteButton.innerHTML = 'Delete';
        deleteButton.value = data.id;
        deleteButton.classList.add('btn');
        deleteButton.classList.add('btn-primary');

        deleteButton.addEventListener('click', function () {
            const gameId = deleteButton.value;
            
            deleteGame(gameId);
        });

        return deleteButton;
    }
</script>

<?php
include __DIR__ . '/../footer.php';
?>
