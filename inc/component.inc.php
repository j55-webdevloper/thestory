<?php

    //Unique ID
    function generatePostId() {
        $keyLength = 8;
        $str = "1234567890";
        $uniqKey = substr(str_shuffle($str), 0, $keyLength);
       
        return $uniqKey;
    }

    // Verify user credentials against databas details
    function verifyUserLogin($conn, $uid, $pwd) {
        if(empty($uid) || empty($pwd)){
            header("Location: ../login/?error=emptyfields");
            exit();
        }
        else{
            $sql = 'SELECT * FROM user WHERE uid=? OR emailId=?;';
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../login/?error=sqlerror");
                exit();
            }
            else{
                $uid = $conn->real_escape_string($uid);

                mysqli_stmt_bind_param($stmt, "ss", $uid, $uid);
                mysqli_stmt_execute($stmt);

                $result = mysqli_stmt_get_result($stmt);
                if($row = mysqli_fetch_assoc($result)){

                    $pwdCheck = password_verify($pwd, $row['pwd']);

                    if($pwdCheck == false){
                        header("Location: ../login/?error=pwdincorrect");
                        exit();
                    }
                    else if($pwdCheck == true){
                        session_start();
                        $_SESSION['userId'] = $row['uid'];

                        // Verify's whether POST id exists or not
                        verifyPostID($conn);
                    }
                }
                else{
                    header("Location: ../login/?error=nouid");
                    exit();
                }
            }
        }
    }

    function verifyPostID($conn) {
        $sql = "SELECT * FROM posts WHERE post_id=?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login/?error=sql");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", generatePostId());
            if(mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($result);

                if($row > 0) {
                    while($row > 0) {
                        header("Location: ../create/?id=" . generatePostId());
                    }
                }
                else {
                    header("Location: ../create/?id=" . generatePostId());
                    exit();
                }      
            }
            else {
                header("Location: ../login/?error=sqlexe");
                exit();
            }
        }
    }