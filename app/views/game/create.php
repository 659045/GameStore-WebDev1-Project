<? include __DIR__ . '/../header.php'; ?>

<body>
    <h1>Insert game</h1>
    <form method="POST">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br>
        <label for="description">Description:</label><br>
        <input type="text" id="description" name="description" required><br>
        <label for="price">Price:</label><br>
        <input type="number" id="price" name="price" required><br><br>
        <input type="submit" value="Create">
    </form>
</body>

<script src="../javascript/general.js"></script>
<script>
    const form = document.querySelector('form');
    form.addEventListener('submit', handleSubmit);

    function handleSubmit(event) {
        event.preventDefault();
        const data = new FormData(event.target);
        data.append('post_type', 'insert');

        try {
            //TODO remember to change back to localhost
            postForm('http://localhost:8888/api/game', data).then((response) => {
                window.location.href =  "http://localhost:8888/game";
            }).catch((error) => {
                  //TODO insert unsuccessfull
            }); 
        } catch(error) {
            //TODO show error
            throw error
        }
    }
</script>

<? include __DIR__ . '/../footer.php'; ?>