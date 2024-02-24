<?php
// Include database connection and any necessary functions
session_start();
include('db.php');
include('header.php');

// Check if the recipe ID is provided in the URL parameter
if (isset($_GET['id'])) {
    // Sanitize the recipe ID to prevent SQL injection
    $recipe_id = intval($_GET['id']);

    // Query the database to fetch the recipe details based on the provided ID
    $query = "SELECT recipes.id, title, `image`, ingredients, instructions, username 
    FROM recipes INNER JOIN users ON recipes.user_id = users.id WHERE recipes.id = $recipe_id";

    $result = $conn->query($query);

    // Check if the query was successful and if a recipe with the provided ID exists
    if ($result && $result->num_rows > 0) {
        // Fetch the recipe details
        $row = $result->fetch_assoc();

        echo '<div id="recipe">';
        echo '<h2 id="recipe_title">' . $row['title'] . '</h2>';
        echo '<p> <img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="' . $row['title'] . '" id="recipe_picture"></p>';
        echo '<p><strong>Ingredients:</strong> ' . $row['ingredients'] . '</p>';
        echo '<p><strong>Instructions:</strong> ' . $row['instructions'] . '</p>';
        echo '<p><strong>Created by:</strong> ' . $row['username'] . '</p>';
        echo '</div>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<body>
    <script>
        document.getElementById("menu").addEventListener("click", function() {
            document.getElementById("recipe").innerHTML = "";
        });
    </script>
</body>
</html>

