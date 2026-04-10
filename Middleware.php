<?php
    class Middleware{
        public static function checkHomeInput() {
            if (!isset($_POST['plate_no']) && !isset($_POST['license_no'])) {
            header("Location: /test/");
            exit;
            }
        }


        public static function authenticate(){
            if (!isset($_SESSION['user_id'])){
                header("Location: /test/login");
                exit;
            }
        }

        public static function isLoggedIn() {
            if (isset($_SESSION['user_id'])) {
                header("Location: /test/user-dashboard");
                exit;
            }
        }

        public static function authorize(){
            if (!isset($_SESSION['admin_id'])){
                header("Location: /test/admin");
                exit;
            }
        }
    }
?>