<?php
    class Ticket{
        private $pdo;

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }
        public function getActiveTickets($plate, $license){
            if ($plate != '') {
                $stmt = $this->pdo->prepare("
                    SELECT t.*, v.name AS violation_name
                    FROM tickets t
                    JOIN violations v ON t.violation_id = v.id
                    LEFT JOIN payments p ON t.id = p.ticket_id
                    LEFT JOIN disputes d ON t.id = d.ticket_id
                    WHERE t.plate_number = ?
                    AND p.ticket_id IS NULL
                    AND (d.ticket_id IS NULL OR d.status = 'rejected' OR d.status = 'pending')
                ");
                $stmt->execute([$plate]);
            } else {
                $stmt = $this->pdo->prepare("
                    SELECT t.*, v.name AS violation_name
                    FROM tickets t
                    JOIN violations v ON t.violation_id = v.id
                    LEFT JOIN payments p ON t.id = p.ticket_id
                    LEFT JOIN disputes d ON t.id = d.ticket_id
                    WHERE t.license_number = ?
                    AND p.ticket_id IS NULL
                    AND (d.ticket_id IS NULL OR d.status = 'rejected' OR d.status = 'pending')
                ");
                $stmt->execute([$license]);
            }

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }   

        public function getUserTickets($user){
            $stmt = $this->pdo->prepare("
                SELECT t.*, v.name AS violation_name, v.current_fine_amount, c.name AS city_name, d.status AS dispute_status
                FROM tickets t
                JOIN violations v ON t.violation_id = v.id
                JOIN cities c ON t.city_id = c.id
                LEFT JOIN payments p ON t.id = p.ticket_id
                LEFT JOIN disputes d ON t.id = d.ticket_id
                WHERE (
                    t.license_number = ?
                    OR t.plate_number IN (
                        SELECT plate_number FROM vehicles WHERE user_id = ?
                    )
                )
                AND p.ticket_id IS NULL
                AND (d.status IS NULL OR d.status != 'resolved')
                ORDER BY t.issued_at DESC
            ");
            
            $stmt->execute([$user['license_number'], $user['id']]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getAllTickets($user) {
            $stmt = $this->pdo->prepare("
                SELECT 
                    t.*,
                    v.name AS violation_name,
                    v.current_fine_amount,
                    c.name AS city_name,
                    p.id AS payment_id,
                    d.id AS dispute_id,
                    d.status AS dispute_status
                FROM tickets t
                JOIN violations v ON t.violation_id = v.id
                JOIN cities c ON t.city_id = c.id
                LEFT JOIN payments p ON t.id = p.ticket_id
                LEFT JOIN disputes d ON t.id = d.ticket_id
                WHERE (
                    t.license_number = ?
                    OR t.plate_number IN (
                        SELECT plate_number FROM vehicles WHERE user_id = ?
                    )
                )
                ORDER BY t.issued_at DESC
            ");
            $stmt->execute([$user['license_number'], $user['id']]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getTicketAmount($ticketId) {
            $stmt = $this->pdo->prepare("
                SELECT v.current_fine_amount
                FROM tickets t
                JOIN violations v ON t.violation_id = v.id
                WHERE t.id = ?
            ");
            $stmt->execute([$ticketId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['current_fine_amount'] : null;
        }

        public function getTicket($ticketId){
            $stmt = $this->pdo->prepare("
                SELECT *
                FROM tickets
                WHERE id = ?
            ");

            $stmt->execute([$ticketId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>