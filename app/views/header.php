<!DOCTYPE html>
<html lang="en">
<head>  
    <title>Game Store</title>
    <link 
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" 
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
      crossorigin="anonymous"
    >

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <main>
    <div class="container">
      <header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
          <li class="nav-item"><a href="/" class="nav-link">Home</a></li>
          <li class="nav-item ml-auto"><a href="/game" class="nav-link">Manage games</a></li>
          <li class="nav-item"><a href="/cart" class="nav-link">Shopping Cart</a></li>
          <li class="nav-item"><a href="/wishlist" class="nav-link">Wish List</a></li>
          <li class="nav-item"><a href="/premium" class="nav-link">Upgrade to Premium</a></li>
          <li class="nav-item"><a href="/login" class="nav-link">Login</a></li>
        </ul>
        <button href="/signup" class="btn btn-primary" style="width: 10%"><i class="fa fa-user userIcon mr-2"></i>Sign Up</button>
      </header>


<style>
  .nav-item {
    margin: 0px 5px 0px 5px;

    :hover {
      background-color: lightgray;
    }
  }

  .container {
    min-height: 100vh;
  }

  .userIcon {
    font-size: 20px;
  }

  .active-page {
    background-color: lightgray;
  }

</style>