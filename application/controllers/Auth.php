<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{
    protected $helpers = [
        'application'
    ];

    protected $models = [
        'auth',
    ];

    protected $twig_globals = [
        'config',
        'session',
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
        if (!$this->input->get('token')) {
            show_404();
        }
        // check token in link
        $user = $this->auth->get_by('token', $this->input->get('token'));
        if (!$user) {
            // set flash msg. "error"
            set_alert('danger', 'Some error occurred!');
        } else {
            // active account
            $this->auth->update($user->id, ['token' => null]);
            set_alert('success', 'Account activated successfully!');
            // email to user
            $this->load->library('Sendmail');
            $this->sendmail->confirmEmail((array) $user);
        }
        // redirect to login
        redirect('login');
    }

    /**
     * Log in in to app
     */
    public function login()
    {
        // check if logged in
        $this->_logged_in();
        if ($this->input->post('login') && $this->form_validation->run('login')) {
            $user = $this->auth->get_by('email', $this->input->post('email'));
            // check if user exist
            if (!$user) {
                set_alert('danger', 'User does not exist!');
                redirect('login');
            }
            // check if account is activated
            if ($user->token !== null) {
                // alert: account not active
                set_alert('danger', 'Your account is not activated. Please check your email.');
                redirect('login');
            }
            // compare input pass with stored user password
            if (password_verify($this->input->post('password'), $user->password)) {
                $this->auth->login($user);
                redirect('home');
            }
        }
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
        session_destroy();
        // redirect to login page
        redirect('login');
    }

    /**
     * Forgot the password
     */
    public function password()
    {
        // display forgot password form
        // get user email and check if exist
        // exist: send email: link with token
        // not exist: display message
        $this->twig->display('auth/password');
    }

    /**
     * Register new user
     */
    public function register()
    {
        // validate the data
        if ($this->input->post('register') && $this->form_validation->run('register_user')) {
            // create account
            $user_id = $this->auth->create_user(array_from_post(['full_name', 'email', 'password']));
            if ($user_id) {
                // send activation email (link with token)
                $this->load->library('Sendmail');
                $user = $this->auth->get($user_id);
                $this->sendmail->activationEmail((array) $user);
                // set flash msg. "check your email..."
                set_alert('success', 'Please check your email inbox.');
                // redirect to login page
                redirect('login');
            }
        }
        // display register form
        $this->twig->display('auth/register');
    }

    /**
     * Reset forgot password
     */
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

    // Private methods

    public function _logged_in()
    {
        if ((bool) $this->session->userdata('logged_in')) {
            redirect('home');
        }
    }

    /**
     * Check if email has been already used
     */
    public function _email_exist($email)
    {
        if ($this->auth->count_by('email', $email)) {
            $this->form_validation->set_message('_email_exist', 'This email address is already registered');
            return false;
        }

        return true;
    }
}

// End of file Dashboard.php
// Location: ./application/controllers/Dashboard.php
