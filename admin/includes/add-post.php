<h1 class="page-header">
    Add Post
</h1>

<?php
    if (isset($_POST['add_post'])) {
        $category_id = $_POST['category_id'];
        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];
        $post_body = $_POST['post_body'];

        if ( $_FILES['post_image']['size'] > 0) {
            $post_image = uniqid() . '-' . $_FILES['post_image']['name'];
            $tmp_name = $_FILES['post_image']['tmp_name'];
    
            if (!move_uploaded_file($tmp_name, '../images/' . $post_image)) {
                echo '<div class="alert alert-warning">Upload Failed.</div>';
                exit;
            }
        } else $post_image = 'placeholder-900x300.png';

        $query = "INSERT INTO posts (category_id, post_title, post_author, post_image, post_body, post_status, post_date) VALUES ($category_id,'{$post_title}', '{$post_author}', '{$post_image}', '{$post_body}', '{$post_status}', CURDATE())";

        $result = mysqli_query($con, $query);

        confirm_query($result, 'Insert Post Failed!');

        redirect('posts.php?source=add');
    }
    
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input id="post_title" name="post_title" type="text" class="form-control">
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
                    <option value="<?php echo $category_id; ?>">
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
        <input id="post_author" name="post_author" type="text" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" id="post_status" class="form-control">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_body">Post Body</label>
        <textarea name="post_body" id="post_body" class="form-control" cols="30" rows="10"></textarea>
    </div>
    <button type="submit" name="add_post" class="btn btn-primary">Add Post</button>
</form>