<?php
    //
    //the code in this page is used in posts.php
    //to delete post according to post id
    //
?>

<?php

    if ($_GET['source'] == 'delete') {

        //delete post base on id
        $idToDelete = $_GET['id'];
        $sql = "delete from posts where post_id = '$idToDelete'";
        $result = mysqli_query($conn, $sql);
        confirmQuery($result, $conn);

        //associated comments are also deleted
        $sql = "delete from comments where comment_post_id = $idToDelete";
        $result = mysqli_query($conn, $sql);
        confirmQuery($result, $conn);

    }

?>
