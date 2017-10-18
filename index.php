<?php include "includes/header.php" ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <?php
                    $sql = "select * from posts where post_status = 'published'";
                    $result = mysqli_query($conn, $sql);
                    $result_row_num = mysqli_num_rows($result);

                    if($result_row_num < 1) {
                        echo "<h2>Sorry, no posts available</h2>";
                    } else {

                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }

                        $post_count_query = "select * from posts";
                        $result = mysqli_query($conn, $post_count_query);
                        $post_count = mysqli_num_rows($result);
                        $post_count_to_display = ceil($post_count / 10);

                        $post_limit = ($page * 10 - 10);
                        $sql = "select * from posts limit $post_limit, 10";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = substr($row['post_content'], 0, 200);
                            $post_status = $row['post_status'];

                            if($post_status == 'published') {

                                ?>

                                <!-- Blog Post -->
                                <h2>
                                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                                </h2>
                                <p class="lead">
                                    by <a href="author.php?author=<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
                                </p>
                                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>
                                <hr>
                                <a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive" src="images/<?php echo $post_image ?>" alt=""></a>
                                <p><?php echo $post_content; ?></p>
                                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                                <hr><br>

                    <?php
                            }
                        }
                    }
                    ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <ul class="pager">
            <?php
                if ($post_count_to_display > 1) {
                    echo "<hr>";
                    for ($i = 1; $i <= $post_count_to_display ; $i++) {
                        if ($i == $page) {
                            echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
                        } else {
                            echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                        }
                    }
                }
            ?>
        </ul>

<!-- Footer -->
<?php include "includes/footer.php" ?>
