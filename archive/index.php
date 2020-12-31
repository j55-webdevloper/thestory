<?php
    error_reporting(0);
    session_start();

    if(isset($_SESSION['userId'])){

    }
    else if(!isset($_SESSION['userId'])){
      header("Location: ../login/");
      exit();
    }

    $currentPage = 'Archive';
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
        
        <title>theStory | Archive</title>
    </head>
    <body>
        
        <?php include '../components/navbar_alt.php'; ?>

        <!-- Hero -->
        <div id="archive-image" class="container-fluid">
            <div class="overlay">
                <h1 data-aos="fade-up" data-aos-once="true" class="text-center"><strong class="playfair text-white">The Archive</strong></h1>
            </div>
        </div>

          <!-- Featured Posts -->
        <div id="featured-posts" class="container-fluid">
            <div class="row" id="food-posts">
                <div class="col-lg-12">
                    <div class="row">
                        <?php
                            require '../inc/dbh.inc.php';

                            $resultsPerPage = 9;

                            $sql = "SELECT * FROM `archived_posts` ORDER BY id;";
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
                            
                            $sql = "SELECT * FROM `archived_posts` ORDER BY id DESC LIMIT ".$thisPageFirstResult . ',' . $resultsPerPage;
                            $result = $conn->query($sql);

                            while($row = $result->fetch_assoc()):
                        ?>

                        <?php 
                            $datetime = $row['archived_time'];
                            $dt = substr($datetime, 0, -9);
                            $newDate = date("M j, Y", strtotime($dt));
                        ?>
                        <div data-aos="fade-up" data-aos-once="true" class="col-md-3 col-lg-3 text-grey mt-3 category-post">
                            <div style="background: url('../media/archive/<?php echo $row['image']; ?>'); background-repeat: no-repeat; background-size: cover; background-position: center;" class="blog-bg-img"></div>
                            <p id="category-date" class="d-flex mt-2"><span class="pr-3">Archived</span><span class='ml-auto pl-3'><?php echo $newDate; ?></span><p>
                            <h5 class="playfair text-black pt-1"><?php echo $row['title']; ?></h5>
                            <a href="../edit/?id=<?php echo $row['post_id']; ?>" class="btn text-white py-2 px-3 mb-5 mt-2">Edit <i class="fas fa-pencil-alt"></i></a>
                        </div>
                        <?php endwhile ?>
                        <div id="pag-container" class="col-lg-12 text-center">
                            <ul>
                                <li class="d-inline">
                                    <a class="d-inline-block" href="http://localhost/thestory/archive/?page=<?php echo $page - 1; ?>&#food-posts">
                                        <i class="fas fa-angle-left"></i>
                                    </a>
                                </li>
                                <?php for($page = 1; $page <= $numberOfPages; $page++): ?>
                                    <li class="d-inline"><a id="<?php if($_GET['page'] == $page){ echo 'active';} ?>" class="pagination-number d-inline-block" href="http://localhost/thestory/foods/?page=<?php echo $page; ?>&#food-posts"><?php echo $page; ?></a></li>
                                <?php endfor; ?> 
                                <li class="d-inline">
                                    <a class="d-inline-block" href="http://localhost/thestory/archive/?page=<?php echo ($_GET['page'] + 1); ?>&#food-posts">
                                        <i class="fas fa-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
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