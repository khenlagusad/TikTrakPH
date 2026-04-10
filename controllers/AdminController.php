<?php
    require_once('db.php');
    require_once('models/Admin.php');

    class AdminController{
        private $adminDB;

        public function __construct() {
            global $pdo;
            $this->adminDB = new Admin($pdo);
        }

        public function showAdminLogin(){
            $error = "";
            require("views/mains/admin-login.php");
        }

        public function adminLogin() {
            if ($_SERVER['REQUEST_METHOD'] !== "POST") {
                header("Location: /test/admin");
                return;
            }

            $admin = $this->adminDB->searchAdmin($_POST['username']);
            $error = "";

            if (!$admin) {
                $error = "Admin does not exist";
            } else if (!password_verify($_POST['password'], $admin['password'])){
                $error = "Incorrect password";
            }

            if ($admin && password_verify($_POST['password'], $admin['password'])){
                $_SESSION['admin_id'] = $admin['id'];
                header("Location: /test/admin/admin-dashboard");

                return;
            }

            require("views/mains/admin-login.php");
        }

        public function showAdminDashboard(){
            Middleware::authorize();

            $admin = $this->adminDB->searchAdminByID($_SESSION['admin_id']);
            $totalUsers = $this->adminDB->getTotalUsers();
            $totalVehicles = $this->adminDB->getTotalVehicles();
            $totalTickets = $this->adminDB->getTotalTickets();
            $totalPayments = $this->adminDB->getTotalPayments();
            $unsettledDisputes = $this->adminDB->getTotalUnsettledDisputes();
            $totalEnforcers = $this->adminDB->getTotalEnforcers();

            require("views/mains/admin-dashboard.php");
        }

        public function showViewPayments(){
            Middleware::authorize();

            $admin = $this->adminDB->searchAdminByID($_SESSION['admin_id']);
            $payments = $this->adminDB->getAllPayments();

            require("views/mains/admin-view-payments.php");
        }

        public function showViewTickets(){
            Middleware::authorize();

            $admin = $this->adminDB->searchAdminByID($_SESSION['admin_id']);
            $tickets = $this->adminDB->getAllTickets();

            require("views/mains/admin-view-tickets.php");
        }

        public function showManageAdmins(){
            Middleware::authorize();

            $admin = $this->adminDB->searchAdminByID($_SESSION['admin_id']);
            $admins = $this->adminDB->getAllAdmins();

            require("views/mains/admin-manage-admins.php");
        }

        public function addAdmin(){
            Middleware::authorize();

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $firstName = trim($_POST['first_name'] ?? '');
                $lastName  = trim($_POST['last_name']  ?? '');
                $username  = trim($_POST['username']   ?? '');
                $password  = trim($_POST['password']   ?? '');

                $hashed = password_hash($password, PASSWORD_BCRYPT);

                $this->adminDB->insertAdmin([
                    'first_name' => $firstName,
                    'last_name'  => $lastName,
                    'username'   => $username,
                    'password'   => $hashed,
                ]);
            }

            header("Location: /test/admin/manage-admins");
            exit;
        }

        public function editAdmin() {
            Middleware::authorize();

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $id        = $_POST['id'];
                $firstName = trim($_POST['first_name'] ?? '');
                $lastName  = trim($_POST['last_name']  ?? '');
                $username  = trim($_POST['username']   ?? '');
                $password  = trim($_POST['password']   ?? '');

                $data = [
                    'id'         => $id,
                    'first_name' => $firstName,
                    'last_name'  => $lastName,
                    'username'   => $username,
                ];

                if (!empty($password)) {
                    $data['password'] = password_hash($password, PASSWORD_BCRYPT);
                }

                $this->adminDB->updateAdmin($data);
            }

            header("Location: /test/admin/manage-admins");
            exit;
        }

        public function deleteAdmin(){
            Middleware::authorize();

            if ($_SERVER['REQUEST_METHOD'] == "POST"){
                $id = $_POST['id'];
                $this->adminDB->deleteAdmin($id);

            }
            
            header("Location: /test/admin/manage-admins");
            exit;
        }

        public function showManageDisputes(){
            Middleware::authorize();
            $admin = $this->adminDB->searchAdminByID($_SESSION['admin_id']);

            $disputes = $this->adminDB->getAllDisputes();
            require('views/mains/admin-manage-disputes.php');
        }

        public function resolveDispute(){
            Middleware::authorize();

            if ($_SERVER['REQUEST_METHOD'] == "POST"){
                $adminId = $_SESSION['admin_id'];
                $disputeId = $_POST['id'];
                $notes = $_POST['admin_notes'];

                $this->adminDB->resolveDispute($disputeId, $adminId, $notes);
            }

            header("Location: /test/admin/manage-disputes");
            exit;
        }
        public function rejectDispute(){
            Middleware::authorize();

            if ($_SERVER['REQUEST_METHOD'] == "POST"){
                $adminId = $_SESSION['admin_id'];
                $disputeId = $_POST['id'];
                $notes = $_POST['admin_notes'];

                $this->adminDB->rejectDispute($disputeId, $adminId, $notes);
            }

            header("Location: /test/admin/manage-disputes");
            exit;
        }

        public function showManageEnforcers(){
            Middleware::authorize();
            $admin = $this->adminDB->searchAdminByID($_SESSION['admin_id']);
            $enforcers = $this->adminDB->getAllEnforcers();
            $cities = $this->adminDB->getAllCities();
            require('views/mains/admin-manage-enforcers.php');
        }
    
        public function addEnforcer() {
            Middleware::authorize();
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $this->adminDB->insertEnforcer([
                    'first_name' => trim($_POST['first_name'] ?? ''),
                    'last_name'  => trim($_POST['last_name']  ?? ''),
                    'city_id'    => $_POST['city_id']
                ]);
            }
            header("Location: /test/admin/manage-enforcers");
            exit;
        }

        public function editEnforcer() {
            Middleware::authorize();
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $this->adminDB->editEnforcer([
                    'id'         => $_POST['id'],
                    'first_name' => trim($_POST['first_name'] ?? ''),
                    'last_name'  => trim($_POST['last_name']  ?? ''),
                    'city_id'    => $_POST['city_id']
                ]);
            }
            header("Location: /test/admin/manage-enforcers");
            exit;
        }

        public function deleteEnforcer() {
            Middleware::authorize();
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $this->adminDB->deleteEnforcer($_POST['id']);
            }
            header("Location: /test/admin/manage-enforcers");
            exit;
        }

        public function showManageUsers(){
            Middleware::authorize();

            $admin = $this->adminDB->searchAdminByID($_SESSION['admin_id']);
            $users = $this->adminDB->getAllUsers();

            require("views/mains/admin-manage-users.php");
        }

        public function editUser() {
            Middleware::authorize();
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $this->adminDB->editUser([
                    'id'             => $_POST['id'],
                    'first_name'     => trim($_POST['first_name']     ?? ''),
                    'last_name'      => trim($_POST['last_name']      ?? ''),
                    'username'       => trim($_POST['username']       ?? ''),
                    'phone'          => trim($_POST['phone']          ?? ''),
                    'license_number' => trim($_POST['license_number'] ?? ''),
                    'password'       => trim($_POST['password']       ?? ''),
                ]);
            }
            header("Location: /test/admin/manage-users");
            exit;
        }

        public function deleteUser() {
            Middleware::authorize();
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $this->adminDB->deleteUser($_POST['id']);
            }
            header("Location: /test/admin/manage-users");
            exit;
        }

        public function showManageVehicles(){
            Middleware::authorize();

            $admin = $this->adminDB->searchAdminByID($_SESSION['admin_id']);
            $vehicles = $this->adminDB->getAllVehicles();
            $users = $this->adminDB->getAllUsers();

            require('views/mains/admin-manage-vehicles.php');
        }

        public function addVehicle() {
            Middleware::authorize();
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $this->adminDB->addVehicle([
                    'user_id'      => $_POST['user_id'],
                    'plate_number' => trim($_POST['plate_number'] ?? ''),
                    'brand'        => trim($_POST['brand']        ?? ''),
                    'year'         => trim($_POST['year']         ?? ''),
                    'model'        => trim($_POST['model']        ?? ''),
                    'color'        => trim($_POST['color']        ?? ''),
                ]);
            }
            header("Location: /test/admin/manage-vehicles");
            exit;
        }

        public function editVehicle() {
            Middleware::authorize();
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $this->adminDB->editVehicle([
                    'id'           => $_POST['id'],
                    'user_id'      => $_POST['user_id'],
                    'plate_number' => trim($_POST['plate_number'] ?? ''),
                    'color'        => trim($_POST['color']        ?? ''),
                ]);
            }
            header("Location: /test/admin/manage-vehicles");
            exit;
        }

        public function deleteVehicle() {
            Middleware::authorize();
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $this->adminDB->deleteVehicle($_POST['id']);
            }
            header("Location: /test/admin/manage-vehicles");
            exit;
        }

        public function showManageViolations(){
            Middleware::authorize();

            $admin = $this->adminDB->searchAdminByID($_SESSION['admin_id']);
            $violations = $this->adminDB->getAllViolations();

            require("views/mains/admin-manage-violations.php");
        }

        public function addViolation() {
            Middleware::authorize();
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $this->adminDB->addViolation([
                    'name'                => trim($_POST['name']                ?? ''),
                    'description'         => trim($_POST['description']         ?? ''),
                    'current_fine_amount' => trim($_POST['current_fine_amount'] ?? ''),
                ]);
            }
            header("Location: /test/admin/manage-violations");
            exit;
        }

        public function editViolation() {
            Middleware::authorize();
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $this->adminDB->editViolation([
                    'id'                  => $_POST['id'],
                    'name'                => trim($_POST['name']                ?? ''),
                    'description'         => trim($_POST['description']         ?? ''),
                    'current_fine_amount' => trim($_POST['current_fine_amount'] ?? ''),
                ]);
            }
            header("Location: /test/admin/manage-violations");
            exit;
        }

        public function deleteViolation() {
            Middleware::authorize();    
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $this->adminDB->deleteViolation($_POST['id']);
            }
            header("Location: /test/admin/manage-violations");
            exit;
        }

        public function adminLogout(){
            Middleware::authorize();
            session_unset();
            header("Location: /test/admin");
        }

        public function showIssueTicket() {
            Middleware::authorize();

            $admin = $this->adminDB->searchAdminByID($_SESSION['admin_id']);
            $lastTicket = $this->adminDB->getLastTicket();

            if ($lastTicket) {
                // Extract the number from e.g. "TK-2025-000001" → 1, then +1
                $lastNum = intval(substr($lastTicket['ref_number'], -6));
                $nextRefNumber = 'TIK-2025-' . str_pad($lastNum + 1, 6, '0', STR_PAD_LEFT);
            } else {
                $nextRefNumber = 'TIK-2025-000001';
            }

            $vehicles   = $this->adminDB->getAllVehicles();
            $violations = $this->adminDB->getAllViolations();
            $enforcers  = $this->adminDB->getAllEnforcers();
            $cities     = $this->adminDB->getAllCities();
            require("views/mains/admin-issue-ticket.php");
        }

        public function submitIssueTicket() {
            Middleware::authorize();
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $fineAmount = $this->adminDB->getViolationFine($_POST['violation_id']);

                $ticket = [
                    'ref_number'     => $_POST['ref_number'],
                    'plate_number'   => $_POST['plate_number'],
                    'license_number' => $_POST['license_number'],
                    'violation_id'   => $_POST['violation_id'],
                    'enforcer_id'    => $_POST['enforcer_id'],
                    'city_id'        => $_POST['city_id'],
                    'amount_due'         => $fineAmount
                ];
                $this->adminDB->insertTicket($ticket);
            }
            header("Location: /test/admin/view-tickets");
            exit;
        }
    }
?>