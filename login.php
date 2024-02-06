<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $pw = $_POST['password'];
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "table users";
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }
    $query = "SELECT * FROM login WHERE username=? AND password =?";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }
    $stmt->bind_param("ss", $username, $pw);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
       // header("Location: http://localhost/thrine-html/TABIB/2index/index.html");
        header("Location: success.html");
        exit();
    } else {
        header("Location: http://localhost/error.html");
        exit();
    }
    $stmt->close();

    $conn->close();
}
?>
