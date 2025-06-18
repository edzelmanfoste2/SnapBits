<?php
session_start();

$host = "localhost";
$user = "admin2";
$password = "admin1234";
$database = "photobooth";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) die("Connection Error: " . $conn->connect_error);

$cipher = "AES-256-CBC";
$EncryptionKey = 'OIvcK5scnM65nemGWOJEgyhvh6fd87Bd';

function encryptData($data, $cipher, $EncryptionKey) {
    $iv_length = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($iv_length);
    $encrypted = openssl_encrypt($data, $cipher, $EncryptionKey, 0, $iv);
    return base64_encode($iv . $encrypted);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $imageData = file_get_contents($_FILES['image']['tmp_name']);
    $encryptedImage = encryptData($imageData, $cipher, $EncryptionKey);

    $stmt = $conn->prepare("INSERT INTO images (image) VALUES (?)");
    $stmt->bind_param("s", $encryptedImage);

    if ($stmt->execute()) {
        $_SESSION['timeCreated'] = time();
        $_SESSION['uploaded_id'] = $stmt->insert_id;

        echo "success"; 
    } else {
        echo "Error uploading image.";
    }
}
?>
