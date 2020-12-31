<?php

    include 'component.inc.php';
    include 'psql.inc.php';

    // URL Related data
    $postId = $_POST['post_id'];

    // File Paths
    $imagePath = 'archive/' . $_POST['imagePath'];
    $mediaPath = 'archive/' . $_POST['mediaPath'];

    // Text Related Data
    $title = $_POST['title'];
    $content = $_POST['content'];
    $more_content = $_POST['more_content'];
    $category_1 = $_POST['category_1'];
    $category_2 = $_POST['category_2'];
    $author = $_POST['author'];

    // Uploaded Data //
    // Upload directory path
    $uploads_dir = '../media/';

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

    if(empty($title) || empty($content) || empty($more_content) || empty($category_1) || empty($category_2) || empty($author)){
        header("Location: ../edit/?error=emptyfields&id=" . $postId);
        exit();
    }
    else{
        $sql = "SELECT * FROM posts WHERE post_id=?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login/?error=sql&id=" . $postId);
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $postId);
            if(mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($result);

                if($row > 0) {
                    while($row > 0) {
                        $postId = generatePostId();
                    }
                }
                else {
                    if((strlen($imagePath) > 8) && (strlen($mediaPath) > 8)){
                        $image = $imagePath;
                        $media = $mediaPath;

                        uploadSql($conn, $postId, $title, $image, $content, $media, $more_content, $category_1, $category_2, $author);
                    }
                    else if((strlen($imagePath) > 8) && (strlen($mediaPath) <= 8)){
                        $image = $imagePath;

                        if(($_FILES["media"]["size"] < 10000)) {
                            header("Location: ../edit/?error=filesm&id=" . $postId);
                            exit();
                        }
                        else if(file_exists($mediaTarget_file)) {
                            header("Location: ../edit/?error=exists&id=" . $postId);
                            exit();
                        }
                        else if(!in_array($mediaFileType, $mediafileTypes)){
                            header("Location: ../edit/?error=mediaformat&id=" . $postId);
                            exit();
                        }
                        else {
                            move_uploaded_file($mediaTName, $uploads_dir.'/'.$media);
                            uploadSql($conn, $postId, $title, $image, $content, $media, $more_content, $category_1, $category_2, $author);
                        }
                    }
                    else if((strlen($imagePath) <= 8) && (strlen($mediaPath) > 8)){
                        $media = $mediaPath;

                        if(($_FILES["image"]["size"] < 10000)) {
                            header("Location: ../edit/?error=filesm&id=" . $postId);
                            exit();
                        }
                        else if(file_exists($imageTarget_file)) {
                            header("Location: ../edit/?error=exists&id=" . $postId);
                            exit();
                        }
                        else if(!in_array($imageFileType, $imagefileTypes)){
                            header("Location: ../edit/?error=imageformat&id=" . $postId);
                            exit();
                        }
                        else {
                            move_uploaded_file($imageTName, $uploads_dir.'/'.$image);
                            uploadSql($conn, $postId, $title, $image, $content, $media, $more_content, $category_1, $category_2, $author);
                        }
                    }
                    else if((strlen($imagePath) <= 8) || (strlen($mediaPath) <= 8)){
                        if(($_FILES["image"]["size"] < 10000) || ($_FILES["media"]["size"] < 10000)) {
                            header("Location: ../edit/?error=filesm");
                            exit();
                        }
                        else if(file_exists($imageTarget_file) || file_exists($mediaTarget_file)) {
                            header("Location: ../edit/?error=exists");
                            exit();
                        }
                        else if(!in_array($imageFileType, $imagefileTypes)){
                            header("Location: ../edit/?error=imageformat");
                            exit();
                        }
                        else if(!in_array($mediaFileType, $mediafileTypes)){
                            header("Location: ../edit/?error=mediaformat");
                            exit();
                        }
                        else{
                            move_uploaded_file($imageTName, $uploads_dir.'/'.$image);
                            move_uploaded_file($mediaTName, $uploads_dir.'/'.$media);
                            uploadSql($conn, $postId, $title, $image, $content, $media, $more_content, $category_1, $category_2, $author);
                        }
                    }
                }      
            }
            else {
                header("Location: ../edit/?error=sqlexe&id=" . $postId);
                exit();
            }
        }       
    }