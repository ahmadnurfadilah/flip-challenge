<?php

class Transaction {
    public $conn, $id, $user_id, $slightly_id, $amount, $status, $bank_code, $account_number, $beneficiary_name, $remark, $receipt, $time_served, $fee, $created_at, $updated_at;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function get()
    {
        $datas = [];
        $sql = "SELECT * FROM transactions WHERE user_id = '$this->user_id'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $datas[] = $row;
            }
        }
        return $datas;
    }

    public function disburse()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://nextar.flip.id/disburse",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "bank_code=".$this->bank_code."&account_number=".$this->account_number."&amount=".$this->amount."&remark=".$this->remark,
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded",
            "Authorization: Basic SHl6aW9ZN0xQNlpvTzduVFlLYkc4TzRJU2t5V25YMUp2QUVWQWh0V0tadW1vb0N6cXA0MTo="
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $result = json_decode($response, true);

        $sql = "INSERT INTO transactions (user_id, slightly_id, amount, status, bank_code, account_number, beneficiary_name, remark, receipt, time_served, fee) VALUES ('$this->user_id', '$result[id]', '$result[amount]', '$result[status]', '$result[bank_code]', '$result[account_number]', '$result[beneficiary_name]', '$result[remark]', NULL, NULL, '$result[fee]')";

        $result = $this->conn->query($sql);
        if ($result) {
            return 'success';
        } else {
            return "Error: " . $this->conn->error;
        }
    }

    public function checkDisburse($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://nextar.flip.id/disburse/" . $id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Basic SHl6aW9ZN0xQNlpvTzduVFlLYkc4TzRJU2t5V25YMUp2QUVWQWh0V0tadW1vb0N6cXA0MTo="
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $result = json_decode($response, true);

        $sql = "UPDATE transactions SET status = '$result[status]', receipt = '$result[receipt]', time_served = '$result[time_served]' WHERE slightly_id = '$id'";

        $result = $this->conn->query($sql);
        if ($result) {
            return 'success';
        } else {
            return "Error: " . $this->conn->error;
        }
    }
}