<h1 class="page-header">
    View All Posts
</h1>

<?php

if (isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $postId) {
        $options = $_POST['bulk-options'];

        switch ($options) {
            case 'published':
                $query = "UPDATE posts SET post_status='published' WHERE post_id=$postId";
                confirm_query(mysqli_query($con, $query), 'Update post status to published failed!');
                break;

            case 'draft':
                $query = "UPDATE posts SET post_status='draft' WHERE post_id=$postId";
                confirm_query(mysqli_query($con, $query), 'Update post status to draft failed!');
        }
    }
}


$query = "SELECT * FROM posts ORDER BY post_id DESC";

$result = mysqli_query($con, $query);

confirm_query($result, 'Select Posts Failed!');

if (is_record_exist($result)) :
    ?>
        <form method="post">

            <div class="row">
                <div class="col-md-3">
                    <select class="form-control" name="bulk-options">
                        <option value="">--Select--</option>
                        <option value="published">Published</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
                <div class="col">
                    <input type="submit" class="btn btn-primary" value="Apply">
                </div>
            </div>

            <table class="table" id="table">


                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all-boxes"></th>
                        <th>#</th>
                        <th>Post Title</th>
                        <th>Post Image</th>
                        <th>Category</th>
                        <th>Post Author</th>
                        <th>Post Date</th>
                        <th>Post Status</th>
                        <th>Post Body</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($row = mysqli_fetch_assoc($result)) :
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_image = $row['post_image'];
                            $post_author = $row['post_author'];
                            $post_body = $row['post_body'];
                            $post_date = $row['post_date'];
                            $post_status = $row['post_status'];
                            $category_id = $row['category_id'];

                            $query = "SELECT category_name FROM categories WHERE category_id=$category_id";
                            $category_result = mysqli_query($con, $query);
                            $category_name = mysqli_fetch_assoc($category_result)['category_name'];
                            ?>

                        <tr>
                            <td>
                                <input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id; ?>">
                            </td>
                            <th scope="row">
                                <?php echo $post_id; ?>
                            </th>
                            <td>
                                <a href="posts.php?source=edit&id=<?php echo $post_id; ?>">
                                    <?php echo $post_title; ?>
                                </a>
                            </td>
                            <td>
                                <img src="../images/<?php echo $post_image; ?>" width="150" />
                            </td>
                            <td>
                                <?php echo $category_name; ?>
                            </td>
                            <td>
                                <?php echo $post_author; ?>
                            </td>
                            <td>
                                <?php echo $post_date; ?>
                            </td>
                            <td>
                                <!-- <a href="posts.php?status=<?php // echo $post_status; 
                                                                        ?>&post_id=<?php // echo $post_id; 
                                                                                            ?>"><?php // echo ucfirst($post_status); 
                                                                                                                            ?></a> -->

                                <a data-status="<?php echo $post_status; ?>" data-id="<?php echo $post_id; ?>" class="post-status-link" href="#"><?php echo ucfirst($post_status); ?></a>
                            </td>
                            <td>
                                <?php
                                        $continue = strlen($post_body) > 50 ? '...' : '';
                                        echo substr($post_body, 0, 50) . $continue;
                                        ?>
                            </td>

                            <td>
                                <form method="post">
                                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>" />
                                    <button type="submit" class="btn btn-danger" name="delete_post">Delete</button>
                                </form>
                            </td>
                        </tr>

                    <?php endwhile; ?>
                </tbody>
            </table>
        </form>

        <script>
            let table = document.getElementById('table');

            table.addEventListener('click', function(e) {
                // console.log(e.target);
                e.preventDefault();

                if (e.target && e.target.matches('a.post-status-link')) {
                    

                    const status = e.target.dataset.status;
                    const postId = e.target.dataset.id;

                    var xhr = new XMLHttpRequest();

                    xhr.open("GET", "includes/_updatePost.php?status=" + status + "&postId=" + postId);

                    xhr.onreadystatechange = function() {
                        if (this.readyState === 4 && this.status === 200) {
                            e.target.innerHTML = titleCase(this.responseText);
                        }
                    }

                    xhr.send();
                }
            });

            function titleCase(string) {
                var sentence = string.toLowerCase().split(" ");
                for (var i = 0; i < sentence.length; i++) {
                    sentence[i] = sentence[i][0].toUpperCase() + sentence[i].slice(1);
                }
                return sentence.join(" ");
            }

        </script>
    <?php
    else :
        echo '<h2>There is no Posts.</h2>';
    endif;

    if (isset($_GET['status'])) {
        $post_id = $_GET['post_id'];
        $status = $_GET['status'];

        if ($status === 'draft') {
            $query = "UPDATE posts SET post_status='published' WHERE post_id=$post_id";
        } else {
            $query = "UPDATE posts SET post_status='draft' WHERE post_id=$post_id";
        }

        $result = mysqli_query($con, $query);
        confirm_query($result, 'UPDATE post_status failed!');
        redirect('posts.php');
    }

    if (isset($_POST['delete_post'])) {
        $post_id = $_POST['post_id'];

        $query = "DELETE FROM posts WHERE post_id=$post_id";

        $result = mysqli_query($con, $query);

        confirm_query($result, 'Delete Post Failed!');

        redirect('posts.php');
    }
