<?php
    error_reporting(0);
    session_start();

    if(isset($_SESSION['userId'])){

    }
    else if(!isset($_SESSION['userId'])){
      header("Location: ../login/");
      exit();
    }

    $currentPage = 'Edit';
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="../css/style.css">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
        
        <title>theStory | Edit Post</title>
    </head>
    <body>

        <!-- Navbar -->
        <?php require '../components/navbar_alt.php'; ?>

        <!-- Form -->
        <div class="container-fluid">
            <form method="POST" id="post-form" action="../inc/update.inc.php" enctype="multipart/form-data">
                <input type="hidden" value="<?php echo $_GET['id']; ?>" name="post_id">
                <?php
                    require '../inc/dbh.inc.php';
                    $id = $_GET['id'];

                    $sql = "SELECT * FROM `archived_posts` WHERE post_id = '$id'";
                    $result = $conn->query($sql);

                    while($row = $result->fetch_assoc()):
                ?>
                <div class="row">
                    <input type="hidden" value="<?php echo $row['image']; ?>" name="imagePath">
                    <input type="hidden" value="<?php echo $row['media']; ?>" name="mediaPath">
                    <div class="col-md-6 offset-md-1 pt-4 pb-5">
                        <?php
                            if(isset($_GET['error'])){
                                if($_GET['error'] == 'emptyfields'){
                                    echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                            Please complete all fields!
                                          </div>';
                                }
                                else if($_GET['error'] == 'sql'){
                                    echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                            Database connection error!
                                          </div>';
                                }
                                else if($_GET['error'] == 'filesm'){
                                    echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                            File/s are too small!
                                          </div>';
                                }
                                else if($_GET['error'] == 'exists'){
                                    echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                            This file already exists. Change file name!
                                          </div>';
                                }
                                else if($_GET['error'] == 'mediaformat'){
                                    echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                            Invalid file format for addtional media content!
                                          </div>';
                                }
                                else if($_GET['error'] == 'imageformat'){
                                    echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                           Invalid file format for blog image!
                                          </div>';
                                }
                                else if($_GET['error'] == 'archivetitle'){
                                    echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                            Please enter a title for post!
                                          </div>';
                                }
                                else if($_GET['error'] == 'sqlexe'){
                                    echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                            Database Execution error!
                                          </div>';
                                }
                            }
                        ?>
                        <h2 class="pl-1 playfair text-oo-black">Edit Post</h2>
                        <div class="form-row col-12 mt-4">
                            <label for="image">
                                <div class="text-center text-primary">
                                    <i class="d-block fas fa-upload fa-2x"></i>    
                                    <span class="d-block pt-3">Click to Upload Image</span>
                                    <div class="text-orange mt-3 py-2 px-3" id="image-name-container"><?php echo $row['image'] ?></div>
                                </div>
                                <input class="form-control" type="file" name="image" id="image">
                            </label>
                        </div>
                        <div class="form-row col-12 mt-4">
                            <label for="title"></label>
                            <input type="text" name="title" value="<?php echo $row['title']; ?>" class="form-control" id="title" placeholder="Blog Title">
                        </div>
                        <div class="form-row col-12 mt-4">
                            <label for="content"></label>
                            <textarea class="form-control" value="" name="content" id="content" cols="30" rows="10" placeholder="Content"><?php echo $row['content']; ?></textarea>
                        </div>
                        <div class="form-row col-12 mt-4">
                            <label for="media">
                                <div class="text-center text-primary">
                                    <i class="d-block fas fa-upload fa-2x"></i>    
                                    <span class="d-block pt-3">Click to Upload File</span>
                                    <div class="text-orange mt-3 py-2 px-3" id="media-name-container"><?php echo $row['media'] ?></div>
                                </div>
                                <input class="form-control" style="display: none" type="file" name="media" id="media">
                            </label>
                        </div>
                        <div class="form-row col-12 mt-4">
                            <label for="more_content"></label>
                            <textarea class="form-control" name="more_content" id="more_content" cols="30" rows="10" placeholder="More Content"><?php echo $row['content_2']; ?></textarea>
                        </div>
                        <div class="form-row pl-2 mt-3">
                            <div class="col-5">
                                <select id="category_1" name="category_1" class="custom-select">
                                    <option selected value="">Category 1</option>
                                    <option <?php if($row['category_1'] == 'Food') echo 'selected'; ?> class="text-black" value="Food">Food</option>
                                    <option <?php if($row['category_1'] == 'Travel') echo 'selected'; ?> class="text-black" value="Travel">Travel</option>
                                    <option <?php if($row['category_1'] == 'Dessert') echo 'selected'; ?> class="text-black" value="Dessert">Dessert</option>
                                    <option <?php if($row['category_1'] == 'Lifestyle') echo 'selected'; ?> class="text-black" value="Lifestyle">Lifestyle</option>
                                    <option <?php if($row['category_1'] == 'Recipes') echo 'selected'; ?> class="text-black" value="Recipes">Recipes</option>
                                </select>
                            </div>
                            <div class="col-5">
                                <select id="category_2" name="category_2" class="custom-select">
                                    <option selected value="">Category 2</option>
                                    <option <?php if($row['category_2'] == 'Food') echo 'selected'; ?> class="text-black" value="Food">Food</option>
                                    <option <?php if($row['category_2'] == 'Travel') echo 'selected'; ?> class="text-black" value="Travel">Travel</option>
                                    <option <?php if($row['category_2'] == 'Dessert') echo 'selected'; ?> class="text-black" value="Dessert">Dessert</option>
                                    <option <?php if($row['category_2'] == 'Lifestyle') echo 'selected'; ?> class="text-black" value="Lifestyle">Lifestyle</option>
                                    <option <?php if($row['category_2'] == 'Recipes') echo 'selected'; ?> class="text-black" value="Recipes">Recipes</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row col-5 mt-3">
                            <label for="author"></label>
                            <input type="text" placeholder="Author" value="<?php echo $row['author']; ?>" name="author" class="form-control" id="author">
                        </div>
                        <div class="form-row col-3 mt-4">
                            <button type="submit" name="upload-post" class="btn btn-orange">Upload</button>
                        </div>
                    </div>

                    <div id="upload-post-form" class="col-md-5 pt-4 pb-5">
                        <div id="art-options" class="text-grey">
                            <h2 class="pb-2 playfair text-oo-black">Edit Options</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum incidunt ea porro vero numquam distinctio accusamus debitis fuga error totam.</p>
                            <button type="button" class="btn btn-blue">Preview</button>
                            <hr class="bg-info">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum incidunt ea porro vero numquam distinctio accusamus debitis fuga error totam.</p>
                            <button type="submit" name="archive-post" class="btn btn-green">Archive</button>
                            <hr class="bg-green">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum incidunt ea porro vero numquam distinctio accusamus debitis fuga error totam.</p>
                            <button type="submit" id="reset-btn" name="reset-post" class="btn btn-black">Reset</button>
                            <hr class="bg-black">
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </form>
        </div>

       <?php include '../components/footer.php'; ?>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

        <!-- Popper JS -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    
        <!-- Create JS -->
        <script type="text/javascript" src="../js/create.js"></script>
    </body>
</html>