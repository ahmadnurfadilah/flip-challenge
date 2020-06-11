<?php

class User {
    public $conn;
    public $id;
    public $name;
    public $email;
    public $password;
    public $balance;
    public $created_at;
    public $updated_at;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getBalance($id)
    {
        $sql = "SELECT balance FROM sellers WHERE id = '$id'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc()['balance'];
        }
        return 0;
    }

    public function decBalance($uid, $amount)
    {
        $sql = "UPDATE sellers SET balance = balance - '$amount' WHERE id = '$uid'";
        $this->conn->query($sql);
    }

    public function login()
    {
        $sql = "SELECT * FROM sellers WHERE email = '$this->email' AND password = '$this->password'";
        $result = $this->conn->query($sql);

        if ($result == TRUE) {
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['status'] = 'login';

                return 'success';
            } else {
                return "Email atau password salah";
            }
        } else {
            return "Error: " . $this->conn->error;
        }
    }
}