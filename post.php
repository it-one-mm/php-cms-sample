<?php include_once 'includes/header.php'; ?>

    <!-- Navigation -->
    <?php include_once 'includes/nav.php'; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <?php

                    if (isset($_GET['post_id'])) {
                        $post_id = $_GET['post_id'];
                        $query = "SELECT * FROM posts WHERE post_id=$post_id";
                       
                        $result = mysqli_query($con, $query);

                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);

                            $post_title = $row['post_title'];
                            $post_image = $row['post_image'];
                            $post_author = $row['post_author'];
                            $post_body = $row['post_body'];
                            $post_date = $row['post_date'];
                            $post_status = $row['post_status'];
                            $category_id = $row['category_id'];

                            ?>
<!-- Title -->
<h1><?php echo $post_title; ?></h1>

<!-- Author -->
<p class="lead">
    by <a href="#"><?php echo $post_author; ?></a>
</p>

<hr>

<!-- Date/Time -->
<p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>

<hr>

<!-- Preview Image -->
<img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">

<hr>

<!-- Post Content -->
<p><?php echo $post_body; ?></p>


                            <?php

                        } else {
                            redirect('./');
                        }

                        
                    } else {
                        redirect('./');
                    }

                ?>

                

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <?php
                        if (isset($_GET['post_id']) && isset($_POST['create_comment'])) {
                            $comment_user = $_POST['comment_user'];
                            $comment = $_POST['comment'];

                            $query = "INSERT INTO comments (post_id, comment_user, comment, comment_date) VALUES ({$post_id}, '{$comment_user}', '{$comment}', CURDATE())";

                            $result = mysqli_query($con, $query);
                            
                            confirm_query($result, 'Create Comment Failed!');
                            
                            $_SESSION['msg'] = 'Your Comment has been Submitted. Please Wait for the comment to be approved by admin.';

                            redirect("post.php?post_id=$post_id#comment");

                        }
                    ?>
                    <form role="form" method="post" id="comment">
                        <div class="form-group">
                            <input type="text" name="comment_user" class="form-control" placeholder="Type your user name...">
                        </div>
                        <div class="form-group">
                            <textarea name="comment" class="form-control" rows="3" placeholder="Comment..."></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                    
                    <?php 
                        if (isset($_SESSION['msg'])) {
                            $msg = $_SESSION['msg'];
                            unset($_SESSION['msg']);
                            echo '<p class="alert alert-info">'. $msg .'</p>';
                        }
                    ?>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php
                    $query = "SELECT * FROM comments WHERE comment_status='approved' ORDER BY comment_id DESC";
                    
                    $result = mysqli_query($con, $query);

                    while ($row = mysqli_fetch_assoc($result)):
                        $comment_user = $row['comment_user'];
                        $comment_date = $row['comment_date'];
                        $comment = $row['comment'];
                ?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_user; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment; ?>
                    </div>
                </div>
                        <?php
                    endwhile;
                ?>
                

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

               <?php include_once 'includes/sidebar.php'; ?>

            </div>

        </div>
        <!-- /.row -->

      <?php include_once 'includes/footer.php'; ?>
