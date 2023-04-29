<!DOCTYPE html>

<?php
session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = new PDO("mysql:host=localhost;dbname=komputer_db", "root", "");

    $query = "SELECT * FROM data_customer WHERE email = ?";

    $result = $conn->prepare($query);
    $result->execute([$email]);

    if ($row = $result->fetch()) {
        if (md5($password) == $row['password']) {
            $_SESSION['email'] = $row['email'];
            $_SESSION['name'] = $row['name'];
            $id_transaction = time();
            $_SESSION['id_transaction'] = $id_transaction;

            setcookie('email', $row['email'], time() + (7 * 24 * 60 * 60));

            $query_transaction = "INSERT INTO transaction VALUES (?,?)";
            $result_transaction = $conn->prepare($query_transaction);
            $result_transaction->execute([$email, $id_transaction]);

            $message = "You have login successfully";
            echo "<script>alert('$message');</script>";
            header('Location: product_list.php');
        } else {
            header('Location: login.php');
            session_destroy();
        }
    } else {
        header('Location: login.php');
        session_destroy();
    }
}
?>

<html lang="en">

<head>
    <title>Web Design and Development</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--Bootstrap CSS File-->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <h1>TOKO KOMPUTER SEJATI</h1>
    </header>
    <main>
        <h2>Welcome, please log in first</h2>

        <form class="form" action="login.php" method="post">
            <table>
                <tr>
                    <td><label for="email">E-mail:</label></td>
                    <td><input class="input" type="email" id="email" name="email" placeholder="E-mail" maxlength="30"
                            required>
                    </td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input class="input" type="password" id="password" name="password" placeholder="Password"
                            maxlength="20" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button class="button" name="submit" id="submit" type="submit">Log IN</button></td>
                </tr>
            </table>
            <p>Don&apos;t have an account? <a href="register.php">Register</a></p>
        </form>
    </main>
</body>

</html>