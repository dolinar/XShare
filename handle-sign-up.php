<?php
include 'Connection.php';
$db = new Connection();

function test_input($data) {
    $data = trim($data);;
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

if (isset($_POST['username']) && isset($_POST['password']) &&  isset($_POST['mail'])) {
    $username = test_input($_POST['username']);
    $password = hash('sha256', test_input($_POST['password']));
    $mail     = test_input($_POST['mail']);

    $checkUsername = $db->checkIfAlreadyExists($username);

    if ($checkUsername) {
        echo 0;
        exit(0);
    }
    $registration = $db->addUser($username, $password, $mail);
    if ($registration) {
        echo $registration;
        mkdir('C:/wamp64/www/images/' . $username);
    } else {
        echo -1;
    }
} else {
    echo -1;
}

$db->closeConnection();
?>