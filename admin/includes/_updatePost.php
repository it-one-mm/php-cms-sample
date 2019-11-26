<?php

require_once '../../includes/db.php';

if (isset($_GET['status']) && isset($_GET['postId'])) {
    $status = $_GET['status'];
    $post_id = $_GET['postId'];

    if ($status === 'draft') {
        $query = "UPDATE posts SET post_status='published' WHERE post_id=$post_id";
    } else if ($status === 'published') {
        $query = "UPDATE posts SET post_status='draft' WHERE post_id=$post_id";
    }

    $result = mysqli_query($con, $query);

    if ($result) {
        echo $status === 'draft' ? 'published' : 'draft';
    } else {
        echo 'Update Failed';
    }
    
}