<?php
    require 'component.inc.php';
    require 'dbh.inc.php';

    if(isset($_POST['create-link'])) {
        verifyPostID($conn);
    }