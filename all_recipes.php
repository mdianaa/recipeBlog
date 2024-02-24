<?php

session_start();
include('db.php');
include('header.php');

$query = "SELECT recipes.id AS recipe_id, title, `image`, ingredients, instructions, username 
    FROM recipes INNER JOIN users ON recipes.user_id = users.id";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        echo '<div id="recipe">';
        echo '<h2 id="recipeTitle">' . $row['title'] . '</h2>';
        echo '<p> <img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="' . $row['title'] . '"></p>';
        echo '<p><strong>Ingredients:</strong> ' . $row['ingredients'] . '</p>';
        echo '<p><strong>Instructions:</strong> ' . $row['instructions'] . '</p>';
        echo '<p>Created by: ' . $row['username'] . '</p>';
        echo '</div>';

    } else {
        // If there are multiple recipes, display each recipe on a separate page
        $recipe_array = array();

        while ($row = $result->fetch_assoc()) {
            // Generate a new page for each recipe
            array_push($recipe_array, '<strong><a href="recipe.php?id=' . $row['recipe_id'] . '" class="link-">' . $row['title'] . '</a></strong><br>');
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<body>

    <div id="all_recipes">
        <h2>All Recipes:</h2>
        <?php 
            foreach ($recipe_array as $recipe) {
                echo '- ' . $recipe;
            }
        ?>
    </div>

    <script>
        document.getElementById("menu").addEventListener("click", function() {
            document.getElementById("all_recipes").innerHTML = "";
        });
    </script>

</body>
</html>