<?php
    //
    //this page displays all categories id db admin_header
    //also the form to add new category
    //
?>


<!-- Header -->
<?php include "includes/admin_header.php" ?>

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">
                            Welcome To Admin Page
                            <small>Subheading</small>
                        </h1>

                        <div class="col-xs-6">

                            <?php //call addCategory() function from functions.php to display add category form ?>
                            <?php addCategory($conn); ?>

                            <?php //call deleteCategory() function from functions.php to delete category ?>
                            <?php deleteCategory($conn); ?>

                            <!-- Add category form -->
                            <form action="categories.php" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Add Category</label>
                                    <input class="form-control" type="text" name="cat-title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>

                            <?php //call editCategory() function from functions.php to edit existing category ?>
                            <?php editCategory($conn); ?>

                        </div>

                        <!-- Table displaying all categories available in db -->
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>Category</th>
                                </thead>
                                <tbody>

                                    <?php //call displayCategories() function from functions.php to display all categories ?>
                                    <?php displayCategories($conn); ?>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<!-- Footer -->
<?php include "includes/admin_footer.php" ?>
