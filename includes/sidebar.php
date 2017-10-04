<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

    <!-- Login Well -->
    <?php
        if(!isset($_SESSION['username'])) {
            echo "
            <div class='well'>
                <h4>Login</h4>
                <form action='includes/login.php' method='post'>
                    <div class='form-group'>
                        <input name='username' type='text' class='form-control' placeholder='Username'>
                    </div>
                    <div class='input-group'>
                        <input name='password' type='password' class='form-control' placeholder='Password'>
                        <span class='input-group-btn'>
                            <button class='btn btn-primary' type='submit' name='submit-login'>Login</button>
                        </span>
                    </div>
                </form>
                <!-- /.input-group -->
            </div>
            ";
        }
    ?>

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="submit">
                        <span class="glyphicon glyphicon-search"></span>
                </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">

                    <?php
                        $sql = "select * from categories";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $cat_id = $row['cat_id'];
                            $category = $row['cat_title'];
                            echo "<li><a href='category.php?cat_id=$cat_id'>$category</a></li>";
                        }
                    ?>

                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "includes/widget.php" ?>

</div>
