<?php
include __DIR__ . '/../header.php';
?>

<head>
    <title>User Info</title>
</head>

<h1>User Info</h1>
<form>
  <div class="form-group d-flex flex-column">
    <input type="hidden" class="form-control" id="idInput" name="id" value="<? echo $user->getId(); ?>">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="emailInput" name="email" value="<? echo $user->getEmail(); ?>" placeholder="Enter email" required>
    <label for="username">Username</label>
    <input type="text" class="form-control" id="usernameInput" name="username" value="<? echo $user->getUsername(); ?>" placeholder="Enter username" required>
    <label for="password">Password</label>
    <input type="password" class="form-control" id="passwordInput" name="password" value="<? echo $user->getPassword(); ?>" placeholder="Password" required>
    <button type="submit" id="editButton" class="btn btn-primary mt-3 mx-auto" @click="handleEditInfo(event)">Edit Info</button>
    <button type="submit" id="deleteButton" class="btn btn-danger mt-3 mx-auto" @click="handleDeleteAccount()">Delete Account</button>
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
        const editButton = document.querySelector('#editButton');
        const deleteButton = document.querySelector('#deleteButton');

        editButton.addEventListener('click', handleEditInfo);
        deleteButton.addEventListener('click', handleDeleteAccount);
    })

    function handleEditInfo(event) {
        console.log('edit info');
        event.preventDefault();

        const data = new FormData(event.target);

        postForm('http://localhost:8888/api/user', data).then((response) => {
            label.innerHTML = 'User info edited successfully';
        }).catch((error) => {
            console.log(error);
            label.innerHTML = 'Error editing user';
        })
    }

    function handleDeleteAccount() {
        const data = {
            id: document.querySelector('#idInput').value
        }

        deleteData('http://localhost:8888/api/user', data);
        window.location.href = '/logout';
    }
</script>

<style>
    .form-group {
        width: 25%;
        margin: 8% auto;
    }

    .form-control {
        margin-bottom: 10%;
    }
</style>