<?php
include_once "header.php";
?>
<section class="main_container">
    <div class="main_wrapper">
        <h2>Home</h2>
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['signup'] == "invalid10") {
                echo '<p class="error">Please click logout button</p>';
            }
        } ?>
    </div>
</section>
<?php
include_once "footer.php";
?>