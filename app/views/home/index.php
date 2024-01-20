<? 
include __DIR__ . '/../header.php'; 
?>

<head>
  <title>Home</title>
</head>

<div>
  <img class="front-image" src="https://media.gq-magazine.co.uk/photos/645b5c3c8223a5c3801b8b26/16:9/w_1280,c_limit/100-best-games-hp-b.jpg">
</div>
<div class="row">
  <?php foreach ($games as $game) { ?>
    <div class="col-lg-4 col-md-6 col-sm-12">
      <div class="card mb-5">
        <div class="card-body d-flex flex-column">
          <?
            if (isset($_SESSION['role']) && ($_SESSION['role'] === 'premium' || $_SESSION['role'] === 'admin')) {
              echo '<button value="' . $game->getId() . '" class="btn btn-primary w-25 ml-auto wishlist-button mb-3"><i id="heartIcon' . $game->getId() . '" class="fa fa-heart-o"></i></button>';
            }
          ?>
          <img src="/img/<? echo $game->getImage() ?>"/>
          <small class="text-muted mt-3">Title</small>
          <p><? echo $game->getTitle() ?></p>
          <small class="text-muted">Description</small>
          <p><? echo $game->getDescription() ?></p>
          <small class="text-muted">Price</small>
          <p><? echo $game->getPrice() ?></p>
          <?
            if (isset($_SESSION['username'])) {
              echo '<button class="btn btn-primary w-50 ml-auto add-to-cart-button" value="' . $game->getId() . '">Add to cart</button>';
            }
          ?>
          <label id="labelError<? echo $game->getId(); ?>" class="p-2 mt-2 ml-auto label"></label>
        </div>
      </div>
    </div>
  <?php } ?>
</div>

<? 
include __DIR__ . '/../footer.php'; 
?>

<script src="/javascript/general.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const wishlistButtons = document.querySelectorAll('.wishlist-button');
    const addToCartButtons = document.querySelectorAll('.add-to-cart-button');

    fetchData('/wishlist?user_id=<? echo $_SESSION['user_id']; ?>').then((wishlist) => {
      wishlist.forEach((item) => {
        const heartIcon = document.getElementById('heartIcon' + item.game_id);
        heartIcon.classList.remove('fa-heart-o');
        heartIcon.classList.add('fa-heart');
      });
    }).catch((error) => {
      console.log(error);
    });

    wishlistButtons.forEach(function (button) {
      button.addEventListener("click", function () {
        const gameId = button.value
        const heartIcon = document.getElementById('heartIcon' + gameId);

        fetchData('/wishlist?user_id=<? echo $_SESSION['user_id']; ?>&game_id=' + gameId).then((wishlistGame) => {
          label = document.getElementById('labelError' + gameId);

          const data = {
              user_id: <? echo $_SESSION['user_id']; ?>,
              game_id: gameId
          }

          console.log(wishlistGame);

          if (wishlistGame && wishlistGame.length > 0) {
            deleteData('/wishlist', data).then((response) => {
              heartIcon.classList.remove('fa-heart');
              heartIcon.classList.add('fa-heart-o');
              showSuccessMessage('Game removed from wishlist', label);
            }).catch((error) => {
              console.log(error);
              showErrorMessage('Error removing game from wishlist', label);
            });
          } else {
            postData('/wishlist', data).then((response) => {
              heartIcon.classList.remove('fa-heart-o');
              heartIcon.classList.add('fa-heart');
              showSuccessMessage('Game added to wishlist', label);
            }).catch((error) => {
              console.log(error);
              showErrorMessage('Error adding game to wishlist', label);
            });
          }
        }).catch((error) => {
          console.log(error);
          showErrorMessage('Error adding game to wishlist', label);
        });
      });
    });

    addToCartButtons.forEach(function (button) {
      button.addEventListener("click", function () {
        const gameId = button.value;
        label = document.getElementById('labelError' + gameId);

        fetchData('/owned?user_id=<? echo $_SESSION['user_id']; ?>&game_id=' + gameId).then((ownedGame) => {
          if (ownedGame) {
            showErrorMessage('Game already owned', label);
            return;
          } else {
            const data = {
              id: gameId
            }

            postData('/cart', data).then((response) => {
              showSuccessMessage('Game added to cart', label);
            }).catch((error) => {
              console.log(error);
              showErrorMessage('Error adding game to cart', label);
            });
          }
        }).catch((error) => {
          console.log(error);
          showErrorMessage('Error adding game to cart', label);
        });
      });
    });
  });
</script>

<style>
  .front-image {
    height: 500px;
    width: 100%;
    display: block;
    margin: 2% auto 5% auto
  }

  p {
    overflow: hidden;
    width: 200px;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  img {
    height: 300px;
    width: 300px;
    display: block;
    margin: 0 auto;
  }
</style>
  
           