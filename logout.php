<?php
// ensure a session is started before destroying it!
session_start();
session_destroy();
// redirect to home page
header('Location: home.php');
?>
