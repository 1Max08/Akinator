<?php

function getResultDate(int $result, int $userId) {
    $pdo = getConnexion();
    
    $query = $pdo->prepare("INSERT INTO `game`(`date`,`result_id`,`user_id`) VALUES (NOW(),$result,$userId)");

    $query->execute();
    $date = $query->fetchAll();
    
    return $date;
}

function getPastResult(int $result) {
    $pdo = getConnexion();
    
    $query = $pdo->prepare("SELECT game.date,result.character_name FROM result
    INNER JOIN game ON result.id = game.result_id
    WHERE game.result_id = $result AND result.id = $result
    ORDER BY game.date DESC
    LIMIT 1");

    $query->execute();
    $past = $query->fetchAll();
    
    return $past;
}