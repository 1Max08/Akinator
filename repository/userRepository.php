<?php 
function getUsers(): array|bool
{
        $pdo = getConnexion();
        
        $query = $pdo->prepare('SELECT * FROM users');
        
        $query->execute();
        
        $users = $query->fetchAll();
        
        return $users;
}
function getUserByEmail(string $email): array|bool
{
        $pdo = getConnexion();
        
        $query = $pdo->prepare('SELECT * FROM users WHERE email=?');
        

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
        

        $query = $pdo->prepare("INSERT INTO users (username,email ,  password) VALUES (?, ?, ?)");
        

        $query->execute([$username,$email,$password]);
        

        $newData = $query->fetch();
        
        return $newData;
}

function getResultId(int $password, int $userId) {
    $pdo = getConnexion();
    
    $query = $pdo->prepare("UPDATE `user` SET `password`= $password WHERE id = $userId");

    $query->execute();
    $newPassword = $query->fetchAll();
    
    return $newPassword;
}

