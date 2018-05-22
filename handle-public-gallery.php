<?php
    include 'Connection.php';
    $db = new Connection();

    $offset = $_POST['offset'];
    $images = $db->getPublicImages(intval($offset));

    $total = '';
    foreach ($images as $value) {
        $caption = $db->getImageCaption($value['id_image']);
        $total .= '<div class="col-md-4">
                      <div class="thumbnail">';
        $total .= '      <a href="/images/' . $value['username'] . '/' . $value['path'] . '" target="_blank">';
        $total .= '      <img src="/images/' . $value['username'] . '/' . $value['path'] . '" alt="' . $value['title'] . '" style="width:100%">';
        $total .= '      <div class="caption">';
        $total .= '          <p style="font-size:18px;">From: <b>' . $value['username'] . '</b></p>';
        $total .= '          <p style="font-size:18px;">Title: <b>' . $value['title'] . '</b>';
        $total .= '          <p style="font-size:18px;">Caption: '.  $caption . '</p>';
        $total .= '      </div>';
        $total .= '      </a>';
        $total .= '  </div>';
        $total .= '</div>';
    }
    $db->closeConnection();
    echo $total;
?>