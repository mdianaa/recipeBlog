<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "book_for_cook";

// create mysql connection
$conn = new mysqli($servername, $username, $password, $database);

if (!$conn) {
    echo"Cannot connect to data base!";
} 
// else {
//     echo"Connected to the Recipe DB!";
// }

?>
