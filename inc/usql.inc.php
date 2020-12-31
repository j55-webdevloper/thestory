<?php
    function updateSql($conn, $title, $image, $content, $media, $more_content, $category_1, $category_2, $author, $postId){
        $sql = "UPDATE archived_posts SET title=?, image=?, content=?, media=?, content_2=?, category_1=?, category_2=?, author=? WHERE post_id=?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../edit/?error=sql&id=" . $postId);
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "sssssssss", $title, $image, $content, $media, $more_content, $category_1, $category_2, $author, $postId);
            if(mysqli_stmt_execute($stmt)){
                header("Location: ../archive/");
                exit();
            }
            else{
                header("Location: ../edit/?error=sqlexe&id=" . $postId);
                exit();
            }
        }
    }