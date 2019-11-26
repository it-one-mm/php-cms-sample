<h1 class="page-header">
    Edit Post
</h1>

<?php

    if (isset($_GET['id']) && isset($_GET['source']) && $_GET['source'] === 'edit') {
        $post_id = $_GET['id'];  

        if (!isset($_POST['edit_post'])) {
        
            $query = "SELECT * FROM posts WHERE post_id=$post_id";

            $result = mysqli_query($con, $query);

            $row = mysqli_fetch_assoc($result);

            $post_title = $row['post_title'];
            $post_edit_image = $row['post_image'];
            $post_category_id = $row['category_id'];
            $post_author = $row['post_author'];
            $post_body = $row['post_body'];
            $post_status = $row['post_status'];

        }

    } else {
       redirect('posts.php'); 
    }

    if (isset($_POST['edit_post'])) {
        $category_id = $_POST['category_id'];
        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];
        $post_body = $_POST['post_body'];
        $post_status = $_POST['post_status'];

        $post_image = '';
        if ( $_FILES['post_image']['size'] > 0 ) {
            $post_image = uniqid() . '-' . $_FILES['post_image']['name'];
            $tmp_name = $_FILES['post_image']['tmp_name'];
    
            if (!move_uploaded_file($tmp_name, '../images/' . $post_image)) {
                echo '<div class="alert alert-warning">Upload Failed.</div>';
                exit;
            }
        }

        $query = "UPDATE posts SET ";
        $query .= "post_title='$post_title', ";
        if ($post_image)
            $query .= "post_image='$post_image', ";
        $query .= "post_author='$post_author', ";
        $query .= "post_status='$post_status', ";
        $query .= "post_body='$post_body', ";
        $query .= "category_id={$category_id} WHERE post_id=$post_id";

        $result = mysqli_query($con, $query);

        confirm_query($result, 'Update Post Failed! <br>' . $query . '<br>');

        redirect('posts.php');
    }
    
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input id="post_title" name="post_title" 
            type="text" class="form-control" 
            value="<?php echo $post_title; ?>">
    </div>
    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" class="form-control">
            <?php
                $query = "SELECT * FROM categories;";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_assoc($result)):
                    $category_id = $row['category_id'];
                    $category_name = $row['category_name'];
            ?>
                    <option value="<?php echo $category_id; ?>" <?php echo $category_id === $post_category_id ? 'selected' : ''; ?>>
                        <?php echo $category_name; ?>
                    </option>
                    
            <?php
                endwhile;
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image" id="post_image" />
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input id="post_author" name="post_author" type="text" class="form-control"
            value="<?php echo $post_author; ?>">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" id="post_status" class="form-control">
            <option value="draft" <?php echo $post_status === 'draft' ? 'selected' : '' ?>>Draft</option>
            <option value="published" <?php echo $post_status === 'published' ? 'selected' : '' ?>>Published</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_body">Post Body</label>
        <textarea name="post_body" id="post_body" class="form-control" cols="30" rows="10"><?php echo $post_body; ?></textarea>
    </div>
    <button type="submit" name="edit_post" class="btn btn-primary">Update Post</button>
</form>