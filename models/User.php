<?php
    class User{
        private $pdo;

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        public function getUser($username){
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$username]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function fetchUser($userID){
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$_SESSION['user_id']]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function fetchUserVehicles($userID){
            $stmt = $this->pdo->prepare("SELECT * FROM vehicles WHERE user_id = ?");
            $stmt->execute([$_SESSION['user_id']]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function isUsernameAvailable($username){
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$username]);

            if ($stmt->rowCount() == 0) return true;
            else return false;
        } 

        public function isPhoneAvailable($phone){
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE phone = ?");
            $stmt->execute([$phone]);

            if ($stmt->rowCount() == 0) return true;
            else return false;
        }

        public function isLicenseAvailable($license_no){
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE license_number = ?");
            $stmt->execute([$license_no]);
            
            if ($stmt->rowCount() == 0) return true;
            else return false;
        }

        public function insertUser($user){
            $stmt = $this->pdo->prepare("INSERT INTO users (first_name, last_name, username, password, phone, license_number) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$user['first_name'], $user['last_name'], $user['username'], $user['password'], $user['phone'], $user['license_no']]);
        }

        public function updateUser($id, $data) {
            if (isset($data['password'])) {
                $stmt = $this->pdo->prepare("
                    UPDATE users SET username = ?, phone = ?, password = ? WHERE id = ?
                ");
                $stmt->execute([$data['username'], $data['phone'], $data['password'], $id]);
            } else {
                $stmt = $this->pdo->prepare("
                    UPDATE users SET username = ?, phone = ? WHERE id = ?
                ");
                $stmt->execute([$data['username'], $data['phone'], $id]);
            }
        }
    }
?>