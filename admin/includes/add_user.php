<?php
    //
    //this page is to add user to db
    //
?>

<?php

    //check if add_user button is pressed
    if (isset($_POST['add_user'])) {

        //retrieve all the data
        $username = $_POST['username'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $password = $_POST['user_password'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];

        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));

        //sql statement to insert user data to table
        $sql = "insert into users (username, user_password, user_firstname, user_lastname,
                user_email, user_role) values ('{$username}', '{$password}', '{$user_firstname}',
                 '{$user_lastname}', '{$user_email}', '{$user_role}')";

        //sql statement executed
        $result = mysqli_query($conn, $sql);

        //checking if sql statement successfull
        confirmQuery($result, $conn);

        //direct page to users.php
        header("Location: users.php");

    }

?>

<h3>Add New User</h3>

<!-- Add user form -->
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="username">Username</label>
        <input class="form-control" type="text" name="username">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input class="form-control" type="password" name="user_password">
    </div>

    <div class="form-group">
        <label for="retype_password">Retype Password</label>
        <input class="form-control" type="password" name="retype_password">
    </div>

    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input class="form-control" type="text" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input class="form-control" type="text" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input class="form-control" type="email" name="user_email">
    </div>

    <div class="form-group">
        <label for="user_role">Role</label><br>
        <select name="user_role" class="btn btn-default">
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="add_user" value="Add User">
    </div>

</form>
