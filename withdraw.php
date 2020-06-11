<?php

require 'core/config.php';
require 'model/user.php';
require 'model/transaction.php';

$uid = $_SESSION['id'];

if (isset($_GET['status']) && $_GET['status'] == 'check') {
    $id = $_GET['id'];
    $transaction = new Transaction($conn);
    $check = $transaction->checkDisburse($id);
    if ($check == 'success') {
        header('Location: /history.php');
    } else {
        $_SESSION['error'] = $check;
        header('Location: /history.php');
    }
} else {
    $user = new User($conn);
    $balance = $user->getBalance($uid);

    if ($balance >= $_POST['amount']) {
        $transaction = new Transaction($conn);
        $transaction->user_id = $uid;
        $transaction->bank_code = $_POST['bank_code'];
        $transaction->account_number = $_POST['account_number'];
        $transaction->amount = $_POST['amount'];
        $transaction->remark = $_POST['remark'];
        $disburse = $transaction->disburse();
        if ($disburse == 'success') {
            $user->decBalance($uid, $_POST['amount']);
            header('Location: /history.php');
        } else {
            $_SESSION['error'] = $disburse;
            header('Location: /');
        }
    } else {
        $_SESSION['error'] = 'Saldo tidak cukup, saldo Anda: Rp' . number_format($balance);
        header('Location: /');
    }
}