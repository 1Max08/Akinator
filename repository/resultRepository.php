<?php

function getResult(int $resultatId) {
    $pdo = getConnexion();
    
    $query = $pdo->prepare("SELECT character_name,image,description FROM result
        INNER JOIN answer ON result.id = answer.result_id
        WHERE result.id = $resultatId AND answer.result_id = $resultatId");

    $query->execute();
    $result = $query->fetchAll();

    return $result;
}

function getResultId(int $reponse, int $question) {
    $pdo = getConnexion();
    
    $query = $pdo->prepare("SELECT answer.result_id FROM result
    INNER JOIN answer ON result.id = answer.result_id
    WHERE answer.response = $reponse AND answer.question_id = $question");

    $query->execute();
    $resultId = $query->fetchAll();
    
    return $resultId;
}