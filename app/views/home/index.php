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
    <div class="col-lg-3 col-md-6 col-sm-12">
      <div class="card mb-5 itemCard">
        <div class="card-body d-flex flex-column">
          <button id="btnWishlist" value="<? echo $game->getId() ?>" class="btn btn-primary w-25 ml-auto wishlist-button mb-3"><i id="heartIcon<? echo $game->getId() ?>" class="fa fa-heart"></i></button>
          <img src="/img/<? echo $game->getImage() ?>"/>
          <p><? echo $game->getTitle() ?></p>
          <p><? echo $game->getDescription() ?></p>
          <p><? echo $game->getPrice() ?></p>
          <button class="btn btn-primary w-50 ml-auto">Add to cart</button>
        </div>
      </div>
    </div>
  <?php } ?>
</div>

<? 
include __DIR__ . '/../footer.php'; 
?>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var wishlistButtons = document.querySelectorAll('.wishlist-button');

    wishlistButtons.forEach(function (button) {
      button.addEventListener("click", function () {
        var iconId = button.value
        var heartIcon = document.getElementById('heartIcon' + iconId);

        if (heartIcon.classList.contains('fa-heart')) {
          heartIcon.classList.remove('fa-heart');
          heartIcon.classList.add('fa-heart-o');

          //TODO add to wishlist
        } else {
          heartIcon.classList.remove('fa-heart-o');
          heartIcon.classList.add('fa-heart');

          //TODO remove from wishlist
        }
      });
    });
  });
</script>

<style>
  .front-image {
    height: 50%;
    width: 100%;
    display: block;
    margin: 2% auto 5% auto
  }
</style>
  
           