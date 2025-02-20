<?php 
session_start();

include "config/database.php";
include "repository/questionRepository.php";
include "repository/resultRepository.php";
include "repository/answerRepository.php";

$result = getResult(2);

include "result.phtml";