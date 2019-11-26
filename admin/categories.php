<?php include_once 'includes/header.php'; ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include_once 'includes/nav.php'; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Categories
                        <!-- <small>Subheading</small> -->
                    </h1>
                    <div class="row">
                        <div class="col-lg-6">
                            <?php
                            $query = "SELECT * FROM categories";

                            $result = mysqli_query($con, $query);

                            confirm_query($result, 'Select Category Failed');

                            if (is_record_exist($result)) :
                                ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category Name</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while ($row = mysqli_fetch_assoc($result)) :
                                                $category_id = $row['category_id'];
                                                $category_name = $row['category_name'];
                                        ?>
                                            <tr>
                                                <th scope="row">
                                                    <?php echo $category_id; ?>
                                                </th>
                                                <td>
                                                    <a href="categories.php?source=edit&id=<?php echo $category_id; ?>">
                                                        <?php echo $category_name; ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <form method="post">
                                                        <input type="hidden" name="category_id" value="<?php echo $category_id; ?>" />
                                                        <button type="submit" class="btn btn-danger" name="delete_category">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>

                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            <?php
                            else :
                                echo '<h2>There is no Categories.</h2>';
                            endif;
                            ?>

                        </div>
                        <div class="col-lg-6">

                            <?php
                            if (isset($_POST['create_category'])) {
                                $category_name = $_POST['category_name'];
                                $query = "INSERT INTO categories (category_name) VALUES ('{$category_name}')";
                                $result = mysqli_query($con, $query);

                                confirm_query($result, 'Create Category Failed');

                                redirect("categories.php");
                            }
                            ?>

                            <h2>Create Category</h2>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="category_name">category name</label>
                                    <input id="category_name" name="category_name" type="text" class="form-control">
                                </div>
                                <button type="submit" name="create_category" class="btn btn-primary">Create</button>
                            </form>

                            <?php
                            if (isset($_GET['source']) && $_GET['source'] === 'edit') {

                                $category_id = $_GET['id'];

                                $query = "SELECT category_name FROM categories WHERE category_id=$category_id";

                                $result = mysqli_query($con, $query);

                                $row = mysqli_fetch_assoc($result);

                                $category_name = $row['category_name'];

                                if (isset($_POST['edit_category'])) {
                                    $category_name = $_POST['category_name'];

                                    $query = "UPDATE categories SET category_name = '$category_name' WHERE category_id=$category_id";

                                    $result = mysqli_query($con, $query);

                                    confirm_query($result, 'Update Category Failed');

                                    redirect('categories.php');
                                }

                            ?>
                                <h2>Edit Category</h2>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="category_name">category name</label>
                                        <input id="category_name" name="category_name" type="text" class="form-control" value="<?php echo $category_name; ?>">
                                    </div>
                                    <button type="submit" name="edit_category" class="btn btn-primary">Update</button>
                                </form>
                            <?php
                            }

                            ?>



                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include_once 'includes/footer.php'; ?>

<?php

if (isset($_POST['delete_category'])) {
    $category_id = $_POST['category_id'];

    $query = "DELETE FROM categories WHERE category_id=$category_id";

    $result = mysqli_query($con, $query);

    confirm_query($result, 'Delete Category Failed');

    redirect('categories.php');

}