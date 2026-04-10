<?php
    require_once('db.php');
    require_once('models/Ticket.php');
    require_once('models/User.php');
    require_once('Middleware.php');
    class AuthController{
        private $ticketDB;
        private $userDB;

        public function __construct() {
            global $pdo;
            $this->ticketDB = new Ticket($pdo);
            $this->userDB = new User($pdo);
        }
        public function showHomePage(){
            require("views/mains/homepage.php");
        }

        public function showLoginPage(){
            Middleware::isLoggedIn();
            $error = "";
    
            if ($_SERVER['REQUEST_METHOD'] == "POST"){
                $username = trim($_POST['username'] ?? '');
                $password = trim($_POST['password'] ?? '');

                $user = $this->userDB->getUser($username);
            
                if (!$user){
                    $error = "User does not exist";
                } else if (!password_verify($password, $user['password'])){
                    $error = "Incorrect password";
                }

                if ($user && password_verify($password, $user['password'])){
                    $_SESSION['user_id'] = $user['id'];
                    header("Location: /test/user-dashboard");
                    exit;
                }
            }

            require("views/mains/login.php");
        }

        public function showRegisterPage(){
            $success = "";
            $error = "";
            
            if ($_SERVER['REQUEST_METHOD'] == "POST"){
                $firstName  = trim($_POST['first_name']  ?? '');
                $lastName   = trim($_POST['last_name']   ?? '');
                $username   = trim($_POST['username']    ?? '');
                $password   = trim($_POST['password']    ?? '');
                $phone      = trim($_POST['phone']       ?? '');
                $licenseNo  = strtoupper(trim($_POST['license_no'] ?? ''));

                if (!$this->userDB->isUsernameAvailable($username)) {
                    $error = "Username is already taken";
                } else if (!$this->userDB->isPhoneAvailable($phone)) {
                    $error = "Phone number is already taken";
                } else if (!$this->userDB->isLicenseAvailable($licenseNo)) {
                    $error = "License number is already registered to a User";
                } else {
                    $hashed = password_hash($password, PASSWORD_BCRYPT);
                    $user = [
                        'first_name' => $firstName,
                        'last_name'  => $lastName,
                        'username'   => $username,
                        'password'   => $hashed,
                        'phone'      => $phone,
                        'license_no' => $licenseNo
                    ];
                    $this->userDB->insertUser($user);
                    $success = "Successfully created account";
                }
            }

            require("views/mains/register.php");
        }

        public function showViolationRecords(){
            $plate   = trim($_POST['plate_no']   ?? '');
            $license = trim($_POST['license_no'] ?? '');

            Middleware::checkHomeInput();

            $tickets = $this->ticketDB->getActiveTickets($plate, $license);

            require("views/mains/violations.php");
        }
    }
?>