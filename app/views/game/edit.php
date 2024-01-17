<?php
include __DIR__ . '/../header.php';
?>

<head>
    <title>Edit Game</title>
</head>

<div>
    <form method="PUT">
        <label for="title">Title:</label><br>
        <input type="text" id="titleInput" name="title" value="<? echo $game->getTitle() ?>" required><br>
        <label for="description">Description:</label><br>
        <input type="text" id="descriptionInput" name="description" value="<? echo $game->getDescription() ?>" required><br>
        <label for="price">Price:</label><br>
        <input type="float" id="priceInput" name="price" value="<? echo $game->getPrice() ?>" required><br>
        <label for="image">Image:</label><br>
        <input type="file" id="imageInput" name="image" accept="image/*"><br><br>
        <input type="submit" class="btn btn-primary" value="Edit">
    </form>
    <label id="error"></label>
</div>

<script src="../javascript/general.js"></script>
<script>
    const form = document.querySelector('form');
    form.addEventListener('submit', handleSubmit);

    function handleSubmit(event) {
        event.preventDefault();
        const label = document.getElementById('error');

        const data = {
            id: <? echo $game->getId() ?>,
            title: document.getElementById('titleInput').value,
            description: document.getElementById('descriptionInput').value,
            price: document.getElementById('priceInput').value,
            image: document.getElementById('imageInput').value
        }
        
        //TODO remember to change back to localhost
        putData('http://localhost:8888/api/game', data).then((response) => {
            window.location.href = "http://localhost:8888/game";
        }).catch((error) => {
            console.error('Error:', error);
            label.innerHTML = 'Error editing data';
        });
    }
</script>

<?php
include __DIR__ . '/../footer.php';
?>