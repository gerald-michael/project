<?php
if (isset($_POST["submit"])) {
    require_once 'connect.php';
    //getting data from form and escaping any code that can result into sql injection
    $firstName = mysqli_real_escape_string($conn, $_POST["firstname"]);
    $lastName = mysqli_real_escape_string($conn, $_POST["lastname"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $nin = mysqli_real_escape_string($conn, $_POST["nin"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $confirmpwd = mysqli_real_escape_string($conn, $_POST["confirm"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);

    //error handling
    //checking for empty feilds 
    if (empty($firstName) || empty($lastName) || empty($email) || empty($nin) || empty($phone) || empty($password) || empty($username)) {
        header("Location:../signup.php?signin=empty");
        //checking if firstname and last name have vallid characters
    } elseif (!preg_match("/^[a-zA-Z]*$/", $firstName) || !preg_match("/^[a-zA-Z]*$/", $lastName)) {
        header("Location:../signup.php?signin=invalid1");
        exit();
        //checking valid email
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location:../signup.php?signin=invalidemail");
        exit();
    } else {
        //checking if username exists
        $sql = "SELECT * FROM tenant WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
            header("Location:../signup.php?signin=usernametaken");
            exit();
        } elseif ($password != $confirmpwd) {
            //checking if passwords match
            header("Location:../signup.php?signin=passwordsdontmatch");
            exit();
        } else {
            //hashing password
            $hashedpwd = password_hash($password, PASSWORD_DEFAULT);
            //insert user into the database
            $sql = "INSERT INTO tenant(firstName,lastName,nin,email,password,username) VALUES ('$firstName','$lastName','$nin','$email','$hashedpwd','$username')";
            mysqli_query($conn, $sql);
            header("Location:../signup.php?signin=success");
            exit();
        }
    }
} else {
    header("Location:../signup.php?signin=error");
    exit();
}
//dont forget to close the database connection
//check if username isadmin
//check if password has both low and uppercase
