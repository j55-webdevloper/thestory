<?php   
    error_reporting(0);
    session_start();

    if(isset($_SESSION['userId'])){
        if($_SESSION['userId'] != 'blog_admin'){
            header("Location: ../archive/");
            exit();
        }
    }

    $currentPage = 'Accounts';
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
        
        <title>theStory | Accounts</title>
    </head>
    <body>
        
        <?php include '../components/navbar_alt.php'; ?>

        <!-- Login Form -->
        <div class="container">
            <div class="row">
                <!-- Create Account form -->
                <div class="col-md-6 mb-5">
                    <div class="comment-form mt-5">
                        <form action="../inc/acc.inc.php" method="POST">
                            <h3 class="pl-1 playfair text-oo-black pb-2"><i class="fas fa-user-plus"></i> Create Acc</h3>
                            <?php
                                if(isset($_GET['cerror'])){
                                    if($_GET['cerror'] == 'emptyfields'){
                                        echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                                Please complete all fields!
                                              </div>';
                                    }
                                    else if($_GET['cerror'] == 'sqlerror'){
                                        echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                                Database connection error!
                                              </div>';
                                    }
                                    else if($_GET['cerror'] == 'passwwordcheck'){
                                        echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                                Password is incorrect!
                                              </div>';
                                    }
                                    else if($_GET['cerror'] == 'exists'){
                                        echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                                User already exists!
                                              </div>';
                                    }
                                    else if($_GET['cerror'] == 'pwdlength'){
                                        echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                                Password must be greater than 8 characters!
                                              </div>';
                                    }
                                    else if($_GET['cerror'] == 'pwdcontainmum'){
                                        echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                                Password must contain a number!
                                              </div>';
                                    }
                                    else if($_GET['cerror'] == 'pwdcontainlet'){
                                        echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                                Password must contain lowercase letters!
                                              </div>';
                                    }
                                    else if($_GET['cerror'] == 'pwdcontainclet'){
                                        echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                                Password must contain a uppercase letter!
                                              </div>';
                                    }
                                    else if($_GET['cerror'] == 'pwdcontainsym'){
                                        echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                                Password must contain a symbol!
                                              </div>';
                                    }
                                }
                            ?>
                            <div class="form-group">
                                <input placeholder="Fullname" type="text" name="name" class="form-control form-control" id="name">
                            </div>
                            <div class="form-group">
                                <input placeholder="Email Address" type="email" name="email" class="form-control form-control" id="email">
                            </div>
                            <div class="form-group">
                                <input placeholder="Password" type="password" name="pwd" class="form-control form-control" id="pwd">
                            </div>
                            <div class="form-group">
                                <input placeholder="Confirm Password" type="password" name="con_pwd" class="form-control form-control" id="con_pwd">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="create-account" class="btn btn-blue text-white py-2"><i class="fas fa-magic"></i> Create</button>
                            </div>
                        </form>
                    </div>
                </div>  
                <!-- Delete Account Form -->
                <div class="col-md-6 mb-5">
                    <div class="comment-form mt-5">
                        <form action="../inc/acc.inc.php" method="POST">
                            <h3 class="pl-1 playfair text-oo-black pb-2"><i class="fas fa-user-times"></i> Delete Acc</h3>
                            <?php
                                if(isset($_GET['derror'])){
                                    if($_GET['derror'] == 'emptyfield'){
                                        echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                                Please complete the field!
                                              </div>';
                                    }
                                    else if($_GET['derror'] == 'noexists'){
                                        echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                                User does not exist!
                                              </div>';
                                    }
                                    else if($_GET['derror'] == 'sql'){
                                        echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                                Database connection error!
                                              </div>';
                                    }
                                    else if($_GET['derror'] == 'sqlexe'){
                                        echo '<div class="alert alert-danger border border-danger text-center" role="alert">
                                                Database execution error!
                                              </div>';
                                    }
                                }
                                else if(isset($_GET['success'])){
                                    if($_GET['success'] == 'deleted'){
                                        echo '<div class="alert alert-success border border-success text-center" role="alert">
                                                    Database execution error!
                                                </div>';
                                    }
                                }
                            ?>
                            <div class="form-group">
                                <input placeholder="Email Address" type="email" name="uid" class="form-control form-control" id="username">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="delete-account" class="btn btn-green text-white py-2"><i class="far fa-trash-alt"></i> Delete</button>
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