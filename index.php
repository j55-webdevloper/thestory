<?php   
    error_reporting(0);
    $currentPage = 'Home';
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
        <link rel="stylesheet" href="css/style.css">

        <!-- AOS Css -->
        <link rel="stylesheet" href="css/aos.css">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
        
        <title>theStory | Blog</title>
    </head>
    <body>
        
        <?php include 'components/navbar.php'; ?>

        <!-- Hero -->
        <div id="hero-container" class="container-fluid">
            <div id="carouselExampleFade" class="carousel slide carousel-fade hero-carousel" data-ride="carousel">
                <div class="carousel-inner">
                        <?php
                            require 'inc/dbh.inc.php';
                            $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT 2;";
                            $result = $conn->query($sql);

                            while($row = $result->fetch_assoc()):

                        ?>
                        <div class="carousel-item">
                            <div class="row">
                                <div style="background: url('media/<?php echo $row['image']; ?>'); background-repeat: no-repeat; background-size: cover; background-position: center;" id="blog-image" class="col-md-8 bg-dark">
                                    
                                </div>
                                <div data-aos="fade-up" data-aos-once="true" id="blog-opening" class="col-md-4 text-left pl-5 pr-5 pt-5">
                                     <p class="mt-2">FEATURED POSTS</p>
                                    <h1 class="text-black"><?php echo $row['title']; ?></h1>
                                    <p class="pt-4"><?php echo substr($row['content'], 0, 70); ?></p>
                                    <a href="post/?id=<?php echo $row['id']; ?>" id="main-button" class="btn text-white mt-4">Read More <i class="fas fa-arrow-right pl-4"></i></a>
                                    <button data-target="#carouselExampleFade" id="left-button"  role="button" data-slide="prev" class="btn btn-dir text-grey py-4"><i class="fas fa-arrow-left"></i> Forward</button>
                                    <button data-target="#carouselExampleFade" id="right-button" role="button" data-slide="next" class="btn btn-dir text-grey py-4">Next <i class="fas fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?> 
                    </div>
                </div>
            </div>
        </div>

        <!-- Hero Mobile -->
        <div id="mobile-hero-container" class="container-fluid">
            <div id="carousel-mobile" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner">
                <?php
                    require 'inc/dbh.inc.php';
                    $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT 2;";
                    $result = $conn->query($sql);

                    while($row = $result->fetch_assoc()):
                ?>
                    <div id="mobile-blog-image" style="background: url('media/<?php echo $row['image']; ?>'); background-repeat: no-repeat; background-size: cover; background-position: center;" class="carousel-item text-center px-5 pt-5">
                        <div class="mobile-overlay text-white">
                            <p class="mt-5">FEATURED POSTS</p>
                            <h1><strong><?php echo $row['title']; ?></strong></h1>
                            <p class="pt-4"><?php echo substr($row['content'], 0, 70); ?></p>
                            <a href="post/?id=<?php echo $row['id']; ?>" id="main-button-mobile" class="btn text-white mt-4 mb-5">Read More <i class="fas fa-arrow-right pl-1"></i></a>
                        </div>
                    </div>
                <?php endwhile; ?> 
                </div>
            </div>
        </div>

        <!-- Recent Stories -->
        <div id="recent-stories" class="container-fluid">
            <h2><span class="playfair text-oo-black mr-2">Recent Stories</span></h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <?php
                            require 'inc/dbh.inc.php';
                            $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT 4;";
                            $result = $conn->query($sql);

                            while($row = $result->fetch_assoc()):
                        ?>
                        <div data-aos="fade-up" data-aos-once="true" class="col-md-6 text-grey pt-3">
                            <?php 
                                $datetime = $row['post_time'];
                                $dt = substr($datetime, 0, -9);
                                $newDate = date("M j, Y", strtotime($dt));
                            ?>
                            <div style="background: url('media/<?php echo $row['image']; ?>'); background-repeat: no-repeat; background-size: cover; background-position: center;" class="blog-image-small"></div>
                            <p id="category-date" class="d-flex mt-2">
                                <span class="pr-3"><?php echo $row['category_1']; ?></span>
                                <span class="ml-auto pl-3"><?php echo $newDate; ?></span>
                            <p>
                            <h5 class="playfair text-black pt-1"><?php echo $row['title']; ?></h5>
                            <a href="post/?id=<?php echo $row['id']; ?>" class="d-block pt-3"><p class="text-orange">Read More <i class="pl-4 fas fa-arrow-right"></i></p></a>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
                <div data-aos="fade-up" data-aos-once="true" class="col-md-6">
                    <div id="recent-stories-standin">
                        <div class="mobile-overlay"></div>
                        <p class="text-yellow text-left">Food</p>
                        <h2 class="playfair text-white">Tasty & Delicious Foods</h2>
                        <a href="" class="text-black py-3 bg-white">Read More<i class="pl-2 fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Posts -->
        <div id="featured-posts" class="container-fluid">
            <h2><span class="playfair text-oo-black mr-2">Featured Posts</span></h2>
            <div class="row">
                <?php
                    require 'inc/dbh.inc.php';

                    $sql = "SELECT * FROM posts ORDER BY id ASC LIMIT 3;";
                    $result = $conn->query($sql);

                    while($row = $result->fetch_assoc()):
                ?>
                <div data-aos="fade-up" data-aos-once="true" class="col-md-4 col-lg-3 text-grey mt-3 mb-5">
                    <div style="background: url('media/<?php echo $row['image']; ?>'); background-repeat: no-repeat; background-size: cover; background-position: center;" class="blog-bg-img"></div>
                    <p id="category-date" class="d-flex mt-2"><span class="pr-3"><?php echo $row['category_2']; ?></span><span class='ml-auto pl-3'><?php echo $newDate; ?></span><p>
                    <h5 class="playfair text-black pt-1"><?php echo $row['title']; ?></h5>
                    <a href="post/?id=<?php echo $row['id']; ?>" class="btn text-white py-2 px-3 mb-5">Read More <i class="pl-4 fas fa-arrow-right"></i></a>
                </div>
                <?php endwhile; ?>
                <div data-aos="fade-up" data-aos-once="true" id="identity" class="col-md-12 col-lg-3">
                    <h4 class="pt-5"><strong class="playfair text-oo-black">About Me</strong></h4>
                    <img src="img/author.jpg" class="img-fluid mt-3" alt="Profile Pic">
                    <p class="text-grey mt-4">Hi! My name is <span class="text-black"><strong>Cathy Deon</strong></span>, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                </div>
            </div>
        </div>

        <!-- About / Counter -->
        <div id="about-counter" class="container-fluid">
            <div class="row">
                <div id="about-pic" class="col-md-6">
                    
                </div>
                <div id="about-stories" class="col-md-6">
                    <h3 class="mt-5"><strong class="playfair text-oo-black">About Stories</strong></h3>
                    <p class="text-grey pt-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
                    <div class="row text-center justify-content-around mb-4">
                        <div data-aos="fade-up" data-aos-once="true" class="col-md-5 counter-container py-5 px-5">
                            <h3 class="num" data-target="110">0</h3>
                            <p>Years of Experience</p>
                        </div>
                        <div data-aos="fade-up" data-aos-once="true" class="col-md-5 counter-container py-5 px-5">
                            <h3 class="num" data-target="200">0</h3>
                            <p>Foods</p>
                        </div>
                    </div>
                    <div class="row text-center justify-content-around mb-4">
                        <div data-aos="fade-up" data-aos-once="true" class="col-md-5 counter-container py-5 px-5">
                            <h3 class="num" data-target="300">0</h3>
                            <p>Lifestyle</p>
                        </div>
                        <div data-aos="fade-up" data-aos-once="true" class="col-md-5 counter-container py-5 px-5">
                            <h3 class="num" data-target="480">0</h3>
                            <p>Happy Customers</p>
                        </div>
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

        <?php include 'components/footer.php'; ?>

        <!-- jQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
        
        <!-- Waypoints -->
        <script src="js/jquery.waypoints.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    
        <!-- AOS JS -->
        <script src="js/aos.js" type="text/javascript"></script>
        
        <script type="text/javascript">
            $(document).ready(function(){
                // Bootstrap Carousel Initialization on desktop and mobile view
                $('#carouselExampleFade').find('.carousel-item').first().addClass('active');
                $('#carousel-mobile').find('.carousel-item').first().addClass('active');

                // Animate on Scroll Initialization
                AOS.init({
                    duration: 1000,
                    mirror: true
                });

                // Waypoints
                var waypoints = $('#about-stories').waypoint({
                    handler: function(direction) {
                        console.log('scrolled over');
                        // Counter Script
                        const num = document.querySelectorAll('.num');
                        const speed = 200;

                        num.forEach(counter => {
                            const updateCount = () => {
                                const target = +counter.getAttribute('data-target');
                                const count = +counter.innerText;
                                

                                const inc = target / speed;

                                if(count < target){
                                    counter.innerText = Math.ceil(count + inc);
                                    setTimeout(updateCount, 1);
                                }
                                else{
                                    count.innerText = target;
                                }
                            }

                            updateCount();
                        });
                    }
                });
            });
        </script>
    </body>
</html>