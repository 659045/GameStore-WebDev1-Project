<?php
include __DIR__ . '/../header.php';
?>

<head>
    <title>Sign Up</title>
</head>

<form method="POST">
  <div class="form-group d-flex flex-column">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="emailInput" name="email" placeholder="Enter email" required>
    <label for="username">Username</label>
    <input type="text" class="form-control" id="usernameInput" name="username" placeholder="Enter username" required>
    <label for="password">Password</label>
    <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Password" required>
    <a href="/login" class="mx-auto"><small>Already have an account?</small></a>
    <button type="submit" class="btn btn-primary mt-3 mx-auto">Sign Up</button>
    <label id="error"></label>
  </div>
</form>

<?php
include __DIR__ . '/../footer.php';
?>

<script src="../javascript/general.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        form.addEventListener('submit', handleSignUp);
    })

    function handleSignUp(event) {
        label = document.getElementById('error');
        event.preventDefault();
        const data = new FormData(event.target);

        fetchData('/user?username=' + data.get('username')).then((user) => {
            if (user) {
                label.innerHTML = 'User already exists';
            } else {
                postForm('http://localhost:8888/api/user', data).then((response) => {
                    window.location.href = '/login';
                }).catch((error) => {
                    console.log(error);
                    label.innerHTML = 'Error creating user';
                });
            }
        }).catch((error) => {
            console.log(error);
        });
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

    .btn {
        width: 30%;
    }
</style>