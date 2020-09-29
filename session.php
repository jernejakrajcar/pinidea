<?php
session_start();

if(!isset($_SESSION['user_id'])
        && $_SERVER['REQUEST_URI']!='/pinterest-klon/login.php'
        && $_SERVER['REQUEST_URI']!='/pinterest-klon/registration.php'
        && $_SERVER['REQUEST_URI']!='/pinterest-klon/login_check.php') {
    header("Location: login.php");
    die();
}



// function isAdmin() {
//     $result = false;
//     if (isset($_SESSION['admin']) && ($_SESSION['admin']==1)) {
//         $result = true;
//     }
//     return $result;
// }
//
// function adminOnly() {
//     //če ni admin, ga preusmeri na index
//     if (!isAdmin()) {
//         header("Location: index.php");
//         die();
//     }
// }



?>
