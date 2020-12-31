<?php 
    error_reporting(0);
    $currentPage = 'Contact';
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
        <div id="contact-image" class="container-fluid">
            <div class="overlay">
                <h1 data-aos="fade-up" data-aos-once="true" class="text-center"><strong class="playfair text-white">Contact Us</strong></h1>
            </div>
        </div>

        <!-- Contact Us -->
        <div class="container-fluid" id="contact-body">
            <div class="row">
                <div class="col-md-6">

                </div>
                <div class="col-md-6">
                    <div class="comment-form mt-5">
                        <form action="../inc/comment.inc.php" method="POST">
                            <input type="hidden" name="blog-id" value="<?php echo $id; ?>">
                            <div class="form-group">
                                <input placeholder="Your Name" type="text" name="name" class="form-control form-control-lg" id="name">
                            </div>
                            <div class="form-group">
                                <input placeholder="Your Email" type="email" name="email" class="form-control form-control-lg" id="email">
                            </div>
                            <div class="form-group">
                                <input placeholder="Subject" type="text" name="subject" class="form-control form-control-lg" id="subject">
                            </div>
                            <div class="form-group">
                                <textarea name="message" placeholder="Message" class="form-control form-control-lg" id="message" rows="6"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit-comment" class="btn btn-orange text-white py-3">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="contact-icons" class="row text-center">
                <div class="col-md-3">
                    <div class="contact-icon bg-black py-5 px-5">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h5 class="text-black mb-4">Address</h5>
                    <p class="text-grey">198 West 21th Street, Suite 721<br> New York NY 10016</p>
                </div>
                <div class="col-md-3">
                    <div class="contact-icon bg-black py-5 px-5">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h5 class="text-black mb-4">Contact Number</h5>
                    <p class="text-grey">+ 1235 2355 98</p>
                </div>
                <div class="col-md-3">
                    <div class="contact-icon bg-black py-5 px-5">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                    <h5 class="text-black mb-4">Email Address</h5>
                    <p class="text-grey">info@yoursite.com</p>
                </div>
                <div class="col-md-3">
                    <div class="contact-icon bg-black py-5 px-5">
                        <i class="fas fa-globe-americas"></i>
                    </div>
                    <h5 class="text-black mb-4">Website</h5>
                    <p class="text-grey">yoursite.com</p>
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
                });
            });
        </script>
    </body>
</html>