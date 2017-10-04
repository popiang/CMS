<?php

    if ($_GET['source'] == 'delete') {

        $idToDelete = $_GET['id'];
        $sql = "delete from posts where post_id = '$idToDelete'";
        $result = mysqli_query($conn, $sql);
        confirmQuery($result, $conn);

        $sql = "delete from comments where comment_post_id = $idToDelete";
        $result = mysqli_query($conn, $sql);
        confirmQuery($result, $conn);

    }

?>
