<?php
include __DIR__ . '/../header.php';
?>

<head>  
    <title>Game Management</title>
</head>

<body>
    <div id="content-container">
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
                        <td><input type="text" id="titleInput" name="title" required></td>
    
                        <td><input type="text" id="descriptionInput" name="description" required></td>

                        <td><input type="float" pattern="[0-9]+(\.[0-9]+)?" id="priceInput" name="price" required></td>

                        <td><input type="file" id="imageInput" name="image" accept="image/*"></td>

                        <td><input type="submit" class="btn btn-primary ml-3" value="Add Game"></td>
                    </form>
                </tr>
            </tbody>
        </table>
        <label id="error"></label>
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
        
        console.log(data);
        insertGame(data);
    }

    function insertGame(data) {
        //TODO remember to change back to localhost
        fetchData('/game?title=' + data.get('title')).then((game) => {
            if (game) {
                label.innerHTML = 'Game already exists';
            } else {
                postForm('http://localhost:8888/api/game', data).then((response) => {
                    fetchData('/game').then((response) => {
                        generateTable(response);
                    }).catch(() => {
                        label.innerHTML = 'Error fetching data';
                    });

                    const titleInput = document.getElementById('titleInput');
                    const descriptionInput = document.getElementById('descriptionInput');
                    const priceInput = document.getElementById('priceInput');
                    const imageInput = document.getElementById('imageInput');

                    titleInput.value = '';
                    descriptionInput.value = '';
                    priceInput.value = '';
                    imageInput.value = '';
                    label.innerHTML = 'Game added successfully';
                }).catch((error) => {
                    console.error('Error:', error);
                    label.innerHTML = 'Error adding game';
                }); 
            }
        }).catch((error) => {
            console.log(error);
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
