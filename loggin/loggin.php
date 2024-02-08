if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $pw = $_POST['password'];
    $job= $_POST['job'];
    $id = $_POST['id'];
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "notrebase"; // Remplacez par le nom de votre base de données
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }
    $query = "SELECT * FROM employee WHERE username=? AND password=? AND job=? AND id=?  ";
    
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }
    $stmt->bind_param("ss", $username, $pw  , $job, $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        header("Location: http://localhost/log.php");
        exit();
    } else {
        header("Location: error.html");
        exit();
    }
    $stmt->close();

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="sty.css">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form action="loggin.php" name="myform" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
                <label for="username">Job</label>
                <input type="text" id="job" name="job" placeholder="Enter your job" required>
                <label for="username">Id</label>
                <input type="text" id="id" name="id" placeholder="Enter your Id" required>
            </div>
        
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Login">
            </div>
        </form>
    </div>
</body>
</html>
