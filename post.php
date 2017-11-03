<?php include "includes/header.php" ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php
                    if(isset($_GET['p_id'])) {
                        $post_id = $_GET['p_id'];

                        $sql = "update posts set post_views_count = post_views_count + 1 where post_id = $post_id";
                        $result = mysqli_query($conn, $sql);
                        if(!$result) {
                            die("QUERY FAILED" . mysqli_error($conn));
                        }

                        $sql = "select * from posts where post_id = '$post_id'";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = $row['post_content'];

                ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- Blog Post -->
                <h2>
                    <?php echo $post_title; ?>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>

                <?php
                        }
                    } else {
                        header("Location: index.php");
                    }
                ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Blog Comments -->

        <?php

            if (isset($_POST['comment_submit'])) {

                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];
                $post_id = $_GET['p_id'];

                if (empty($comment_author) || empty($comment_email) || empty($comment_content)) {
                    echo "<script>alert('Fields cannot be empty')</script>";
                } else if (!filter_var($comment_email, FILTER_VALIDATE_EMAIL)) {
                    echo "<script>alert('Invalid email address')</script>";
                } else {

                    $sql = "insert into comments (comment_post_id, comment_author, comment_email,
                    comment_content, comment_status, comment_date) values ($post_id, '{$comment_author}',
                    '{$comment_email}', '{$comment_content}', 'unapproved', now())";

                    $result = mysqli_query($conn, $sql);

                    if (!$result) {
                        die("QUERY FAILED. ".mysqli_error($conn));
                    }

                    // $sql = "update posts set post_comment_count = post_comment_count + 1 where post_id = $post_id";
                    // $result = mysqli_query($conn, $sql);

                    if (!$result) {
                        die("QUERY FAILED. ".mysqli_error($conn));
                    }

                }
            }

        ?>

        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>
            <form action="" method="post" role="form">
                <div class="form-group">
                    <label for="comment-author">Author</label>
                    <input class="form-control" type="text" name="comment_author">
                </div>
                <div class="form-group">
                    <label for="comment-email">Email</label>
                    <input class="form-control" type="email" name="comment_email">
                </div>
                <div class="form-group">
                    <label for="comment-content">Your Comment</label>
                    <textarea class="form-control" rows="3" name="comment_content"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="comment_submit">Submit</button>
            </form>
        </div>

        <hr>

        <!-- Posted Comments -->

        <?php

            $sql = "select * from comments where comment_post_id = $post_id and comment_status = 'approved' order by comment_id desc";
            $result = mysqli_query($conn, $sql);
            if(!$result) {
                die("QUERY FAILED. ".mysqli_error($conn));
            }
            while ($row = mysqli_fetch_assoc($result)) {
                $c_author = $row['comment_author'];
                $c_email = $row['comment_email'];
                $c_content = $row['comment_content'];

            ?>

            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $c_author; ?>
                        <small><?php echo $c_email; ?></small>
                    </h4>
                    <?php echo $c_content; ?>
                </div>
            </div>

            <?php
            }

        ?>





<!-- Footer -->
<?php include "includes/footer.php" ?>
