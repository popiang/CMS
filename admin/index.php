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
                            <?php
                                $username = $_SESSION['username'];
                            ?>
                            <small><?php echo $username; ?></small>
                        </h1>
                    </div>
                </div>

                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                            $sql = "select * from posts where post_status = 'published'";
                                            $result = mysqli_query($conn, $sql);
                                            confirmQuery($result, $conn);
                                            $posts_count = mysqli_num_rows($result);
                                        ?>
                                        <div class='huge'><?php echo $posts_count; ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                            $sql = "select * from comments where comment_status = 'approved'";
                                            $result = mysqli_query($conn, $sql);
                                            confirmQuery($result, $conn);
                                            $comments_count = mysqli_num_rows($result);
                                        ?>
                                        <div class='huge'><?php echo $comments_count; ?></div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                            $sql = "select * from users where user_role = 'admin'";
                                            $result = mysqli_query($conn, $sql);
                                            confirmQuery($result, $conn);
                                            $users_count = mysqli_num_rows($result);
                                        ?>
                                        <div class='huge'><?php echo $users_count; ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                            $sql = "select * from categories";
                                            $result = mysqli_query($conn, $sql);
                                            confirmQuery($result, $conn);
                                            $categories_count = mysqli_num_rows($result);
                                        ?>
                                        <div class='huge'><?php echo $categories_count; ?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- /.row -->

                <div class="row">

                    <?php
                        $sql = "select * from posts where post_status = 'draft'";
                        $result = mysqli_query($conn, $sql);
                        confirmQuery($result, $conn);
                        $post_draft_count = mysqli_num_rows($result);

                        $sql = "select * from comments where comment_status = 'unapproved'";
                        $result = mysqli_query($conn, $sql);
                        confirmQuery($result, $conn);
                        $comments_unapproved_count = mysqli_num_rows($result);

                        $sql = "select * from users where user_role = 'subscriber'";
                        $result = mysqli_query($conn, $sql);
                        confirmQuery($result, $conn);
                        $user_subscriber_count = mysqli_num_rows($result);
                    ?>

                    <script type="text/javascript">

                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {

                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],

                            <?php

                                $element_title = ['Active Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscriber', 'Categories'];
                                $element_count = [$posts_count, $post_draft_count, $comments_count, $comments_unapproved_count, $users_count, $user_subscriber_count, $categories_count];

                                for ($i = 0; $i < 7; $i++) {
                                    echo "['{$element_title[$i]}', $element_count[$i]],";
                                }

                            ?>

                            // ['Posts', 1000],
                            ]);

                        var options = {
                            chart: {
                            title: '',
                            subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
                        chart.draw(data, google.charts.Bar.convertOptions(options));

                    }

                    </script>

                    <div id="columnchart_material" style="width: auto; height: 500px;"></div>

                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<!-- Footer -->
<?php include "includes/admin_footer.php" ?>
