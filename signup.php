<?php
require_once 'header.php';
?>
<section class="main_container">
    <div class="main_wrapper">
        <h2>Sign up</h2>
        <?php
        if (isset($_GET['signup'])) {
            if ($_GET['signup'] == "empty") {
                echo '<p class="error">Please fill in all fields</p>';
            } elseif ($_GET['signup'] == "invalid1") {
                echo '<p class="error">Names must contain only upper and lower case letters </p>';
            } elseif ($_GET['signup'] == "invalid2") {
                echo '<p class="error">Username must have only letters and numbers </p>';
            } elseif ($_GET['signup'] == "invalidphone") {
                echo '<p class="error">Input ugandan phone number only</p>';
            } elseif ($_GET['signup'] == "invalidpassword") {
                echo '<p class="error">password must be Minimum eight characters, at least one uppercase letter, one lowercase letter and one number</p>';
            } elseif ($_GET['signup'] == "invalidemail") {
                echo '<p class="error">Not a valid email</p>';
            } elseif ($_GET['signup'] == "passwordsdontmatch") {
                echo '<p class="error">password do not match</p>';
            } elseif ($_GET['signup'] == "sqlerror") {
                echo '<p class="error">failed to add result to database</p>';
            } elseif ($_GET['signup'] == "usernametaken") {
                echo '<p class="error">username already exists</p>';
            } elseif ($_GET['signup'] == "error") {
                echo '<p class="error">please submit form</p>';
            } elseif ($_GET['signup'] == "success") {
                echo '<p class="success">Account created successfully</p>';
            }
        }

        ?>
        <form class="signup_form" action="includes_php/signup_inc.php" method="post">
            <input type="text" name="username" placeholder="Username" required="" />
            <input type="text" name="firstname" placeholder="Firstname" required="" />
            <input type="text" name="lastname" placeholder="Last name" required="" />
            <input type="email" name="email" required="" placeholder="email" />
            <input type="text" name="phone" placeholder="phone number" required="" />
            <input type="password" name="password" placeholder="new password" required="" />
            <input type="password" name="confirm" placeholder="confirm password" required="" />
            <button type="submit" name="submit">Sign up</button>
        </form>
    </div>
</section>
<?php
require_once 'footer.php';
?>