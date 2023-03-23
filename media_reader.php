<?php
include 'encrypt_functions.php';
//session_start(); 

$encryption_key = md5('dost dobar ključ*');
$cipher = "AES-128-CTR";

$db_name = "lv2_database";
$conn = mysqli_connect('localhost', 'root', '', $db_name) or die("<p>Ne možemo se spojiti na bazu $db_name.</p></body></html>");
$table_name = "file";

$sql = "SELECT * FROM $table_name";
$result = mysqli_query($conn, $sql);

/*while ($row = mysqli_fetch_assoc($result)) {
    $file_name = $row["name"];
    $file_type = $row["type"];
    $encrypted_data = $row["file"];
    $encryption_iv = $_SESSION['iv'];
    $options = 0;

    $decrypted_data = openssl_decrypt(
        base64_decode($encrypted_data),
        $cipher,
        $encryption_key,
        $options,
        $encryption_iv
    );


$download_link = '<a href="download.php?file=' . $file_name . '">Download ' . $file_name . '</a>';


echo $download_link;
}*/

$files = array_diff(scandir('./files'), array('..', '.'));
foreach ($files as $file)
{
    $download_link = '<a href="download.php?file=' . $file . '">  Download ' . $file . '  </a>';
    echo $download_link;
}


mysqli_close($conn);
?>