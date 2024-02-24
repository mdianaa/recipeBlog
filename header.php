<?php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $logoutLink = '<strong><a href="logout.php" class="link-">Log Out</a><strong>';
    $loginLink = ''; // no need to show Login link if already logged in
    $registerLink = ''; // no need to show Register link if already logged in
    $addRecipeLink = '<a href="add_recipe.php" class="link-">Add recipe</a>';
} else {
    $username = 'Guest';
    $logoutLink = ''; // no need to show Logout link if there is no logged in user
    $loginLink = '<strong><a href="login.php" class="link-">Login</a></strong>';
    $registerLink = '<strong><a href="register.php" class="link-">Register</a></strong>';
    $addRecipeLink = ''; // no need to show Add Recipe link if there is no logged in user
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book for Cook</title>

    <link rel="stylesheet" type="text/css" href="projectStyle.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <link rel="icon" href="cookingBookIcon.png" type="image/x-icon">

</head>
<body>

    <nav class="navbar navbar-light">
        <button class="btn btn-outline-light" id="leftButton" type="button" data-bs-toggle="collapse" 
        data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        <img id="menuIcon" src="cookingBookIcon.png" alt="menuIcon">
            <div id="menu"><strong>Menu</strong></siv>
        </button>

        <div id="header">
            <h1 id="title">Book for Cook</h1>
            <h4 id="moto">Hello, <?php echo $username; ?>! Choose from the delicious meals collected in the menu.</h4>
        </div>

        <button class="btn btn-outline-light" id="rightButton" type="button"><img id="addIcon" src="addIcon.png" alt="addIcon">
            <div id="search"><strong>Search Recipe</strong></div>
        </button>

    </nav>

    <div class="collapse" id="collapseExample" class="alt-grid">
        <div class="card card-body">
            <ul type="none">
                <nav>
                    <li><a href="home.php" class="link-">Home</a></li>
                    <li><?php echo $addRecipeLink; ?></li>
                    <li><a href="all_recipes.php" class="link-">View All Recipes</a></li>
                    <li><?php echo $loginLink; ?></li>
                    <li><?php echo $registerLink; ?></li>
                    <li><?php echo $logoutLink; ?></li>
                </nav>
            </ul>
        </div>
    </div> 

    <div class="container">
        <img src="fork.png" alt="fork" id="fork">
        <img src="knife.png" alt="knife" id="knife">
        <img src="woodenPlate.png" alt="plate" id="plate">
    </div>

    <script>
        document.getElementById("search").addEventListener("click", function() {
            window.location.href = "search_recipe.php";
        });
    </script>

</body>

</html>