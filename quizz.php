<?php 
session_start();

include "config/database.php";
include "repository/questionRepository.php";
include "repository/resultRepository.php";
include "repository/answerRepository.php";

if (!isset($_SESSION['question_id'])) {
    $_SESSION['question_id'] = getFirstQuestion()['id'];
}

$questionId = $_SESSION['question_id'];
$questions = getQuestion($questionId);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["reponse"])) {
    $reponse = (int) $_POST["reponse"];
} else {
    $reponse = 2;
}

$nextQuestion = getNextQuestion($reponse, $questionId);

$resultId = getResultId($reponse, $questionId);

if (empty($nextQuestion) && !empty($resultId)) {
    $_SESSION['result'] = $resultId;
    header("Location: result.php");
    exit();
}

if (!empty($nextQuestion) && isset($nextQuestion[0]['next_question'])) {
    $_SESSION['question_id'] = $nextQuestion[0]['next_question'];
    header("Location: quizz.php");
    exit();
}

$template = "quizz";

include "layout.phtml";