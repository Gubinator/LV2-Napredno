<?php /*
//Kriptiranje podataka i spremanje u session varijable
session_start(); */?>

<?php
include 'encrypt_functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["file"])) {
        $fileName = $_FILES["file"]["name"];
        $fileTmp = $_FILES["file"]["tmp_name"];
        $fileType = $_FILES["file"]["type"];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        
        /*
        
        //print_r($fileTmp);
        $encryption_key = md5('dost dobar ključ*');
        //Odaber cipher metodu AES
        $cipher = "AES-128-CTR";

        //Stvori IV sa ispravnom dužinom
        $iv_length = openssl_cipher_iv_length($cipher);
        $options = 0;

        // Non-NULL inicijalizacijski vektor za enkripciju 
        //Random dužine 16 byte
        $encryption_iv = random_bytes($iv_length);
        $content = file_get_contents($fileTmp);

        // Kriptiraj podatke sa openssl 
        $data = openssl_encrypt(
            $content,
            $cipher,
            $encryption_key,
            $options,
            $encryption_iv
        ); 

        //Spremi podatke
        //$_SESSION['podaci'] = base64_encode($data);
        $_SESSION['iv'] = $encryption_iv;
        $decryption_key = md5('dost dobar ključ*');
        $db_name = "lv2_database";
        $conn = @mysqli_connect('localhost', 'root', '', $db_name) or die("<p>Ne možemo se spojiti na bazu $db_name.</p></body></html>");
        $stmt = mysqli_prepare($conn, "INSERT INTO file (name,file,extension,type,tmp) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssss", $fileName, $content, $fileExtension, $fileType, $fileTmp);
        mysqli_stmt_execute($stmt);
        */
        $directory = './files';

        $targetFile = $directory . '/' . basename($fileName);

        encryptFile($fileTmp, SECRET_KEY, $targetFile);

    }
}


?>



<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
    <input type="file" name="file" required>
    <input type="submit">
</form>