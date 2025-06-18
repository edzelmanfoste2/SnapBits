<?php
session_start();

$host = "localhost";
$user = "admin2";
$password = "admin1234";
$database = "photobooth";

$conn = new mysqli ($host, $user, $password, $database);
if ($conn->connect_error) die ("Connection Error: " . $conn->connect_error);


$cipher = "AES-256-CBC";
$EncyptionKey = 'OIvcK5scnM65nemGWOJEgyhvh6fd87Bd';
//$options = 0;

function decryptData($data, $cipher, $EncyptionKey) {
    $data = base64_decode($data);
    $iv_length = openssl_cipher_iv_length($cipher);
    $iv = substr($data, 0, $iv_length);
    $encrypted = substr($data, $iv_length);
    return openssl_decrypt($encrypted, $cipher, $EncyptionKey, 0, $iv );
}

if (isset($_SESSION['uploaded_id'])) {
    $id = intval($_SESSION['uploaded_id']);
    $query = "SELECT image FROM images WHERE id = $id";
    $result = $conn->query($query);

    if ($result && $row = $result->fetch_assoc()) {
        $decryptedImage = decryptData($row['image'], $cipher, $EncyptionKey);
        header("Content-Type: image/png");
        header("Content-Disposition: attachment; filename=\"SnapBits_Image.png\"");
        echo $decryptedImage;
        exit;
    } else {
        echo "Image not found";
    } 
} else {
        echo "No picture found";
}


?>