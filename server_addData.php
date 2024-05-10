<?php

$servername = "localhost";//hostname
$username = "id22059027_nith";
$password = "Nithish10515@";
$database = "id22059027_logins";
$card = $_GET['carduid'];
$name = $_GET['name'];
date_default_timezone_set("Asia/Kolkata");
$logged_in = date('Y-m-d H:i:s');
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully"."<br>";
    echo "Card_uid: " . $card . "<br>";
    echo "name: " . $name . "<br>";
    $sql = "INSERT INTO users (card_uid, name, logged_in) VALUES ('$card', '$name', '$logged_in')";
    // echo "SQL Query: " . $sql;
    if ($conn->query($sql) === TRUE) {
        echo "New record added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();

?>
