<?php

function getDate(int $reponse, int $question) {
    $pdo = getConnexion();
    
    $query = $pdo->prepare("SELECT answer.next_question FROM question 
        INNER JOIN answer ON question.id = answer.next_question
        WHERE answer.response = $reponse AND answer.question_id = $question");

    $query->execute();
    $next = $query->fetchAll();
    
    return $next;
}