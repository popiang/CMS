<?php
    //
    //this page display all the users in the db
    //
?>

<!-- All users table -->
<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>

        <?php
            //sql query to retrieve all users
            $sql = "select * from users";

            //execute above sql query
            $result = mysqli_query($conn, $sql);

            //check if sql query successfull
            confirmQuery($result, $conn);

            //retrieve user data and display it in users table
            while ($row = mysqli_fetch_assoc($result)) {

                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_password = $row['user_password'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_image = $row['user_image'];
                $user_role = $row['user_role'];

                echo "<tr>";
                echo "<td>{$user_id}</td>";
                echo "<td>{$username}</td>";
                echo "<td>{$user_firstname}</td>";
                echo "<td>{$user_lastname}</td>";
                echo "<td>{$user_email}</td>";
                echo "<td>{$user_role}</td>";
                echo "<td><a href='users.php?toadmin=$user_id'>Admin<a/></td>";
                echo "<td><a href='users.php?tosubscriber=$user_id'>Subscriber<a/></td>";
                echo "<td><a href='users.php?source=edituser&user_id=$user_id'>Edit<a/></td>";
                echo "<td><a onClick=\"javascript: return confirm('Are you sure want to delete the user?');\" href='users.php?delete=$user_id'>Delete<a/></td>";
                echo "</tr>";

            }
        ?>

    </tbody>
</table>

<?php

    //update user_role to admin
    if (isset($_GET['toadmin'])) {
        $user_id = $_GET['toadmin'];
        $sql = "update users set user_role = 'admin' where user_id = $user_id";
        $result = mysqli_query($conn, $sql);
        confirmQuery($result, $conn);
        header("Location: users.php");
    }

    //update user_role to subscriber
    if (isset($_GET['tosubscriber'])) {
        $user_id = $_GET['tosubscriber'];
        $sql = "update users set user_role = 'subscriber' where user_id = $user_id";
        $result = mysqli_query($conn, $sql);
        confirmQuery($result, $conn);
        header("Location: users.php");
    }

    //delete user base onid
    if (isset($_GET['delete'])) {
        $user_id = $_GET['delete'];
        $sql = "delete from users where user_id = $user_id";
        $result = mysqli_query($conn, $sql);
        confirmQuery($result, $conn);
        header("Location: users.php");
    }

?>
