
<?php
class Connection {
	private $db;

	function __construct () {
        try{
            $this->db = new PDO('mysql:host=localhost;dbname=db;charset=utf8','root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch(PDOException $e){
            echo $e->getMessage();
            die();
        }
	}

	function closeConnection() {
		$this->db = null;
    }

    function login($username, $password) {
        $credentialsCheck = $this->db->prepare("SELECT * FROM users WHERE username = ? AND password = ?;");
        $credentialsCheck->bindValue(1, $username);
        $credentialsCheck->bindValue(2, $password);

        $credentialsCheck->execute();

        return $credentialsCheck->fetch(PDO::FETCH_ASSOC);
    }

    function getIdFromUsername($username) {
        $id = $this->db->prepare("SELECT id_user FROM users WHERE username = ?;");
        $id->bindValue(1, $username);

        $id->execute();
        $results = $id->fetch(PDO::FETCH_ASSOC);
        return $results['id_user'];
    }

    function getUsernameFromId($id_user) {
        $username = $this->db->prepare("SELECT username FROM users WHERE id_user = ?;");
        $username->bindValue(1, $id_user);

        $username->execute();
        $results = $username->fetch(PDO::FETCH_ASSOC);
        return $results['username'];
    }

    function checkIfAlreadyExists($username) {
        $usernameCheck = $this->db->prepare("SELECT * FROM users WHERE username = ?;");
        $usernameCheck->bindValue(1, $username);

        $usernameCheck->execute();

        return $usernameCheck->fetch(PDO::FETCH_ASSOC);
    }

    function addUser($username, $password, $mail) {
        $addUser = $this->db->prepare("INSERT INTO users(username, password, mail) VALUES(?, ?, ?);");
        $addUser->bindValue(1, $username);
        $addUser->bindValue(2, $password);
        $addUser->bindValue(3, $mail);

        return $addUser->execute();
    }

    function getUsersImages($id_user) {
        $images = $this->db->prepare("SELECT * FROM images where id_user = ?;");
        $images->bindValue(1, $id_user);

        $images->execute();

        return $images->fetchAll(PDO::FETCH_ASSOC);
    }

    function getImageCaption($id_image) {
        $caption = $this->db->prepare("SELECT * FROM image_caption where id_image = ?;");
        $caption->bindValue(1, $id_image);

        $caption->execute();
        $results = $caption->fetch(PDO::FETCH_ASSOC);

        return $results['caption'];
    }

    function addImage($id_user, $title, $public, $path) {
        $addImg = $this->db->prepare("INSERT INTO images(id_user, title, public, path) VALUES(?, ?, ?, ?);");
        $addImg->bindValue(1, $id_user);
        $addImg->bindValue(2, $title);
        $addImg->bindValue(3, $public);
        $addImg->bindValue(4, $path);

        $addImg->execute();

        return $this->db->lastInsertId();
    }

    function addImageCaption($id_image, $caption) {
        $addImgCaption = $this->db->prepare("INSERT INTO image_caption(id_image, caption) VALUES(?, ?);");
        $addImgCaption->bindValue(1, $id_image);
        $addImgCaption->bindValue(2, $caption);
        return $addImgCaption->execute();
    }

    function getMaxId() {
        $maxId = $this->db->prepare("SELECT MAX(id_image) as max FROM images;");
        $maxId->execute();
        $results = $maxId->fetch(PDO::FETCH_ASSOC);
        return $results['max'];
    }

    function getPublicImages($offset) {
        $id = $this->getMaxId();
        $upperLimit = $id - $offset;
        $lowerLimit = $upperLimit - 8;

        $publicImages = $this->db->prepare("SELECT users.username, images.id_image, images.title, images.public, images.path FROM users
                                            LEFT JOIN images ON users.id_user = images.id_user
                                            WHERE images.id_image > ? AND images.id_image <= ? AND images.public = 1 ORDER BY images.id_image DESC;");
        $publicImages->bindValue(1, $lowerLimit);
        $publicImages->bindValue(2, $upperLimit);
        $publicImages->execute();
        return $publicImages->fetchAll(PDO::FETCH_ASSOC);
    }
}

