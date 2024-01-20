<?php
include __DIR__ . '/../header.php';
?>

<head>
    <title>Login</title>
</head>

<form method="POST">
  <div class="form-group d-flex flex-column">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="usernameInput" name="username" placeholder="Username" required>
    <label for="password">Password</label>
    <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Password" required>
    <a href="/signup" class="mx-auto"><small>Don't have a account?</small></a>
    <label id="labelError" class="label mx-auto"></label>
    <button id="btnLogin" type="submit" class="btn btn-primary mx-auto">Login</button>
  </div>
</form>

<?php
include __DIR__ . '/../footer.php';
?>

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