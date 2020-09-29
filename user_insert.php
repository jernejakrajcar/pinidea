<?php
include_once './database.php';

$nickname = $_POST['nickname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$country_id = $_POST['country_id'];
$lang_id = $_POST['language_id'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];

//echo $nickname, $email, $phone, $country_id, $pass1, $pass2;
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
    header("Location: registration.php");
// če je vse v redu, se poskuša datoteko naložiti
} else {
    //preverim podatke, da so obvezni vnešeni
    if (!empty($email) && !empty($nickname)
            && !empty($pass1) && !empty($country_id) && !empty($lang_id)
            && ($pass1 == $pass2)) {

        //$pass = sha1($pass1.$salt);
        $pass = password_hash($pass1, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (nickname,email,phone,country_id,language_id,avatar,pass)VALUES (?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$nickname,$email,$phone,$country_id,$lang_id,$target_file,$pass]);

        $query2 = "SELECT * FROM users WHERE email=?";
        $stmt2 = $pdo->prepare($query2);
        $stmt2->execute([$email]);

        $user = $stmt2->fetch();

        if(isset($user['id']))
        {
          session_start();
          $_SESSION['user_id'] = $user['id'];
          $_SESSION['nickname'] = $user['nickname'];
          $_SESSION['email'] = $user['email'];

          echo $_SESSION['user_id'];
          echo $_SESSION['nickname'];
          echo $_SESSION['email'];

          header("Location: index.php");
        }



        // die();
    }
    else {
        header("Location: registration.php");
    }

    if (move_uploaded_file($tmpName, $target_file)) {
        echo "The file ". basename( $name). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}




?>
