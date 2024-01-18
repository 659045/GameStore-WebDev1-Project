<?php
include __DIR__ . '/../header.php';
?>

<head>
    <title>Edit Game</title>
</head>

<div>
    <form method="POST">
        <input type="hidden" id="idField" name="id" value="<?php echo $game->getId(); ?>" required><br>
        <label for="title">Title:</label><br>
        <input type="text" id="titleInput" name="title" value="<?php echo $game->getTitle(); ?>" required><br>
        <label for="description">Description:</label><br>
        <input type="text" id="descriptionInput" name="description" value="<?php echo $game->getDescription(); ?>" required><br>
        <label for="price">Price:</label><br>
        <input type="float" pattern="[0-9]+(\.[0-9]+)?" id="priceInput" name="price" value="<?php echo $game->getPrice(); ?>" required><br>
        <label for="image">Image:</label><br>
        <input type="file" id="imageInput" name="image" accept="image/*" value="<?php echo $game->getPrice(); ?>" required><br><br>
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

        const data = new FormData(event.target);
        
        //TODO remember to change back to localhost
        postForm('http://localhost:8888/api/game', data).then((response) => {
            window.location.href = '/game';
        }).catch((error) => {
            console.error('Error:', error);
            label.innerHTML = 'Error editing data';
        });
    }
</script>

<?php
include __DIR__ . '/../footer.php';
?>