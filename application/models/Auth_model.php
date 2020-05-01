<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends MY_Model
{
    public $_table = 'users';

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('auth');
    }

    public function create_user($data)
    {
        $data['token'] = generate_token();
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $this->create($data);
    }

    public function login($user)
    {
        $user_data = [
            'user_id' => $user->id,
            'full_name' => $user->full_name,
            'logged_in' => true,
        ];
        $this->session->set_userdata($user_data);
    }
}

/* End of file Auth_model.php */
/* Location: ./application/models/Auth_model.php */
