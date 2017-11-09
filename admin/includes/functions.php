<?php
    //
    //this page contains a lot of functions called by many part of the website
    //
?>


<?php

function escape($string) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($string));
}

function usersOnline($conn) {

    $session = session_id();
    $time = time();
    $time_out_in_seconds = 30;
    $time_out = $time - $time_out_in_seconds;

    $sql = "select * from users_online where session = '$session'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if($count == null) {
        mysqli_query($conn, "insert into users_online (session, time) values ('$session', '$time')");
    } else {
        mysqli_query($conn, "update users_online set time = '$time' where session = '$session'");
    }

    $result = mysqli_query($conn, "select * from users_online where time > '$time_out'");
    return $users_online_count = mysqli_num_rows($result);

}

//this function is to check if a sql statement is executed successfully
function confirmQuery($result, $conn) {
    if (!$result) {
        die("Query Failed. ".mysqli_error($conn));
    }
}

//this function add new category into the db
function addCategory($conn) {

    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat-title'];
        if(empty($cat_title)) {
            echo "This field should not be empty";
        } else {
            $sql = "insert into categories (cat_title) values ('$cat_title')";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die("Query failed ".mysqli_error($conn));
            }
        }
    }
}

//this function displays all the categories
function displayCategories($conn) {

    $sql = "select * from categories";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>$cat_id</td>";
        echo "<td>$cat_title</td>";
        echo "<td><a onClick=\"javascript: return confirm('Are you sure want to delete the category?');\" href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }
}

//this function delete category base on category id
function deleteCategory($conn) {

    if (isset($_GET['delete'])) {
        $cat_id_to_delete = $_GET['delete'];
        $sql = "delete from categories where cat_id = '$cat_id_to_delete'";
        $result = mysqli_query($conn, $sql);
        header("Location: categories.php");
    }
}

//this function checks for _GET 'edit' variable in the url or if submit-update buttonis pressed
//then include the edit_category.php page
function editCategory() {
    global $conn;
    if (isset($_GET['edit']) || isset($_POST['submit-update'])) {
        include "includes/edit_category.php";
    }
}
