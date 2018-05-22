<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible">
    <title>Front Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</head>

<body>
    <?php
        include "navbar.php";
    ?>
    <div class="container">
        <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
            <div id="image_preview"><img id="previewing" src="noimage.png" style="width:240px;height:200px;"/></div>
            <hr>
            <h3>Select image to upload:<h3>
            <input type="file" name="file" id="file">
            <div class="input-group" style="margin-top:20px;">
                <span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
                <input id="title" type="text" class="form-control" name="title" placeholder="Image title">
            </div>
            <div class="input-group" style="margin-top:20px;">
                <span class="input-group-addon"><i class="glyphicon glyphicon-tasks"></i></span>
                <input id="caption" type="text" class="form-control" name="caption" placeholder="Image caption (not required).">
            </div>
            <div class="radio" style="margin-top:20px;">
                <label><input type="radio" value='1' name="public">Do you want your image to be public?</label>
            </div>
            <input type="hidden" value="<?php echo $_SESSION['id']; ?>" name="id_user" />
            <input type="submit" value="Upload image" class="btn btn-info" style="margin-top:20px;" id="button-upload">
        </form>

        <h4 id="loading" hidden>loading..</h4>
        <div id="message"></div>
    </div>
</body>
</html>