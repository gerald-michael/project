<?php

session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>
    </title>
    <link rel='stylesheet' type='text/css' href='css/main.css'>
</head>

<body>
    <header>
        <nav>
            <div class="main-wrapper">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                </ul>
                <div class="nav_login">
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo '<form action="includes_php/logout.php" method="POST">
                        <button type="submit" name="submit">logout</button></form>';
                    } else {
                        echo '<form action="includes_php/signin_inc.php" method="post">
                        <input type="text" name="username" placeholder="username/email">
                        <input type="password" name="password" placeholder="password">
                        <button type="submit" name="submit">Login</button></form><a href="signup.php">Sign up</a>';
                    }
                    ?>
                </div>
            </div>
        </nav>
    </header>