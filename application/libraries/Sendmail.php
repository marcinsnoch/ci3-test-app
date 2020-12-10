<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sendmail
{
    private $ci;
    private $app_email;
    private $app_name;

    public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->library('email');
        $this->app_email = $this->ci->config->item('app_email');
        $this->app_name = $this->ci->config->item('app_name');
    }

    public function sendEmail($to, $subject, $body = "", $cc = false)
    {
        $this->ci->email->set_header('From', $this->app_email);
        $this->ci->email->from($this->app_email, $this->app_name);
        $this->ci->email->to($to);
        if ($cc) {
            $this->ci->email->cc($cc);
        }
        $this->ci->email->subject($subject);
        $this->ci->email->message($body);
        return $this->ci->email->send();
    }

    public function activationEmail($user)
    {
        $email_data = [
            'body_title' => 'Hi '. $user->full_name . '!',
            'body_top' => 'Please click the button below, to confirm your registration.',
            'btn' => [
                'name' => 'Confirm',
                'link' => site_url('auth/activation?token='.$user->token),
            ],
            'body_bottom' => 'Thank you!',
        ];
        $body = $this->ci->twig->render('emails/activation', $email_data);
        return $this->sendEmail($user->email, 'Activation email', $body);
    }

    public function confirmEmail($user)
    {
        $email_data = [
            'body_title' => 'Hi '. $user->full_name . '!',
            'body_top' => 'You account is active!',
        ];
        $body = $this->ci->twig->render('emails/activation', $email_data);
        return $this->sendEmail($user->email, 'Activation email', $body);
    }
    
    public function resetPasswordEmail($user)
    {
        $email_data = [
            'body_title' => 'Hi '. $user->full_name . '!',
            'body_top' => 'Reset Your password!',
        ];
        $body = $this->ci->twig->render('emails/activation', $email_data);
        return $this->sendEmail($user->email, 'Activation email', $body);
    }
}

/* End of file Sendmail.php */
/* Location: ./application/libraries/Sendmail.php */
