<?php

session_start();
include('db.php');
include('header.php');

    // randomly get one recipe from the database

    $query = "SELECT title, `image`, ingredients, instructions, username 
    FROM recipes INNER JOIN users ON recipes.user_id = users.id ORDER BY RAND() LIMIT 1";

    $result = $conn->query($query);

    if ($result && $result->num_rows == 1) {

        $row = $result->fetch_assoc();

        echo '<h2 id="try">Try this!</h2>';
        echo '<div id="recipe">';
        echo '<h2 id="recipe_title">' . $row['title'] . '</h2>';
        echo '<p> <img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="' . $row['title'] . '" id="recipe_picture"></p>';
        echo '<p><strong>Ingredients:</strong> ' . $row['ingredients'] . '</p>';
        echo '<p><strong>Instructions:</strong> ' . $row['instructions'] . '</p>';
        echo '<p><strong>Created by:</strong> ' . $row['username'] . '</p>';
        echo '</div>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <script>
        document.getElementById("menu").addEventListener("click", function() {
            document.getElementById("recipe").innerHTML = "";
            document.getElementById("try").innerHTML = "";
        });
    </script>
</body>
</html>