<?php

function getFirstQuestion(){
    $pdo = getConnexion();
    $query = $pdo->prepare("SELECT id FROM `question` WHERE first_question = 1");
    
    $query->execute();
    $firstquestions = $query->fetch();
    
    return $firstquestions;
}

function getQuestion(int $id){
    $pdo = getConnexion();
    $query = $pdo->prepare("SELECT question,id FROM `question` WHERE id = $id");
    
    $query->execute();
    $question = $query->fetchAll();
    
    return $question;
}