<?php

    function previewPostValidation($id, $conn) {
        $sql = "SELECT * FROM previewed_posts WHERE post_id=?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../create/?error=sql");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $id);

            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($result);

                if($row > 0){
                    header("Location: http://localhost/thestory/preview/?id=" . $id);
                    exit();
                }
                else{
                    
                }
            }
            else{
                header("Location: ../create/?error=sqlexe");
                exit();
            }
        }
    }