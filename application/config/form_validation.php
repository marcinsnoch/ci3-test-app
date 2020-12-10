<?php

$config = [
    'login' => [
        ['field' => 'email', 'label' => 'Email', 'rules' => 'required|trim|valid_email'],
        ['field' => 'password', 'label' => 'Password', 'rules' => 'trim|required'],
    ],
    'user_email' => [
        ['field' => 'email', 'label' => 'Email', 'rules' => 'required|trim|valid_email|callback__email_exist'],
    ],
    'reset_password' => [
        ['field' => 'password', 'label' => 'Password', 'rules' => 'required|trim|min_length[8]'],
        ['field' => 'passconf', 'label' => 'Password confirm', 'rules' => 'required|trim|matches[password]'],
    ],
    'register_user' => [
        ['field' => 'full_name', 'label' => 'Full name', 'rules' => 'required|trim'],
        ['field' => 'email', 'label' => 'Email', 'rules' => 'required|trim|valid_email|callback__email_not_exist'],
        ['field' => 'password', 'label' => 'Password', 'rules' => 'trim|required'],
        ['field' => 'passconf', 'label' => 'Password confirm', 'rules' => 'required|trim|matches[password]'],
    ],
];

$config['error_prefix'] = '<span class="help-block">';
$config['error_suffix'] = '</span>';
