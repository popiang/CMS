<?php
    //
    //below code is called by editCategory() function in functions.php into categories.php
    //else part is executed first, then if part is executed when submit-update button is pressed
    //
?>


<?php

    //check if submit-update button from edit category form is pressed
    //update category base on category id
    if (isset($_POST['submit-update']))
    {
        $cat_id = $_POST['cat-id'];
        $new_cat_title = $_POST['cat-title'];
        $sql = "update categories set cat_title = '$new_cat_title' where cat_id = '$cat_id'";
        $result = mysqli_query($conn, $sql);
        if (!$result)
        {
            die("Query Failed ".mysqli_error($conn));
        }
    }
    else
    {
        //display edit category form and display existing category base on  category id
        $cat_id_to_edit = $_GET['edit'];
        $sql = "select * from categories where cat_id = '$cat_id_to_edit'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result))
        {
            $cat_title = $row['cat_title'];
            echo "<form action='categories.php' method='post'>
                    <input type='hidden' name='cat-id' value='{$cat_id_to_edit}'>
                    <div class='form-group'>
                        <label for='cat-title'>Update Category</label>
                        <input value='$cat_title' class='form-control' type='text' name='cat-title'>
                    </div>
                    <div class='form-group'>
                        <input class='btn btn-primary' type='submit' name='submit-update' value='Update Category'>
                    </div>
                  </form>";
        }
    }

?>
