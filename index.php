<?php 
session_start(); // Start session at the top

include "config/database.php";
include "repository/questionRepository.php";
include "repository/resultRepository.php";
include "repository/answerRepository.php";

$result = getResult(8,8);
$reponse = null;

if (isset($_SESSION['question_id'])) {
    $questionId = $_SESSION['question_id'];
} else {
    $questionId = getFirstQuestion()['id'];
}

$questions = getQuestion($questionId);
var_dump($questions);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["reponse"])) {
    $reponse = (int) $_POST["reponse"];
    echo ($reponse == 1 ? "Oui" : "Non");
}

$nextQuestion = null;
if (!is_null($reponse)) {
    $nextQuestion = getNextQuestion($reponse, $questionId);
}

if (empty($nextQuestion)) {
    $nextQuestion = $result;
}

var_dump($nextQuestion);

if (!empty($nextQuestion) && isset($nextQuestion[0]['id'])) {
        $questionId = (int) $nextQuestion[0]['id'];
}

$_SESSION['question_id'] = $questionId;

include "index.phtml";