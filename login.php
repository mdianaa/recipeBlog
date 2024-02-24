<?php

session_start();
include('db.php');
include('header.php');

// check if the form is submitted using the POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // find user with this username
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // get the first (and only) line from result 
        $row = $result->fetch_assoc();
        // password verification
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            // redirect
            header('Location: home.php');
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "Invalid username.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<body>

<h1 id="login_title">Login</h1>
    <div id="login_form">
        <form method="post" action="login.php">
            <strong>Username: </strong><input type="text" name="username" required><br><br>
            <strong>Password: </strong><input type="password" name="password" required><br><br>
            <input type="submit" value="Log in" class="form_button">
        </form>

        <br>
        
        <h6><strong>Don't have an account yet? </strong><a href="register.php" class="link-"><strong>Register here</strong></a></h6><br>
        <p><strong><?php echo $error; ?></strong></p>
    </div>
</body>

<script>
    document.getElementById("menu").addEventListener("click", function() {
        document.getElementById("login_title").innerHTML = "";
        document.getElementById("login_form").innerHTML = "";
    });
</script>

</html>
