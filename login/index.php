<?php   
    error_reporting(0);
    $currentPage = 'Login';
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
        
        <title>theStory | Login</title>
    </head>
    <body>
        
        <?php include '../components/navbar.php'; ?>

        <!-- Login Form -->
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 mb-5">
                    <div class="comment-form mt-5">
                        <form action="../inc/login.inc.php" method="POST">
                            <h3 class="pl-1 playfair text-oo-black pb-2">Please Login</h3>
                            <?php
                                if(isset($_GET['error'])){
                                    if($_GET['error'] == 'emptyfields'){
                                        echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                                Please complete all fields!
                                              </div>';
                                    }
                                    else if($_GET['error'] == 'sqlerror'){
                                        echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                                Database connection error!
                                              </div>';
                                    }
                                    else if($_GET['error'] == 'pwdincorrect'){
                                        echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                                Password is incorrect!
                                              </div>';
                                    }
                                    else if($_GET['error'] == 'nouid'){
                                        echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                                User does not exist!
                                              </div>';
                                    }
                                    else if($_GET['error'] == 'sql'){
                                        echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                                Database connection error!
                                              </div>';
                                    }
                                    else if($_GET['error'] == 'sqlexe'){
                                        echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                                Database execution error!
                                              </div>';
                                    }
                                }
                            ?>
                            <div class="form-group">
                                <input placeholder="Your Username" type="text" name="uid" class="form-control form-control-lg" id="username">
                            </div>
                            <div class="form-group">
                                <input placeholder="Your Password" type="password" name="pwd" class="form-control form-control-lg" id="password">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="login-submit" class="btn btn-orange text-white py-2"><i class="fas fa-sign-in-alt"></i> Login</button>
                            </div>
                        </form>
                    </div>
                </div>  
            </div>
        </div>

        <?php include '../components/footer.php'; ?>

        <!-- jQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

        <!-- Popper JS -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    
        <!-- AOS JS -->
        <script src="../js/aos.js" type="text/javascript"></script>
        
    </body>
</html>