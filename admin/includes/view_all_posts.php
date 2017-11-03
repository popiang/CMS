<?php
    //
    //this page displays all the posts
    //
?>

<?php

    //check for _GET 'added_post_id' variable in url
    if (isset($_GET['added_post_id'])) {
        $added_post_id = $_GET['added_post_id'];

        //display an alert stating 'Post Added!'
        echo "<p class='alert alert-success'>Post Added!   <a class='btn btn-success btn-xs'
             href='../post.php?p_id={$added_post_id}'>View Post</a> or <a class='btn btn-success btn-xs' href='posts.php?source=edit&id={$added_post_id}'>Edit Post</a></p>";
    }

    //check for _GET 'edited_post_id' variable in url
    if (isset($_GET['edited_post_id'])) {
        $edited_post_id = $_GET['edited_post_id'];

        //display an alert stating 'Post Updated!'
        echo "<p class='alert alert-success'>Post Updated!   <a class='btn btn-success btn-xs'
             href='../post.php?p_id={$edited_post_id}'>View Post</a> or <a class='btn btn-success btn-xs' href='posts.php?source=edit&id={$edited_post_id}'>Edit Post</a></p>";
    }

    //check if submit button is pressed and checkbox in the form is checked
    if (isset($_POST['submit']) && isset($_POST['checkBoxArray'])) {

        $checkBoxArray = $_POST['checkBoxArray'];

        foreach ($checkBoxArray as $checkBoxId) {

            $bulk_options = $_POST['bulk_options'];

            //choose action base on 'bulk_options' value
            switch ($bulk_options) {

                //set checked posts status to published
                case 'published':
                    $sql = "update posts set post_status = 'published' where post_id = $checkBoxId";
                    $result = mysqli_query($conn, $sql);
                    confirmQuery($result, $conn);
                    break;

                //set checked posts status to draft
                case 'draft':
                    $sql = "update posts set post_status = 'draft' where post_id = $checkBoxId";
                    $result = mysqli_query($conn, $sql);
                    confirmQuery($result, $conn);
                    break;

                //delete checked posts base on id
                case 'delete':
                    $sql = "delete from posts where post_id = $checkBoxId";
                    $result = mysqli_query($conn, $sql);
                    confirmQuery($result, $conn);

                    $sql = "delete from comments where comment_post_id = $checkBoxId";
                    $result = mysqli_query($conn, $sql);
                    confirmQuery($result, $conn);
                    break;

                //clone checked posts and add to db
                case 'clone':
                    $sql = "select * from posts where post_id = $checkBoxId";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($result);

                    $postTitle = $row['post_title'];
                    $postCategory = $row['post_category_id'];
                    $postAuthor = $row['post_author'];
                    $postStatus = $row['post_status'];
                    $postImage = $row['post_image'];
                    $postTags = $row['post_tags'];
                    $postContent = $row['post_content'];
                    $postDate = date('y-m-d');

                    $sql = "insert into posts (post_category_id, post_title, post_author, post_date,
                            post_image, post_content, post_tags, post_status)
                            values ({$postCategory}, '{$postTitle}', '{$postAuthor}', '{$postDate}',
                            '{$postImage}', '{$postContent}', '{$postTags}', '{$postStatus}')";

                    $result = mysqli_query($conn, $sql);
                    confirmQuery($result, $conn);

                    break;

            }
        }
    }

?>

<!-- form for bulk_options -->
<form action="" method="post">
    <div id="bulkOptionContainer" class="form-group col-xs-4">
        <select class="form-control" name="bulk_options" id="select-options">
            <option value="">Select Option</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
            <option value="clone">Clone</option>
        </select>
    </div>
    <div class="form-group col-xs-4">
        <input onclick="return checkDelete();" type="submit" name="submit" value="Apply" class="btn btn-success">
        <a class="btn btn-primary" href="posts.php?source=addpost">Add New</a>
    </div>
    <!-- <div class="table-responsive"> -->

    <!-- Table for all the posts -->
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center"><input id="selectAllBoxes" type="checkbox"></th>
                <th class="text-center">Id</th>
                <th class="text-center">Author</th>
                <th class="text-center">Title</th>
                <th class="text-center">Category</th>
                <th class="text-center">Status</th>
                <th class="text-center">Image</th>
                <th class="text-center">Tags</th>
                <th class="text-center">Comments</th>
                <th class="text-center">Date</th>
                <th class="text-center">Edit</th>
                <th class="text-center">Views Count</th>
            </tr>
        </thead>
        <tbody>

            <?php
                $sql = "select * from posts";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {

                    $post_id = $row['post_id'];
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_date = $row['post_date'];
                    $post_views_count = $row['post_views_count'];

                    echo "<tr>";
                    ?>
                          <td class="text-center"><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>
                    <?php
                    echo "<td class='text-center'>{$post_id}</td>";
                    echo "<td class='clickable' style='cursor:pointer' data-href='../author.php?author=$post_author'>{$post_author}</td>";
                    echo "<td class='clickable' style='cursor:pointer' data-href='../post.php?p_id=$post_id'>{$post_title}</td>";

                    $cat_query = "select * from categories where cat_id = '$post_category_id'";
                    $cat_result = mysqli_query($conn, $cat_query);
                    confirmQuery($cat_result, $conn);
                    while ($row = mysqli_fetch_assoc($cat_result)) {
                        echo "<td>{$row['cat_title']}</td>";
                    }

                    echo "<td class='text-center'>{$post_status}</td>";
                    echo "<td class='text-center'><img width='50' src='../images/$post_image' alt='images'></td>";
                    echo "<td>{$post_tags}</td>";

                    $comment_sql = "select * from comments where comment_post_id = '{$post_id}'";
                    $comment_result = mysqli_query($conn, $comment_sql);
                    $comment_count = mysqli_num_rows($comment_result);

                    echo "<td class='text-center clickable' style='cursor:pointer' data-href='./comments.php?p_id=$post_id'>{$comment_count}</td>";

                    echo "<td class='text-center'>{$post_date}</td>";
                    echo "<td class='text-center clickable' style='cursor:pointer' data-href='../post.php?p_id=$post_id'><a href='posts.php?source=edit&id=$post_id'>Edit<a/></td>";
                    echo "<td class='text-center'>{$post_views_count}</td>";
                    echo "</tr>";

                }
            ?>

        </tbody>
    </table>
    <!-- </div> -->
</form>

<script type="text/javascript">

    //check with user if really want to delete user
    function checkDelete() {
        var selected = document.getElementById('select-options').value;
        var confirmDelete = true;

        if (selected == 'delete') {
             confirmDelete = confirm("Are you sure want to delete the posts?");
        }
        return confirmDelete;
    }

    //link the row of the post table to post.php
    var elements = document.getElementsByClassName('clickable');
    for (var i = 0; i < elements.length; i++) {
        var element = elements[i];
        element.addEventListener('click', function() {
            var href = this.dataset.href;
            if (href) {
                window.location.assign(href);
            }
        });
    }

</script>
