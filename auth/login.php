<?php // GalaxyCode Panel v1.0 by Marek_p

if(isset($_POST["submit"])) {

    $form_username = $_POST["username"];
    $form_password = $_POST["password"];
    
    // Připojení k MySQL databázi (více v souboru db.php ve složce includes)
    $db_hostname = "x";
    $db_username = "x";
    $db_password = "x";
    $db_database = "x";

    $conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);

    if ($conn->connect_error) {
        die("[ERROR] Nepodařilo se spojit s databází! <br> " . $conn->connect_error);
    }

    $sql = "SELECT * FROM `users` WHERE `username`='$form_username' AND `password`='$form_password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {

            session_start();

            $_SESSION["isloggedin"] = 1;

            $_SESSION["username"] = $row["username"];
            $_SESSION["password"] = $row["password"];
            $_SESSION["kredit"] = $row["credit"];
            $_SESSION["rank"] = $row["rank"];
            $_SESSION["id"] = $row["id"];

            if($row["rank"] == "admin") {
                header("Location: ../admin/index.php");
            } elseif($row["rank"] == "user") {
                header("Location: ../client/index.php");
            }
        }
    } else {
        echo "<h1 class='error'>Přístup odepřen!</h1>";
    }
}
?>
<html lang="cs"> <!-- Jazyk -->
<head>

    <!-- ##### Hlavičky ##### -->

    <meta charset="UTF-8"> <!-- Encoding -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Kompatibilita -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsibilita -->
    <link rel = "icon" href="images/logo.png" type ="image/x-icon">  <!-- Ikona v Kartě Prohlížeče -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Fa Ikony -->
    <link rel="stylesheet" href="../css/login.css"> <!-- Import CSS Souboru -->
    <title>GalaxyCode | Login</title> <!-- Jméno Karty v Prohlížeči -->

    <!-- ##### Konec Hlavičky ####### -->

</head>
<body>
    
<div class="content">
    <form action="login.php" method="post">
        <h1>Přihlášení</h1>
        <input type="text" name="username" placeholder="🤵Jméno" required><br>
        <input type="password" name="password" placeholder="🔒Heslo" required><br>
        <input type="submit" name="submit" value="Přihlásit se">
    </form>
</div>

</body>

<?php include("../includes/colors.php") ?>

</html>
