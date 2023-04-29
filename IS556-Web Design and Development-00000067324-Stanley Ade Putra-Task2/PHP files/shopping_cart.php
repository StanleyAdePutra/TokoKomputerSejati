<!DOCTYPE html>

<?php
    session_start();

    $conn = mysqli_connect('localhost', 'root', '', 'komputer_db');

    $id_transaction = $_SESSION['id_transaction'];

    $data = mysqli_query($conn, "SELECT list_produk.product, SUM(transaction_detail.qty) AS qty, SUM(transaction_detail.total_price) AS total_price
        FROM list_produk, transaction_detail
        WHERE list_produk.id_product = transaction_detail.id_product AND transaction_detail.id_transaction = '$id_transaction'
        GROUP BY list_produk.product");

    if (isset($_POST["submit"])) {
        $address = $_POST["address"];
        $city = $_POST["city"];
        $state = $_POST["state"];
        $zip = $_POST["zip"];
        $credit_card = $_POST["credit_card"];
        $month = $_POST["month"];
        $year = $_POST["year"];

        $conn->query("INSERT INTO destination
                                            VALUES
                                            ('$id_transaction','$address','$city','$state','$zip','$credit_card','$month','$year')
                                            ");
        
        $message = "Your order has been received. Please wait for the delivery";
        echo "<script>alert('$message');</script>";
        session_destroy();
        header('refresh:1; url=login.php');
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <h1>TOKO KOMPUTER SEJATI</h1>
    </header>

    <main>
        <h2> Your Shopping Cart</h2>

        <a href="product_list.php"><button class="button">Continue Shopping</button></a>

        <div class="container1">
            <div class="rowhead">
                <p>Product</p>
                <p>Quantity</p>
                <p>Price</p>
            </div>
            <?php 
            $pay_price = 0;
            while ($product = mysqli_fetch_array($data)) { 
                $pay_price += $product["total_price"];
            ?>
            <div class="rowbody">
                <div class="toppart">
                    <p>
                        <?php echo $product["product"] ?>
                    </p>
                    <p>
                        <?php echo $product["qty"] ?>
                    </p>
                    <p>Rp.
                        <?php echo number_format($product["total_price"], 0, ',', '.') ?>
                    </p>
                </div>
            </div>
            <?php } ?>
            <div class="total">
                <p></p>
                <p>Total</p>
                <p>Rp.
                    <?php echo number_format($pay_price, 0, ',', '.') ?></p>
            </div>
        </div>

        <button class="openmodal" id="openmodal">Checkout</button>

        <div id="myModal" class="modal">
            <div class="modal-content">
                <form class="form" action="shopping_cart.php" method="post">
                    <h2>Package Destination</h2>
                    <table>
                        <tr>
                            <td><label for="address">Address:</label></td>
                            <td><input class="input" type="text" id="address" name="address" placeholder="Address"
                                    maxlength="40" required>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="city">City:</label></td>
                            <td><input class="input" type="text" id="city" name="city" placeholder="City" maxlength="15"
                                    required></td>
                        </tr>
                        <tr>
                            <td><label for="state">State:</label></td>
                            <td><input class="input" type="text" id="state" name="state" placeholder="State"
                                    maxlength="15" required></td>
                        </tr>
                        <tr>
                            <td><label for="zip">Zip Code:</label></td>
                            <td><input class="input" type="text" id="zip" name="zip" placeholder="Zip Code"
                                    maxlength="5" pattern="[0-9]{5}" required></td>
                        </tr>
                        <tr>
                            <td><label for="credit_card">Credit Card</label></td>
                            <td><input class="input" type="text" id="credit_card" name="credit_card"
                                    placeholder="Credit Card" maxlength="16" pattern="[0-9]{16}" required></td>
                        </tr>
                        <tr>
                            <td><label for="expire_m">Expires</label></td>
                            <td><label for="expire_m">Month:</label>
                                <input class="input1" type="number" id="month" name="month" placeholder="Month" min="1"
                                    max="12" required>
                                <label for="expire_y">Year:</label>
                                <input class="input1" type="number" id="year" name="year" placeholder="Year" min="2023"
                                    required>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><button class="button" onclick="closeModal()">Cancel</button>
                                <button class="button" name="submit" id="submit" type="submit">Place Order</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </main>

    <script>
    var modal = document.querySelector(".modal");

    document.getElementById("openmodal").addEventListener("click", () => {
        document.querySelector(".modal").classList.add("active");
    });

    function closeModal() {
        modal.classList.remove("active");
    }
    </script>
</body>

</html>