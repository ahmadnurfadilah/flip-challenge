<?php

require 'core/config.php';


$sellers = "CREATE TABLE sellers (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    balance BIGINT(20) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

$transactions = "CREATE TABLE transactions (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    slightly_id BIGINT(20) NOT NULL,

    amount BIGINT(20) NOT NULL,
    status VARCHAR(255) NOT NULL,
    bank_code VARCHAR(255) NOT NULL,
    account_number VARCHAR(255) NOT NULL,
    beneficiary_name VARCHAR(255) NOT NULL,
    remark VARCHAR(255) NOT NULL,
    receipt VARCHAR(255) NULL,
    time_served TIMESTAMP NULL,
    fee BIGINT(20) NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

$users = [
    ['User 1', 'user1@gmail.com', 'user1', 1000000],
    ['User 2', 'user2@gmail.com', 'user2', 1000000],
];

$usersSeed = '';
foreach ($users as $user) {
    $name = $user[0];$email = $user[1];$password = md5($user[2]);$balance = 1000000;
    $usersSeed .= "INSERT INTO sellers (name, email, password, balance) VALUES ('$name', '$email', '$password', '$balance');";
}

$conn->query($sellers);
$conn->query($transactions);
$conn->multi_query($usersSeed);

?>