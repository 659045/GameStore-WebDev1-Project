<?php
include __DIR__ . '/../header.php';
?>

<head>
    <title>My Games</title>
</head>

<h1>My Games</h1>
<h3 class="text-muted pt-3 pb-3">Recently Purchased</h3>
<div class="row"></div>

<?php
include __DIR__ . '/../footer.php';
?>

<script src="/javascript/general.js"></script>
<script>
    generateOwnedGames(<? echo json_encode($ownedGames); ?>);

    function generateOwnedGames(ownedGames) {
        ownedGames.forEach((item) => {
            fetchData('/game?id=' + item.game_id).then((game) => {
                generateItemCard(game);
            }).catch((error) => {
                console.log(error);
            });
        });
    }

    function generateItemCard(game) {
        console.log(game);

        const cardContainer = document.createElement('div');
        cardContainer.classList.add('col-lg-4', 'col-md-6', 'col-sm-12');

        const card = document.createElement('div');
        card.classList.add('card', 'mb-5');

        const cardBody = document.createElement('div');
        cardBody.classList.add('card-body', 'd-flex', 'flex-column');

        const img = document.createElement('img');
        img.src = '/img/' + game.image;

        const smallTitle = document.createElement('small');
        smallTitle.classList.add('text-muted', 'mt-3');
        smallTitle.innerText = 'Title';

        const pTitle = document.createElement('p');
        pTitle.innerText = game.title;

        const smallDescription = document.createElement('small');
        smallDescription.classList.add('text-muted');
        smallDescription.innerText = 'Description';

        const pDescription = document.createElement('p');
        pDescription.innerText = game.description;

        const smallPrice = document.createElement('small');
        smallPrice.classList.add('text-muted');
        smallPrice.innerText = 'Price';

        const pPrice = document.createElement('p');
        pPrice.innerText = game.price;

        cardBody.appendChild(img);
        cardBody.appendChild(smallTitle);
        cardBody.appendChild(pTitle);
        cardBody.appendChild(smallDescription);
        cardBody.appendChild(pDescription);
        cardBody.appendChild(smallPrice);
        cardBody.appendChild(pPrice);

        card.appendChild(cardBody);

        cardContainer.appendChild(card);

        document.querySelector('.row').appendChild(cardContainer);
    }
</script>

<style>
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