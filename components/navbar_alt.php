<?php require '../inc/dbh.inc.php'; ?>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg py-3">
    <div class="container">
        <a class="navbar-brand" href="#">
            <h3><strong>theStory<span class="text-yellow">.</span></strong></h3>
        </a>
        <button class="navbar-toggler text-grey" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i> MENU
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-4">
                    <a class="nav-link <?php if($currentPage == 'Home') echo 'active'; ?>" href="http://localhost/thestory/">Home</a>
                </li>
                <li class="nav-item mr-4">
                    <form action="../inc/create.inc.php" method="POST">
                        <input type="submit" id="create-link" value="Create" name="create-link" class="nav-link <?php if($currentPage == 'Create') echo 'active'; ?>" />
                    </form>
                </li>
                <li class="nav-item mr-4">
                    <a class="nav-link <?php if($currentPage == 'Archive') echo 'active'; ?>" href="http://localhost/thestory/archive/">Archive</a>
                </li>
                <li class="nav-item">
                    <form action="../inc/logout.inc.php" method="POST">
                        <button name="logout-submit" class="nav-link btn-black <?php if($currentPage == 'Login') echo 'active'; ?>">Logout</button>
                    </form>
                </li>
                <!-- Accounts Menu Item : only visible/accessible to blog admin -->
                <?php
                    if(isset($_SESSION['userId'])){
                        if($_SESSION['userId'] == 'blog_admin'){
                            $linkState = '';
                            if($currentPage == 'Accounts'){
                                $linkState = 'active';
                            }
                            echo '<li class="nav-item ml-3">
                                    <a href="http://localhost/thestory/accounts/" class="nav-link ' . $linkState . '">Accounts</a>
                                </li>';
                        }
                    }
               
                ?>
            </ul>
        </div>
    </div>
</nav>