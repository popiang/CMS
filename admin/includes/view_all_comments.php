
<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response To</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

        <?php
            $sql = "select * from comments";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {

                $comment_id = $row['comment_id'];
                $comment_post_id = $row['comment_post_id'];
                $comment_author = $row['comment_author'];
                $comment_content = $row['comment_content'];
                $comment_email = $row['comment_email'];
                $comment_status = $row['comment_status'];
                $comment_date = $row['comment_date'];

                echo "<tr>";
                echo "<td>{$comment_id}</td>";
                echo "<td>{$comment_author}</td>";
                echo "<td>{$comment_content}</td>";
                echo "<td>{$comment_email}</td>";
                echo "<td>{$comment_status}</td>";

                $sql_post = "select * from posts where post_id = $comment_post_id";
                $sql_post_result = mysqli_query($conn, $sql_post);

                if(!$sql_post_result) {
                    die("QUERY FAILED. ".mysqli_error($conn));
                }

                while ($row = mysqli_fetch_assoc($sql_post_result)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                }

                echo "<td>{$comment_date}</td>";
                echo "<td><a href='comments.php?approve=$comment_id'>Approve<a/></td>";
                echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove<a/></td>";
                echo "<td><a onClick=\"javascript: return confirm('Are you sure want to delete the comment?');\" href='comments.php?delete=$comment_id'>Delete<a/></td>";
                echo "</tr>";

            }
        ?>

    </tbody>
</table>

<?php

    if (isset($_GET['approve'])) {
        $comment_id = $_GET['approve'];
        $sql = "update comments set comment_status = 'approved' where comment_id = $comment_id";
        $result = mysqli_query($conn, $sql);
        confirmQuery($result, $conn);
        header("Location: comments.php");
    }

    if (isset($_GET['unapprove'])) {
        $comment_id = $_GET['unapprove'];
        $sql = "update comments set comment_status = 'unapproved' where comment_id = $comment_id";
        $result = mysqli_query($conn, $sql);
        confirmQuery($result, $conn);
        header("Location: comments.php");
    }

    if (isset($_GET['delete'])) {
        $comment_id = $_GET['delete'];
        $sql = "delete from comments where comment_id = $comment_id";
        $result = mysqli_query($conn, $sql);
        confirmQuery($result, $conn);

        $sql = "update posts set post_comment_count = post_comment_count - 1 where post_id = $comment_post_id";
        $result = mysqli_query($conn, $sql);
        confirmQuery($result, $conn);

        header("Location: comments.php");
    }

?>
