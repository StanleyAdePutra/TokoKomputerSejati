<!DOCTYPE html>

<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=komputer_db", "root", "");

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $_SESSION['errFile'] = "OK";

        if ($_SESSION['errFile'] = "OK") {
            //Insert to table user_data
            $query = "INSERT INTO data_customer (name, email, password) 
                VALUES (?,?,?)";

            $result = $conn->prepare($query);
            $result->execute([$name, $email, $password]);

            $message = "You have successfully registered";
            echo "<script>alert('$message');</script>";
            header('refresh:1; url=login.php');
        } else {
            $messagefail = "Your registration is failed, Try again";
            echo "<script>alert('$messagefail');</script>";
            header('Location: register.php');
        }
    }
} catch (Exception $e) {
    $message = "Account has been existed, please use other email";
    echo "<script>alert('$message');</script>";
    header('refresh:1; url=register.php');
    exit();
}
?>

<html lang="en">

<head>
    <title>Register</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <h1>TOKO KOMPUTER SEJATI</h1>
    </header>

    <main>
        <h2>Registration</h2>

        <form class="form" action="register.php" method="post" name="register" id="register">
            <table>
                <tr>
                    <td><label for="name">Name:</label></td>
                    <td><input class="input" type="text" id="name" name="name" placeholder="Name" maxlength="30"
                            pattern="[a-zA-Z]+" required></td>
                </tr>
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
                    <td><button class="button" name="submit" id="submit" type="submit">Register Now</button></td>
                </tr>
            </table>
            <p><a href="login.php">Back to login</a></p>
        </form>
    </main>
</body>

</html>