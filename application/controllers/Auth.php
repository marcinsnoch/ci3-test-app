<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{
    protected $models = [
        'user'
    ];

    protected $twig_globals = [
        'config'
    ];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Activate the created account
     */
    public function activation()
    {
        // check token in link
        //     correct
        //         active account
        //         email to user
        //         set msg. "wait for admin"
        //         redirect to login
        //     incorrect
        //         set msg. "error"
        //         redirect to login
    }

    /**
     * Log in in to app
     */
    public function login()
    {
        // correct
        //     set session
        //     update last login timestamp
        //     redirect to dashboard
        // incorrect
        //     error message
        //     check login attempts
        //         < 3
        //             message "try again"
        //         > 3
        //             login blocking 5 min.
        //             message "to many wrong login"
        $this->twig->display('auth/login');
    }

    /**
     * Log out from teh app
     */
    public function logout()
    {
        // session destroy
	    // redirect to login page
    }

    /**
     * Forgot the password
     */
    public function password()
    {
        // display forgot password form
        // get user email and check if exist
        // exist
            // send email: link with token
        // not exist
            // display message
        $this->twig->display('auth/password');
    }

    public function register()
    {
        // display register form
        // validate the data
        // create account
        // generate and store token
        // send email: link with activation token
        // display msg. "check your email"
        $this->twig->display('auth/register');
    }

    public function reset()
    {
        // check token in link
        // incorrect
            // show	404
        // correct
            // new password form
            // update password
		    // display message
		    // email with info
    }
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */