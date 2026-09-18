    <?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "orbital_trens";
    $conn = mysqli_connect($host, $user, $password, $database, 3308);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>