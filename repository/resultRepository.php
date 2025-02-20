<?php

function getResult(int $resultat, int $answers) {
    $pdo = getConnexion();
    
    $query = $pdo->prepare("SELECT character_name,image,description FROM result
        INNER JOIN answer ON result.id = answer.result_id
        WHERE result.id = $resultat AND answer.result_id = $answers");

    $query->execute();
    $result = $query->fetchAll();
    
    return $result;
}