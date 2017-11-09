<?php
    //
    //this page displays all the users in the db
    //
?>

<!-- Header -->
<?php include "includes/admin_header.php" ?>

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

                        <?php
                            //checking for _GET 'source' variable
                            if (isset($_GET['source'])) {
                                $source = $_GET['source'];
                            } else {
                                $source = "";
                            }

                            //choose action base on the value of 'source' variable
                            switch ($source) {
                                case 'adduser':
                                    include 'includes/add_user.php';
                                    break;

                                case 'edituser':
                                    include 'includes/edit_user.php';
                                    break;

                                case 'deleteuser':
                                    include "includes/delete_user.php";
                                    include 'includes/view_all_users.php';
                                    break;

                                default:
                                    include 'includes/view_all_users.php';
                                    break;
                            }

                        ?>

                    </div>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<!-- Footer -->
<?php include "includes/admin_footer.php" ?>
