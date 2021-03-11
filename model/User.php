<?php

class User
{
    private string $_userId;
    private string $_password;

    public function __construct(array $data)
    {
        $this->setUserId($data['userId']);
        $this->setPassword($data['password']);
    }

    public function getUserId()
    {
        return $this->_userId;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function setUserId(string $userId)
    {
        if ($userId != '') {
            $this->_userId = htmlspecialchars($userId);
        } else {
            throw new Exception('UserId cannot be empty.');
        }
    }

    public function setPassword(string $password)
    {
        if ($password != '') {
            $this->_password = htmlspecialchars($password);
        } else {
            throw new Exception('UserId cannot be empty.');
        }
    }
}
