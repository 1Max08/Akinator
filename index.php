<?php 
session_start();

include "config/database.php";
include "repository/questionRepository.php";
include "repository/resultRepository.php";
include "repository/answerRepository.php";

if (!isset($_SESSION['question_id'])) {
    $_SESSION['question_id'] = getFirstQuestion()['id'];
}

$result = getResult(2);
$reponse = null;

$questionId = $_SESSION['question_id'];
$questions = getQuestion($questionId);
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["reponse"])) {
    $reponse = (int) $_POST["reponse"];
}

$nextQuestion = null;
if (!is_null($reponse)) {
    $nextQuestion = getNextQuestion($reponse, $questionId);
}

if (empty($nextQuestion)) {
    $nextQuestion = $result;
}

if (!empty($nextQuestion) && isset($nextQuestion[0]['next_question'])) {
    $_SESSION['question_id'] = $nextQuestion[0]['next_question'];
    header("Location: index.php");
    exit();
}
var_dump($nextQuestion);

var_dump($questionId);

include "index.phtml";