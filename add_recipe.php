<?php

session_start();
include('db.php');
include('header.php');

// if there is no logged in user - redirect to log in page 
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

// check if the form is submitted using the POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = htmlspecialchars($conn->$_POST['title']);
    $ingredients = htmlspecialchars($conn->$_POST['ingredients']);
    $instructions = htmlspecialchars($conn->$_POST['instructions']);
    $username = $_SESSION['username'];

    $image = $_FILES['photo']['tmp_name'];
    $imageData = file_get_contents($image); // read image file contents
    $imageData = $conn->real_escape_string($imageData);

    // rget user id as a separate query
    $query = "SELECT id FROM users WHERE username='$username'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $user_id = $row['id'];

    // insert recipe details into the database
    $query = "INSERT INTO recipes (user_id, title, ingredients, instructions, `image`) 
              VALUES ('$user_id', '$title', '$ingredients', '$instructions', '$imageData')";
    $conn->query($query);

    // redirect
    header('Location: home.php');
}
?>

<!DOCTYPE html>
<html lang="en">
    <body>

    <h1 class="title" id="add_recipe_title">Add Recipe</h1>
        <div id="recipe_form">
            
            <form action="add_recipe.php" method="post" enctype="multipart/form-data">
                <label for="photo"><strong>Select Recipe Photo:</strong></label> <br><br>
                <input type="file" name="photo" accept="image/*" required><br><br>
                <label for="title"><strong>Title:</strong></label> <br>
                <input type="text" name="title" required><br><br>
                <label for="ingredients"><strong>Ingredients:</strong></label> <br>
                <textarea name="ingredients" rows="4" cols="50" required></textarea><br><br>
                <label for="instructions"><strong>Instructions:</strong></label> <br>
                <textarea name="instructions" rows="4" cols="50" required></textarea><br><br>
                <input type="submit" value="Add Recipe" class="form_button">
            </form>
        </div>

    </body>

    <script>
        document.getElementById("menu").addEventListener("click", function() {
            document.getElementById("add_recipe_title").innerHTML = "";
            document.getElementById("recipe_form").innerHTML = "";
        });
    </script>
</html>
