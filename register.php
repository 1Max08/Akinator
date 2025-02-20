<?php
include "config/database.php";
include "repository/userRepository.php";

$pdo = getConnexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    try {
        // Préparez et exécutez la requête pour insérer un nouvel utilisateur
        $stmt = $pdo->prepare("INSERT INTO user (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);
        
        // Redirigez l'utilisateur vers la page de connexion après l'inscription réussie
        header('Location: login.php');
        exit;
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
include "register.phtml";