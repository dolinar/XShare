<?php
include 'Connection.php';
$db  = new Connection();

$title = $_POST['title'];
$caption = $_POST['caption'];
$id_user = $_POST['id_user'];

$public = isset($_POST['public']) ? 1 : 0;

$username = $db->getUsernameFromId($id_user);

if(isset($_FILES["file"]["type"])) {
    $validextensions = array("jpeg", "jpg", "png");
    $temporary = explode(".", $_FILES["file"]["name"]);
    $file_extension = end($temporary);
if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) 
    && ($_FILES["file"]["size"] < 1000000)//Approx. 1MB files can be uploaded.
    && in_array($file_extension, $validextensions)) {
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
        } else {
            if (file_exists("images/" . $username . "/" . $_FILES["file"]["name"])) {
                echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
            } else {
                $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
                $targetPath = "images/" . $username . "/" . $_FILES['file']['name']; // Target path where file is to be stored
                move_uploaded_file($sourcePath, $targetPath) ; // Moving Uploaded file
                $id = $db->addImage($id_user, $title, $public, $_FILES['file']['name']);
                if ($db->addImageCaption($id, $caption)) {
                    echo "<span id='success'>Image Uploaded Successfully!</span><br/>";
                    echo "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
                    echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
                    echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
                } else {
                    echo "No caption";
                }

                
            }
        }
    } else {
        echo "<span id='invalid'>***Invalid file Size or Type***<span>";
    }
}
?>