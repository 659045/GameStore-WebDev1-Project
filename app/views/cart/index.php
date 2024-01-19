<?php
include __DIR__ . '/../header.php';
?>

<head>
    <title>Shopping Cart</title>
</head>

<h1>Shopping Cart</h1>
<?  
    foreach ($cart as $item => $value) {
        echo '<p> value' . $value . '</p>';
    }
?>
<div class="row">
  <?php foreach ($cart as $item => $value) { ?>
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card mb-5">
            <div class="card-body d-flex flex-column">
                
            </div>
        </div>
    </div>
  <?php } ?>
</div>

<?php
include __DIR__ . '/../footer.php';
?>

<script src="/javascript/general.js"></script>
<script>
    generateCart(<?php echo json_encode($cart); ?>);

    function generateCart(cart) {
        cart.forEach((item) => {
            generateItemCard(item);
        });
    }

    function generateItemCard($id) {
        const game = fetchGame('/game?=' + $id);

        const cardContainer = document.createElement('div');
        cardContainer.classList.add('col-lg-4', 'col-md-6', 'col-sm-12');

        const card = document.createElement('div');
        card.classList.add('card', 'mb-5');

        const cardBody = document.createElement('div');
        const image = document.createElement('img');
    }
</script>