<?php
    class Admin{
        private $pdo;

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        public function searchAdmin($username){
            $stmt = $this->pdo->prepare("
                        SELECT *
                        FROM admins
                        WHERE username = ?
                    ");
            $stmt->execute([$username]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function searchAdminByID($id){
            $stmt = $this->pdo->prepare("
                        SELECT *
                        FROM admins
                        WHERE id = ?
                    ");
            $stmt->execute([$id]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getTotalUsers() {
            $stmt = $this->pdo->query("SELECT COUNT(*) FROM users");
            return $stmt->fetchColumn() ?? 0;
        }

        public function getTotalVehicles() {
            $stmt = $this->pdo->query("SELECT COUNT(*) FROM vehicles");
            return $stmt->fetchColumn() ?? 0;
        }

        public function getTotalTickets() {
            $stmt = $this->pdo->query("SELECT COUNT(*) FROM tickets");
            return $stmt->fetchColumn() ?? 0;
        }

        public function getTotalPayments() {
            $stmt = $this->pdo->query("SELECT SUM(amount_paid) FROM payments");
            return $stmt->fetchColumn() ?? 0;
        }

        public function getTotalUnsettledDisputes() {
            $stmt = $this->pdo->query("SELECT COUNT(*) FROM disputes WHERE status = 'pending'");
            return $stmt->fetchColumn() ?? 0;
        }

        public function getTotalEnforcers() {
            $stmt = $this->pdo->query("SELECT COUNT(*) FROM enforcers");
            return $stmt->fetchColumn() ?? 0;
        }

        public function getAllPayments() {
            $stmt = $this->pdo->query("
                SELECT 
                    p.id            AS payment_id,
                    CONCAT(u.first_name, ' ', u.last_name) AS payer_name,
                    p.amount_paid,
                    p.payment_date
                FROM payments p
                JOIN tickets t    ON p.ticket_id     = t.id
                JOIN users u      ON t.license_number = u.license_number
                ORDER BY p.payment_date DESC
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getAllTickets() {
            $stmt = $this->pdo->query("
                SELECT
                    t.id                                    AS ticket_id,
                    t.ref_number,
                    CONCAT(u.first_name, ' ', u.last_name)  AS user_ticketed,
                    v.name                                  AS violation_name,
                    CONCAT(e.first_name, ' ', e.last_name)  AS enforcer_name,
                    c.name                                  AS city_name,
                    t.issued_at
                FROM tickets t
                JOIN users u        ON t.license_number = u.license_number
                JOIN violations v   ON t.violation_id   = v.id
                JOIN enforcers e    ON t.enforcer_id     = e.id
                JOIN cities c       ON t.city_id         = c.id
                ORDER BY t.issued_at DESC
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getAllAdmins() {
            $stmt = $this->pdo->query("SELECT * FROM admins ORDER BY id ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insertAdmin($admin) {
            $stmt = $this->pdo->prepare("
                INSERT INTO admins (first_name, last_name, username, password)
                VALUES (?, ?, ?, ?)
            ");
            $stmt->execute([
                $admin['first_name'],
                $admin['last_name'],
                $admin['username'],
                $admin['password']
            ]);
        }

        public function updateAdmin($data) {
            if (isset($data['password'])) {
                $stmt = $this->pdo->prepare("
                    UPDATE admins 
                    SET first_name = ?, last_name = ?, username = ?, password = ?
                    WHERE id = ?
                ");
                $stmt->execute([
                    $data['first_name'],
                    $data['last_name'],
                    $data['username'],
                    $data['password'],
                    $data['id']
                ]);
            } else {
                $stmt = $this->pdo->prepare("
                    UPDATE admins 
                    SET first_name = ?, last_name = ?, username = ?
                    WHERE id = ?
                ");
                $stmt->execute([
                    $data['first_name'],
                    $data['last_name'],
                    $data['username'],
                    $data['id']
                ]);
            }
        }

        public function deleteAdmin($id) {
            $stmt = $this->pdo->prepare("DELETE FROM admins WHERE id = ?");
            $stmt->execute([$id]);
        }

        public function getAllDisputes(){
            $stmt = $this->pdo->query("SELECT 
                    d.*,
                    u.first_name,
                    u.last_name,
                    t.ref_number
                FROM disputes d
                JOIN users u ON d.user_id = u.id
                JOIN tickets t ON d.ticket_id = t.id
                ORDER BY d.submitted_at DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function resolveDispute($id, $adminId, $adminNotes = '') {
            $stmt = $this->pdo->prepare("
                UPDATE disputes 
                SET status = 'resolved', admin_id = ?, admin_notes = ?, reviewed_at = NOW()
                WHERE id = ?
            ");
            $stmt->execute([$adminId, $adminNotes, $id]);
        }

        public function rejectDispute($id, $adminId, $adminNotes = '') {
            $stmt = $this->pdo->prepare("
                UPDATE disputes 
                SET status = 'rejected', admin_id = ?, admin_notes = ?, reviewed_at = NOW()
                WHERE id = ?
            ");
            $stmt->execute([$adminId, $adminNotes, $id]);
        }

        public function getAllEnforcers(){
            $stmt = $this->pdo->query("SELECT e.*, c.name AS city_name
                FROM enforcers e
                JOIN cities c ON e.city_id = c.id
                ORDER BY e.id ASC"
            );
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getAllCities(){
            $stmt = $this->pdo->query("SELECT * FROM cities ORDER BY id ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insertEnforcer($enforcer) {
            $stmt = $this->pdo->prepare("
                INSERT INTO enforcers (first_name, last_name, city_id)
                VALUES (?, ?, ?)
            ");
            $stmt->execute([
                $enforcer['first_name'],
                $enforcer['last_name'],
                $enforcer['city_id']
            ]);
        }

        public function editEnforcer($enforcer) {
            $stmt = $this->pdo->prepare("
                UPDATE enforcers
                SET first_name = ?, last_name = ?, city_id = ?
                WHERE id = ?
            ");
            $stmt->execute([
                $enforcer['first_name'],
                $enforcer['last_name'],
                $enforcer['city_id'],
                $enforcer['id']
            ]);
        }

        public function deleteEnforcer($id) {
            $stmt = $this->pdo->prepare("DELETE FROM enforcers WHERE id = ?");
            $stmt->execute([$id]);
        }

        public function getAllUsers(){
            $stmt = $this->pdo->query("SELECT * FROM users");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function editUser($data) {
            if (!empty($data['password'])) {
                $stmt = $this->pdo->prepare("
                    UPDATE users 
                    SET first_name = ?, last_name = ?, username = ?, phone = ?, license_number = ?, password = ?
                    WHERE id = ?
                ");
                $stmt->execute([
                    $data['first_name'],
                    $data['last_name'],
                    $data['username'],
                    $data['phone'],
                    $data['license_number'],
                    password_hash($data['password'], PASSWORD_BCRYPT),
                    $data['id']
                ]);
            } else {
                $stmt = $this->pdo->prepare("
                    UPDATE users 
                    SET first_name = ?, last_name = ?, username = ?, phone = ?, license_number = ?
                    WHERE id = ?
                ");
                $stmt->execute([
                    $data['first_name'],
                    $data['last_name'],
                    $data['username'],
                    $data['phone'],
                    $data['license_number'],
                    $data['id']
                ]);
            }
        }

        public function deleteUser($id) {
            $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
            $stmt->execute([$id]);
        }

        public function getAllVehicles() {
            $stmt = $this->pdo->query("
                SELECT v.*, 
                    u.first_name, 
                    u.last_name,
                    u.username,
                    u.license_number
                FROM vehicles v
                JOIN users u ON v.user_id = u.id
                ORDER BY v.id ASC
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function addVehicle($data) {
            $stmt = $this->pdo->prepare("
                INSERT INTO vehicles (user_id, plate_number, brand, year, model, color)
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $data['user_id'],
                $data['plate_number'],
                $data['brand'],
                $data['year'],
                $data['model'],
                $data['color']
            ]);
        }

        public function editVehicle($data) {
            $stmt = $this->pdo->prepare("
                UPDATE vehicles
                SET user_id = ?, plate_number = ?, color = ?
                WHERE id = ?
            ");
            $stmt->execute([
                $data['user_id'],
                $data['plate_number'],
                $data['color'],
                $data['id']
            ]);
        }

        public function deleteVehicle($id) {
            $stmt = $this->pdo->prepare("DELETE FROM vehicles WHERE id = ?");
            $stmt->execute([$id]);
        }

        public function getAllViolations(){
            $stmt = $this->pdo->query("SELECT * FROM violations");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function addViolation($data) {
            $stmt = $this->pdo->prepare("
                INSERT INTO violations (name, description, current_fine_amount)
                VALUES (?, ?, ?)
            ");
            $stmt->execute([
                $data['name'],
                $data['description'],
                $data['current_fine_amount']
            ]);
        }

        public function editViolation($data) {
            $stmt = $this->pdo->prepare("
                UPDATE violations
                SET name = ?, description = ?, current_fine_amount = ?
                WHERE id = ?
            ");
            $stmt->execute([
                $data['name'],
                $data['description'],
                $data['current_fine_amount'],
                $data['id']
            ]);
        }

        public function deleteViolation($id) {
            $stmt = $this->pdo->prepare("DELETE FROM violations WHERE id = ?");
            $stmt->execute([$id]);
        }

        public function getLastTicket(){
            $stmt = $this->pdo->query("SELECT id, ref_number FROM tickets ORDER BY id DESC LIMIT 1");
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function insertTicket($data) {
            $stmt = $this->pdo->prepare("
                INSERT INTO tickets (ref_number, amount_due, plate_number, license_number, violation_id, enforcer_id, city_id, issued_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
            ");
            $stmt->execute([
                $data['ref_number'],
                $data['amount_due'],
                $data['plate_number'],
                $data['license_number'],
                $data['violation_id'],
                $data['enforcer_id'],
                $data['city_id'],
            ]);
        }

        public function getViolationFine($violationId) {
            $stmt = $this->pdo->prepare("SELECT current_fine_amount FROM violations WHERE id = ?");
            $stmt->execute([$violationId]);
            $violation = $stmt->fetch(PDO::FETCH_ASSOC);
            return $violation['current_fine_amount'];
        }
    }
?>