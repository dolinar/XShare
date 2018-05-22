<?php
session_start();
include 'Connection.php';
$db = new Connection();

function test_input($data) {
    $data = trim($data);;
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = test_input($_POST['username']);
    $password = hash('sha256', test_input($_POST['password']));
    $checkCredentials = $db->login($username, $password);

    if ($checkCredentials) {
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $db->getIdFromUsername($username);
        echo 1;
    } else {
        echo 0;
    }
} else {
    echo -1;
}

$db->closeConnection();
?>