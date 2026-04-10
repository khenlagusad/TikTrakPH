<?php
    class Disputes{
        private $pdo;

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        public function insertDispute($dispute){
            $stmt = $this->pdo->prepare("
                INSERT INTO disputes (ticket_id, user_id, title, explanation)
                VALUES (?, ?, ?, ?)
            ");

            $stmt->execute([$dispute['ticket_id'], $dispute['user_id'], $dispute['title'], $dispute['explanation']]);
        }

        public function alreadyFiled($ticket_id){
            $stmt = $this->pdo->prepare("SELECT * FROM disputes WHERE ticket_id = ?");
            $stmt->execute([$ticket_id]);

            return $stmt->rowCount() > 0;
        }
    }

?>