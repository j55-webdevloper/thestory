<?php

    require 'dbh.inc.php';

    if(isset($_POST['submit-reply'])){
        $name = $_POST['name'];
        $message = $_POST['message'];
        $blog_id = $_POST['blog-id'];
        $comment_id = $_POST['comment-id'];


        if(empty($name) || empty($message)){
            header("Location: ../post/?error=emptyfields&id=" . $blog_id);
            exit();
        }
        else{
            $sql = "INSERT INTO comment_replies(comment_id, name, message, blog_id) VALUES (?, ?, ?, ?);";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../post/?error=sql&id=" . $blog_id);
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "ssss", $comment_id, $name, $message, $blog_id);
                
                if(mysqli_stmt_execute($stmt)){
                    header("Location: ../post/?reply=posted&id=" . $blog_id . "&#cch");
                }
                else{
                    header("Location: ../post/?reply=notposted&id=" . $blog_id . "&#cch");
                    exit();
                }
            }
        }
    }
    else{
        header("Location: ../");
        exit();
    }