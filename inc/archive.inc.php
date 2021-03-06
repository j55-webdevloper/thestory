<?php

    // URL Related data
    $postId = $_POST['post_id'];

    // Text Related Data
    $title = $_POST['title'];
    $content = $_POST['content'];
    $more_content = $_POST['more_content'];
    $category_1 = $_POST['category_1'];
    $category_2 = $_POST['category_2'];
    $author = $_POST['author'];

    // Uploaded Data //
    // Upload directory path
    $uploads_dir = '../media/archive/';

    // file names with a random number so that similar dont get replaced
    $image = $_FILES["image"]["name"];
    $media = $_FILES["media"]["name"];

    // temporary file names to store file
    $imageTName = $_FILES["image"]["tmp_name"];
    $mediaTName = $_FILES["media"]["tmp_name"];

    // target files
    $imageTarget_file = $uploads_dir . $image;
    $mediaTarget_file = $uploads_dir . $media;

    // File Types
    $imageFileType = strtolower(pathinfo($imageTarget_file, PATHINFO_EXTENSION));
    $mediaFileType = strtolower(pathinfo($mediaTarget_file, PATHINFO_EXTENSION));

    // File Types
    $imagefileTypes = array("jpg", "png", "jpeg", "JPG", "PNG", "JPEG");
    $mediafileTypes = array("jpg", "png", "jpeg", "mp4", "avi", "JPG", "PNG", "JPEG", "MP4", 'AVI');

    if(empty($title)){
        header("Location: ../create/?error=archivetitle&id=" . $postId);
        exit();
    }
    else if(file_exists($imageTarget_file) || file_exists($mediaTarget_file)) {
        header("Location: ../create/?error=exists");
        exit();
    }
    else if(!in_array($imageFileType, $imagefileTypes)){
        header("Location: ../create/?error=imageformat&id=" . $postId);
        exit();
    }
    else if(!in_array($mediaFileType, $mediafileTypes)){
        header("Location: ../create/?error=mediaformat&id=" . $postId);
        exit();
    }
    else{
        $sql = "INSERT INTO archived_posts (post_id, title, image, content, media, content_2, category_1, category_2, author) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../create/?error=sql&id=" . $postId);
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "sssssssss", $postId, $title, $image, $content, $media, $more_content, $category_1, $category_2, $author);
            
            if(!mysqli_stmt_execute($stmt)){
                header("Location: ../create/?error=sqlexe&id=" . $postId);
                exit();
            }
            else{
                move_uploaded_file($imageTName, $uploads_dir.'/'.$image);
                move_uploaded_file($mediaTName, $uploads_dir.'/'.$media);

                header("Location: ../create/?success=archived&id=" . $postId);
                exit();
            }                
        }
    }