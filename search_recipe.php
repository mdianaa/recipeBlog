<?php

session_start();
include('db.php');
include('header.php');

// check if the form is submitted using the POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recipe_title = strtolower($_POST['recipe_title']);

    // find user with this username
    $query = "SELECT recipes.id AS recipe_id, title, `image`, ingredients, instructions, username 
    FROM recipes INNER JOIN users ON recipes.user_id = users.id WHERE LOWER(title) LIKE '%$recipe_title%'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {

        $recipe_array = array();

        while ($row = $result->fetch_assoc()) {
            // Generate a new page for each recipe
            array_push($recipe_array, '<strong><a href="recipe.php?id=' . $row['recipe_id'] . '" class="link-">' . $row['title'] . '</a></strong><br>');
        }

    } else {
        $error_response = "No recipe name found that includes the key word \"" . $recipe_title . "\".";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<body>

<h1 class="title" id="recipe_title">Search Recipe</h1>
    <div class="search_form" id="form">   
            
        <form method="post" action="search_recipe.php" id="form">
            <input type="text" name="recipe_title" required><br>
            <br>
            <input type="submit" value="Search" id="serach_button"><br>
            <br>

            <?php 
            foreach ($recipe_array as $recipe) {
                echo '- ' . $recipe;
            }
            ?>
            
            <p style="width: 50%;"><strong><?php echo $error_response?></strong><p>
        </form>
    </div>

    <script>
        document.getElementById("menu").addEventListener("click", function() {
            document.getElementById("recipe_title").innerHTML = "";
            document.getElementById("form").innerHTML = "";
            document.getElementById("recipe").innerHTML = "";
        });
    </script>
</body>
</html>