<?php 
function getuser(): array|bool
{
        $pdo = getConnexion();
        
        $query = $pdo->prepare('SELECT * FROM user');
        
        $query->execute();
        
        $user = $query->fetchAll();
        
        return $user;
}
function getUserByEmail(string $email): array|bool
{
        $pdo = getConnexion();
        
        //préparation de la requête
        $query = $pdo->prepare('SELECT * FROM user WHERE email=?');
        
        $query->execute([$email]);
        
        $user = $query->fetch();
        
        return $user;
}

function insertData($username,$email,$password): array|bool
{
$user = getUserByEmail($email);
    if ($user) {
        throw new Exception("Cet email est déjà utilisé.");
    }
        $pdo = getConnexion();

        $query = $pdo->prepare("INSERT INTO user (username,email ,  password) VALUES (?, ?, ?)");

        $query->execute([$username,$email,$password]);

        $newData = $query->fetch();
        
        return $newData;
}

