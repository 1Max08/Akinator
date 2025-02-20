<?php
include "config/database.php";
include "repository/userRepository.php";
include "repository/questionRepository.php";
session_start();

$pdo = getConnexion();
            $_SESSION['question_id'] = getFirstQuestion()['id'];
            var_dump($_SESSION['question_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            // $_SESSION['username'] = $user['username'];

            header('Location: index.php');
            exit;
        } else {
            $error = 'Email ou mot de passe incorrect';
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

include "login.phtml";