<?php
    //
    //this page displays the profile of the user in a form, ready to be edited if user wants to
    //
?>

<!-- Header -->
<?php include "includes/admin_header.php" ?>
<?php

    //check if _SESSION variable exists
    if (isset($_SESSION['username'])) {

        $username = $_SESSION['username'];

        //below codes retrieve user's data and populate in respective variables
        $sql = "select * from users where username = '$username'";
        $result = mysqli_query($conn, $sql);
        confirmQuery($result, $conn);
        while ($row = mysqli_fetch_assoc($result)) {

            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];

        }
    } else {
        //redirect to index.php upon unauthorized access
        header("Location: index.php");
    }

    //check if update_profile button is pressed
    if (isset($_POST['update_profile'])) {

        //retrieve all the data from the edit-user form
        $username = $_POST['username'];
        $user_password = $_POST['user_password'];
        $user_rpassword = $_POST['retype_password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];

        //sql statement to update user data in db
        $sql = "update users set username = '{$username}', user_password = '{$user_password}',
                user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}',
                user_email = '{$user_email}', user_role = '{$user_role}' where user_id = $user_id";

        //sql statement is executed
        $result = mysqli_query($conn, $sql);

        //check if executed sql statement is successfull
        confirmQuery($result, $sql);

        //direct to index.php
        header("Location: index.php");

    }

?>

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">
                            Welcome To Admin Page
                            <small>Subheading</small>
                        </h1>

                        <!-- Edit profile form -->
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
                                <input class="btn btn-primary" type="submit" name="update_profile" value="Edit Profile">
                            </div>

                        </form>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<!-- Footer -->
<?php include "includes/admin_footer.php" ?>
