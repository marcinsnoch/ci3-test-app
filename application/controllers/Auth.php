<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{
    protected $helpers = [
        'application'
    ];

    protected $twig_globals = [
        'config',
        'session',
    ];

    public function __construct()
    {
        parent::__construct();
//        dd(password_hash('password', PASSWORD_DEFAULT));
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
        $user = User::where('token', $this->input->get('token'))->first();
        if (!$user) {
            // set flash msg. "error"
            set_alert('danger', 'Some error occurred!');
        } else {
            // active account
            $user->token = null;
            $user->save();
            set_alert('success', 'Account activated successfully!');
            // email to user
            $this->load->library('Sendmail');
            $this->sendmail->confirmEmail($user);
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
            $user = User::where('email', $this->input->post('email'))->first();
            // check if user exist
            if (!$user) {
                set_alert('danger', 'User does not exist!');
                redirect('/login');
            }
            // check if account is activated
            if ($user->token !== null) {
                // alert: account not active
                set_alert('danger', 'Your account is not activated. Please check your email.');
                redirect('/login');
            }
            // compare input pass with stored user password
            if (password_verify($this->input->post('password'), $user->password)) {
                $this->_login($user);
                redirect('/home');
            }
            set_alert('danger', 'Wrong username or password!');
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
        redirect('/login');
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
            $data = array_from_post(['email', 'full_name']);
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $data['token'] = bin2hex(random_bytes(64));
            $user = User::create($data);
            if ($user) {
                // send activation email (link with token)
                $this->load->library('Sendmail');
                $this->sendmail->activationEmail($user);
                // set flash msg. "check your email..."
                set_alert('success', 'Please check your email inbox.');
                // redirect to login page
                redirect('/login');
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

    public function _login($user)
    {
        $user_data = [
            'user_id' => $user->id,
            'full_name' => $user->full_name,
            'logged_in' => true,
        ];
        $this->session->set_userdata($user_data);
    }

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
        $user_email = User::where('email', $email)->first();
        if ($user_email) {
            $this->form_validation->set_message('_email_exist', 'This email address is already registered');
            return false;
        }

        return true;
    }
}
