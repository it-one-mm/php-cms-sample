<?php include_once 'includes/header.php'; ?>

<!-- Navigation -->
<?php include_once 'includes/nav.php'; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <!-- Blog Posts -->

            <?php

            if (isset($_GET['category_id'])):

                $category_id = $_GET['category_id'];
                
                $query = "SELECT * FROM posts WHERE category_id=$category_id AND post_status='published' ORDER BY post_id DESC LIMIT 5";

                $result = mysqli_query($con, $query);

                if (mysqli_num_rows($result) == 0) :
                    echo '<h2>There is no Posts.</h2>';
                else :
                    while ($row = mysqli_fetch_assoc($result)):

                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_image = $row['post_image'];
                    $post_date = $row['post_date'];
                    $post_body = $row['post_body'];
                    $post_author = $row['post_author'];
            ?>
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="<?php echo 'images/' . $post_image; ?>" alt="">
                <hr>
                <p>
                    <?php 
                        $continue = strlen($post_body) > 100 ? '...' : '';
                        echo substr($post_body, 0, 100) . $continue;      
                    ?>
                </p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            <?php
                    endwhile;
                endif;
            endif;
            ?>
            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">

            <?php include_once 'includes/sidebar.php'; ?>

        </div>

    </div>
    <!-- /.row -->

    <?php include_once 'includes/footer.php'; ?>