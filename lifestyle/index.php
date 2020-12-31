<?php 
    error_reporting(0);
    $currentPage = 'Lifestyle';
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

        <!-- AOS Css -->
        <link rel="stylesheet" href="../css/aos.css">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
        
        <title>theStory | Category/Lifestyle</title>
    </head>
    <body>
        
        <?php include '../components/navbar.php'; ?>

        <!-- Hero -->
        <div id="lifestyle-image" class="container-fluid">
            <div class="overlay">
                <h1 data-aos="fade-up" data-aos-once="true" class="text-center"><strong class="playfair text-white">Lifestyle</strong></h1>
            </div>
        </div>

          <!-- Featured Posts -->
        <div id="lifestyle" class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-lg-9">
                    <div id="lifestyle-posts" class="row">
                        <?php
                            require '../inc/dbh.inc.php';

                            $resultsPerPage = 6;

                            $sql = "SELECT * FROM `posts` WHERE category_1 = 'Lifestyle' OR category_2 = 'Lifestyle' ORDER BY id DESC LIMIT 4;";
                            $result = $conn->query($sql);
                            $numberOfResults = mysqli_num_rows($result);

                            $numberOfPages = ceil($numberOfResults / $resultsPerPage);

                            if(!isset($_GET['page'])){
                                $page = 1;
                            }
                            else if($_GET['page'] == 0){
                                $page = 1;
                            }
                            else{
                                $page = $_GET['page'];
                            }

                            $thisPageFirstResult = ($page - 1) * $resultsPerPage;
                            
                            $sql = "SELECT * FROM `posts` WHERE category_1 = 'Lifestyle' OR category_2 = 'Lifestyle' ORDER BY id DESC LIMIT ".$thisPageFirstResult . ',' . $resultsPerPage;
                            $result = $conn->query($sql);

                            while($row = $result->fetch_assoc()):
                        ?>

                        <?php 
                            $datetime = $row['post_time'];
                            $dt = substr($datetime, 0, -9);
                            $newDate = date("M j, Y", strtotime($dt));
                        ?>
                        <div data-aos="fade-up" data-aos-once="true" class="col-md-12 col-lg-6 text-grey mt-3 category-post">
                            <div style="background: url('../media/<?php echo $row['image']; ?>'); background-repeat: no-repeat; background-size: cover; background-position: center;" class="blog-bg-img"></div>
                        </div>
                        <div data-aos="fade-up" data-aos-once="true" class="col-md-12 col-lg-5 text-grey mb-5 mt-2 lifstyle-post-text">
                            <p id="category-date" class="d-flex mt-2"><span class="pr-3"><?php echo $row['category_2']; ?></span><span class='ml-auto pl-3'><?php echo $newDate; ?></span><p>
                            <h3 class="playfair text-black pt-1 font-weight-bold"><?php echo $row['title']; ?></h3>
                            <p class="text-grey mt-3"><?php echo substr($row['content'], 0, 150); ?></p>
                            <a href="../post/?id=<?php echo $row['id']; ?>" class="btn text-white py-2 px-3 mb-5 mt-2">Read More <i class="pl-4 fas fa-arrow-right"></i></a>
                        </div>
                        <?php endwhile ?>
                        <div id="pag-container" class="col-lg-12 text-center">
                            <ul>
                                <li class="d-inline">
                                    <a class="d-inline-block" href="http://localhost/thestory/lifestyle/?page=<?php echo $page - 1; ?>&#lifestyle-posts">
                                        <i class="fas fa-angle-left"></i>
                                    </a>
                                </li>
                                <?php for($page = 1; $page <= $numberOfPages; $page++): ?>
                                    <li class="d-inline"><a id="<?php if($_GET['page'] == $page){ echo 'active';} ?>" class="pagination-number d-inline-block" href="http://localhost/thestory/lifestyle/?page=<?php echo $page; ?>&#lifestyle-posts"><?php echo $page; ?></a></li>
                                <?php endfor; ?> 
                                <li class="d-inline">
                                    <a class="d-inline-block" href="http://localhost/thestory/lifestyle/?page=<?php echo ($_GET['page'] + 1); ?>&#lifestyle-posts">
                                        <i class="fas fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div data-aos="fade-up" data-aos-once="true" id="identity" class="col-md-12 col-lg-3 mt-3">
                    <h4 class="pt-5"><strong class="playfair text-oo-black">About Me</strong></h4>
                    <img src="../img/author.jpg" class="img-fluid mt-3" alt="Profile Pic">
                    <p class="text-grey mt-4">Hi! My name is <span class="text-black"><strong>Cathy Deon</strong></span>, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                </div>
            </div>
        </div>


        <!-- Subscribe -->
        <div id="subscribe" class="container-fluid mt-5">
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
        
        <!-- Popper JS -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        
        <!-- AOS JS -->
        <script src="../js/aos.js" type="text/javascript"></script>

        <!-- App JS -->
        <script type="text/javascript">
            $(document).ready(function(){
               // Animate on Scroll Initialization
               AOS.init({
                    duration: 1000,
                    mirror: true
                }) 
            });
        </script>
    </body>
</html>