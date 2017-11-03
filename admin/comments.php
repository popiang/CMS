<?php
    //
    //this page displays all comments in the db
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

                            //checking for _GET 'p_id' variable
                            if (!isset($_GET['p_id'])) {

                                //display all comments
                                include 'includes/view_all_comments.php';

                            } else {

                                //get the post_id
                                $post_id = $_GET['p_id'];

                                //display comments for the post_id
                                include 'includes/view_post_comments.php';

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
