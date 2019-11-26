<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./">CMS</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                    <?php
                        if (isset($_SESSION['user_role'])) {
                            ?>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li role="separator" class="divider"></li>
            <li><a href="includes/logout.php">Logout</a></li>
          </ul>
        </li>
                    <?php  if ($_SESSION['user_role'] === 'admin'): ?>
                            <li>
                                <a href="admin/">Admin</a>
                            </li>
                    <?php
                            endif;
                        } else {
                    ?>
                        <li>
                            <a href="register.php">Register</a>
                        </li>
                        <li>
                            <a href="login.php">Login</a>
                        </li>
                    <?php
                        }
                    ?>
                    
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>