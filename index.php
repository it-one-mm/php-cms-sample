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

                $query = "SELECT * FROM posts WHERE post_status='published' ";

                $result = mysqli_query($con, $query);
                
                $total_record = mysqli_num_rows($result); // 7
                $page_per_record = 3;

                $pages = ceil($total_record / $page_per_record); // 3

                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }

                if ($page == '' || !is_numeric($page)) {
                    $page = 1;
                }
                
                $offset = ($page * $page_per_record) - $page_per_record;
                


$query = "SELECT * FROM posts WHERE post_status='published' ORDER BY post_id DESC LIMIT {$offset}, {$page_per_record}";

                $result = mysqli_query($con, $query);

                if ($total_record == 0) :
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
                    <a href="post.php?post_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?post_id=<?php echo $post_id; ?>">
                    <img class="img-responsive" src="<?php echo 'images/' . $post_image; ?>" alt="">
                </a>
                <hr>
                <p>
                    <?php 
                        $continue = strlen($post_body) > 100 ? '...' : '';
                        echo substr($post_body, 0, 100) . $continue;      
                    ?>
                </p>
                <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            <?php
                    endwhile;
                endif;
            ?>

          
            <!-- Pager -->
            <ul class="pagination">
            <?php
            if($page != 1){
                ?>
                <li class="enabled">
                    <a href="index.php" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
                </li>
            <?php } ?>

                <?php
                    for($i = 1; $i <= $pages; $i++) {
                        
                ?>

                        <li class="<?php echo $i == $page ? 'active' : '' ?>">
                            <a href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>

                        
                <?php
                    }
                    if($page != $pages){
                ?>  
                        <li class="enabled">
                            <a href="index.php?page=<?php echo $pages; ?>" aria-label="Previous"><span aria-hidden="true">»</span></a>
                        </li>
                <?php 
                    } 

                
                ?>
                
            </ul>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">

            <?php include_once 'includes/sidebar.php'; ?>

        </div>

    </div>
    <!-- /.row -->

    <?php include_once 'includes/footer.php'; ?>