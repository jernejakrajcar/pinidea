<?php
require_once './database.php';

$user = $_POST['user_id'];

$prva_slika = $_POST['avatar'];
$f_name = $_POST['first_name'];
$l_name = $_POST['last_name'];
$nickname = $_POST['nickname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
//$country = $_POST['country'];
//$lang = $_POST['language'];


$name     = $_FILES['file']['name'];
$tmpName  = $_FILES['file']['tmp_name'];
$size     = $_FILES['file']['size'];
$ext      = strtolower(pathinfo($name, PATHINFO_EXTENSION));


/* INSERT INTO stavek za slike  */
$target_dir = "pictures/";
$target_file = $target_dir.basename($name);
$uplaodOk = 1;
$imageFileType = $ext;
// preverite ali je datoteka v resnici slika ali je ponarejena slika
if(isset($_POST["submit"])) {
    $check = getimagesize($tmpName);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// preverite, če datoteka že obstaja
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// preverite velikost datoteke
if ($size > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// preverite tipe datotek
if($imageFileType !="jpg" && $imageFileType !="png" && $imageFileType !="jpeg" && $imageFileType !="gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// preverite, če je $uploadOk postavljena na 0 (zaradi napake)
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// če je vse v redu, se poskuša datoteko naložiti
} else {
    //bio od userja ne pozabi dodati!!!

      $query = "UPDATE users SET first_name =?, last_name =?, nickname =?, email =?, phone =?, avatar =? WHERE id=?";
      echo $query;
      $stmt = $pdo->prepare($query);
      $stmt->execute([$f_name,$l_name,$nickname,$email,$phone,$target_file,$user]);

    if (move_uploaded_file($tmpName, $target_file)) {
        echo "The file ". basename( $name). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

header("Location:account.php");
