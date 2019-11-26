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
                            $source = '';
                            if (isset($_GET['source'])) {
                                $source = $_GET['source'];
                            }

                            switch ($source) {
                                case 'add':
                                    include_once 'includes/add-post.php';
                                break;
                                case 'edit':
                                    include_once 'includes/edit-post.php';
                                break;
                                default:
                                    include_once 'includes/view-all-posts.php';
                            }
                        
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

   <?php include_once 'includes/footer.php'; ?>