<?php
    //
    //this page is called by users.php to edit user base on user id
    //
?>

<?php

    //check for _GET 'source' variable in url
    if(isset($_GET['source']) == 'edituser') {

        $user_id = $_GET['user_id'];
        $sql = "select * from users where user_id = $user_id";
        $result = mysqli_query($conn, $sql);
        confirmQuery($result, $conn);

        //retrieve user data to display on edit form
        while ($row = mysqli_fetch_assoc($result)) {

            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];

        }

    } else {
        header("Location: users.php");
    }

    //check if edit_user button is pressed
    if (isset($_POST['edit_user'])) {

        //retrieve all edited user data from the form
        $user_id = $_GET['user_id'];
        $username = $_POST['username'];
        $user_password = $_POST['user_password'];
        $user_rpassword = $_POST['retype_password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];

        if(!empty($user_password)) {

            $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost'=> 10));
            $sql = "update users set user_password = '{$user_password}' where user_id = '{$user_id}'";
            $result = mysqli_query($conn, $sql);
            confirmQuery($result, $conn);

        }


        //sql statement to update user data base on user id
        $sql = "update users set username = '{$username}', user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}',
                user_email = '{$user_email}', user_role = '{$user_role}' where user_id = $user_id";

        //execute the sql statement
        $result = mysqli_query($conn, $sql);

        //check if the executed sql statement is successfull
        confirmQuery($result, $conn);

        //direct page to users.php
        header("Location: users.php");

    }

?>

<h3>Edit User</h3>

<!-- Edit user form -->
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="username">Username</label>
        <input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
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
        <input class="form-control" type="text" name="user_firstname" value="<?php echo $user_firstname; ?>">
    </div>

    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input class="form-control" type="text" name="user_lastname" value="<?php echo $user_lastname; ?>">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input class="form-control" type="email" name="user_email" value="<?php echo $user_email; ?>">
    </div>

    <div class="form-group">
        <label for="user_role">Role</label><br>
        <select name="user_role" class="btn btn-default">
            <?php
                switch ($user_role) {
                    case 'admin':
                        echo '<option value="admin" selected="selected">Admin</option>';
                        echo '<option value="subscriber">Subscriber</option>';
                        break;

                    case 'subscriber':
                        echo '<option value="admin">Admin</option>';
                        echo '<option value="subscriber" selected="selected">Subscriber</option>';
                        break;
                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
    </div>

</form>
