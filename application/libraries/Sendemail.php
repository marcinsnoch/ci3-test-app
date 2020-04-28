<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sendemail
{
    private $ci;
    private $appEmail;
    private $appEmailName;
    private $adminEmail;
    private $notifyEmails;

    public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->library('email');
        $this->appEmail = $this->ci->config->item('app_email');
        $this->appEmailName = $this->ci->config->item('app_email_name');
        $this->adminEmail = $this->ci->config->item('admin_email');
        $this->notifyEmails = $this->ci->config->item('notifi_emails');
    }

    public function sendEmail($to, $subject, $body = "", $cc = false, $admin = false)
    {
        $this->ci->email->set_header('From', $this->appEmail);
        $this->ci->email->from($this->appEmail, $this->appEmailName);
        $this->ci->email->to($to);
        if ($cc) {
            $this->ci->email->cc($cc);
        }
        $this->ci->email->subject($subject);
        $this->ci->email->message($body);
        if ($admin) {
            $this->ci->email->bcc($this->adminEmail);
        }

        return $this->ci->email->send();
    }

    public function emailToAdmin($subject = "System message", $body = "")
    {
        $this->sendEmail($this->adminEmail, $subject, $body);
    }

    public function emailToModerator($subject = "Notification", $body = "")
    {
        $this->sendEmail($this->notifyEmails, $subject, $body);
    }
}

/* End of file Sendemail.php */
/* Location: ./application/libraries/Sendemail.php */
