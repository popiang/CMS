<?php

function confirmQuery($result, $conn) {
    if (!$result) {
        die("Query Failed. ".mysqli_error($conn));
    }
}

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

function deleteCategory($conn) {

    if (isset($_GET['delete'])) {
        $cat_id_to_delete = $_GET['delete'];
        $sql = "delete from categories where cat_id = '$cat_id_to_delete'";
        $result = mysqli_query($conn, $sql);
        header("Location: categories.php");
    }
}

function editCategory() {
    global $conn;
    if (isset($_GET['edit']) || isset($_POST['submit-update'])) {
        include "includes/edit_category.php";
    }
}
