<?php
include __DIR__ . '/../header.php';
?>

<head>
    <title>Login</title>
</head>

<form>
  <div class="form-group d-flex flex-column">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="emailInput" placeholder="Enter email">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="passwordInput" placeholder="Password">
    <a href="/signup" class="mx-auto"><small>Don't have a account?</small></a>
    <button type="submit" class="btn btn-primary mt-3 mx-auto">Login</button>

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