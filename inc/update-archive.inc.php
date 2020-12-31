<?php

    include 'usql.inc.php';

    // URL Related data
    $postId = $_POST['post_id'];

    // File Paths
    $imagePath = $_POST['imagePath'];
    $mediaPath = $_POST['mediaPath'];

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
        header("Location: ../edit/?error=archivetitle&id=" . $postId);
        exit();
    }
    else{
        /*
        Image already exists and media already exists
        Option to keep existing files archived
        Option to upload new image and/or media item that will be archived and replace original
        */
        if((strlen($imagePath) > 4) && (strlen($mediaPath) > 4)){
            $image = $imagePath;
            $media = $mediaPath;
            if(($_FILES["image"]["size"] > 10000) || ($_FILES["media"]["size"] > 10000)){

                if($_FILES["image"]["size"] > 10000){
                    if(file_exists($imageTarget_file)) {
                        header("Location: ../edit/?error=exists&id=" . $postId);
                        exit();
                    }
                    else if(!in_array($imageFileType, $imagefileTypes)){
                        header("Location: ../edit/?error=imageformat&id=" . $postId);
                        exit();
                    }
                    else{
                        $image = $_FILES["image"]["name"];
                        move_uploaded_file($imageTName, $uploads_dir.'/'.$image);
                        updateSql($conn, $title, $image, $content, $media, $more_content, $category_1, $category_2, $author, $postId);
                    }
                }
                else if($_FILES["media"]["size"] > 10000){
                    if(file_exists($mediaTarget_file)) {
                        header("Location: ../edit/?error=exists&id=" . $postId);
                        exit();
                    }
                    else if(!in_array($mediaFileType, $mediafileTypes)){
                        header("Location: ../edit/?error=mediaformat&id=" . $postId);
                        exit();
                    }
                    else{
                        $media = $_FILES["media"]["name"];
                        move_uploaded_file($mediaTName, $uploads_dir.'/'.$media);
                        updateSql($conn, $title, $image, $content, $media, $more_content, $category_1, $category_2, $author, $postId);
                    }
                }
                else{
                    if(file_exists($imageTarget_file) || file_exists($mediaTarget_file)) {
                        header("Location: ../edit/?error=exists&id=" . $postId);
                        exit();
                    }
                    else if(!in_array($imageFileType, $imagefileTypes)){
                        header("Location: ../edit/?error=imageformat&id=" . $postId);
                        exit();
                    }
                    else if(!in_array($mediaFileType, $mediafileTypes)){
                        header("Location: ../edit/?error=mediaformat&id=" . $postId);
                        exit();
                    }
                    else{
                        $image = $_FILES["image"]["name"];
                        $media = $_FILES["media"]["name"];
                        move_uploaded_file($imageTName, $uploads_dir.'/'.$image);
                        move_uploaded_file($mediaTName, $uploads_dir.'/'.$media);
                        updateSql($conn, $title, $image, $content, $media, $more_content, $category_1, $category_2, $author, $postId);
                    }
                } 
            }
            else{
                updateSql($conn, $title, $image, $content, $media, $more_content, $category_1, $category_2, $author, $postId);
                // echo 'Image exists and media exists';
            }
        } 
        /*        
        Image already exists
        User will not be uplaoding any media content
        Option to upload new image content that will be archived and replace original
        */
        else if((strlen($imagePath) > 4) && ($_FILES["media"]["size"] < 10000)){
            $image = $imagePath;
            if($_FILES["image"]["size"] > 10000){
                if(file_exists($imageTarget_file)) {
                    header("Location: ../edit/?error=exists&id=" . $postId);
                    exit();
                }
                else if(!in_array($imageFileType, $imagefileTypes)){
                    header("Location: ../edit/?error=imageformat&id=" . $postId);
                    exit();
                }
                else{
                    $image = $_FILES["image"]["name"];
                    move_uploaded_file($imageTName, $uploads_dir.'/'.$image);
                    updateSql($conn, $title, $image, $content, $media, $more_content, $category_1, $category_2, $author, $postId);
                }
            }
            else{
                updateSql($conn, $title, $image, $content, $media, $more_content, $category_1, $category_2, $author, $postId);
                // echo 'Image exists and media will not exist';
            }
        }     
        /*
        Image already exists
        Option to upload new image to be archived and replace original
        User will be uploading media item
        */
        else if((strlen($imagePath) > 4) && (strlen($mediaPath) <= 4)){
            $image = $imagePath;
            if($_FILES["image"]["size"] > 10000){
                if(file_exists($imageTarget_file)) {
                    header("Location: ../edit/?error=exists&id=" . $postId);
                    exit();
                }
                else if(!in_array($imageFileType, $imagefileTypes)){
                    header("Location: ../edit/?error=imageformat&id=" . $postId);
                    exit();
                }
                else{
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
                        // echo 'Image exists and media will exist';
                        $image = $_FILES["image"]["name"];
                        move_uploaded_file($imageTName, $uploads_dir.'/'.$image);
                        updateSql($conn, $title, $image, $content, $media, $more_content, $category_1, $category_2, $author, $postId);
                    }
                }
            }
            else{
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
                    updateSql($conn, $title, $image, $content, $media, $more_content, $category_1, $category_2, $author, $postId);
                    // echo 'Image exists and media will exist';
                }
            }
        }
        /*
        User will not be uploading image
        Option to upload new media to be archived and replace existing media
        */
        else if(($_FILES["image"]["size"] < 10000) && (strlen($mediaPath) > 4)){
            $media = $mediaPath;
            if($_FILES["media"]["size"] > 10000){
                if(file_exists($mediaTarget_file)) {
                    header("Location: ../edit/?error=exists&id=" . $postId);
                    exit();
                }
                else if(!in_array($mediaFileType, $mediafileTypes)){
                    header("Location: ../edit/?error=mediaformat&id=" . $postId);
                    exit();
                }
                else{
                    $media = $_FILES["media"]["name"];
                    move_uploaded_file($mediaTName, $uploads_dir.'/'.$media);
                    updateSql($conn, $title, $image, $content, $media, $more_content, $category_1, $category_2, $author, $postId);
                }
            }
            else{
                updateSql($conn, $title, $image, $content, $media, $more_content, $category_1, $category_2, $author, $postId);
                // echo 'Image will not exist and media exists';
            }
        }
        /*
        User will not be uploading any image
        User will not be uploading any media
        */
        else if(($_FILES["image"]["size"] < 10000) && ($_FILES["media"]["size"] < 10000)){
            updateSql($conn, $title, $image, $content, $media, $more_content, $category_1, $category_2, $author, $postId);
            // echo 'Image will not exist and media will not exist';
        }
        /*
        User will not be uploading any image
        User will be uploading media item
        */
        else if(($_FILES["image"]["size"] < 10000) && (strlen($mediaPath) <= 4)){

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
                updateSql($conn, $title, $image, $content, $media, $more_content, $category_1, $category_2, $author, $postId);
            }
            // echo 'Image will not exist and media will exist';
        }
        /*
        User will be uploading image item
        Option to upload media that will be archived and replace original
        */
        else if((strlen($imagePath) <= 4) && (strlen($mediaPath) > 4)){
            $media = $mediaPath;
            if($_FILES["media"]["size"] > 10000){
                if(file_exists($mediaTarget_file)) {
                    header("Location: ../edit/?error=exists&id=" . $postId);
                    exit();
                }
                else if(!in_array($mediaFileType, $mediafileTypes)){
                    header("Location: ../edit/?error=mediaformat&id=" . $postId);
                    exit();
                }
                else{
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
                        $media = $_FILES["media"]["name"];
                        move_uploaded_file($mediaTName, $uploads_dir.'/'.$media);
                        updateSql($conn, $title, $image, $content, $media, $more_content, $category_1, $category_2, $author, $postId);
                        // echo 'Image will exist and media exists';
                    }
                }
            }
            else{
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
                    updateSql($conn, $title, $image, $content, $media, $more_content, $category_1, $category_2, $author, $postId);
                    // echo 'Image will exist and media exists';
                }
            }
        }
        /*
        User will upload image item
        User will not be uploading any media item
        */
        else if((strlen($imagePath) <= 4) && ($_FILES["media"]["size"] < 10000)){

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
                updateSql($conn, $title, $image, $content, $media, $more_content, $category_1, $category_2, $author, $postId);
            }
            // echo 'Image will exist and media will not exist';
        }
        /*
        User will be uploading image item
        User will be uploading media item
        */
        else if((strlen($imagePath) <= 4) && (strlen($mediaPath) <= 4)){

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
                updateSql($conn, $title, $image, $content, $media, $more_content, $category_1, $category_2, $author, $postId);
                // echo 'Image will exist and media will exist';
            }
        }
    }