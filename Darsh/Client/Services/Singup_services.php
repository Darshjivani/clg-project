<?php
require_once 'DB/connetction.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"],PASSWORD_DEFAULT);

    $sql = "INSERT INTO user_details VALUES ('$name', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        header("Location: Dashboard");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>