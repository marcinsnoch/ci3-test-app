<?php

class Auth extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Log in to App
     */
    public function login()
    {
        // check if logged in
        $this->_logged_in();
        $this->_check_remember_me();
        if ($this->input->post('login') && $this->form_validation->run('login')) {
            $user = UserModel::where('email', $this->input->post('email'))->first();
            // check if user exist
            if (!$user) {
                alert_error('Błąd logowania!', null, "{positionClass: 'toast-top-center'}");
                redirect('login');
            }
            // check if account is activated
            if ($user->token !== null) {
                // alert: account not active
                alert_error('Twoje konto nie jest aktywowane. Sprawdź pocztę email.', null, "{positionClass: 'toast-top-center'}");
                redirect('login');
            }
            // compare input password with stored user password
            if (password_verify($this->input->post('password'), $user->password)) {
                $this->_login($user);
                $this->_remember_me($user);
                redirect();
            }
            alert_error('Błędny login lub hasło!', null, "{positionClass: 'toast-top-center'}");
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
        // del remember cookie
        delete_cookie('remember_me');
        // redirect to login page
        redirect('login');
    }

    /**
     * Forgot the password
     */
    public function forgot_password()
    {
        if ($this->input->post('send') && $this->form_validation->run('user_email')) {
            $user = UserModel::where('email', $this->input->post('email'))->first();
            $user->token = bin2hex(random_bytes(64));
            $user->save();
            $this->load->library('Sendmail');
            $this->sendmail->resetPasswordEmail($user);
            alert_success('Sprawdź skrzynkę pocztową.', null, "{positionClass: 'toast-top-center'}");
            redirect('login');
        }
        $this->twig->display('auth/forgot_password');
    }

    /**
     * Reset forgot password
     */
    public function recovery_password()
    {
        $user = UserModel::where('token', $this->input->get('token'))->first() ?? show_404();
        if ($this->input->post('recovery') && $this->form_validation->run('recovery_password')) {
            $user->password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $user->token = null;
            $user->save();
            alert_success('Password changed!', null, "{positionClass: 'toast-top-center'}");
            redirect('login');
        }
        $this->twig->display('auth/recovery_password', ['token' => $user->token]);
    }

    /**
     * Register new user
     */
    public function register()
    {
        // validate the data
        if ($this->input->post('register') && $this->form_validation->run('register_user')) {
            // create account
            $user = UserModel::create([
                'email' => $this->input->post('email'),
                'full_name' => $this->input->post('full_name'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'token' => bin2hex(random_bytes(64)),
            ]);
            // send activation email (link with token)
            $this->load->library('Sendmail');
            $this->sendmail->activationEmail($user);
            // set flash msg. "check your email..."
            alert_success('Please check your email inbox.', null, "{positionClass: 'toast-top-center'}");
            // redirect to login page
            redirect('login');
        }
        // display register form
        $this->twig->display('auth/register');
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
        $user = UserModel::where('token', $this->input->get('token'))->first();
        if (!$user) {
            // set flash msg. "error"
            alert_error('Some error occurred!', null, "{positionClass: 'toast-top-center'}");
        } else {
            // active account
            $user->token = null;
            $user->save();
            alert_success('Account activated successfully!', null, "{positionClass: 'toast-top-center'}");
            // email to user
            $this->load->library('Sendmail');
            $this->sendmail->confirmEmail($user);
        }
        // redirect to login
        redirect('login');
    }

    // Private methods

    /**
     * Set remember me
     */
    public function _remember_me(UserModel $user)
    {
        if ($this->input->post('remember_me')) {
            $random_string = bin2hex(random_bytes(64));
            $cookie = [
                'name' => 'remember_me',
                'value' => $random_string,
                'expire' => 2678400,
                'httponly' => true,
            ];
            set_cookie($cookie);
            $user->remember_me = $random_string;
            $user->save();

            return;
        }
        delete_cookie('remember_me');
        $user->remember_me = null;
        $user->save();
    }

    /**
     * Check remember me
     */
    public function _check_remember_me()
    {
        if (!get_cookie('remember_me')) {
            return;
        }
        $user = UserModel::where('remember_me', get_cookie('remember_me'))->first();
        if ($user) {
            $this->_login($user);
            redirect('home');
        }
    }

    /**
     * Login user
     */
    public function _login(UserModel $user)
    {
        $last_activity = date('Y-m-d H:i:s');
        $user->last_activity = $last_activity;
        $user->save();
        $user_data = [
            'user_id' => $user->id,
            'full_name' => $user->full_name,
            'is_admin' => $user->is_admin,
            'last_activity' => $last_activity,
            'logged_in' => true,
        ];
        $this->session->set_userdata($user_data);
    }

    /**
     * Check if is logged in
     */
    public function _logged_in()
    {
        if ((bool) $this->session->userdata('logged_in')) {
            redirect('home');
        }
    }

    /**
     * Check if email exists
     */
    public function _email_exist($email)
    {
        $user_email = UserModel::where('email', $email)->first();
        if (!$user_email) {
            $this->form_validation->set_message('_email_exist', 'Email does not exist!');

            return false;
        }

        return true;
    }
    /**
     * Check if email has been already used
     */
    public function _email_not_exist($email)
    {
        $user_email = UserModel::where('email', $email)->first();
        if ($user_email) {
            $this->form_validation->set_message('_email_not_exist', 'This email address is already registered');

            return false;
        }

        return true;
    }
}
