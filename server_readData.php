<?php
$servername = "localhost";
$username = "id22059027_nith";
$password = "Nithish10515@";
$database = "id22059027_logins";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {

    $sql = "SELECT * FROM users";

    if ($result = $conn->query($sql)) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Assuming there's a column called 'name' in your 'users' table
                echo "Name: " . $row['name'] . " Time: ".$row['logged_in']."<br>";
                // You can output other columns similarly
            }
        } else {
            echo "No records found";
        }
        $result->free(); // Free result set
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
