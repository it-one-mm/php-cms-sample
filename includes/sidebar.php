<!-- Blog Search Well -->
<div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                        <div class="input-group">
                            <input type="text" name="search-value" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-default" name="search" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                            </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                <?php
                    $query = "SELECT * FROM categories";
                    $result = mysqli_query($con, $query);

                    while ($row = mysqli_fetch_assoc($result)):
                        $category_id = $row['category_id'];
                        $category_name = $row['category_name'];
                ?>

                                <li><a href="category.php?category_id=<?php echo $category_id; ?>"><?php echo $category_name; ?></a>
                                </li>
                    <?php endwhile; ?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>