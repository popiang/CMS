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

                            <?php addCategory($conn); ?>

                            <?php deleteCategory($conn); ?>

                            <form action="categories.php" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Add Category</label>
                                    <input class="form-control" type="text" name="cat-title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>

                            <?php editCategory($conn); ?>

                        </div>

                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>Category</th>
                                </thead>
                                <tbody>

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
