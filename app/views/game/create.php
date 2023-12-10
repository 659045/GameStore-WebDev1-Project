<?php
include __DIR__ . '/../header.php';
?>
<h1>Create game</h1>
<form method="POST">
    <label for="title">Title:</label><br>
    <input type="text" id="title" name="title"><br>
    <label for="description">Description:</label><br>
    <input type="text" id="description" name="description"><br>
    <label for="price">Price:</label><br>
    <textarea id="price" name="price" rows="10" cols="80"></textarea><br><br>
    <input type="submit" value="Create">
</form>
<?php
include __DIR__ . '/../footer.php';
?>