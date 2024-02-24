<?php

session_start();
include('db.php');
include('header.php');

// check if the form is submitted using the POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // try to find user with this username
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $error = "Username already exists. Choose a different username.";
    } else {
        // hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // register user
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
        $conn->query($query);

        $_SESSION['username'] = $username;
        // redirect
        header('Location: home.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<body>

<h1 id="login_title">Register</h1>
    <div id="login_form">
        
        <form action="register.php" method="post">
            <strong>Username: </strong><input type="text" name="username" required><br><br>
            <strong>Password: </strong><input type="password" name="password" required><br><br>
            <input type="submit" value="Register" class="form_button">
        </form>

        <br>

        <h6><strong>Already have an account? </strong><a href="login.php" class="link-"><strong>Login here</strong></a></h6>
        <p><?php echo $error; ?></p>
    </div>

<script>
    document.getElementById("menu").addEventListener("click", function() {
        document.getElementById("login_title").innerHTML = "";
        document.getElementById("login_form").innerHTML = "";
    });
</script>
</body>
</html>
