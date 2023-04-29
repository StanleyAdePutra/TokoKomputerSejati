<!DOCTYPE html>

<?php
    session_start();

    $conn = new mysqli("localhost", "root", "", "komputer_db");

    $data = mysqli_query($conn, "SELECT * FROM list_produk");

    $email = $_SESSION['email'];
    $id_transaction = $_SESSION['id_transaction'];

    if (isset($_POST["submit"])) {
        $id_product = $_POST["id_product"];
        $qty = $_POST["qty"];
        $price = $_POST["price"];
        $total_price = $qty * $price;

        $conn->query("INSERT INTO transaction_detail VALUES ('$id_transaction', '$id_product','$qty','$total_price')");
        
        $message = "Product added to cart";
        echo "<script>alert('$message');</script>";
    }
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="javascript/java.js"></script>
</head>

<body>
    <header>
        <h1>TOKO KOMPUTER SEJATI</h1>
    </header>
    <main>
        <h2> WELCOME
            <?php echo strtoupper($_SESSION['name']); ?> <br><br>Please Enjoy Your Shopping
        </h2>

        <a href="shopping_cart.php"><button class="button" type="submit" name="check">Shopping Cart</button></a>

        <div class="container">
            <div class="rowhead">
                <p>Product</p>
                <p>Type</p>
                <p>Price</p>
            </div>
            <?php $i = 1;
            while ($product = mysqli_fetch_array($data)) { ?>
            <div class="rowbody">
                <div class="toppart">
                    <p>
                        <?php echo $product["product"] ?>
                    </p>
                    <p>
                        <?php echo $product["type"] ?>
                    </p>
                    <p>Rp.
                        <?php echo number_format($product["price"], 0, ',', '.') ?>
                    </p>
                </div>
                <div class="lowpart">
                    <form method="post" action="product_list.php">
                        <input type="hidden" name="id_product" value="<?php echo $product['id_product']; ?>">
                        <input type="hidden" name="price" value="<?php echo $product['price']; ?>">

                        <button class="button1" onclick="decrement(event, <?php echo $i; ?>)">-</button>
                        <input class="input2" type="number" name="qty" id="qty<?php echo $i; ?>" min="1" value="0"
                            readonly>
                        <button class="button1" onclick="increment(event, <?php echo $i; ?>)">+</button>
                        <br>

                        <button class="button" type="submit" name="submit">Add to Cart</button>
                    </form>
                </div>
            </div>
            <?php $i++; } ?>
        </div>
    </main>
</body>

</html>