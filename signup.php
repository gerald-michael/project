<?php
require_once 'header.php';
?>
<section class="main_container">
    <div class="main_wrapper">
        <h2>Sign up</h2>
        <form class="signup_form" action="includes_php/signup_inc.php" method="post">
            <input type="text" name="username" placeholder="Username" required="" />
            <input type="text" name="firstname" placeholder="Firstname" required="" />
            <input type="text" name="lastname" placeholder="Last name" required="" />
            <input type="email" name="email" required="" placeholder="email" />
            <input type="text" name="nin" placeholder="nin" required="" />
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