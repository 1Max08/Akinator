<?php 
session_start();
include "config/database.php";
include "repository/questionRepository.php";
include "repository/resultRepository.php";
include "repository/answerRepository.php";

if (isset($_SESSION['result'][0]['result_id']) && is_numeric($_SESSION['result'][0]['result_id'])) {
    $resultId = (int) $_SESSION['result'][0]['result_id'];
} else {
    $resultId = null; // Prevents TypeError
}

if (!is_null($resultId)) {
    $result = getResult($resultId);
} else {
    die("Erreur : Aucun résultat disponible. Veuillez recommencer le questionnaire.");
}
$resultId = $_SESSION['result'][0]['result_id'] ?? null;
$result = getResult($resultId);

include "result.phtml";