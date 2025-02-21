<?php 
session_start();
var_dump($_SESSION);
include "config/database.php";
include "repository/questionRepository.php";
include "repository/resultRepository.php";
include "repository/answerRepository.php";
include "repository/gameRepository.php";

$_SESSION['question_id'] = getFirstQuestion()['id'];

if (isset($_SESSION['result'][0]['result_id'])) {
    $resultId = (int) $_SESSION['result'][0]['result_id'];
} else {
    $resultId = null;
}

if (!is_null($resultId)) {
    $result = getResult($resultId);
} else {
    echo ("Erreur Resultat est NULL");
}

$resultId = $_SESSION['result'][0]['result_id'] ?? null;
$result = getResult($resultId);

getResultDate($resultId, $_SESSION['user_id']);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["reset"])) {
    header("Location: quizz.php");
    exit();
}

$template = "result";

include "layout.phtml";