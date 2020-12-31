<?php

    // Database connection file
    require 'dbh.inc.php';

    if(isset($_POST['upload-post'])){

        include 'upload.inc.php';

    }
    else if(isset($_POST['archive-post'])){

        include 'update-archive.inc.php';   

    }
    else{
        header("Location: ../create/");
        exit();
    }