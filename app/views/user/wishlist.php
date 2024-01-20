<?php
include __DIR__ . '/../header.php';
?>

<head>
    <title>Wish List</title>
</head>

<h1>Wish List</h1>
<div class="row"></div>

<?php
include __DIR__ . '/../footer.php';
?>

<script src="/javascript/general.js"></script>
<script>
    generateWishList(<? echo json_encode($wishList); ?>);

    function generateWishList(wishlist) {
        wishlist.forEach((item) => {
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
        cardContainer.id = 'cardContainer' + game.id;

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

        const removeButton = document.createElement('button');
        removeButton.classList.add('btn', 'btn-danger', 'w-50', 'ml-auto', 'btnRemove');
        removeButton.value = game.id;
        removeButton.innerText = 'Remove from wishlist';
        removeButton.addEventListener('click', function () {
            if (confirm('Are you sure you want to remove this game from your wishlist?')) {
                const gameId = removeButton.value;
                const cardContainer = document.getElementById('cardContainer' + gameId);

                const data = {
                    user_id: <? echo $_SESSION['user_id']; ?>,
                    game_id: gameId
                };

                deleteData('/wishList', data).then((response) => {
                    cardContainer.remove();
                }).catch((error) => {
                    console.log(error);
                });
            }
        });

        cardBody.appendChild(img);
        cardBody.appendChild(smallTitle);
        cardBody.appendChild(pTitle);
        cardBody.appendChild(smallDescription);
        cardBody.appendChild(pDescription);
        cardBody.appendChild(smallPrice);
        cardBody.appendChild(pPrice);
        cardBody.appendChild(removeButton);

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