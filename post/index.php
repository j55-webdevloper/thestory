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

        <!-- AOS Css -->
        <link rel="stylesheet" href="../css/aos.css">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
        
        <title>theStory | Single Post</title>
    </head>
    <body>
        
        <?php include '../components/navbar.php'; ?>

        <!-- Hero -->
        <?php
            $id = $_GET['id'];

            require '../inc/dbh.inc.php';
            $sql = "SELECT * FROM posts WHERE id = '".$id."';";
            $result = $conn->query($sql);

            while($row = $result->fetch_assoc()):
        ?>
        <div style="background: url('../media/<?php echo $row['image']; ?>'); background-repeat: no-repeat;  background-position: center; background-size: cover;" id="main-blog-image" class="container-fluid">
            <div class="overlay">
                <h1 data-aos="fade-up" data-aos-once="true" class="text-center"><strong class="playfair text-white"><?php echo $row['title']; ?></strong></h1>
            </div>
        </div>
        <?php endwhile; ?>

        <!-- Post -->
        <div class="container-fluid" id="post-area">
            <div class="row">
                <div id="categories-recents" class="col-md-4 mt-4">
                    <div data-aos="fade-up" data-aos-once="true">
                        <h4 class="mb-4"><strong class="playfair text-oo-black">Categories</strong></h4>
                        <?php include '../inc/count.inc.php'; ?>
                        <p class="text-oo-black">
                            <span>Food</span>
                            <span class="float-right text-grey-light">(<?php echo $foodCategory_1 + $foodCategory_2; ?>)</span>
                        </p>
                        <hr class="bg-grey-light">
                        <p>
                            <span>Travel</span>
                            <span class="float-right text-grey-light">(<?php echo $travelCategory_1 + $travelCategory_2; ?>)</span>
                        </p>
                        <hr class="bg-grey-light">
                        <p>
                            <span>Dessert</span>
                            <span class="float-right text-grey-light">(<?php echo $dessertCategory_1 + $dessertCategory_2; ?>)</span>
                        </p>
                        <hr class="bg-grey-light">
                        <p>
                            <span>Lifestyle</span>
                            <span class="float-right text-grey-light">(<?php echo $lifestyleCategory_1 + $lifestyleCategory_2; ?>)</span>
                        </p>
                        <hr class="bg-grey-light">
                        <p>
                            <span>Recipes</span>
                            <span class="float-right text-grey-light">(<?php echo $recipesCategory_1 + $recipesCategory_2; ?>)</span>
                        </p>
                    </div>
                    <div data-aos="fade-up" data-aos-once="true">
                        <h4 class="mb-4 mt-5"><strong class="playfair text-oo-black">Recent Blog</strong></h4>
                        <?php
                            require '../inc/dbh.inc.php';
                            $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT 3;";
                            $result = $conn->query($sql);

                            while($row = $result->fetch_assoc()):
                        ?>
                        <div class="row mb-4 pl-3">
                            <div style="background: url(../media/<?php echo $row['image'];?>); background-repeat: no-repeat; background-position: center; background-size: cover;" id="recent-blog-image" class="col-3">
                                
                            </div>
                            <div class="col-9">
                                <p><a href="http://localhost/thestory/post/?id=<?php echo $row['id']; ?>"><?php echo substr($row['content'], 0, 70); ?></a></p>
                                <?php
                                    $datetime = $row['post_time'];
                                    $dt = substr($datetime, 0, -9);
                                    $new_date = date("F j, Y", strtotime($dt));
                                ?>
                                <span class="text-grey"><i class="far fa-calendar-alt"></i> <small><?php echo $new_date; ?></small></span>
                                <span class="text-grey float-right"><i class="far fa-comment-alt"></i> <small>19</small></span>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
                <?php
                    $id = $_GET['id'];

                    require '../inc/dbh.inc.php';
                    $sql = "SELECT * FROM posts WHERE id = '".$id."';";
                    $result = $conn->query($sql);

                    while($row = $result->fetch_assoc()):
                ?>
                <div class="col-md-8">
                    <p class="text-grey mt-4">
                        <?php echo nl2br($row['content']); ?>
                    </p>
                    <?php
                        $imgFormats = array('png', 'jpeg', 'jpg', 'PNG', 'JPEG', 'JPG');
                        $vidFormats = array('AVI', 'MP4', 'avi', 'mp4');
                        
                        $media = $row['media'];
                        $secCon = pathinfo($row['media'], PATHINFO_EXTENSION);

                        if(in_array($secCon, $imgFormats)){
                            echo '<img id="" src="../media/' . $media . '" class="img-fluid media" alt="">';
                        }
                        else if(in_array($secCon, $vidFormats)){
                            echo '<div class="mx-auto"><video width="640" height="360" controls>
                                    <source src="../media/' . $media . '">
                                  </video></div>';
                        }
                    ?>
                    <!-- <img src="../media/<?php // echo $row['media']; ?>" class="img-fluid media" alt=""> -->
                    <p class="text-grey mt-4">
                        <?php echo nl2br($row['content_2']); ?>
                    </p>
                    <span class="category-container"><?php echo $row['category_1']; ?></span>
                    <span class="category-container"><?php echo $row['category_2']; ?></span>
                </div>
                <?php endwhile; ?>
                <div class="col-md-8 offset-md-4 my-5">
                    <?php
                        require '../inc/dbh.inc.php';

                        $commentSql = "SELECT COUNT('comment') AS comment FROM comments WHERE blog_id = '$id';";
                        $commentResult = $conn->query($commentSql);
                        $row = mysqli_fetch_assoc($commentResult);

                        $replySql = "SELECT COUNT('reply') AS reply FROM comment_replies WHERE blog_id = '$id';";
                        $replyResult = $conn->query($replySql);
                        $replyRow = mysqli_fetch_assoc($replyResult);

                        $commentCount = $row['comment'] + $replyRow['reply'];

                    ?>
                    <h3 id="cch" class="text-oo-black playfair font-weight-light"><?php echo $commentCount; ?> Comments</h3>
                    <?php

                        require '../inc/dbh.inc.php';

                        $sql = "SELECT * FROM comments WHERE blog_id  = '$id';";
                        $result = $conn->query($sql);

                        while($row = $result->fetch_assoc()):

                    ?>
                    <div class="row">
                        <div class="col-1">
                            <img src="../img/profile.png" class="img-fluid rounded-circle mt-4" alt="Profile Picture">
                        </div>
                        <div class="col-10">
                            <h5 class="playfair font-weight-light mt-4"><?php echo $row['name'] ?></h5>
                            <?php
                                $datetime = $row['comment_time'];

                                $commentId = $row['id'];

                                $dt = substr($datetime, 0, -9);
                                $new_date = date("F j, Y", strtotime($dt));

                                $tt = substr($datetime, 10, 8);
                                $new_time = date("g:i A", strtotime($tt));
                            ?>
                            <small class="text-grey-light ls-sm"><span class="text-uppercase"><?php echo $new_date ?></span> AT <span class=""><?php echo $new_time ?></span></small>
                            <p class="text-grey mt-2"><?php echo nl2br($row['message']); ?></p>
                            <button type="button" data-toggle="modal" data-target="#reply-modal-<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>" class="btn-ow mb-4 btn-reply">REPLY</button>
                            <?php
                                require '../inc/dbh.inc.php';

                                $sqlReply = "SELECT * FROM comment_replies WHERE comment_id = $commentId;";
                                $resultReply = $conn->query($sqlReply);

                                while($rowReply = $resultReply->fetch_assoc()):
                            ?>
                            <div class="row ml-3">
                                <div class="col-1">
                                    <img src="../img/profile.png" class="img-fluid rounded-circle mt-4" alt="Profile Picture">
                                </div>
                                <div class="col-10">
                                    <h5 class="playfair font-weight-light mt-4"><?php echo $rowReply['name'] ?></h5>
                                    <?php
                                        $datetime = $rowReply['reply_time'];

                                        $commentId = $rowReply['id'];

                                        $dt = substr($datetime, 0, -9);
                                        $new_date = date("F j, Y", strtotime($dt));

                                        $tt = substr($datetime, 10, 8);
                                        $new_time = date("g:i A", strtotime($tt));
                                    ?>
                                    <small class="text-grey-light ls-sm"><span class="text-uppercase"><?php echo $new_date ?></span> AT <span class=""><?php echo $new_time ?></span></small>
                                    <p class="text-grey mt-2"><?php echo nl2br($rowReply['message']); ?></p>
                                    <button type="button" data-toggle="modal" data-target="#reply-modal-<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>" class="btn-ow mb-4 btn-reply">REPLY</button>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div> 

                        <!-- Reply Modal -->
                        <div class="modal fade" id="reply-modal-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body py-3 px-3">
                                        <form action="../inc/replycomment.inc.php" method="POST">
                                            <input type="hidden" name="comment-id" value="<?php echo $row['id']; ?>" id="comment-id">
                                            <input type="hidden" name="blog-id" value="<?php echo $_GET['id']; ?>">
                                            <div class="form-group">
                                                <label for="reply-name" class="text-grey">Name *</label>
                                                <input required type="text" name="name" class="form-control form-control-lg" id="reply-name">
                                            </div>
                                            <div class="form-group">
                                                <label for="reply-message" class="text-grey">Message *</label>
                                                <textarea required name="message" class="form-control form-control-lg" id="reply-message" rows="6"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="submit-reply" class="btn btn-orange text-white py-2">Reply</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                    </div>
                    <?php endwhile; ?>
                    <h3 class="text-oo-black playfair font-weight-light mt-5">Leave a Comment</h3>
                    <div class="comment-form mt-5">
                        <form action="../inc/comment.inc.php" method="POST">
                            <input type="hidden" name="blog-id" value="<?php echo $id; ?>">
                            <div class="form-group">
                                <label for="name" class="text-grey">Name *</label>
                                <input type="text" name="name" class="form-control form-control-lg" id="name">
                            </div>
                            <div class="form-group">
                                <label for="message" class="text-grey">Message *</label>
                                <textarea name="message" class="form-control form-control-lg" id="message" rows="6"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit-comment" class="btn btn-orange text-white py-3">Post Comment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subscribe -->
        <div id="subscribe" class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2 text-center my-5">
                    <div data-aos="fade-up" data-aos-once="true">
                        <h2 class="mt-5"><strong class="playfair text-oo-black">Subscribe to our Newsletter</strong></h2>
                        <p class="text-grey mt-4">A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                        <div id="subscribe-container" class="input-group mt-4 mb-5">
                            <input type="text" class="form-control" placeholder="Enter email address" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text text-white bg-black px-4" id="basic-addon2">Subscribe</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include '../components/footer.php'; ?>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

        <!-- Counter-Up JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.js" integrity="sha512-+/4Q+xH9jXbMNJzNt2eMrYv/Zs2rzr4Bu2thfvzlshZBvH1g+VGP55W8b6xfku0c0KknE7qlbBPhDPrHFbgK4g==" crossorigin="anonymous"></script>
                        
        <!-- Waypoints JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js" integrity="sha512-ZKNVEa7gi0Dz4Rq9jXcySgcPiK+5f01CqW+ZoKLLKr9VMXuCsw3RjWiv8ZpIOa0hxO79np7Ec8DDWALM0bDOaQ==" crossorigin="anonymous"></script>
        
        <!-- Popper JS -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    
        <!-- AOS JS -->
        <script src="../js/aos.js" type="text/javascript"></script>
        
        <script>
            $(document).ready(function () {
                AOS.init({
                    duration: 1000,
                    mirror: true
                });

            });
        </script>
    </body>
</html>