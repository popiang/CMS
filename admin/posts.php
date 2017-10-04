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

                            if (isset($_GET['source'])) {
                                $source = $_GET['source'];
                            } else {
                                $source = "";
                            }

                            switch ($source) {
                                case 'addpost':
                                    include 'includes/add_post.php';
                                    break;

                                case 'edit':
                                    include 'includes/edit_post.php';
                                    break;

                                case 'delete':
                                    include "includes/delete_post.php";
                                    include 'includes/view_all_posts.php';
                                    break;

                                default:
                                    include 'includes/view_all_posts.php';
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
