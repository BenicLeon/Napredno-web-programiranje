<?php
session_start();

if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    exit("Error uploading file.");
}

$filename = basename($_FILES['file']['name']);
$imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
$validExtensions = ["jpg", "jpeg", "png", "pdf"];

if (!in_array($imageFileType, $validExtensions)) {
    exit("Unsupported file format ($imageFileType).");
}

$content = file_get_contents($_FILES['file']['tmp_name']);

$encryptionKey = md5('encryption_key');
$cipher = "AES-128-CTR";
$ivLength = openssl_cipher_iv_length($cipher);
$options = 0;
$encryptionIv = openssl_random_pseudo_bytes($ivLength);

$encrypted = openssl_encrypt($content, $cipher, $encryptionKey, $options, $encryptionIv);
$encryptedData = base64_encode($encrypted);
$_SESSION['iv'] = $encryptionIv;

$uploadDir = "uploads/";
if (!is_dir($uploadDir) && !mkdir($uploadDir, 0777, true)) {
    exit("Failed to create directory $uploadDir.");
}

$fileNameWithoutExt = pathinfo($filename, PATHINFO_FILENAME);
$fileNameOnServer = "$uploadDir$fileNameWithoutExt.encrypted";

file_put_contents($fileNameOnServer, $encryptedData);

exit("File successfully uploaded and encrypted.");
?>