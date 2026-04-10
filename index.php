<?php
    require 'controllers/AuthController.php';
    require 'controllers/UserController.php';
    require 'controllers/AdminController.php';

    session_start();
    ini_set('display_errors', 1);
    error_reporting(E_ALL); 

    $authCtrl = new AuthController();
    $userCtrl = new UserController();
    $adminCtrl = new AdminController();

    $url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

    switch($url) {

        // Auth
        case 'test':
            $authCtrl->showHomePage(); break;
        case 'test/login':
            $authCtrl->showLoginPage(); break;
        case 'test/register':
            $authCtrl->showRegisterPage(); break;
        case 'test/search-violations':
            $authCtrl->showViolationRecords(); break;

        // User
        case 'test/user-dashboard':
            $userCtrl->showUserDashboard(); break;
        case 'test/user-dashboard/user-profile':
            $userCtrl->showUserProfile(); break;
        case 'test/user-dashboard/edit-profile':
            $userCtrl->showEditProfile(); break;
        case 'test/user-dashboard/manage-tickets':
            $userCtrl->showManageTickets(); break;
        case 'test/user-dashboard/pay-ticket':
            $userCtrl->payTicket(); break;
        case 'test/user-dashboard/file-dispute':
            $userCtrl->showFileDispute(); break;
        case 'test/user-dashboard/submit-dispute':
            $userCtrl->fileDispute(); break;
        case 'test/user-dashboard/logout':
            $userCtrl->userLogout(); break;

        // Admin
        case 'test/admin':
            $adminCtrl->showAdminLogin(); break;
        case 'test/admin/login':
            $adminCtrl->adminLogin(); break;
        case 'test/admin/admin-dashboard':
            $adminCtrl->showAdminDashboard(); break;
        case 'test/admin/admin-dashboard/logout':
            $adminCtrl->adminLogout(); break;
        case 'test/admin/issue-ticket':
            $adminCtrl->showIssueTicket(); break;
        case 'test/admin/issue-ticket/submit':
            $adminCtrl->submitIssueTicket(); break;
        case 'test/admin/view-payments':
            $adminCtrl->showViewPayments(); break;
        case 'test/admin/view-tickets':
            $adminCtrl->showViewTickets(); break;
        case 'test/admin/manage-admins':
            $adminCtrl->showManageAdmins(); break;
        case 'test/admin/manage-admins/add':
            $adminCtrl->addAdmin(); break;
        case 'test/admin/manage-admins/edit':
            $adminCtrl->editAdmin(); break;
        case 'test/admin/manage-admins/delete':
            $adminCtrl->deleteAdmin(); break;
        case 'test/admin/manage-disputes':
            $adminCtrl->showManageDisputes(); break;
        case 'test/admin/manage-disputes/resolve':
            $adminCtrl->resolveDispute(); break;
        case 'test/admin/manage-disputes/reject':
            $adminCtrl->rejectDispute(); break;
        case 'test/admin/manage-enforcers':
            $adminCtrl->showManageEnforcers(); break;
        case 'test/admin/manage-enforcers/add':
            $adminCtrl->addEnforcer(); break;
        case 'test/admin/manage-enforcers/edit':
            $adminCtrl->editEnforcer(); break;
        case 'test/admin/manage-enforcers/delete':
            $adminCtrl->deleteEnforcer(); break;
        case 'test/admin/manage-users':
            $adminCtrl->showManageUsers(); break;
        case 'test/admin/manage-users/edit':
            $adminCtrl->editUser(); break;
        case 'test/admin/manage-users/delete':
            $adminCtrl->deleteUser(); break;
        case 'test/admin/manage-vehicles':
            $adminCtrl->showManageVehicles(); break;
        case 'test/admin/manage-vehicles/add':
            $adminCtrl->addVehicle(); break;
        case 'test/admin/manage-vehicles/edit':
            $adminCtrl->editVehicle(); break;
        case 'test/admin/manage-vehicles/delete':
            $adminCtrl->deleteVehicle(); break;
        case 'test/admin/manage-violations':
            $adminCtrl->showManageViolations(); break;
        case 'test/admin/manage-violations/add':
            $adminCtrl->addViolation(); break;
        case 'test/admin/manage-violations/edit':
            $adminCtrl->editViolation(); break;
        case 'test/admin/manage-violations/delete':
            $adminCtrl->deleteViolation(); break;
    }
?>