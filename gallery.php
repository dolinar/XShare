<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible">
    <title>Gallery</title>
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
    <div class="row" id="users-gallery">
        <?php
            include 'Connection.php';
            $db = new Connection();

            $images = $db->getUsersImages($_SESSION['id']);
            $username = $_SESSION['username'];
            foreach ($images as $value) {
                $caption = $db->getImageCaption($value['id_image']);
                echo '<div class="col-md-4">
                        <div class="thumbnail">';
                echo '      <a href="/images/' . $username . '/' . $value['path'] . '" target="_blank">';
                echo '      <img src="/images/' . $username . '/' . $value['path'] . '" alt="' . $value['title'] . '" style="width:100%">';
                echo '      <div class="caption">';
                echo '          <p style="font-size:22px;"><b>' . $value['title'] . '</b>' . ': ' . $caption . '</p>';
                echo '      </div>';
                echo '      </a>';
                echo '  </div>';
                echo '</div>';
            }


            $db->closeConnection();
        ?>

    </div>
    </div>
</body>
</html>