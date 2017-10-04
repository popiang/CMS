<?php include "includes/header.php" ?>

<?php

    $sql = "select count(*) from posts";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("QUERY FAILED. ".mysqli_error($conn));
    }
    $pages = mysqli_fetch_field($result);
    echo "$pages";

?>

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php
                    $sql = "select * from posts where post_status = 'published'";
                    $result = mysqli_query($conn, $sql);
                    $result_row_num = mysqli_num_rows($result);

                    if($result_row_num < 1) {
                        echo "<h2>Sorry, no posts available</h2>";
                    } else {

                        $sql = "select * from posts";
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

                                <h1 class="page-header">
                                    Page Heading
                                    <small>Secondary Text</small>
                                </h1>

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
                                <hr>
                                <p><?php echo $post_content; ?></p>
                                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

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

        <hr>

<!-- Footer -->
<?php include "includes/footer.php" ?>
