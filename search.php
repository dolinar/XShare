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
    <h2>Search results...</h2>
    <div class="row" id="users-gallery">
        <?php
            include 'Connection.php';
            $db = new Connection();

            $search = isset($_POST['search']) ? $_POST['search'] : 'dsnjdsbdnjsjdsnj';
            $search = $search == '' ? 'dsnjdsbdnjsjdsnj' : $search;
            $images = $db->getSearchResults($search);
            if(reset($images)) {
                foreach ($images as $value) {
                    echo '<div class="col-md-4">
                            <div class="thumbnail">';
                    echo '      <a href="/images/' . $value['username'] . '/' . $value['path'] . '" target="_blank">';
                    echo '      <img src="/images/' . $value['username'] . '/' . $value['path'] . '" alt="' . $value['title'] . '" style="width:100%">';
                    echo '      <div class="caption">';
                    echo '          <p style="font-size:18px;">From: <b>' . $value['username'] . '</b></p>';
                    echo '          <p style="font-size:18px;">Title: <b>' . $value['title'] . '</b>';
                    echo '          <p style="font-size:18px;">Caption: '.  $value['caption'] . '</p>';
                    echo '      </div>';
                    echo '      </a>';
                    echo '  </div>';
                    echo '</div>';
                }
            } else {
                echo '<h2>There was no results for your search query!</h2>';
            }

            $db->closeConnection();
        ?>

    </div>
    </div>
</body>
</html>