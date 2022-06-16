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
            'body_title' => 'Witaj '. $user->full_name . '!',
            'body_top' => 'Kliknij poniższy przycisk, aby potwierdzić rejestrację.',
            'btn' => [
                'name' => 'Potwierdzam',
                'link' => site_url('auth/activation?token='.$user->token),
            ],
            'body_bottom' => 'Administrator',
        ];
        $body = $this->ci->twig->render('emails/auth', $email_data);
        return $this->sendEmail($user->email, 'Email aktywacyjny', $body);
    }

    public function confirmEmail($user)
    {
        $email_data = [
            'body_title' => 'Witam '. $user->full_name . '!',
            'body_top' => 'Twoje konto jest juz aktywne!',
        ];
        $body = $this->ci->twig->render('emails/auth', $email_data);
        return $this->sendEmail($user->email, 'Email potwierdzający', $body);
    }

    public function resetPasswordEmail($user)
    {
        $email_data = [
            'body_title' => 'Witaj '. $user->full_name . '!',
            'body_top' => 'Kliknij poniższy przycisk, aby zresetować hasło.',
            'btn' => [
                'name' => 'Resetuj hasło',
                'link' => site_url('recovery-password?token='.$user->token),
            ],
            'body_bottom' => 'Administrator',
        ];
        $body = $this->ci->twig->render('emails/auth', $email_data);
        return $this->sendEmail($user->email, 'Resetowanie hasła', $body);
    }

    public function deliveryConfirmationEmail($user, $product)
    {
        $email_data = [
            'body_title' => 'Witaj '. $user->full_name . '!',
            'body_top' => 'Potwierdzam dostawę produktu: <b>' . $product->number . ' - ' .$product->name .'</b>, do magazymu.<br> Aktualny stan po dostawie: '. $product->quantity,
            'body_bottom' => 'Administrator',
        ];
        $body = $this->ci->twig->render('emails/delivery', $email_data);
        return $this->sendEmail($user->email, 'Potwierdzenie dostawy', $body);
    }
}

/* End of file Sendmail.php */
/* Location: ./application/libraries/Sendmail.php */
