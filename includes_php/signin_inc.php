<?php

if (isset($_POST["submit"])) {
    include 'connect.php';
    $password = $_POST["password"];
    $username = $_POST["username"];

    //error handlers
    //check if inputs are empty
    if (empty($username) || empty($password)) {
        header("Location:../index.php?signin=empty");
        exit();
    } else {
        $sql = "SELECT * FROM user WHERE username = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location:../index.php?signin=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $passwordChk = password_verify($password, $row['password']);
                if ($passwordChk == false) {
                    header("Location:../index.php?signin=error");
                    exit();
                } elseif ($passwordChk == true) {
                    session_start();
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['email'] = $row['username'];
                    header("Location:../index.php?signin=succes");
                    exit();
                } else {
                    header("Location:../index.php?signin=error");
                    exit();
                }
            } else {
                header("Location:../index.php?signin=error");
                exit();
            }
        }
    }
} else {
    header("Location:../index.php?signin=error");
    exit();
}
