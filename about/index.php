<?php 
    error_reporting(0);
    $currentPage = 'About';
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
        
        <title>theStory | About Us</title>
    </head>
    <body>
        
        <?php include '../components/navbar.php'; ?>

        <!-- Hero -->
        <div id="about-us-image" class="container-fluid">
            <div class="overlay">
                <h1 data-aos="fade-up" data-aos-once="true" class="text-center"><strong class="playfair text-white">About Us</strong></h1>
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
                            <h3 data-target="800" class="num">0</h3>
                            <p>Years of Experience</p>
                        </div>
                        <div data-aos="fade-up" data-aos-once="true" class="col-md-5 counter-container py-5 px-5">
                            <h3 data-target="166" class="num">0</h3>
                            <p>Foods</p>
                        </div>
                    </div>
                    <div class="row text-center justify-content-around mb-4">
                        <div data-aos="fade-up" data-aos-once="true" class="col-md-5 counter-container py-5 px-5">
                            <h3 data-target="273" class="num">0</h3>
                            <p>Lifestyle</p>
                        </div>
                        <div data-aos="fade-up" data-aos-once="true" class="col-md-5 counter-container py-5 px-5">
                            <h3 data-target="360" class="num">0</h3>
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

        <?php include '../components/footer.php'; ?>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        
        <!-- Waypoints JS -->
        <script src="../js/jquery.waypoints.min.js" type="text/javascript"></script>

        <!-- Popper JS -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    
        <!-- AOS JS -->
        <script src="../js/aos.js" type="text/javascript"></script>

        <script>
            $(document).ready(function(){
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