<?php
include __DIR__ . '/../header.php';
?>

<body>
    
    
    <div id="content-container">
        <label id="error"></label>
        <h1>Manage games</h1>    
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <form id="insertGameForm" method="POST">
                            <td><input type="text" id="title" name="title" required></td>
        
                            <td><input type="text" id="description" name="description" required></td>

                            <td><input type="number" id="price" name="price" required></td>
                
                            <td><input type="submit" class="btn btn-primary" value="Add Game"></td>
                        </form>
                    </tr>
                </tbody>
            </table>
        <table id="games-table" class="table">
            
        </table>
    </div>
</body>

<script src="../javascript/general.js"></script>
<script>
    generateTable(<?php echo json_encode($games); ?>);

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('#insertGameForm');
        form.addEventListener('submit', handleInsertGame);
    })

    function handleInsertGame(event) {
        event.preventDefault();
        const data = new FormData(event.target);


        console.log(data);
        label = document.getElementById('error');

        //TODO remember to change back to localhost
        postForm('http://localhost:8888/api/game', data).then((response) => {
            fetchData('/game').then((response) => {
                generateTable(response);
            }).catch((error) => {
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

            try {
                //TODO change to localhost later
                deleteData('http://localhost:8888/api/game', data)
                .then(() => {
                    fetchData('/game')
                    .then((responseData) => {
                        console.log(responseData);
                        generateTable(responseData);
                    })
                })
                .catch((error) => {
                    console.error('Error:', error);
                });

            } catch(error) {
                throw error;
            }
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

        titleHeader.innerHTML = 'Title';
        descriptionHeader.innerHTML = 'Description';
        priceHeader.innerHTML = 'Price';

        header.appendChild(titleHeader);
        header.appendChild(descriptionHeader);
        header.appendChild(priceHeader);

        table.appendChild(header);
    }

    function generateTableBody(table, data) {
        const body = document.createElement('tbody');

        data.forEach(function (game) {
            const row = document.createElement('tr');
            const title = document.createElement('td');
            const description = document.createElement('td');
            const price = document.createElement('td');
            const editButtonContainer = document.createElement('td');
            const deleteButtonContainer = document.createElement('td');

            title.innerHTML = game.title;
            description.innerHTML = game.description;
            price.innerHTML = game.price;

            editButtonContainer.appendChild(generateEditButton(game));
            deleteButtonContainer.appendChild(generateDeleteButton(game));

            row.appendChild(title);
            row.appendChild(description);
            row.appendChild(price);
            row.appendChild(editButtonContainer);
            row.appendChild(deleteButtonContainer);

            body.appendChild(row);
        });

        table.append(body);
    }

    function generateEditButton(data) {
        const editButton = document.createElement('button');
        editButton.innerHTML = 'Edit';
        editButton.value = data.id;

        editButton.addEventListener('click', function () {
            const gameId = editButton.value;
            //TODO maybe change later
            window.location.href =  "http://localhost:8888/game/edit/" + gameId;
        });

        return editButton;
    }

    function generateDeleteButton(data) {
        const deleteButton = document.createElement('button');
        deleteButton.innerHTML = 'Delete';
        deleteButton.value = data.id;

        deleteButton.addEventListener('click', function () {
            const gameId = deleteButton.value;
            
            deleteGame(gameId);
        });

        return deleteButton;
    }

    //TODO flickers on the second time
    function fadeOut(element) {
        var op = 3;
        var timer = setInterval(function () {
            if (op <= 0){
                clearInterval(timer);
                element.style.display = 'hidden';
            }
            element.style.opacity = op;
            element.style.filter = 'alpha(opacity=' + op * 100 + ")";
            op -= op * 0.1;
        }, 50);
    }   
</script>

<?php
include __DIR__ . '/../footer.php';
?>
