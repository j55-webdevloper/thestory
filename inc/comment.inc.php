<?php
    require 'dbh.inc.php';

    if(isset($_POST['submit-comment'])){
        $blog_id = $_POST['blog-id'];
        $name =  ucfirst(strtolower(trim($_POST['name'])));
        $message = trim($_POST['message']);

        if(empty($name) || empty($message)){
            header("Location: ../post/?error=emptyfields&id=" . $blog_id);
            exit();
        }
        else{
            $name = $conn -> real_escape_string($name);
            $message = $conn -> real_escape_string($message);

            $sql = "INSERT INTO comments (blog_id, name, message) VALUES (?, ?, ?);";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../post/?error=sql&id=" . $blog_id);
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "sss", $blog_id, $name, $message);

                if(mysqli_stmt_execute($stmt)){
                    header("Location: ../post/?comment=posted&id=" . $blog_id . "&#cch");
                    exit();
                }
                else{
                    header("Location: ../post/?comment=notposted&id=" . $blog_id . "&#cch");
                    exit();
                }
            }

        }
        

    }
    else{
        header("Location: ../");
        exit();
    }