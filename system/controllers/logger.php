<?php

namespace Lamework\Controller;

use \Lamework\Model\User;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Logger extends Core
{
    public function __construct()
    {
        parent::__construct();
        $this->page_name = "Login";
    }

    /**
     * Show the login page
     */
    public function login()
    {
        if (!empty($_POST)) {
            $this->login_user();
        }
        $this->template = "login";
    }

    /**
     * Try to log in the user
     * @return bool
     */
    private function login_user()
    {
        // Check input
        if (($_POST['username'] == '') || ($_POST['password'] == '')) {
            $this->msg_to_user = "Morate popuniti sva polja.";
        } else {
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $user = new User(array('username' => $username, 'password' => $password));

            // Make a new user
            //$user->saveToDb();

            if ($user->check()) {
                $_SESSION['username'] = $user->username;
                header('Location: /admin/manage-pages');
            } else {
                $this->msg_to_user = "Pogrešan username ili password.";
                return false;
            }
        }
    }

    /**
     * Log the user out
     */
    public function logout()
    {
        return $this->logout_user();
    }

    /**
     * Log out user from the system
     */
    public function logout_user()
    {
        // Check if user is logged in
        if ($user = $this->user_logged_in()) {
            // Remove all session variables
            session_unset();
        }
        header('Location: /login');
    }

    /**
     * Check to see if user is logged in
     * @return bool
     */
    public function user_logged_in()
    {
        if (isset($_SESSION['username'])) {
            return true;
        }
        return false;
    }
}
