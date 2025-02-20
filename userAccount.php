<?php

include "config/database.php";
include "repository/userRepository.php";

session_start();

 if (!isset($_SESSION['user_id'])) {
     header("Location: login.php");
     exit();
}

$username = $_SESSION['username'];

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $description = trim($_POST["description"]);
    $important = isset($_POST["important"]) ? 1 : 0;
    $urgent = isset($_POST["urgent"]) ? 1 : 0;

    if (!empty($name) && !empty($description)) {
        insertTask($name, $description, $urgent, $important, $_SESSION['user_id']);
        header("Location: userAccount.php");
        exit();
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}




if(isset($_SESSION['user'])){

    $template = "userAccount";
    include "layout.phtml";
    
}
// else{
//     header("Location: login.php");
//     exit;
// }

include "userAccount.phtml";