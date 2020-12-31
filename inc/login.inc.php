<?php

    require 'dbh.inc.php';

    if(isset($_POST['login-submit'])){
        $uid = $_POST['uid'];
        $pwd = $_POST['pwd'];

        include 'component.inc.php';

        // Verify User Login Function
        verifyUserLogin($conn, $uid, $pwd); 
    }
    else {
        header("Location: ../login/");
        exit();
    }