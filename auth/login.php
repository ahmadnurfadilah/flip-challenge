<?php

require '../core/config.php';
require '../model/user.php';

$user = new User($conn);
$user->email = $_POST['email'];
$user->password = md5($_POST['password']);
if ($user->login() == 'success') {
    header('Location: /');
} else {
    $_SESSION['error'] = $user->login();
    header('Location: /');
}