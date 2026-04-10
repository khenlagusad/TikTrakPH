<?php
    require_once("db.php");
    require_once('models/Ticket.php');
    require_once('models/User.php');
    require_once('models/Payment.php');
    require_once('models/Disputes.php');
    require_once('Middleware.php');

    class UserController{
        private $userDB;
        private $ticketDB;
        private $paymentDB;
        private $disputesDB;

        public function __construct() {
            global $pdo;
            $this->userDB   = new User($pdo);
            $this->ticketDB = new Ticket($pdo);
            $this->paymentDB = new Payment($pdo);
            $this->disputesDB = new Disputes($pdo);
        }

        public function showUserDashboard(){
            Middleware::authenticate();
            $user = $this->userDB->fetchUser($_SESSION['user_id']);
            $vehicles = $this->userDB->fetchUserVehicles($_SESSION['user_id']);
            $tickets = $this->ticketDB->getUserTickets($user);
            require("views/mains/user-dashboard.php");
        }

        public function showUserProfile(){
            Middleware::authenticate();
            $user = $this->userDB->fetchUser($_SESSION['user_id']);
            require("views/mains/user-profile.php");
        }

        public function showEditProfile() {
            Middleware::authenticate();
            $user  = $this->userDB->fetchUser($_SESSION['user_id']);
            $error = "";

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $username = trim($_POST['username'] ?? '');
                $phone    = trim($_POST['phone']    ?? '');
                $password = trim($_POST['password'] ?? '');

                if ($user['username'] != $username && !$this->userDB->isUsernameAvailable($username)) {
                    $error = "Username is already taken.";
                } else if ($user['phone'] != $phone && !$this->userDB->isPhoneAvailable($phone)) {
                    $error = "Phone number is already taken.";
                }

                if ($error == "") {
                    $data = [
                        'username' => $username,
                        'phone'    => $phone,
                    ];

                    if (!empty($password)) {
                        $data['password'] = password_hash($password, PASSWORD_BCRYPT);
                    }

                    $this->userDB->updateUser($_SESSION['user_id'], $data);
                    header("Location: /test/user-dashboard/user-profile");
                    exit;
                }
            }

            require("views/mains/user-edit-profile.php");
        }

        public function showManageTickets(){
            Middleware::authenticate();
            $user  = $this->userDB->fetchUser($_SESSION['user_id']);
            
            $allTickets   = $this->ticketDB->getAllTickets($user);
            $unpaidTickets = array_filter($allTickets, fn($t) => !$t['payment_id'] && !$t['dispute_id']);

            require('views/mains/user-manage-tickets.php');
        }

        public function showFileDispute(){
            Middleware::authenticate();
            $user  = $this->userDB->fetchUser($_SESSION['user_id']);
            $ticket = $this->ticketDB->getTicket($_POST['ticket_id']);

            $error = "";
            require("views/mains/user-file-dispute.php");
        }

        public function payTicket(){
            Middleware::authenticate();

            if ($_SERVER['REQUEST_METHOD'] == "POST"){
                $payment = [
                    'ticket_id' => $_POST['ticket_id'],
                    'amount' => $this->ticketDB->getTicketAmount($_POST['ticket_id'])
                ];

                $this->paymentDB->insertPayment($payment);
            }

            header("Location: /test/user-dashboard/manage-tickets");
        }

        public function fileDispute(){
            Middleware::authenticate();

            if ($_SERVER['REQUEST_METHOD'] == "POST"){
                if ($this->disputesDB->alreadyFiled($_POST['ticket_id'])) {
                    $error = "A dispute has already been filed for this ticket.";
                    $user  = $this->userDB->fetchUser($_SESSION['user_id']);
                    $ticket = $this->ticketDB->getTicket($_POST['ticket_id']);
                    require("views/mains/user-file-dispute.php");
                    return;
                } else {
                    $dispute = [
                        'ticket_id' => $_POST['ticket_id'],          
                        'user_id' => $_SESSION['user_id'],          
                        'title' => $_POST['title'],
                        'explanation' => $_POST['explanation']
                    ];

                    $this->disputesDB->insertDispute($dispute);

                    header("Location: /test/user-dashboard/manage-tickets");
                    exit;
                }
            }
        }

        public function userLogout(){
            Middleware::authenticate();
            session_unset();
            header("Location: /test/");
        }
    }
?>