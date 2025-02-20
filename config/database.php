<?php
function getConnexion(){
$pdo = new PDO('mysql:host=db.3wa.io;port=3306;dbname=maxpham_akinator;charset=utf8','maxpham','9f6bead5e81907ef084af3bde9a54bca');
return $pdo;
}