<?php
    //
    //this page is to add post to db
    //
?>

<?php

    //checking if create_post button is pressed
    if (isset($_POST['create_post'])) {

        //retrieving all the data from the form
        $postTitle = $_POST['title'];
        $postCategory = $_POST['post_category'];
        $postAuthor = $_POST['post_author'];
        $postStatus = $_POST['post_status'];

        $postImage = $_FILES['image']['name'];
        $postImageTemp = $_FILES['image']['tmp_name'];

        $postTags = $_POST['post_tags'];
        $postContent = mysqli_real_escape_string($conn, $_POST['post_content']);
        $postDate = date('y-m-d');

        move_uploaded_file($postImageTemp, "../images/$postImage");

        //sql statement to insert data into db
        $sql = "insert into posts (post_category_id, post_title, post_author, post_date,
                post_image, post_content, post_tags, post_status)
                values ({$postCategory}, '{$postTitle}', '{$postAuthor}', '{$postDate}',
                '{$postImage}', '{$postContent}', '{$postTags}', '{$postStatus}')";

        //sql statement executed
        $result = mysqli_query($conn, $sql);

        //checking if sql statement successful
        confirmQuery($result, $conn);

        //retreive the id of the inserted data
        $added_post_id = mysqli_insert_id($conn);

        //direct page to posts.php along with the id of the added post
        header("Location: posts.php?added_post_id={$added_post_id}");

    }

?>

<h3>Add New Post</h3>

<!-- Add new post form -->
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Title</label>
        <input class="form-control" type="text" name="title">
    </div>

    <div class="form-group">
        <label for="post_category">Post Category</label><br>
        <select class="btn btn-default" name="post_category">

            <?php
                $sql = "select * from categories";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['cat_id']}'>{$row['cat_title']}</option>";
                }
            ?>

        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input class="form-control" type="text" name="post_author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label><br>
        <label class="radio-inline">
            <input type="radio" name="post_status" value="draft" checked>Draft
        </label>
        <label class="radio-inline">
            <input type="radio" name="post_status" value="published">Publish
        </label>
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input class="form-control" type="text" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" rows="5"></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Submit Post">
    </div>

</form>
