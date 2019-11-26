<?php include_once 'includes/header.php'; ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include_once 'includes/nav.php'; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    $query = "SELECT * FROM comments ORDER BY comment_id DESC";

                    $result = mysqli_query($con, $query);

                    confirm_query($result, 'SELECT Comments Failed!');

                    if (is_record_exist($result)) :
                        

                            ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Comment Post</th>
                                        <th>Comment User</th>
                                        <th>Comment Date</th>
                                        <th>Comment</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while ($row = mysqli_fetch_assoc($result)) :
                                            $comment_id = $row['comment_id'];
                                            $post_id = $row['post_id'];
                                            $comment_user = $row['comment_user'];
                                            $comment = $row['comment'];
                                            $comment_date = $row['comment_date'];
                                            $comment_status = $row['comment_status'];
                
                                            $query = "SELECT post_title FROM posts WHERE post_id=$post_id";
                
                                            $select_post_result = mysqli_query($con, $query);
                
                                            $row = mysqli_fetch_assoc($select_post_result);
                
                                            $post_title = $row['post_title'];
                                    ?>
                                    <tr>
                                        <th scope="row">
                                            <?php echo $comment_id; ?>
                                        </th>
                                        <td>
                                            <a href="../post.php?post_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                                        </td>
                                        <td>
                                        
                                            <?php echo $comment_user; ?>
                                      
                                        </td>
                                        <td>
                                            <?php echo $comment_date; ?>
                                        </td>
                                        <td>
                                            <?php echo $comment; ?>
                                        </td>
                                        <td>
                                            <a href="comments.php?status=<?php echo $comment_status; ?>&comment_id=<?php echo $comment_id; ?>"><?php echo $comment_status; ?></a>
                                        </td>
                                        <td>
                                           <a rel="<?php echo $comment_id ?>" class="delete-link btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                    <?php
                       
                    else :
                        echo '<h2>There is no comments.</h2>';
                    endif;
                    ?>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Are you sure you want to delete?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary modal-delete-link">Delete</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php include_once 'includes/footer.php'; ?>

<script>
    
    $(document).ready(function() {
        $('.delete-link').on('click', function(e) {
            e.preventDefault();
            const comment_id = $(this).attr('rel');
            const delete_url = 'comments.php?delete=' + comment_id;
            $('.modal-delete-link').attr('href', delete_url);
            $('#myModal').modal('show');
        });
    });

    // let deleteBtns = document.querySelectorAll('.comment-delete-btn');

    // deleteBtns.forEach(function (btn) {
       
    //     btn.addEventListener('click', function (e) {
    //         e.preventDefault();
    //         const form = this.parentElement;
    //         const result = confirm('Are you sure you want to delete?');
    //         if (result)
    //             form.submit();
    //         else
    //             return;
    //     });
    // });

</script>

<?php

if (isset($_GET['delete'])) {
    $comment_id = $_GET['delete'];

    $query = "DELETE FROM comments WHERE comment_id=$comment_id";
    $result = mysqli_query($con, $query);
    confirm_query($result, 'Delete Comment Failed!');
    redirect('comments.php');

}

if (isset($_GET['status']) && isset($_GET['comment_id'])) {
    $comment_id = $_GET['comment_id'];
    $status = $_GET['status'];

    switch ($status) {
        case 'approved':
            $query = "UPDATE comments SET comment_status='unapproved' WHERE comment_id=$comment_id";
        break;
        case 'unapproved':
            $query = "UPDATE comments SET comment_status='approved' WHERE comment_id=$comment_id";
    }

    $result = mysqli_query($con, $query);
    confirm_query($result, 'Update Comment Failed!');
    redirect('comments.php');

}