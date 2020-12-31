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
                    <a class="nav-link <?php if($currentPage == 'About') echo 'active'; ?>" href="http://localhost/thestory/about/">About</a>
                </li>
                <li class="nav-item mr-4">
                    <a class="nav-link <?php if($currentPage == 'Foods') echo 'active'; ?>" href="http://localhost/thestory/foods/">Foods</a>
                </li>
                <li class="nav-item mr-4">
                    <a class="nav-link <?php if($currentPage == 'Lifestyle') echo 'active'; ?>" href="http://localhost/thestory/lifestyle/">Lifestyle</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($currentPage == 'Contact') echo 'active'; ?>" href="http://localhost/thestory/contact/">Contact</a>
                </li>
                <li id="login-icon" class="nav-item my-auto pl-4">
                    <a class="nav-link <?php if($currentPage == 'Login') echo 'active'; ?>" href="http://localhost/thestory/login/"><i class="far fa-user"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>