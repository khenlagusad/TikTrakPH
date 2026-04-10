<?php
    class Payment{
        private $pdo;

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        public function insertPayment($payment){
            $ticketId = $payment['ticket_id'];
            $amountPaid = $payment['amount'];

            $stmt = $this->pdo->prepare("
                INSERT INTO payments (ticket_id, amount_paid) 
                VALUES (?, ?)
            ");

            $stmt->execute([$ticketId, $amountPaid]);
        }
    }
?>