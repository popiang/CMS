<?php
session_start();
include "dbh.php";

if(isset($_POST['submit-login'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "select * from users where username = '$username'";
    $result = mysqli_query($conn, $sql);

    if(!$result) {
        die("QUERY FAILED. ".mysqli_error($conn));
    }


    while ($row = mysqli_fetch_assoc($result)) {

        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
        $db_randSalt = $row['randSalt'];

    }

    $password = crypt($password, $db_randSalt);

    if (($username != $db_username) && ($password != $db_user_password)) {
        header("Location: ../index.php");
    } elseif (($username == $db_username) && ($password == $db_user_password)) {

        $_SESSION['username'] = $db_username;
        $_SESSION['user_firstname'] = $db_user_firstname;
        $_SESSION['user_lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;

        header("Location: ../admin");

    } else {
        header("Location: ../index.php?fuck=true");
    }
}
