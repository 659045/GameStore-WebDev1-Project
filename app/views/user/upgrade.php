<?php
include __DIR__ . '/../header.php';
?>

<head>
    <title>Upgrade to premium</title>
</head>

<h1>Upgrade to premium</h1>

<form>
  <div class="form-group d-flex flex-column">
    <input type="hidden" class="form-control" id="idInput" name="id" value="<? echo $user->getId(); ?>">
    <h2 class="mx-auto">Only €9.99!!</h2>
    <button type="submit" id="upgradeButton" class="btn btn-primary mt-3 mx-auto">Upgrade to premium</button>
    <label id="error"></label>
  </div>
</form>

<?php
include __DIR__ . '/../footer.php';
?>

<script src="../javascript/general.js"></script>
<script>
    label = document.getElementById('error');
    label.innerHTML = '';

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        form.addEventListener('submit', handleUpgrade);
    })

    function handleUpgrade(event) {
        event.preventDefault();
        const data = new FormData(event.target);

        postForm('/upgrade', data).then((response) => {
            window.location.href = '/user';
            <? $_SESSION['role'] = 'premium'; ?>
        }).catch((error) => {
            console.log(error);
            label.innerHTML = 'Error upgrading user';
        });
    }
</script>