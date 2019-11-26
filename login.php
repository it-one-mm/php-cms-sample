<?php include_once 'includes/header.php'; ?>

<!-- Navigation -->
<?php include_once 'includes/nav.php'; ?>

<!-- Page Content -->
<div class="container">

    <div class="row" style="min-height: calc(100vh - 300px);">

        <!-- Blog Entries Column -->
        <div class="col-md-6 col-md-offset-3">
            <h2 class="text-center">Login</h2>
            <hr>
            <?php

                $errors = [
                    'username' => '',
                    'password' => ''
                ];

                if (isset($_POST['login'])) {
                    $username = trim($_POST['username']);
                    $password = trim($_POST['password']);

                    if (empty($username)) {
                        $errors['username'] = 'Username cannot be empty!';
                    }

                    if (empty($password)) {
                        $errors['password'] = 'Password cannot be empty!';
                    }

                    if (!username_exists($username)) {
                        $errors['username'] = 'username and password does not match';
                    }

                    foreach ($errors as $key => $value) {
                        if ( !empty($value) )
                            echo '<div class="alert alert-danger">'. $value .'</div>';   
                    }

                    if (empty($errors['username']) && empty($errors['password'])) {

                        login_user($username, $password);
                    }

                }
            ?>

            <form method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" name="username" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" class="form-control">
                </div>
                <button type="submit" name="login" class="btn btn-block btn-primary">Login</button>
            </form>
        </div>
    
    </div>
    <!-- /.row -->

    <?php include_once 'includes/footer.php'; ?>