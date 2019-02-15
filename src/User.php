<?php

class User
{
    private $id;

    private $userName;

    private $hashPass;

    private $email;

    public function __construct()
    {
        $this->id = -1;
        $this->userName = '';
        $this->email = '';
        $this->hashPass = '';
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getHashPass()
    {
        return $this->hashPass;
    }

    public function setHashPass($newPass)
    {
        $newHashedPass = password_hash($newPass, PASSWORD_BCRYPT);
        $this->hashPass = $newHashedPass;

        return $this;
    }

    public function setUserName(string $userName)
    {
        $this->userName = $userName;

        return $this;
    }

    public function setEmail(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Nie poprawny format adresu email');
        }

        $this->email = $email;

        return $this;
    }

    public function saveToDB(PDO $conn)
    {
        if (-1 === $this->id) {
            $stmt = $conn->prepare('INSERT INTO users (username, email, hash_pass) VALUES (:username, :email, :pass)');

            try {
                $stmt->execute([
                    'email' => $this->email,
                    'pass' => $this->hashPass,
                    'username' => $this->userName,
                ]);
            } catch (PDOException $exception) {
                throw new \Exception('Błąd podczas dodawania użytkownika do bazy: ');
            }
            $this->id = $conn->lastInsertId();

            return true;
        }

        return false;
    }
}
