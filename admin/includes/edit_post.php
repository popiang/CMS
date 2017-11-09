<?php
    //
    //this page is called by posts.php along with post id to edit
    //
?>

<?php

    //check if source=edit in url
    if (isset($_GET['source']) && $_GET['source'] == 'edit') {

        $idToEdit = $_GET['id'];

        $sql = "select * from posts where post_id = '$idToEdit'";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die("Query failed. ".mysqli_error($conn));
        }

        //retrieve all the data for the post
        while ($row = mysqli_fetch_assoc($result)) {

            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];
            $post_content = $row['post_content'];
            $post_views_count = $row['post_views_count'];

        }
    }

    //check if update_post button is pressed
    if (isset($_POST['update_post'])) {

        //retrieve edited post data from the form
        $postTitle = escape($_POST['title']);
        $postCategory = escape($_POST['post_category_id']);
        $postAuthor = escape($_POST['post_author']);
        $postStatus = $_POST['post_status'];

        $postImage = $_FILES['image']['name'];
        $postImageTemp = $_FILES['image']['tmp_name'];

        $postTags = escape($_POST['post_tags']);
        $postContent = escape($conn, $_POST['post_content']);
        $postViewsCount = $_POST['post_views_count'];

        if (empty($postImage)) {
            $sql = "select * from posts where post_id = '$idToEdit'";
            $result = mysqli_query($conn, $sql);
            confirmQuery($result, $conn);
            while ($row = mysqli_fetch_array($result)) {
                $postImage = $row['post_image'];
            }
        }

        move_uploaded_file($postImageTemp, "../images/$postImage");

        //sql statement to update post base on post id
        $sql = "update posts set post_category_id = '$postCategory', post_title = '$postTitle',
               post_author = '$postAuthor', post_status = '$postStatus', post_date = now(), post_image = '$postImage',
               post_content = '$postContent', post_tags = '$postTags', post_views_count = '$postViewsCount' where post_id = $idToEdit";

        //sql statement is executed
        $result = mysqli_query($conn, $sql);

        //check if executed sql statement is successful
        confirmQuery($result, $conn);

        //direct back to post.php along with the edited post id
        header("Location: ./posts.php?edited_post_id=$idToEdit");

    }

?>

<h3>Edit Existing Post</h3>

<!-- Edit post form -->
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Title</label>
        <input class="form-control" type="text" name="title" value="<?php echo $post_title ?>">
    </div>

    <div class="form-group">
        <label for="post_category">Post Category</label><br>
        <select class="btn btn-default" name="post_category_id">

            <?php
                $sql = "select * from categories";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)) {
                    if($row['cat_id'] == $post_category_id) {
                        echo "<option value='{$row['cat_id']}' selected='selected'>{$row['cat_title']}</option>";
                    } else {
                        echo "<option value='{$row['cat_id']}'>{$row['cat_title']}</option>";
                    }
                }
            ?>

        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input class="form-control" type="text" name="post_author" value="<?php echo $post_author ?>">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label><br>
        <label class="radio-inline">
            <input type="radio" name="post_status" value="draft" <?php  if ($post_status == 'draft') echo "checked"; ?>>Draft
        </label>
        <label class="radio-inline">
            <input type="radio" name="post_status" value="published" <?php  if ($post_status == 'published') echo "checked"; ?>>Publish
        </label>
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_views_count">Post Views Count: </label> <p id="post_views_count_display" class="well well-sm" style="display:inline-block; font-weight:bold"><?php echo $post_views_count; ?></p>
        <button onclick="resetViews();" type="button" name="reset-views" class="btn btn-primary" style="display:block">Reset Views Count</button>
        <input id="post_views_count" type="hidden" name="post_views_count" value=<?php echo $post_views_count; ?>>
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input class="form-control" type="text" name="post_tags" value="<?php echo $post_tags ?>">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" rows="5"><?php echo $post_content ?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Submit Edited Post">
    </div>

</form>

<script type="text/javascript">

    //javascript function to reset to 0 the displayed post_views_count
    function resetViews() {
        document.getElementById('post_views_count_display').innerHTML = '0';
        document.getElementById('post_views_count').value = '0';
    }

</script>
