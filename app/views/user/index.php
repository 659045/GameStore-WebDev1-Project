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
    <h2 class="mb-3"><? echo $user->getRole(); ?> account</h2>
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
        event.preventDefault();
        label = document.getElementById('error');

        const form   = new FormData(document.querySelector('form'));
        console.log(form);

        postForm('/user', form).then((response) => {
            label.innerHTML = 'User info edited successfully';
        }).catch((error) => {
            console.log(error);
            label.innerHTML = 'Error editing user';
        })
    }

    function handleDeleteAccount(event) {
        if (confirm('Are you sure you want to delete your account?')) {
            event.preventDefault();

            const data = {
                id: document.querySelector('#idInput').value
            }

            deleteData('/user', data).then((response) => {
                window.location.href = '/logout';
            }).catch((error) => {
                console.log('error', error);
                label.innerHTML = 'Error deleting user';
            })
        }
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