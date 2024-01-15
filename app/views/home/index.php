<? 
include __DIR__ . '/../header.php'; 
?>

<head>
  <link
    rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
  />

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
</head>

<div>
  <img class="front-image" src="https://media.gq-magazine.co.uk/photos/645b5c3c8223a5c3801b8b26/16:9/w_1280,c_limit/100-best-games-hp-b.jpg">
</div>
<div class="row">
  <?php foreach ($games as $game) { ?>
    <div class="col-lg-3 col-md-6 col-sm-12">
      <div class="card mb-5 itemCard">
        <div class="card-body">
          <p><? echo $game->title ?></p>
          <p><? echo $game->description ?></p>
          <p><? echo $game->price ?></p>
          <img src="../public/img/<? echo $game->image ?>" alt="<? echo $game->image ?>"/>
        </div>
      </div>
    </div>
  <?php } ?>
</div>

<? 
include __DIR__ . '/../footer.php'; 
?>

<style>
  img {
    height: 50%;
    width: 100%;
    display: block;
    margin: 2% auto 5% auto
  }
</style>
  
           