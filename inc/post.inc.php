<?php

    // Database connection file
    require 'dbh.inc.php';

    if(isset($_POST['upload-post'])){

        include 'publish.inc.php';

    }
    else if(isset($_POST['archive-post'])){

        include 'archive.inc.php';   

    }
    else{
        header("Location: ../create/");
        exit();
    }