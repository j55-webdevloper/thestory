<?php 
    // Database connection file
    require 'dbh.inc.php';

    // Create New Account
    if(isset($_POST['create-account'])){

        $fullName = trim($_POST['name']);
        $email = strtolower(trim($_POST['email']));
        $pwd = $_POST['pwd'];
        $conPwd = $_POST['con_pwd'];

        if(empty($fullName) || empty($email) || empty($pwd) || empty($conPwd)){
            header("Location: ../accounts/?cerror=emptyfields");
            exit();
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            header("Location: ../?cerror=invalidmail");
            exit();
        }
        else if($pwd !== $conPwd){
            header("Location: ../accounts/?cerror=passwordcheck");
            exit();
        }
        else if(strlen($pwd) < 8){
            header("Location: ../accounts/?cerror=pwdlength");
            exit();
        }
        else if(!preg_match("#[0-9]+#", $pwd)){
            header("Location: ../accounts/?cerror=pwdcontainnum");
            exit();
        }
        else if(!preg_match("#[a-z]+#", $pwd)){
            header("Location: ../accounts/?cerror=pwdcontainlet");
            exit();
        }
        else if(!preg_match("#[A-Z]+#", $pwd)){
            header("Location: ../accounts/?cerror=pwdcontainclet");
            exit();
        }
        else if(!preg_match("#\W+#", $pwd)){
            header("Location: ../accounts/?cerror=pwdcontainsym");
            exit();
        }
        else{
            $sql = "SELECT emailId FROM user WHERE emailId=?";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../accounts/?cerror=sqlerror");
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);

                $resultCheck = mysqli_stmt_num_rows($stmt);
                if($resultCheck > 0){
                    header("Location: ../accounts/?cerror=exists");
                }
                else{
                    $sql = "INSERT INTO user (uid, emailId, pwd) VALUES (?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("Location: ../accounts/?cerror=sqlerror");
                        exit();
                    }
                    else{
                        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

                        mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $hashedPwd);
                        mysqli_stmt_execute($stmt);

                        session_start();
                        session_unset();
                        session_destroy();

                        header("Location: ../login/");
                        exit();
                    }
                }
            }
        }
    }
    // Delete Current Account
    else if(isset($_POST['delete-account'])){
        $uid = $_POST['uid'];
            
        if(empty($uid)){
            header("Location: ../accounts/?derror=emptyfield");
            exit();
        }
        else{
            // Check if user exists
            $sql = "SELECT * FROM user WHERE uid=? OR emailId=?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../accounts/?derror=sql");
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "ss", $uid, $uid);

                if(mysqli_stmt_execute($stmt)){
                    $result = mysqli_stmt_get_result($stmt);
                    $row = mysqli_fetch_assoc($result);
    
                    if($row > 0){
                        // Delete user from database
                        $sql = "DELETE FROM user WHERE emailId=?;";
                        $stmt = mysqli_stmt_init($conn);

                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            header("Location: ../accounts/?derror=sql");
                            exit();
                        }
                        else{
                            mysqli_stmt_bind_param($stmt, "s", $uid);
            
                            if(mysqli_stmt_execute($stmt)){
                                header("Location: ../accounts/?success=deleted");
                                exit();
                            }
                            else{
                                header("Location: ../accounts/?derror=sqlexe");
                                exit(); 
                            }
                        }
                    }
                    else{
                        header("Location: ../accounts/?derror=noexists");
                        exit();
                    }
                }
                else{
                    header("Location: ../accounts/?derror=sqlexe");
                    exit();
                }
            }
        }
    }
 
    else{
        header("Location: ../accounts/");
        exit();
    }