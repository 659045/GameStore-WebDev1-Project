<?php
include __DIR__ . '/../header.php';
?>

<head>
    <title>Shopping Cart</title>
</head>

<div class="d-flex flex-row">
    <h1>Shopping Cart</h1>
    <btnCheckout class="btn btn-primary ml-auto mt-3 h-50">Checkout</btnCheckout>
</div>  
<!-- <div class="row">

</div> -->

<table class="table">
    <thead>
        <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody class="cart-table">

    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">Total</td>
            <td id="totalPrice">0.00</td>
        </tr>
    </tfoot>
</table>

<?php
include __DIR__ . '/../footer.php';
?>

<script src="/javascript/general.js"></script>
<script>
    const cart = <?php echo json_encode($cart); ?>;
    generateCart(cart);

    document.addEventListener('DOMContentLoaded', function () {
        const btnCheckout = document.querySelector('btnCheckout');
        btnCheckout.addEventListener('click', function () {
            cart.forEach((item) => {
                const data = {
                    game_id: item,
                    user_id: <?php echo $_SESSION['user_id']; ?>
                }

                console.log(data);

                postData('/owned', data).then((response) => {
                    console.log(response);
                }).catch((error) => {
                    console.log(error);
                });
            });
        });
    });

    function generateCart(cart) {
        let totalPrice = 0;

        cart.forEach((item) => {
            fetchData('/game?id=' + item).then((game) => {
                generateItemRow(game);
                totalPrice += parseFloat(game.price);
                updateTotalPrice(totalPrice);
            }).catch((error) => {
                console.log(error);
            });
        });
    }

    function generateItemRow(game) {
        const tableBody = document.querySelector('.cart-table');

        const row = document.createElement('tr');

        const imgCell = document.createElement('td');
        const img = document.createElement('img');
        img.src = '/img/' + game.image;
        imgCell.appendChild(img);

        const titleCell = document.createElement('td');
        titleCell.innerText = game.title;

        const descriptionCell = document.createElement('td');
        descriptionCell.innerText = game.description;

        const priceCell = document.createElement('td');
        priceCell.innerText = game.price;

        const removeButton = document.createElement('button');
        removeButton.classList.add('btn', 'btn-danger');
        removeButton.innerText = 'Remove';
        removeButton.addEventListener('click', function () {
            const data = {
                id: game.id
            }

            deleteData('/cart', data).then((response) => {
                row.remove();
                const totalPrice = document.getElementById('totalPrice').innerText
                updateTotalPrice(parseFloat(totalPrice) - parseFloat(game.price));
            }).catch((error) => {
                console.log(error);
            });
        });

        row.appendChild(imgCell);
        row.appendChild(titleCell);
        row.appendChild(descriptionCell);
        row.appendChild(priceCell);
        row.appendChild(removeButton);

        tableBody.appendChild(row);
    }

    function updateTotalPrice(totalPrice) {
        const totalPriceElement = document.getElementById('totalPrice');
        totalPriceElement.innerText = parseFloat(totalPrice).toFixed(2);;
    }
</script>

<style>
    body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        img {
            max-width: 80px;
            max-height: 80px;
            display: block;
            margin: 0 auto;
        }
</style>
