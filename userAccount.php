<?php
session_start();
include "config/database.php";
include "repository/userRepository.php";
include "repository/gameRepository.php";

$result_id = $_SESSION['result'][0]['result_id'];

$last = getPastResult($result_id);

if (!empty($last)) {
    $character_name = $last[0]['character_name'];
    $date = $last[0]['date'];
} else {
    $character_name = 'Aucun personnage trouvé';
    $date = 'Aucune date trouvée';
}

// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     $password = $_POST['password'];
//     $oldPassword = $_POST['old'];
//     $newPassword = $_POST['new'];
    
    
// var_dump($oldPassword);
// var_dump($newPassword);
// }

// if (!password_verify($oldPassword, $user['password'])) {
//         die("L'ancien mot de passe est incorrect.");
//     }



$template = "userAccount";
include "layout.phtml";

