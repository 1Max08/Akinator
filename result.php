<?php 
session_start();
include "config/database.php";
include "repository/questionRepository.php";
include "repository/resultRepository.php";
include "repository/answerRepository.php";

$_SESSION['question_id'] = getFirstQuestion()['id'];

if (isset($_SESSION['result'][0]['result_id']) && is_numeric($_SESSION['result'][0]['result_id'])) {
    $resultId = (int) $_SESSION['result'][0]['result_id'];
} else {
    $resultId = null;
}

if (!is_null($resultId)) {
    $result = getResult($resultId);
} else {
    die("Erreur :Aucun résultat disponible. Veuillez recommencer le questionnaire.");
}

$resultId = $_SESSION['result'][0]['result_id'] ?? null;
$result = getResult($resultId);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["reset"])) {
    header("Location: quizz.php");
    exit();
}

$template = "result";

include "layout.phtml";