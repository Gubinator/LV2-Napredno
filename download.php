<?php 
include_once 'encrypt_functions.php';
$UPLOADS_DIR = './files';
//session_start();
/*
$file_name = $_GET['file'];
$file_type = $_GET['type'];

$db_name = "lv2_database";
$conn = mysqli_connect('localhost', 'root', '', $db_name);
$table_name = "file";
$sql = "SELECT * FROM $table_name WHERE name='$file_name'";
$result = mysqli_query($conn, $sql);
$stmt = mysqli_prepare($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_bind_result($stmt, $file_data);
    mysqli_stmt_fetch($stmt);
    $encryption_iv = $_SESSION['iv'];

    // Decrypt the file data
    $decrypted_data = openssl_decrypt(
        $encrypted_data,
        "AES-128-CTR",
        md5('dost dobar ključ*'),
        0,
        $encryption_iv
    );

//$decrypted_data = mb_convert_encoding($decrypted_data, 'UTF-8', 'UTF-8');


    // Set the headers
    header('Content-Type: ' . $file_type);
    header('Content-Disposition: attachment; filename="' . $file_name . '"');
    header('Content-Length: ' . strlen($decrypted_data));

    // Output the file data to the client
    echo $decrypted_data;
}

mysqli_close($conn);
*/
$fileName = $_GET['file'];
$file = $UPLOADS_DIR.'/'.$fileName;

$tmpOutput = tmpfile();
$tmpFile = stream_get_meta_data($tmpOutput)['uri'];
decryptFile($file, SECRET_KEY, $tmpFile);



header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='. $fileName );
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($tmpFile));
ob_clean();
flush();
readfile($tmpFile);

fclose($tmpFile);

?>