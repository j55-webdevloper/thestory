<?php
    function uploadSql($conn, $postId, $title, $image, $content, $media, $more_content, $category_1, $category_2, $author){
        $sql = "INSERT INTO posts (post_id, title, image, content, media, content_2, category_1, category_2, author) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../edit/?error=sql&id" . $postId); 
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "sssssssss", $postId, $title, $image, $content, $media, $more_content, $category_1, $category_2, $author);
            if(mysqli_stmt_execute($stmt)){
                $sql = "DELETE FROM archived_posts WHERE post_id=?;";
                $stmt = mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../edit/?error=sql&id" . $postId); 
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($stmt, "s", $postId);
                    if(mysqli_stmt_execute($stmt)) {
                        header("Location: ../");
                        exit();
                    }
                    else{
                        header("Location: ../edit/?error=sqlexe&id=" . $postId);
                        exit();
                    }
                }  
            }
            else{
                header("Location: ../edit/?error=sqlexe&id=" . $postId);
                exit();
            }
        }
    }