<?php
include __DIR__ . '/../header.php';
?>

<head>
    <title>User Info</title>
</head>

<h1>User Info</h1>
<form method="POST">
  <div class="form-group d-flex flex-column">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="emailInput" name="email" value="<? echo $user->getEmail(); ?>" placeholder="Enter email" required>
    <label for="username">Username</label>
    <input type="text" class="form-control" id="usernameInput" name="username" value="<? echo $user->getUsername(); ?>" placeholder="Enter username" required>
    <label for="password">Password</label>
    <input type="password" class="form-control" id="passwordInput" name="password" value="<? echo $user->getPassword(); ?>" placeholder="Password" required>
    <button type="submit" class="btn btn-primary mt-3 mx-auto">Edit Info</button>
    <button type="submit" class="btn btn-danger mt-3 mx-auto">Delete Account</button>
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
</style>