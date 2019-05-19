<?php
/*signup validation*/
if (isset($_POST["submit"])) {
    include_once 'connect.php';
    //getting data from form and escaping any code that can result into sql injection
    $firstName = $_POST["firstname"];
    $lastName = $_POST["lastname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $confirmpwd = $_POST["confirm"];
    $username = $_POST["username"];

    //error handling
    //checking for empty feilds 
    if (empty($firstName) || empty($lastName) || empty($email) || empty($phone) || empty($password) || empty($username)) {
        header("Location:../signup.php?signup=empty");
        //checking if firstname and last name have vallid characters
    } elseif (!preg_match("/^[a-zA-Z]*$/", $firstName) || !preg_match("/^[a-zA-Z]*$/", $lastName)) {
        header("Location:../signup.php?signup=invalid1");
        exit();
        //checking valid useername
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location:../signup.php?signup=invalid2");
        exit();
        //checking valid ugandan phone number
    } elseif (!preg_match("/^[0][7]\d{8}$/", $phone)) {
        header("Location:../signup.php?signup=invalidphone");
        exit();
        //checking password is Minimum eight characters, at least one uppercase letter, one lowercase letter and one number
    } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $password)) {
        header("Location:../signup.php?signup=invalidpassword");
        exit();
        //checking valid email
    } elseif ($password !== $confirmpwd) {
        //checking if passwords match 
        header("Location:../signup.php?signup=passwordsdontmatch");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location:../signup.php?signup=invalidemail");
        exit();
    } else {
        //checking if username exists
        $sql = "SELECT * FROM user WHERE username = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location:../signup.php?signup=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location:../signup.php?signup=usernametaken");
                exit();
            } else {
                $sql = "INSERT INTO user(firstName,lastName,phone,email,password,username) VALUES (?,?,?,?,?,?)";
                //hashing password
                $hashedpwd = password_hash($password, PASSWORD_DEFAULT);
                //insert user into the database
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location:../signup.php?signup=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "ssssss", $firstName, $lastName, $phone, $email, $hashedpwd, $username);
                    mysqli_stmt_execute($stmt);
                    header("Location:../signup.php?signup=success");
                }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
} else {
    header("Location:../signup.php?signup=error");
    exit();
}
//dont forget to close the database connection
//check if username isadmin
//check if password has both low and uppercase
