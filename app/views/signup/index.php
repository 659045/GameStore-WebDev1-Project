<?php
include __DIR__ . '/../header.php';
?>

<head>
    <title>Sign Up</title>
</head>

<form>
  <div class="form-group d-flex flex-column">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="emailInput" placeholder="Enter email" required>
    <label for="username">Username</label>
    <input type="text" class="form-control" id="usernameInput" placeholder="Enter username" required>
    <label for="password">Password</label>
    <input type="password" class="form-control" id="passwordInput" placeholder="Password" required>
    <a href="/login" class="mx-auto"><small>Already have an account?</small></a>
    <button type="submit" class="btn btn-primary mt-3 mx-auto">Sign Up</button>
    <label id="error"></label>
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