<?php

session_start();

if (isset($_POST["submit"])) {
    include 'connect.php';
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $username = mysqli_real_escape_string($conn, $_POST["username"]);

    //error handlers
    //check if inputs are empty
    if (empty($username) || empty($password)) {
        header("Location:../index.php?signin=empty");
        exit();
    } else {
        $sql = "SELECT * FROM tenant WHERE username = '$username';";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck < 1) {
            header("Location:../index.php?signin=error");
            exit();
        } else {
            if ($row = mysqli_fetch_assoc($result)) {
                //deharshing password
                $harsedpwdcheck = password_verify($pwd, $row['password']);
                if ($harsedpwdcheck == false) {
                    header("Location:../index.php?signin=error3");
                    exit();
                } elseif ($harsedpwdcheck == true) {
                    //login user
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['firstName'] = $row['firstName'];
                    $_SESSION['lastName'] = $row['lastName'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['tenantId'] = $row['tenantId'];
                    header("Location:../index.php?signin=success");
                    exit();
                }
            }
        }
    }
} else {
    header("Location:../index.php?signin=error");
    exit();
}
